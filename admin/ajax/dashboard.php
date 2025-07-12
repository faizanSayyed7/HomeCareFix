<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();
if(isset($_POST['booiing_analytics'])) 
{
    $frm_data = filteration($_POST);

    $condition='';

    if($frm_data['period']==1){
        $condition="WHERE datetime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
    }elseif($frm_data['period']==2){
        $condition="WHERE datetime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
    }elseif($frm_data['period']==3){
        $condition="WHERE datetime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
    }

    $results = mysqli_fetch_assoc(mysqli_query($con, "SELECT
    COUNT(CASE WHEN booking_status='confrim' AND trans_status='PAID' THEN 1 END) AS `total_booking`,
    COUNT(CASE WHEN booking_status='pending' AND trans_status!='PAID' THEN 1 END) AS `failed_total_booking`,
    SUM(CASE WHEN trans_status='PAID' THEN trans_amt ELSE 0 END) AS `total_amt`,
    SUM(CASE WHEN trans_status!='PAID' THEN trans_amt ELSE 0 END) AS `failed_total_amt`
    FROM `booking_order` $condition"));

    $output = json_encode($results);
    echo $output;
}
   
?>