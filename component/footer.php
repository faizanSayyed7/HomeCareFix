<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="fw-bold fs-3 text-white mb-2">HomeCareFix</h3>
            <p>

            <?php
                if($settings_r['site_about']){
                    $description = $settings_r['site_about'];
                    echo <<< data
                        $description
                    data;
                }
            ?>
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3 text-danger fw-bold">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-primary text-decoration-none">Home</a> <br>
            <a href="contact.php" class="d-inline-block mb-2 text-primary text-decoration-none">Contact us</a> <br>
            <a href="about.php" class="d-inline-block mb-2 text-primary text-decoration-none">About Us</a>
        </div>
        <div class="col-lg-4 p-4">
            <h3 class="mb-3 text-white">Follow us</h3>
            <?php
                if($contact_r['twt']!=''){
                echo <<<data
                    <a href="$contact_r[twt]?>" class="d-inline-block text-white text-decoration-none">
                    <i class="bi bi-twitter-x me-2"></i>
                    X
                    </a> <br><br>
                data;
                }
            ?>
            
            <a href="<?php echo $contact_r['fb']?>" class="d-inline-block text-white text-decoration-none">
                <i class="bi bi-facebook me-2"></i>
                Facebook
            </a> <br><br>
            <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-white text-decoration-none">
                <i class="bi bi-instagram me-2"></i>
                Instagram
            </a>
        </div>
    </div>
</div>
<h6 class="text-center text-white p-3 m-0">Copyright © 2048 Home Care Fix., Ltd. All rights reserved. Design & Developed By NopeNoss</h6>


<script src="vendor/swipperjs/swiper-bundle.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.js"></script>


<script>

    function search_service(value){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/search_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('search-data').innerHTML = this.responseText;
        }
        xhr.send('search_service&value=' + value);
    }


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
        setTimeout(remAlert, 3000);
    }

    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }



    function setAction(){
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >=0 ){
                a_tags[i].classList.add('active');
            }
        }
    }

    let signup_form = document.getElementById('signup-form');

    signup_form.addEventListener('submit', function(e){
        e.preventDefault();

        let data = new FormData();

        data.append('name',signup_form.elements['name'].value);
        data.append('email',signup_form.elements['email'].value);
        data.append('phonenum',signup_form.elements['phonenum'].value);
        data.append('pincode',signup_form.elements['pincode'].value);
        data.append('address',signup_form.elements['address'].value);
        data.append('pass',signup_form.elements['pass'].value);
        data.append('cpass',signup_form.elements['cpass'].value);
        data.append('signup', "");

        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/signin_signup.php", true);

        xhr.onload = function () {

            var myModal = document.getElementById('registerModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            

            if(this.responseText == "pass_missmatch"){
                alert('error', "Password Mismatched");
            }else  if(this.responseText == "email_already"){
                alert('error', "Mail Already Exists");
            }else if(this.responseText == "phone_already"){
                alert('error','Phone Number Already Registered');
            }else if(this.responseText == "mail_failed"){
                alert('error','Cannot send confirmation email server down');
            }else if(this.responseText == "ins_failed"){
                alert('error','Failed to register');
            }else{
                alert('success',"Registration successfull. Confirmation link send to email!");
                signup_form.reset();
                modal.hide();
            }
        }
        xhr.send(data);
    });


    // login

    let signin_form = document.getElementById('login-form');

    signin_form.addEventListener('submit', function(e){
        e.preventDefault();

        let data = new FormData();

        data.append('email_mob',signin_form.elements['email_mob'].value);
        data.append('pass',signin_form.elements['pass'].value);
        data.append('signin', "");

        
        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/signin_signup.php", true);

        xhr.onload = function () {
            if(this.responseText == "inval_email_mob"){
                alert('error', "Invalid email or phone");
            }else  if(this.responseText == "not_verified"){
                alert('error', "Mail is not verified");
            }else if(this.responseText == "inactive"){
                alert('error','Sorry you were banned by us!');
            }else if(this.responseText == "invalid_pass"){
                alert('error','Wrong password, please retry correct one!');
            }else{
                window.location =window.location.pathname + window.location.search;
            }
        }
        xhr.send(data);
    });

    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit', function(e){
        e.preventDefault();

        let data = new FormData();

        data.append('email',forgot_form.elements['email'].value);
        data.append('forgot_pass', "");

        
        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/signin_signup.php", true);

        xhr.onload = function () {
            if(this.responseText == "inval_email"){
                alert('error', "Invalid email");
            }else  if(this.responseText == "not_verified"){
                alert('error', "Mail is not verified, Please verify first!");
            }else if(this.responseText == "inactive"){
                alert('error','Sorry you were banned by us!');
            }else if(this.responseText == "mail_failed"){
                alert('error','Failed to send mail, Server Down!');
            }else if(this.responseText == "update_failed"){
                alert('error','password reset failed');
            }else{
                alert('success','link send successfully!');
                forgot_form.reset();
            }
        }
        xhr.send(data);
    });

    function checkLoginToBook(status){
        if(status){
            window.location.href = 'confirm_booking.php';
        }else{
            alert('error',"Please Login First!");
        }
    }

    setAction();


</script>