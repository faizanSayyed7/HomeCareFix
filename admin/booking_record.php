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
    <title>Admin Panel - Bookings</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2"><i class="bi bi-record-circle"> </i>Bookings Records!</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive-md" style="height: 555px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">User Id</th>
                                        <th scope="col">Appointment</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Transaction Amt(₹)</th>
                                        <th scope="col">Transaction Status</th>
                                        <th scope="col">Booking Status</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">View order</th>
                                    </tr>
                                </thead>
                                <tbody id="booking-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="view_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-top">
        <table class="table table-hover">
            <thead class="sticky-top">
                <tr class="bg-dark text-white">
                    <th scope="col">#</th>
                    <th scope="col">Services</th>
                    <th scope="col">Price(₹)</th>
                </tr>
            </thead>
            <tbody id="view-data">

            </tbody>
        </table>
    </div>
  </div>
</div>



    <script>
    
        function get_bookings() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_records.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('booking-data').innerHTML = this.responseText;
            }
            xhr.send('get_bookings');
        }

        function view_order(booking_id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_records.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('view-data').innerHTML = this.responseText;
            }
            xhr.send('view_order=' + booking_id);
        }

        

    window.onload = function () {
        get_bookings();
    }


    </script>

    <?php
    require("component/scripts.php");
    ?>


</body>

</html>