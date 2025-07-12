<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../admin/component/essential.php");
require("../admin/component/db_config.php");
require("../vendor/PHPMailer/Exception.php");
require("../vendor/PHPMailer/PHPMailer.php");
require("../vendor/PHPMailer/SMTP.php");
date_default_timezone_set('Asia/Kolkata');

function sendmail($email, $token, $type){

    if($type == 'email_confrim'){
        $page = 'email_confrim.php';
        $subject = "HomeCareFix please verify your accout";
        $content = "Thank you for signing up with HomeCareFix! We're thrilled to have you onboard.<br><br>
        To complete your registration and start enjoying our services for beauty, hardware repair, and home cleaning, please click the button below to verify your email:
        <br><br>";
    }else{
        $page = 'index.php';
        $subject = "HomeCareFix password reset link";
        $content = "We received a request to reset your password at HomeCareFix. If you did not make this request, you can ignore this email.<br><br>
        To reset your password, please click the button below:
        <br><br>";
    }

    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';  // Changed to Google SMTP
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'newupdatesintech@gmail.com';  // Change to your Gmail 
        $mail->Password   = 'sawn oxxx ubxq fulv';  // Change to app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('newupdatesintech@gmail.com', 'Newupdates');  // Update to Gmail
        $mail->addAddress($email);     //Add a recipient
        
    
        //Content
        $mail->isHTML(true);                               
        $mail->Subject = $subject;
        $mail->Body    = "
        <html>
        <body>
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='font-size: 24px; font-weight: bold; color: #FF5733;'>Welcome to HomeCareFix!</div>
                <div style='font-size: 18px; margin-top: 20px;'>
                    $content
                    <a href='".SITE_URL."$page?$type&email=$email&token=$token' style='display: inline-block; background-color: #FF5733; color: white; font-size: 20px; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px;'>Verify Email</a>
                    <br><br>
                    If the button above doesn't work, you can also copy and paste the following link into your browser's address bar:
                    <br>
                    ".SITE_URL."$page?$type&email=$email&token=$token
                    <br><br>
                    We're excited to have you join our community!
                    <br><br>
                    Best regards,<br>
                    The HomeCareFix Team
                </div>
            </div>
        </body>
        </html>";
    
        if ($mail->send()){
            return 1;
        }else{
            return 0;
        }
    } catch (Exception $e) {
        return 0;
    }
}



if(isset($_POST['signup'])){

    $data = filteration(($_POST));

    // matching Pass and Confirm pass

    if($data['pass'] != $data['cpass']){
        echo "pass_missmatch";
        exit;
    }

    // User Existenence

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email'], $data['phonenum']],'ss');

    if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Email Verification

    $token = bin2hex(random_bytes(16));
    if (!sendmail($data['email'], $token, "email_confrim")){
        echo "mail_failed";
        exit;
    }
    
    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `password`, `token`) VALUES (?,?,?,?,?,?,?)";

    $values = [$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode'],$enc_pass,$token];

    if(insert($query , $values, 'sssssss')){
        echo 1;
    }else{
        echo 'ins_failed';
    }
}

if(isset($_POST['signin'])){
    $data = filteration($_POST);

    // User Existenence

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email_mob'], $data['email_mob']],'ss');

    if(mysqli_num_rows($u_exist)==0){
        echo 'inval_email_mob';
    }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }else if($u_fetch['status']==0){
            echo 'inactive';
        }else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
                echo 'invalid_pass';
            }else{
                session_start();
                $_SESSION['signin'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['u_name'] = $u_fetch['name'];
                $_SESSION['uphone'] = $u_fetch['phonenum'];
                echo 1;
            }
        }
    }
    
}

if(isset($_POST['forgot_pass'])){
    $data = filteration($_POST);

    // User Existenence

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",
    [$data['email']],'s');

    if(mysqli_num_rows($u_exist)==0){
        echo 'inval_email';
    }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }else if($u_fetch['status']==0){
            echo 'inactive';
        }else{
            $token = bin2hex(random_bytes(16));
            if(!sendmail($data['email'], $token, "accouunt_recovery")){
                echo "mail_failed";
            }else{
                $date = date("Y-m-d");
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token',`t_expire`='$date' WHERE `id`='$u_fetch[id]'");

                if($query){
                    echo 1;
                }else{
                    echo "update_failed";
                }
            }
            }
        }
}

if(isset($_POST['recovery_user'])){
    $data = filteration($_POST);

    // User Existenence
    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `password`=?,`token`=?,`t_expire`=? WHERE `email`=? AND `token`=?";

    $values = [$enc_pass, null, null,$data['email'],$data['token']];

    if(update($query,$values,'sssss')){
        echo 1;
    }else{
        echo "failed";
    }
}
    
?>