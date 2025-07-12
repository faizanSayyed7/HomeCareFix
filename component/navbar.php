<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-3 shadow fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand me-3 ms-2" href="index.php">
          <?php
          if($settings_r['site_logo'] && $path != ''){
            $logo = $settings_r['site_logo'];
            echo <<<data
              <img src="$path$logo" alt="Logo" class="max-width-100 max-height-100 logoimg">
          data;
          }
        ?>
        </a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold fs-5">
            <!-- <li class="nav-item">
              <a class="nav-link me-2 ms-4" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="services.php">Servies</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="facilities.php">Facilities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="about.php">About Us</a>
            </li> -->
          </ul>
          <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-search"> </i>Search Services?</button>
          <div class="d-flex">
            <?php
              if(isset($_SESSION['signin']) && $_SESSION['signin']== true){
                echo <<<data
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <i class="bi bi-person-fill me-1"></i>  
                  Hello, $_SESSION[u_name]
                  </button>
                  <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item mb-2" href="profile.php"><i class="bi bi-person-lines-fill"> </i>Profile</a></li>
                    <li><a class="dropdown-item mb-2" href="booking.php"><i class="bi bi-bookmark-check-fill"> </i>Booking</a></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power"> </i>Logout</a></li>
                  </ul>
                </div>
                data;
              }else{
                echo <<<data
                  <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    SignIn
                  </button>
                  <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                    SignUp
                  </button>
                data;
              }
            ?>
          </div>
        </div>
      </div>
    </nav>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
      <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasScrollingLabel">Find Services of your choice!</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <!-- <input type="Sea" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search"> -->
        <input class="form-control me-2 mb-2" oninput="search_service(this.value)" type="search" placeholder="Type to search" aria-label="Search">
        <div class="table-responsive">
            <table class="table table-hover border text-center">
                <tbody id="search-data">
              
                </tbody>
            </table>
        </div>
      </div>
    </div>


    <!-- login  -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="login-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-circle fs-3 me-2"></i>User SignIn
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email/Mobile</label>
                <input type="text" name="email_mob" class="form-control shadow-none" required>
              </div>
              <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control shadow-none" required>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <button type="submit" class="btn btn-dark shadow-none">Login</button>
                <button type="button" class="btn btn-outline shadow-none p-0" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#forgotModal">
                Forgot password?
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- forgot pass modal  -->
    <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="forgot-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-circle fs-3 me-2"></i>Forgot Password
              </h5>
            </div>
            <div class="modal-body">
            <span class="badge bg-warning text-dark mb-4 text-wrap lh-base">
            <i class="bi bi-exclamation-triangle"> </i>Note : A Link will be send to your mail to reset your password!
              </span>
              <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="mail" name="email" class="form-control shadow-none" required>
              </div>
              <div class="mb-2 text-end">
                <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#loginModal">
                  Cancel
                </button>
                <button type="submit" class="btn btn-success shadow-none">Send Link</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- resistrartion Modal  -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="signup-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-plus-fill fs-3 me-2"></i>User Signup
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="badge bg-light text-dark mb-4 text-wrap lh-base">
                Note : please input accurate details during registration
              </span>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name:</label>
                    <input name="name" type="text" class="form-control shadow-none" required>
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Email:</label>
                    <input name="email" type="email" class="form-control shadow-none" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input name="phonenum" type="number" class="form-control shadow-none" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">pincode:</label>
                    <input name="pincode" type="number" class="form-control shadow-none" required>
                  </div>
                  <div class="col-md-12 p-0 mb-3">
                    <label class="form-label">Address:</label>
                    <textarea name="address" class="form-control shadow-none" rows="3" required></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password:</label>
                    <input name="pass" type="password" class="form-control shadow-none" required>
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Confrim Password:</label>
                    <input name="cpass" type="password" class="form-control shadow-none" required>
                  </div>
                </div>
              </div>
              <div class="text-center my-1">
                <button class="btn btn-dark shadow-none">Signup</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>




