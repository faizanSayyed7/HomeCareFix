<?php

require("../admin/component/essential.php");
require("../admin/component/db_config.php");

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['check_validity'])){
    $frm_data = filteration($_POST);

    $status = "";
    $results = "";

    // Check schedule date validity
    $today_date = new DateTime(date('Y-m-d'));
    $schedule_date = new DateTime($frm_data['date_val']);

    if($schedule_date < $today_date){
        $status = 'schedule_date_earlier';
        $results = json_encode(["status"=> $status]);
    }else{
        $status = 'all_correct';
        $results = json_encode(["status"=> $status]);
    }
    // Output results
    echo $results;
}


?>