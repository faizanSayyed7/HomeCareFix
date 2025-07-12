<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();
if(isset($_POST['get_bookings'])) 
{
    $query = "SELECT `booking_id`, `user_id`, `appointment`, `booking_status`, `order_id`, `trans_amt`, `trans_status`, `datetime` FROM `booking_order` WHERE `booking_status`=?";
    $values = ['confrim'];
    $res = select($query, $values, 's');
            
        while ($row = mysqli_fetch_assoc($res)){
            $transaction_status = "<span class='badge bg-success text-white'><i class='bi bi-check-lg'> </i>$row[trans_status]</span>";

            $move_btn="";
        
            $booking_assign = "<span class='badge bg-success'>Booking Confrimed</span>";
            

            
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
                </tr>
                data;
                // onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")'
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