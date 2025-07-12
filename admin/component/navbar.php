<nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-2 py-lg-2 shadow fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold h.font" href="index.php">
          <img src="assets/images/logo.png" alt="Logo" class="img-fluid max-width-100 max-height-100">
        </a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold fs-5">
            <li class="nav-item">
              <a class="nav-link me-2 active" aria-current="page" href="index.php">Home</a>
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
            </li>
          </ul>
          <div class="d-flex">
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
              data-bs-target="#loginModal">
              Login
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
              data-bs-target="#registerModal">
              Register
            </button>
          </div>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-circle fs-3 me-2"></i>User Login
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control shadow-none">
              </div>
              <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none">
              </div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <button type="submit" class="btn btn-dark shadow-none">Login</button>
                <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot
                  password?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-plus-fill fs-3 me-2"></i>User Registration
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="badge bg-light text-dark mb-4 text-wrap lh-base">
                Note : please input accurate details during registration. Your information will be
                matched with your ID(Aadhaar Card, Password, Driving License..etc) later for security.
                For assistance, contact our support.
              </span>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Picture:</label>
                    <input type="file" class="form-control shadow-none">
                  </div>
                  <div class="col-md-12 p-0 mb-3">
                    <label class="form-label">Address:</label>
                    <textarea class="form-control shadow-none" rows="1"></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">pincode:</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control shadow-none">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Confrim Password:</label>
                    <input type="password" class="form-control shadow-none">
                  </div>
                </div>
              </div>
              <div class="text-center my-1">
                <button type="submit" class="btn btn-dark shadow-none">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


