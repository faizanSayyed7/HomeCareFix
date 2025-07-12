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
    <title>Admin Panel - Settings</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Settings</h3>

                <!-- General Settings Actions -->

                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between">
                            <h5 class="card-title m-0 mb-3">General Settings</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#general-settings">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </button>
                        </div>
                        <?php
                        $query = "SELECT * FROM `settings` WHERE `id`=1";
                        $res = mysqli_query($con,$query);
                        $path = LOGO_IMG_PATH;
                        while ($row = mysqli_fetch_assoc($res)){
                            echo <<<data
                                <h6 class="card-subtitle mb-2 fw-bold">Site Logo</h6>
                                <img class="mb-3" src="$path$row[site_logo]" alt="">
                                <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                                <p class="card-text" id="site_about">$row[site_about]</p>
                            data;   
                        }
                        ?>
                    </div>
                </div>

                <!-- General Settings Model -->

                <div class="modal fade" id="general-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general-form" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">New Site Logo:</label>
                                        <input type="file" name="pics" id="site_logo_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description:</label>
                                        <textarea name="site_about" class="form-control shadow-none" id="site_about_inp"
                                            style="resize: none;" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline border text-secondary"
                                        onclick="site_about.value = general_data.site_about"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success shadow">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shut Down -->

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3"><i class="bi bi-exclamation-triangle-fill"> </i>ShutDown Site</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>

                        <p class="card-text">
                            No Customers will be allowed to Book Services, When ShutDown Mode is turn On...
                        </p>

                    </div>
                </div>

                <!-- Contact Details Section -->

                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between">
                            <h5 class="card-title m-0 mb-3">Contact Settings</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#contact-setting">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill me-2"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-whatsapp me-2"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 fw-bold">Social Media</h6>
                                    <p class="card-text">
                                        <i class="bi bi-facebook me-2"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-twitter-x me-2"></i>
                                        <span id="twt"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">I-frame</h6>
                                    <iframe id="iframe" class="border shadow p-2 w-100"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Contact Settings Model -->

                <div class="modal fade" id="contact-setting" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contact-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Settings</h5>
                                </div>

                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" id="address_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" name="gmap" id="gmap_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone(*With Country Code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill me-2"></i></span>
                                                        <input type="number" name="pn1" id="pn1_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-whatsapp me-2"></i></span>
                                                        <input type="number" name="pn2" id="pn2_inp"
                                                            class="form-control shadow-none">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="email" name="email" id="email_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-facebook me-2"></i></span>
                                                        <input type="text" name="fb" id="fb_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-instagram me-2"></i></span>
                                                        <input type="text" name="insta" id="insta_inp"
                                                            class="form-control shadow-none">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-twitter-x me-2"></i></span>
                                                        <input type="text" name="twt" id="twt_inp"
                                                            class="form-control shadow-none">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame</label>
                                                    <input type="text" name="iframe" id="iframe_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline border text-secondary"
                                        onclick="contacts_inp(contacts_data)" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success shadow">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Leader Ship Team Settings Actions -->

                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3">LeaderShip Team</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#team-settings">
                                <i class="bi bi-person-plus-fill"> </i>ADD
                            </button>
                        </div>
                        
                        <div class="row" id="team-data">

                        </div>
                    </div>
                </div>

                <!-- LeaderShip Team Settings Model -->

                <div class="modal fade" id="team-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD LeaderShip Members</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="member_name" id="member_name_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Position</label>
                                        <input type="text" name="member_position" id="member_position_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Info</label>
                                        <input type="text" name="member_info" id="member_info_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture:</label>
                                        <input type="file" accept=".jpg, .png, .webp, .jpeg" name="member_picture"
                                            id="member_picture_inp" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline border text-secondary" onclick="member_name.value='',member_picture.value=''"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success shadow">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require("component/scripts.php");
    ?>
    <script src="scripts/settings.js"></script>
    
    
</body>

</html>