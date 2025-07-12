<?php

    require("admin/component/essential.php");
    require("admin/component/db_config.php");

    if(isset($_GET['email_confrim'])){
        $data = filteration($_GET);

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? LIMIT 1",[$data['email'],$data['token']],'ss');

        if(mysqli_num_rows($query) == 1){
            $fetch = mysqli_fetch_assoc($query);

            if($fetch['is_verified']==1){
                echo"<script>alert('Email Alredy Verified by us!')</script>";
            }else{
                $update = update("UPDATE `user_cred` SET `is_verified`=? WHERE `id`=?",[1,$fetch['id']],'ii');
                if($update){
                    echo "<script>alert('Mail Verification Done!')</script>";
                }else{
                    echo "<script>alert('Mail Verification Failed Server Down')</script>";
                }
            }
            redirect('index.php');
        }else{
            echo "<script>alert('Invalid Link')</script>";
            redirect('index.php');
        }
    }


?>