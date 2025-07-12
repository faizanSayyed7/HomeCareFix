<?php

session_start();

require("../admin/component/essential.php");
require("../admin/component/db_config.php");
require ('../vendor/vendor/autoload.php');

date_default_timezone_set('Asia/Kolkata');

function cashfree_payment($name, $email, $phone, $link_id, $link_amount) {
    $client = new \GuzzleHttp\Client();

    // Calculate expiration time 5 minutes from now in ISO 8601 format
    $expiration_time = date('c', strtotime('+5 minutes'));
    
    $response = $client->request('POST', 'https://sandbox.cashfree.com/pg/links', [
        'body' => json_encode([
            'customer_details' => [
                'customer_phone' => $phone,
                'customer_email' => $email,
                'customer_name' => $name
            ],
            'link_notify' => [
                'send_sms' => false,
                'send_email' => true
            ],
            'link_id' => $link_id,
            'link_amount' => $link_amount,
            'link_currency' => 'INR',
            'link_purpose' => 'Payment for Service',
            'link_expiry_time' => $expiration_time, // Set the expiration time
            'link_meta' => [ 
                'return_url' => SITE_URL // Specify your return URL here
            ]
        ]),
        'headers' => [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-api-version' => '2023-08-01',
            'x-client-id' => 'TEST101583890bdf9fb02d324bc3fa4298385101',
            'x-client-secret' => 'cfsk_ma_test_3fcd0fff2a7b6b65d4111b1f96a7170d_cb76a5ba',
            'x-request-id' => 'TEST101583890bdf9fb02d324bc3fa4298385101',
        ],
    ]);
    
    return $response->getBody();    
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


    
// Payments Gateways code
if(isset($_POST['payment_getway'])){
    $frm_data = filteration($_POST);
    $name = $frm_data['name'];
    $phone = $frm_data['phone'];
    $email = $frm_data['mail'];
    $link_id = 'order'.uniqid();
    $link_amount = $frm_data['total_amount'];
    $appointment_date = $frm_data['date'];
    $appointment_time = $frm_data['time'];
    $appointment = $appointment_date. ' ' .$appointment_time;

    $payment_response = cashfree_payment($name, $email, $phone, $link_id, $link_amount);
    $payment_response_data = json_decode($payment_response, true);

    if(isset($payment_response_data['cf_link_id'])) {
        $url = $payment_response_data['link_url'];
        
        // Insert into booking_order table
        $query = "INSERT INTO `booking_order`(`user_id`, `appointment`, `order_id`, `trans_amt`) VALUES (?,?,?,?)";
        $values = [$_SESSION['uId'],$appointment,$link_id, $link_amount];
        $booking_inserted = insert($query, $values, 'issi');
        
        if($booking_inserted) {
            // Select the row based on order_id to fetch booking_id
            $select_query = "SELECT `booking_id` FROM `booking_order` WHERE `order_id` = ?";
            $booking_row = select($select_query, [$link_id], 's');
            
            if($booking_row && mysqli_num_rows($booking_row) > 0) {
                $booking_data = mysqli_fetch_assoc($booking_row);
                $booking_id = $booking_data['booking_id'];
                
                // Insert into booking_order_service table for each service in the cart
                foreach($_SESSION['cartData'] as $item) {
                    $service_id = $item['cardId']; // Assuming cardId corresponds to service_id
                    
                    // Insert into booking_order_service table
                    $query = "INSERT INTO `booking_order_service`(`booking_id`, `service_id`) VALUES (?,?)";
                    $values = [$booking_id, $service_id];
                    $service_inserted = insert($query, $values, 'ii');
                    
                    if(!$service_inserted) {
                        echo "service_insert_fail";
                        exit; // Exit the loop if insertion fails
                    }
                } 
                // All services inserted successfully
                echo $url;
            } else {
                echo "booking_not_found";
            }
        } else {
            echo "booking_insert_fail";
        }
    } else {
        echo "connect_to_internet";
    }
}


    
?>