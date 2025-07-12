function get_users() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('user-data').innerHTML = this.responseText;
    }
    xhr.send('get_users');
}


function toggle_status(id,val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if(this.responseText==1){
            alert('success','Status toogled');
            get_users();
        }else{
            alert('error','Server Down');
        }
    }
    xhr.send('toggle_status='+id+'&value='+val);
}

function del_user(id){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if(this.responseText==1){
            alert('success','User Removed');
            get_users();
        }else{
            alert('error','Server Down');
        }
    }
    xhr.send('del_user='+id);
}

function del_user(id){
    if(confirm("Are You Sure, you want to remove this User?")){
        let data = new FormData();
        data.append('user_id', id);
        data.append('del_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users_crud.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'User Removed');
                get_users();
            } else {
                alert('error', 'Failed to Remove');
            }
        }
        xhr.send(data);
    }
}

function search_user(value){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('user-data').innerHTML = this.responseText;
    }
    xhr.send('search_user&value=' + value);
}

window,onload = function(){
    get_users();
}