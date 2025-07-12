<?php
require("component/essential.php");
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
    <title>Admin Panel - Carousals</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">BillBoards</h3>


                <!-- Carousel Settings Actions -->

                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3">Promotional Images</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#carousel-settings">
                                <i class="bi bi-person-plus-fill"> </i>ADD
                            </button>
                        </div>
                        <div class="row" id="carousel-data">

                        </div>
                    </div>
                </div>

                <!-- Carousel Model -->

                <div class="modal fade" id="carousel-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="carousel-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD Image</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture:</label>
                                        <input type="file" accept=".jpg, .png, .webp, .jpeg" name="carousel_picture"
                                            id="carousel_picture_inp" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline border text-secondary" onclick="carousel_picture.value=''"
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
    <script src="scripts/carousel.js"></script>
    
    
</body>

</html>