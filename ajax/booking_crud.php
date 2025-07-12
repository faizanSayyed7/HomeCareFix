<?php
require("../admin/component/essential.php");
require("../admin/component/db_config.php");
require ('../vendor/vendor/autoload.php');

session_start();

date_default_timezone_set('Asia/Kolkata');
// UserData
$user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
$user_data = mysqli_fetch_assoc($user_res);
$user_id = $user_data['id'];

if(isset($_POST['get_bookings'])) {
    $today_date = new DateTime(); // Get current date and time
    $today_date_string = $today_date->format('Y-m-d'); // Format as 'YYYY-MM-DD'
    $query = "SELECT `booking_id`, `appointment`, `booking_status`, `order_id`, `trans_amt`, `trans_status` FROM `booking_order` WHERE `user_id` = ? AND DATE(`datetime`) = ? ORDER BY `datetime` DESC";
    $values = [$user_id , $today_date_string];
    $res = select($query, $values, 'is');

    while ($row = mysqli_fetch_assoc($res)) {
        $transaction_status = "<span class='badge bg-warning text-dark'><i class='bi bi-x-lg'> </i>$row[trans_status]</span>";
        $booking_assign ="<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Not Confrim yet!..</span>";
        $refresh="";
        if($row['trans_status'] == "FAILED"){
            $transaction_status = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Failed...</span>";
        }else if($row['trans_status'] == "EXPIRED"){
            $transaction_status = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Expired</span>";
        }else if($row['trans_status'] == "ACTIVE"){
            $transaction_status = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Active</span>";
            $refresh = "<button onclick='payments_status(\"$row[order_id]\")' class='btn btn-secondary btn-sm shadow-none'><i class='bi bi-arrow-clockwise'></i>Refresh</button>";
        }else if($row['trans_status'] == "PAID"){
            $transaction_status = "<span class='badge bg-success'><i class='bi bi-check-lg'> </i>Paid</span>";
            if($row['booking_status'] == "pending"){
                $booking_assign = "<span class='badge bg-danger'><i class='bi bi-x-lg'> </i>Not Confrim yet!..</span>";
            }else if($row['booking_status'] == "confrim"){
                $booking_assign = "<span class='badge bg-success'>Booking Confrimed</span>";
            }
        }else if($row['trans_status'] == "pending"){
            $refresh = "<button onclick='payments_status(\"$row[order_id]\")' class='btn btn-secondary btn-sm shadow-none'><i class='bi bi-arrow-clockwise'></i>Refresh</button>";
        }

        echo <<<data
        <tr>
            <td><button onclick='view_order($row[booking_id])' data-bs-toggle='modal' data-bs-target='#view_order' class='btn btn-info'><i class='bi bi-list-task'></i></button></td>
            <td>$row[appointment]</td>
            <td>$booking_assign</td>
            <td>$transaction_status</td>
            <td>₹ $row[trans_amt]</td>
            <td>$refresh</td>
        </tr>
        data;
    }
}


if(isset($_POST['get_old_bookings'])) {

    $today_date = new DateTime(date('Y-m-d H:i:m'));
    $query = "SELECT `booking_id`, `appointment`, `trans_amt` 
    FROM `booking_order` 
    WHERE `user_id` = ? AND `booking_status` = ?  
    ORDER BY `datetime` DESC";
    
    $res = select($query,[$user_id,'confrim'], 'is');

    while ($row = mysqli_fetch_assoc($res)) {
        $appointment_date = new DateTime(date($row['appointment']));
        if($today_date > $appointment_date){
            echo <<<data
            <tr>
                <td><button onclick='view_order($row[booking_id])' data-bs-toggle='modal' data-bs-target='#view_order' class='btn btn-info'><i class='bi bi-list-task'></i></button></td>
                <td>$row[appointment]</td>
                <td>
                    <span class="badge rounded-pill bg-white">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </span>
                </td>
                <td>₹ $row[trans_amt]</td>
            </tr>
            data;
        }
    }
}
function fetch_payment_details($link_id) {
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', "https://sandbox.cashfree.com/pg/links/$link_id", [
        'headers' => [
            'accept' => 'application/json',
            'x-api-version' => '2023-08-01',
            'x-client-id' => "TEST101583890bdf9fb02d324bc3fa4298385101",
            'x-client-secret' => "cfsk_ma_test_3fcd0fff2a7b6b65d4111b1f96a7170d_cb76a5ba",
            'x-request-id' => "TEST101583890bdf9fb02d324bc3fa4298385101",
        ],
    ]);
    return $response->getBody();
}

    if(isset($_POST['payments_status'])){
        $frm_data = filteration($_POST);
        $link_id = $frm_data['payments_status'];
        $payments_details = fetch_payment_details($link_id);
        $payment_details_response_data = json_decode($payments_details, true);

        if (isset($payment_details_response_data['cf_link_id'])) {
            $link_status = $payment_details_response_data['link_status'];

            // Update the booking_order table with the payment status
            $update_query = "UPDATE `booking_order` SET `trans_status` = ? WHERE `order_id` = ?";
            $update_values = [$link_status, $link_id];
            $update_result = update($update_query, $update_values, 'ss');

            if ($update_result) {
                echo 1;
            } else {
                echo "Failed_to_update_payment_status";
            }
        } else {
            echo "Failed_to_fetch_payment_details";
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


   
?>