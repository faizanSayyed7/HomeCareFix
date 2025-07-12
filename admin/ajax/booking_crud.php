<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../component/essential.php");
require("../component/db_config.php");
require("../vendor/PHPMailer/Exception.php");
require("../vendor/PHPMailer/PHPMailer.php");
require("../vendor/PHPMailer/SMTP.php");

date_default_timezone_set('Asia/Kolkata');

adminLogin();
if(isset($_POST['get_services'])) 
{   

    $query = "SELECT bo.`booking_id`, bo.`user_id`, bo.`appointment`, bo.`booking_status`, bo.`order_id`, bo.`trans_amt`, bo.`trans_status`, bo.`datetime`, uc.`email` 
    FROM `booking_order` AS bo
    INNER JOIN `user_cred` AS uc ON bo.`user_id` = uc.`id`
    WHERE bo.`m_to_r`=? AND bo.`booking_status`=?";
    $values = [0,'pending'];
    $res = select($query, $values, 'is');
            
    while ($row = mysqli_fetch_assoc($res)){
        $transaction_status = "<span class='badge bg-warning text-dark'><i class='bi bi-x-lg'> </i>$row[trans_status]</span>";
        $booking_assign="";
        $move_btn="";
        if($row['trans_status'] == "FAILED"){
            $transaction_status = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Failed...</span>";
            $booking_assign = "<button onclick='toggle_status($row[booking_id])' class='btn btn-secondary btn-sm shadow-none' disabled>Confrim Booking?</button>";
            $move_btn = "<button onclick='move_to_rec($row[booking_id])' class='btn btn-dark'><i class='bi bi-arrows-move'></i></button>";
        }else if($row['trans_status'] == "EXPIRED"){
            $transaction_status = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Exipred</span>";
            $booking_assign = "<button onclick='toggle_status($row[booking_id])' class='btn btn-secondary btn-sm shadow-none' disabled>Confrim Booking?</button>";
            $move_btn = "<button onclick='move_to_rec($row[booking_id])' class='btn btn-dark'><i class='bi bi-arrows-move'></i></button>";
        }else if($row['trans_status'] == "PAID"){
            $transaction_status = "<span class='badge bg-success'><i class='bi bi-check-lg'> </i>Paid</span>";
            if($row['booking_status'] == "pending"){
                $booking_assign = "<button onclick='toggle_status($row[booking_id], \"$row[appointment]\", \"$row[email]\", \"$row[order_id]\")' class='btn btn-secondary btn-sm shadow-none'>Confirm Booking?</button>";
            }else if($row['booking_status'] == "confrim"){
                $booking_assign = "<span class='badge bg-success'>Booking Confrimed</span>";
            }
        }else if($row['trans_status'] == "pending"){
            $booking_assign = "<button onclick='toggle_status($row[booking_id])' class='btn btn-secondary btn-sm shadow-none' disabled>Confrim Booking?</button>";
        }
        echo <<<data
            <tr>
            <td>$row[user_id]</td>
            <td>$row[appointment]</td>
            <td>$row[order_id]</td>
            <td>₹ $row[trans_amt]</td>
            <td>$transaction_status</td>
            <td>$booking_assign</td>
            <td>$row[datetime]</td>
            <td><button onclick='view_order($row[booking_id])' data-bs-toggle='modal' data-bs-target='#view_order' class='btn btn-info'><i class="bi bi-list-task"></i></button>
            </td>
            <td>$move_btn</td>
            </tr>
            data;
        }
    }

    if(isset($_POST['toggle_status'])){
        $frm_data = filteration($_POST);
       
        $q = "UPDATE `booking_order` SET `booking_status`=? WHERE `booking_id`=?";
        $v = ['confrim',$frm_data['toggle_status']];
        $upd = update($q, $v, 'si');
        
        if ($upd && sendmailconfrim($frm_data['email'], $frm_data['appoint'], $frm_data['ordid'])){
            echo 1;
        }else{
            echo 0;
        }
    }

    if(isset($_POST['move_to_rec'])){
        $frm_data = filteration($_POST);
        
        $res1 = update("UPDATE `booking_order` SET `m_to_r`=? WHERE `booking_id`=?",[1,$frm_data['book_id']],'ii');
        
        if($res1){
            echo 1;
        }else{
            echo 0;
        }
    }

    if(isset($_POST['view_order'])){
        $frm_data = filteration($_POST);
        $q = "SELECT bos.booking_id, bos.service_id, s.service_name, s.price
        FROM booking_order_service AS bos
        INNER JOIN services AS s ON bos.service_id = s.id
        WHERE bos.booking_id=?";
        
        $values = [$frm_data['view_order']];
        $data = select($q,$values,'i');
        $i=1;

        while ($row = mysqli_fetch_assoc($data)){
            
            echo <<<data
                <tr>
                <td>$i</td>
                <td>$row[service_name]</td>
                <td>$row[price]</td>
                </tr>
            data;
            $i++;
        }
    }

    function sendmailconfrim($email, $appointment, $order_id){
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'homecarefix@outlook.com';                     //SMTP username
            $mail->Password   = '123456789';                               //Dummy password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('homecarefix@outlook.com', 'HomeCareFix');
            $mail->addAddress($email);     //Add a recipient
            
        
            //Content
            $mail->isHTML(true);       
            $mail->Subject = "Booking Confrimation";
            $mail->Body    = "
            <html>
            <body>
                <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                    <div style='font-size: 24px; font-weight: bold; color: #FF5733;'>Welcome to HomeCareFix!</div>
                    <div style='font-size: 18px; margin-top: 20px;'>
                        Dear Customer,<br><br>
                        We are pleased to inform you that your booking with HomeCareFix has been confirmed successfully.<br>
                        Here are the details of your booking:<br><br>
                        <strong>Appointment Date & Time:</strong>$appointment<br>
                        <strong>Order ID:</strong>$order_id<br><br>
                        Your payment has been received and processed successfully. You can expect our service personnel to arrive at your specified location on time.<br><br>
                        If you have any questions or need further assistance, feel free to contact us. Thank you for choosing HomeCareFix for your service needs.<br><br>
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
?>