<?php


require("../admin/component/essential.php");
require("../admin/component/db_config.php");

if(isset($_POST['info_form'])){
    $frm_data = filteration($_POST);
    session_start();

    $u_exist = select("SELECT * FROM `user_cred` WHERE `phonenum`=? AND `id`!=? LIMIT 1",[$frm_data['phonenum'],$_SESSION['uId']],'ss');

    if(mysqli_num_rows($u_exist)!=0){
        echo "phone_already";
        exit;
    }

    $query = "UPDATE `user_cred` SET `name`=?,`address`=?,`phonenum`=?,`pincode`=? WHERE `id`=?";
    $values = [$frm_data['name'],$frm_data['address'], $frm_data['phonenum'],$frm_data['pincode'],$_SESSION['uId']];

    if(update($query,$values,'ssssi')){
        $_SESSION['u_name'] = $frm_data['name'];
        echo 1;
    }else{
        echo 0;
    }
}

?>