<script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>

<script>
    function alert(type , msg, position='body'){
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;

        if(position == 'body'){
            document.body.append(element);
            element.classList.add('custom-alert');
        }else{
            document.getElementById(position).appendChild(element);
        }
        
        setTimeout(remAlert, 2000);
    }

    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }
</script>

<script>
    function setAction(){
        let navbar = document.getElementById('dashboard-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >=0 ){
                a_tags[i].classList.add('active');
            }
        }
    }
    setAction();
</script>
