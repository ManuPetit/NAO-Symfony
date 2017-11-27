function filter(){
    var statusOwner = document.getElementById('filter_status');
    var index = statusOwner.selectedIndex;
    var status = statusOwner.value;
    var search = document.getElementById('search_name').value;
    var my_url = '/gestion-article';
    if (index > 1 && search !== ''){
        my_url = my_url + '?filter=' + status + '&search=' + search;
    } else if (index > 1){
        my_url = my_url + '?filter=' + status;
    } else if (search !== '') {
        my_url = my_url + '?search=' + search;
    }
    window.location.href = my_url;
}

function search()
{
    document.getElementById('search_name').focus();
    return false;
}

function masquer(id)
{
    var status = 4;
    update(id,status);
}

function publier(id)
{
    var status = 3;
    update(id, status);
}

function update(id, status)
{
    $.ajax({
        type:'POST',
        url:'/update-status-post/' + id + '/' + status,
        cache:false,
        success:function(data) {
            location.href = '/gestion-article';
        }
    });
}