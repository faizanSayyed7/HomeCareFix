<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('component/links.php');
    ?>
    <link rel="stylesheet" href="assets/css/contact_style.css">
    <title>HomeCareFix - CONTACTUS</title>
</head>

<body class="bg-light">

    <header>
        <?php require("component/navbar.php");
        ?>
    </header>

    <section>
        <div class="container heading">
            <div class="my-5 px-4">
                <div class="col-12 my-5 mb-4 px-1">
                    <h1 class="fw-bold">Contact Us</h1>
                    <div style="font-size: 20px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="services.php?+" class="text-secondary text-decoration-none">Contact us</a>
                    </div>
                </div>
                <p class="text-center mt-3">
                We value your feedback, questions, and inquiries, and we're here to assist you in any way we can. Whether you have a query about our services, need assistance with booking an appointment, or simply want to share your thoughts with us, we're just a message away. Feel free to reach out to our dedicated customer support team, and we'll do our best to provide you with prompt and helpful assistance.
                </p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4">
                        <iframe height="320px" class="w-100 mb-4 4rounded"
                            src="<?php echo $contact_r['iframe']?>"
                            loading="lazy"></iframe>
                        <h5 class="fw-bold">Address</h5>
                        
                        <a class="d-inline-block text-decoration-none text-dark mb-4"
                            href="<?php echo $contact_r['google_map']?>"><i class="bi bi-geo-alt-fill me-2"></i><?php echo $contact_r['address']?></a>
                        <h5 class="mb-2 fw-bold">Call Us</h5>
                        <a href="tel: +<?php echo $contact_r['phone1']?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                                class="bi bi-telephone-fill me-2"></i>+<?php echo $contact_r['phone1']?></a>
                        <br>
                        <?php
                            if($contact_r['phone2']!=''){
                            echo <<<data
                                <a href="tel: +$contact_r[phone2]" class="d-inline-block text-decoration-none text-dark"><i
                                class="bi bi-whatsapp me-2"></i>+$contact_r[phone2]</a>
                            data;
                            }
                        ?>
                        
                        <h5 class="mt-4 fw-bold">Email</h5>
                        <i class="bi bi-envelope-at-fill"></i>
                        <a class="d-inline-block text-decoration-none text-dark mb-4"
                            href="mail to: <?php echo $contact_r['email']?>"><?php echo $contact_r['email']?></a>
                        <h5 class="mb-2 fw-bold">Follow Us</h5>
                        <?php
                            if($contact_r['twt']!=''){
                            echo <<<data
                                <a href="$contact_r[twt]" class="d-inline-block mb-3 text-dark fs-6 me-2">
                                <i class="bi bi-twitter-x me-2"></i>
                            </a>
                            data;
                            }
                        ?>
                        

                        <a href="<?php echo $contact_r['fb']?>" class="d-inline-block mb-3 text-dark fs-6 me-2">
                            <i class="bi bi-facebook me-2"></i>
                        </a>

                        <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-dark fs-6">
                            <i class="bi bi-instagram me-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 px-4">
                    <div class="bg-white rounded shadow p-4">
                        <form method="POST">
                            <h5>Send Mesage To Us</h5>
                            <div class="mt-3">
                                <label class="form-label fw-bold" >Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label fw-bold" >Email address</label>
                                <input name="email" type="email" class="form-control shadow-none" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label fw-bold" >Subject</label>
                                <input name="subject" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label fw-bold">Message</label>
                                <textarea name="message" class="form-control shadow-none" rows="5" style="resize: none;" required></textarea>
                            </div>
                            <button name="send" type="submit" class="btn btn-dark shadow mt-3">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        if(isset($_POST['send'])){
            $frm_data = filteration($_POST);

            $q = "INSERT INTO `user_inqueries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
            $res = insert($q,$values,'ssss');
            if($res==1){
                alert('success','Send Sucessfully!');
            }else{
                alert('error','Server Down!');
            }
        }
    ?>

    <footer>
        <?php require("component/footer.php");
        ?>
    </footer>
</body>

</html>