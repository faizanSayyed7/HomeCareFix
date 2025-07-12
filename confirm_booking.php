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
    <title>HomeCareFix - CONFRIM BOOKING</title>
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

    //cartdata



    // UserData
    
    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
    $user_data = mysqli_fetch_assoc($user_res);



    ?>

    <section>
        <div class="container-fluid heading">
            <div class="row ps-5">
                <div class="col-12 my-5 mb-4 px-4">
                    <h2 class="fw-bold">Confrim Booking!</h2>
                    <div style="font-size: 14px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="services.php?+" class="text-secondary text-decoration-none">Contact us</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-secondary text-decoration-none">Confrim</a>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 px-4">
                    <div id="serviceTable">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price (₹)</th>
                                </tr>
                            </thead>
                            <tbody >
                            <?php
                                $totalOverall = 0;
                                // Loop through cart data and display each item
                                foreach ($_SESSION['cartData'] as $item) {
                                    echo "<tr>";
                                    echo "<td>{$item['serviceName']}</td>";
                                    echo "<td>{$item['quantity']}</td>";
                                    echo "<td>{$item['totalPrice']}</td>";
                                    echo "</tr>";
                                    // Calculate the total overall price by adding each item's total price
                                    $totalOverall += $item['totalPrice'];
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total Pay</th>
                                    <td class='fw-bold'><?php echo $totalOverall; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 px-4">
                    <div class="card mb-4 border rounded-3">
                        <div class="card-body">
                            <form id="booking_form">
                                <h4 class="mb-3">Booking Details</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input name="name" type="text" id="name_inp" value="<?php echo $user_data['name'] ?>"
                                            class="form-control shadow-none" required disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input name="phonenum" id="phone_inp" type="number"
                                            value="<?php echo $user_data['phonenum'] ?>"
                                            class="form-control shadow-none" required disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input name="email" id="email_inp" type="email" value="<?php echo $user_data['email'] ?>"
                                            class="form-control shadow-none" required disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Pincode</label>
                                        <input name="pincode" id="pincode_inp" type="number" value="<?php echo $user_data['pincode'] ?>"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <small class="bg-warning rounded-pill">Please Enter Accruate Address, Our executives will arrive here!</small>
                                        <textarea name="address" id="address_inp" class="form-control shadow-none" rows="2"
                                            style="resize: none;"
                                            required><?php echo $user_data['address'] ?></textarea>
                                    </div>
                                    <h4 class="form-label fw-bold">Preferred Appointment Time & Date</h4>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Date</label>
                                        <input name="sch_date" id="date_inp" onchange="check_validity()" type="date" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">Shedule At</label>
                                        <small class="bg-warning rounded-pill">Servering hours are 9am to 6pm</small>
                                        <input name="pref_time" id="time_inp" onchange="check_validity()" type="time"  min="09:00" max="17:00" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="spinner-border text-info d-none mb-3" id="info_loader" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <h6 class="mb-3 text-danger" id="pay_info">Provide Appointment Time & Date!</h6>
                                        <button id="pay_now" class="btn w-100 text-white btn-success shadow mb-1" disabled>Pay Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php require ("component/footer.php");
        ?>
    </footer>

    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let pay_info = document.getElementById('pay_info');
        let pay_now =document.getElementById('pay_now');


        booking_form.addEventListener('submit', function(e){
            e.preventDefault();
            payment_getway();
        });
        
        function check_validity() {
            let date_val = booking_form.elements['sch_date'].value; // Access value property
            let time_val = booking_form.elements['pref_time'].value; // Access value property

            booking_form.elements['pay_now'].setAttribute('disabled',true);

            if (date_val!='' && time_val!='') { // Check if date and time values are not empty
                pay_info.classList.add('d-none');
                info_loader.classList.remove('d-none');
                let data = new FormData();

                data.append('check_validity', '');
                data.append('date_val', date_val);
                data.append('time_val', time_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confrim_book.php", true);

                xhr.onload = function () {
                    let responseData = JSON.parse(this.responseText);
                    if (responseData.status == 'schedule_date_earlier') {
                        pay_info.innerText = "Date is earlier!";
                    } else if(responseData.status == 'all_correct') {
                        pay_info.innerHTML = "You can proceed to checkout!";
                        pay_info.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');
                        
                    }
                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');
                    // Handle response data as needed
                }

                xhr.send(data);
            }
        }

        function payment_getway() {
            let data = new FormData();
            data.append('name', name_inp.value);
            data.append('phone', phone_inp.value);
            data.append('mail', email_inp.value);
            data.append('pincode', pincode_inp.value);
            data.append('address', address_inp.value);
            data.append('total_amount', <?php echo $totalOverall; ?>);
            data.append('date', date_inp.value);
            data.append('time', time_inp.value);
            data.append('payment_getway', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/payments_getway.php", true);

            xhr.onload = function () {
            if(this.responseText == "service_insert_fail"){
                alert('error', "Failed to Book, ServerDown");
            }else  if(this.responseText == "booking_not_found"){
                alert('error', "Please relogin and tryagain");
            }else if(this.responseText == "booking_insert_fail"){
                alert('error','Please relogin and tryagain');
            }else if(this.responseText == "connect_to_internet"){
                alert('error','please check your Internet!');
            }else{
                let url = this.responseText;
                window.location.href = url;
            }
        }
        xhr.send(data);
        }
    </script>
</body>

</html>