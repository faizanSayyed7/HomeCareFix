<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require ('component/links.php');
    ?>
    <link rel="stylesheet" href="assets/css/booking_style.css">
    <title>HomeCareFix - MY BOOKINGS</title>
</head>

<body class="bg-white">

    <header>
        <?php require ("component/navbar.php");
        ?>
    </header>

    <?php
    if ($settings_r['shutdown']) {
        redirect('services.php');
    } else if (!(isset ($_SESSION['signin']) && $_SESSION['signin'] == true) && isset($_SESSION['cartData'])) {
        redirect('index.php');
    }


    ?>

    <section>
        <div class="container-fluid heading">
            <div class="row ps-5">
                <div class="col-12 my-5 mb-4 px-4">
                    <h2 class="fw-bold">My Booking!</h2>
                    <div class="mb-2" style="font-size: 24px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-secondary text-decoration-none">Bookings</a>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 px-4">
                    <div id="serviceTable">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">Service view</th>
                                    <th scope="col">Appointment At</th>
                                    <th scope="col">Booking Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Total Spend</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="booking-data">
                        
                            </tbody>
                        </table>
                    </div>
                </div>

             

                <div class="col-12 my-5 mb-4 px-4">
                    <h2 class="fw-bold"><i class="bi bi-clock-history"> </i>Go through History Bookings!</h2>
                </div>

                <div class="col-lg-12 col-md-12 px-4">
                    <div id="serviceTable">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">Service view</th>
                                    <th scope="col">Appointment At</th>
                                    <th scope="col">Rate it</th>
                                    <th scope="col">Total Spend</th>
                                </tr>
                            </thead>
                            <tbody id="old-book">
                        
                            </tbody>
                        </table>
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
    </section>

    <footer>
        <?php require ("component/footer.php");
        ?>
    </footer>

    <script>
        function get_bookings() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('booking-data').innerHTML = this.responseText;
            }
            xhr.send('get_bookings');
        }

        function get_old_bookings() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('old-book').innerHTML = this.responseText;
            }
            xhr.send('get_old_bookings');
        }

        function payments_status(order_id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if(this.responseText == "Failed_to_fetch_payment_details"){
                    alert('error', "Failed to update check you connection or Server Down!");
                }else  if(this.responseText == "Failed_to_update_payment_status"){
                    alert('error', "Please again later, Server Down!");
                }else{
                    alert('success', "Status Updated");
                    get_bookings()
                }
            }
            xhr.send('payments_status=' + order_id);
        }

        function view_order(booking_id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/booking_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('view-data').innerHTML = this.responseText;
            }
            xhr.send('view_order=' + booking_id);
        }

        window.onload = function () {
            get_bookings();
            get_old_bookings();
        }
    </script>
</body>

</html>