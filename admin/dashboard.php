<?php
require("component/essential.php");
require("component/db_config.php");
adminLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require("component/links.php");
    ?>
    <title>Admin Pannel - Dashboard</title>
</head>

<body bg-light>
    
    <?php
    require("component/header.php");

    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));

    $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT
    COUNT(booking_id) AS `total_booking`,
    COUNT(CASE WHEN booking_status='pending' AND trans_status='PAID' THEN 1 END) AS `new_bookings`
    FROM `booking_order`"));


    $un_read_quries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id)AS `count` FROM `user_inqueries` WHERE `seen`=0"));

    $total_services_quries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id)AS `service` FROM `services` WHERE `removed`=0"));

    $current_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT
    COUNT(id) AS `total`,
    COUNT(CASE WHEN `status`= 1 THEN 1 END) AS `active`,
    COUNT(CASE WHEN `status`= 0 THEN 1 END) AS `inactive`,
    COUNT(CASE WHEN `is_verified`= 0 THEN 1 END) AS `unverified` 
    FROM `user_cred`"));
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between">
                    <h3>DASHBOARD</h3>
                    <?php
                    if($is_shutdown['shutdown']){
                        echo<<<data
                        <h6 class="badge bg-danger py-2 px-3 rounded">Shutdown Mode is Active!</h6>
                        data;
                    }
                    ?>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="newbooking.php" class="text-decoration-none">
                            <div class="card text-center p-3 text-success shadow">
                                <h6>New Bookings</h6>
                                <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings']?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="bookings_record.php" class="text-decoration-none">
                            <div class="card text-center p-3 text-warning shadow">
                                <h6>Total Bookings</h6>
                                <h1 class="mt-2 mb-0"><?php echo $current_bookings['total_booking']?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="user_inquries.php" class="text-decoration-none">
                            <div class="card text-center p-3 text-info shadow">
                                <h6>User Queries</h6>
                                <h1 class="mt-2 mb-0"><?php echo $un_read_quries['count']?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="users.php" class="text-decoration-none">
                            <div class="card text-center p-3 text-primary shadow">
                                <h6>Total Services</h6>
                                <h1 class="mt-2 mb-0"><?php echo $total_services_quries['service']?></h1>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5>Booking Analytics</h5>
                    <select class="form-select shadow-none bg-light w-auto" aria-label="Default select example" onchange="booking_analytics(this.value)">
                        <option selected>Past 30 Days</option>
                        <option value="1">Past 90 Days</option>
                        <option value="2">Past 1 Year</option>
                        <option value="3">All time</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-primary shadow">
                            <h6>Confrim Bookings</h6>
                            <h1 class="mt-2 mb-0" id="total_booking">150</h1>
                            <h4 class="mt-2 mb-0" id="total_amt"> ₹535698</h4>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-danger shadow">
                            <h6>Failed Bookings</h6>
                            <h1 class="mt-2 mb-0" id="failed_total_booking">150</h1>
                            <h4 class="mt-2 mb-0" id="failed_total_amt"> ₹535698</h4>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <h5>Users</h5>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-info shadow">
                            <h6>Total</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['total']?></h1>
            
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-success shadow">
                            <h6>Active</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['active']?></h1>
                            
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-warning shadow">
                            <h6>Inactive Users</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['inactive']?></h1>
                            
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">   
                        <div class="card text-center p-3 text-danger shadow">
                            <h6>unverified Users</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['unverified']?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require("component/scripts.php");
    ?>
    
    <script src="scripts/dashboard.js"></script>
</body>

</html>