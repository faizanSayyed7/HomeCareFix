<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>HomeCareFix - HOME</title>

  <!-- Bootstrap core CSS -->
  <?php
  require('component/links.php');
  ?>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .availability-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 0px;
        padding: 0 35px;
      }
    }

    .custom-alert{
      position: fixed;
      top: 100px;
      right: 25px;
      z-index: 999;
  }
  </style>

</head>

<body class="bg-light">

  <!-- ***** Header Area Start ***** -->
  <header>
    <?php
    require("component/navbar.php");
    ?>
  </header>
  <!-- ***** Header Area End ***** -->


  <div class="container menu-collage p-sm-5">
    <div class="row d-flex">
      <!-- Left Section (40%) -->
      <div class="menubox bg-white col-lg-4 col-sm-10 p-sm-5 border shadow">
        <h4 class="mt-1 fw-bold text-muted">What are you looking for?</h4>
        <div class="row mt-4">
        <?php
          $res = selectAll('categories');
          $path = CATEGORY_ICON_PATH;
          $i = 0;

          while ($row = mysqli_fetch_assoc($res)){
            if($i < 2){
              echo <<<data
                  <div class="crd col-6">
                    <a href="#" onclick="showSubCategory($row[id])" class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <div class="bb p-2 rounded bg-light fw-bold border shadow">$row[category_name]
                        <img src="$path$row[category_img]"
                          alt="">
                      </div>
                    </a>
                  </div>
              data;
            }else{
              echo <<<data
                <div class="crd col-4 py-3 my-2 smcrd">
                  <a href="#" onclick="showSubCategory($row[id])" class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="bb p-2 rounded border bg-light shadow">
                      <img src="$path$row[category_img]" max-width="120px" max-height="90px" alt="" srcset="">
                    </div>
                  </a>
                  <p class="fw-bold text-center mt-2">$row[category_name]</p>
                </div>
              data;
            }
            $i++;
          }
          ?>
        </div>
      </div>

      <!-- Right Section (60%) -->
      <div class="col-8 d-none d-lg-block">
        <div class="advertising">
          <div class="p-4 my-2">
            <!-- Your advertising image content goes here -->
            <div class="row">
              <div class="col-lg-4 col-md-12 mb-2 mb-lg-0">
                <img src="assets/images/gallery/pexels-field-engineer-442154.jpg"
                  class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
                <img src="assets/images/gallery/pexels-karolina-grabowska-4239131.jpg"
                  class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" />
              </div>

              <div class="col-lg-4 mb-2 mb-lg-0">
                <img src="assets/images/gallery/pexels-karolina-grabowska-4239145.jpg"
                  class="w-100 shadow-1-strong rounded mb-4" alt="Mountains in the Clouds" />
                <img src="assets/images/gallery/pexels-cottonbro-studio-3993443.jpg"
                  class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
              </div>

              <div class="col-lg-4 mb-2 mb-lg-0">
                <img src="assets/images/gallery/pexels-tima-miroshnichenko-6195109.jpg"
                  class="w-100 shadow-1-strong rounded mb-4" alt="Waves at Sea" />
                <img src="assets/images/gallery/ac-repair-large.jpg" class="w-100 shadow-1-strong rounded mb-4"
                  alt="Yosemite National Park" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Services Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h4 class="modal-title" id="exampleModalLabel">Services</h4>
        </div>
        <div class="modal-body">
          <div class="row" id="fetch_sub_cat">
              
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- best-deal -->
  <div class="best-deal bg-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>| Best Deal</h6>
            <h2>Find Your Best Deal Right Now!</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item me-2 mb-2" role="presentation">
                    <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab"
                      data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment"
                      aria-selected="true">Wedding Special</button>
                  </li>
                  <li class="nav-item me-2 mb-2" role="presentation">
                    <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button"
                      role="tab" aria-controls="villa" aria-selected="false">Bathroom Services</button>
                  </li>
                </ul>
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Bookings <span>540+</span></li>
                          <li>Ratings<span>3.4</span></li>
                          <li>Expert Stylists<span>80+</span></li>
                          <li>Custom Packages <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/Best_Deals/Beige Cream Thank You Card Wedding Card (2).png" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Description</h4>
                      <p>we understand that your wedding day is one of the most important moments of your life, and
                        we're here to make you feel absolutely radiant.<br><br>Our dedicated team of experienced beauty
                        professionals specializes in providing exquisite wedding salon services exclusively for women
                      </p>
                      <div class="icon-button">
                        <a href="services.php?category=Salon For Women&id=20"><i class="bi bi-calendar-check"></i>Book Your Appointment</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="villa" role="tabpanel" aria-labelledby="villa-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Bookings <span>250+</span></li>
                          <li>Ratings <span>3.2</span></li>
                          <li>Number of Janitors <span>55+</span></li>
                          <li>Custom Packages <span>No</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/Best_Deals/Bathroom.png" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Description</h4>
                      <p> we understand the importance of maintaining a clean and hygienic bathroom environment in your
                        home.<br><br>Our bathroom cleaning services are designed to provide you with a spotless,
                        sanitized, and refreshed space where you can unwind and recharge by top-quality cleaning
                        products to ensure every nook.</p>
                      <div class="icon-button">
                        <a href="#"><i class="bi bi-calendar-check"></i> Book Your Appointment</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <!-- Promotional BillBoard -->
  <section>
    <h2 class="my-5 fw-bold text-start mx-5">New and Noteworthy</h2>
    <div class="container-fluid px-4">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
          <?php
          $res = selectAll('carousel');
          $path = CAROUSEL_IMG_PATH;

          while ($row = mysqli_fetch_assoc($res)){
              echo <<<data
              <div class="swiper-slide">
                <div class="card" style="max-width: 470px;  margin: auto;">
                  <img src="$path$row[image]" alt="...">
                </div>
              </div>
              data;
          }
          ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>


  <!-- Reach Us -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">Reach Us</h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 rounded bg-white shadow">
        <iframe height="320" class="w-100 rounded" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white shadow-lg p-4 rounded mb-4">
          <h5 class="mb-2">Call Us</h5>
          <a href="tel: +<?php echo $contact_r['phone1'] ?>"
            class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill me-2"></i>+
            <?php echo $contact_r['phone1'] ?>
          </a>
          <br>

          <?php
          if ($contact_r['phone2'] != '') {
            echo <<<data
                <a href="tel: +$contact_r[phone2]" class="d-inline-block text-decoration-none text-dark"><i
                class="bi bi-whatsapp me-2"></i>+$contact_r[phone2]</a>
              data;
          }
          ?>
        </div>
        <div class="bg-white shadow p-4 rounded mb-4">
          <h5 class="mb-2">Follow Us</h5>
          <?php
          if ($contact_r['twt'] != '') {
            echo <<<data
                <a href="$contact_r[twt]" class="d-inline-block mb-3">
                <span class="badge bg-light text-dark fs-6 p-2">
                  <i class="bi bi-twitter-x me-2"></i>
                  X
                </span>
              </a>
              <br>
              data;
          }
          ?>

          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook me-2"></i>
              Facebook
            </span>
          </a>
          <br>
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-instagram me-2"></i>
              Instagram
            </span>
          </a>
          <br>
        </div>
      </div>
    </div>
  </div>

  <!-- password reset modal  -->
  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="recovery-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-shield-lock fs-3 me-2"></i>Set New Password
              </h5>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <label class="form-label">New Password</label>
                <input type="password" name="pass" class="form-control shadow-none" required>
                <input type="hidden" name="email">
                <input type="hidden" name="token">
              </div>
              <div class="mb-2 text-end">
                <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">
                  Cancel
                </button>
                <button type="submit" class="btn btn-info shadow-none">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


  <footer>
    <?php
    require("component/footer.php");
    ?>
  </footer>

  <?php

  if(isset($_GET['accouunt_recovery'])){
    $data = filteration($_GET);

    $t_date = date("Y-m-d");

    $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",[$data['email'],$data['token'],$t_date],'sss');
    if(mysqli_num_rows($query)==1){
      echo <<<showModal
      <script>
        var myModal = document.getElementById('recoveryModal');

        myModal.querySelector("input[name = 'email']").value = '$data[email]';
        myModal.querySelector("input[name = 'token']").value = '$data[token]';

        var modal = bootstrap.Modal.getOrCreateInstance(myModal);
        modal.show();
        </script>
      showModal;
    }else{
      alert('error','Invalid or expired link');
    }
  }

  ?>

  <!-- Scripts -->
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        540: {
          slidesPerView: 1,
        },
        390: {
          slidesPerView: 1,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
      },
    });

  function showSubCategory(id) {
    console.log('Sending request with parameter:', id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin/ajax/subcat_curd.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
      console.log('Response received:', this.responseText);
      document.getElementById('fetch_sub_cat').innerHTML = this.responseText;
    }
  xhr.send('showSubCat=true&id=' + id); 
  }

  // recover account

  let recovery_form = document.getElementById('recovery-form');

  recovery_form.addEventListener('submit', function(e){
  e.preventDefault();

  let data = new FormData();

  data.append('email',recovery_form.elements['email'].value);
  data.append('token',recovery_form.elements['token'].value);
  data.append('pass',recovery_form.elements['pass'].value);
  data.append('recovery_user', "");

  
  var myModal = document.getElementById('recoveryModal');
  var modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/signin_signup.php", true);

  xhr.onload = function () {
      if(this.responseText == "failed"){
          alert('error', "password reset failed");
      }else{
        alert('success', "password reset successfully");
        recovery_form.reset();
      }
    }
    xhr.send(data);
    });


  </script>

</body>

</html>