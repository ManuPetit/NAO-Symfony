function update(id){
    var owner = document.getElementById('ms' + id);
    var status = owner.value;
    $.ajax({
        type:'POST',
        url:'/update-status-obs/' + id + '/' + status,
        cache:false,
        success:function(data) {
            location.href = '/gestion-observation';
        }
    });
}

function filter(){
    var statusOwner = document.getElementById('filter_status');
    var index = statusOwner.selectedIndex;
    var status = statusOwner.value;
    var search = document.getElementById('search_name').value;
    var my_url = '/gestion-observation';
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