<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3>HomeCareFix</h3>
    <a href="logout.php" class="btn btn-light btn-md fw-bold">Logout</a>
</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">Admin Pannel</h4>
            <button class="navbar-toggler bg-primary fw-bold text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminDropdown" aria-controls="navbarToggleExternalContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-palette"> </i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="user_inqueries.php"><i class="bi bi-person-fill-exclamation"> </i>User Inquries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php"><i class="bi bi-person-lines-fill"> </i>Users</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#booking_list">
                            <span>Bookings</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div class="collapse show px-3 small mb-1" id="booking_list">
                            <ul class="nav nav-pills flex-column rounded">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="newbooking.php"><i class="bi bi-journal-bookmark-fill"> </i>New Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="booking_record.php"><i class="bi bi-journal-check"> </i>Booking Records</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#category_list">
                            <span><i class="bi bi-cone-striped"> </i>Categories & Icons</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div class="collapse show px-3 small mb-1" id="category_list">
                            <ul class="nav nav-pills flex-column rounded">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="icons_n_category.php">Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="sub_category.php">Sub Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="nested_category.php">Nested Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="services.php"><i class="bi bi-browser-safari"> </i>Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="carousel.php"><i class="bi bi-fast-forward-circle-fill"> </i>Carousals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php"><i class="bi bi-gear"> </i>Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->