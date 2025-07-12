<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require ('component/links.php');
    ?>
    <link rel="stylesheet" href="assets/css/booking_style.css">
    <title>HomeCareFix - PROFILE</title>
</head>

<body class="bg-light">

    <header>
        <?php require ("component/navbar.php");
        ?>
    </header>

    <?php
    if ($settings_r['shutdown']) {
        redirect('services.php');
    } else if (!(isset ($_SESSION['signin']) && $_SESSION['signin'] == true) && isset($_SESSION['cartData'])) {
        redirect('index.php');
    }

    //cartdata



    // UserData
    
    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
    $user_data = mysqli_fetch_assoc($user_res);



    ?>

    <section>
        <div class="container-fluid heading">
            <div class="row ps-5">
                <div class="col-12 my-5 mb-1 px-4">
                    <h2 class="fw-bold">Profile</h2>
                    <div style="font-size: 24px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-secondary text-decoration-none">Profile</a>
                    </div>
                </div>

                

                <div class="col-12 my-5 col-md-12 px-4">
                    <div class="bg-white p-3 p-mb-4 rounded shadow-sm">
                        <form id='info-form'>
                            <h5 class="mb-3 fw-bold">Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input name="name" type="text" id="name_inp" value="<?php echo $user_data['name'] ?>"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input name="phonenum" id="phone_inp" type="number"
                                        value="<?php echo $user_data['phonenum'] ?>"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input name="email" id="email_inp" type="email" value="<?php echo $user_data['email'] ?>"
                                        class="form-control shadow-none" required disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Pincode</label>
                                    <input name="pincode" id="pincode_inp" type="number" value="<?php echo $user_data['pincode'] ?>"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <small class="bg-warning rounded-pill">Please Enter Accruate Address, Our executives will arrive here!</small>
                                    <textarea name="address" id="address_inp" class="form-control shadow-none" rows="2"
                                        style="resize: none;"
                                        required><?php echo $user_data['address'] ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success text-white shadow-none">Save Changes</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php require ("component/footer.php");
        ?>
    </footer>

    <script>
        let info_form =document.getElementById('info-form');

        info_form.addEventListener('submit', function(e){
            e.preventDefault();

            
            let data = new FormData();
            data.append('info_form','');
            data.append('name',info_form.elements['name'].value);
            data.append('phonenum',info_form.elements['phonenum'].value);
            data.append('pincode',info_form.elements['pincode'].value);
            data.append('address',info_form.elements['address'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function () {
                if (this.responseText == 'phone_already') {
                    alert('error','Phone Number already exists');
                }else if(this.responseText == 0){
                    alert('error','no changes read!');
                }else{
                    alert('success', 'Changes saved!');
                }
            }
        xhr.send(data);
    });


    </script>
</body>

</html>