function search()
{
    document.getElementById('search_name').focus();
    return false;
}

function filter(){
    var statusOwner = document.getElementById('filter_status');
    var index = statusOwner.selectedIndex;
    var status = statusOwner.value;
    var search = document.getElementById('search_name').value;
    var my_url = '/gestion-membre';
    if (index > 1 && search !== ''){
        my_url = my_url + '?filter=' + status + '&search=' + search;
    } else if (index > 1){
        my_url = my_url + '?filter=' + status;
    } else if (search !== '') {
        my_url = my_url + '?search=' + search;
    }
    window.location.href = my_url;
}

function publier(role,user)
{
    $.ajax({
        type:'POST',
        url:'/update_user_role/' + user + '/' + role,
        cache:false,
        success:function(data) {
            location.href = '/gestion-membre';
        }
    });
}

function activer(user)
{
    var name = 'us' + user;
    var owner = document.getElementById(name);
    var value = owner.value;
    //message avant suppression
    if (value == 3)
    {
        if (!confirm('Etes vous certain de vouloir supprimer cet utilisateur ?'))
        {
            window.location.href = '/gestion-membre';
            return;
        }
    }
    $.ajax({
       type: 'POST',
       url: '/update_user_status/' + user + '/' + value,
       cache: false,
        success:function(data) {
            location.href = '/gestion-membre';
        }
    });
}

/*
user_update_user_role:
    path: /update_user_role/{id}/{role}
defaults: { _controller: UserBundle:Admin:updateUserRole }

user_update_user_status:
    path: /update_user_status/{id}/{status}
defaults: { _controller: UserBundle:Admin:updateUserStatus }
*/