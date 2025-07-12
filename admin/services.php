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
    <title>Admin Panel - Services</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">Services</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3">Add Service</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#add_services">
                                <i class="bi bi-person-plus-fill"> </i>ADD
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 555px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col" width="10%">Title</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" width="20%">Description</th>
                                        <th scope="col">Under Category Name</th>
                                        <th scope="col">Under Sub-Category Name</th>
                                        <th scope="col">Nested Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="service-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--ADD Service Modal  -->
    <div class="modal fade" id="add_services" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="service-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Service</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Title </label>
                                <input type="text" name="service_title" id="service_title_inp"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" name="service_price" id="service_price_inp"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Category Names</label>
                                <div class="form-floating">
                                    <select class="form-select" name="category" id="category_id_inp"
                                        onchange="showSubCat(this.value)" required>
                                        <option selected value="">select category</option>
                                        <?php
                                        $q = "SELECT `id`, `category_name` FROM `categories` WHERE `status`='0'";
                                        $data = mysqli_query($con, $q);

                                        while ($row = mysqli_fetch_assoc($data)) {
                                            echo <<<query
                                            <option value="$row[id]">$row[category_name]</option>
                                        query;
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Current live Categories Avaliable!</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sub Category Names</label>
                                <div class="form-floating">
                                    <select class="form-select" name="subcategory" id="fetch_sub_category"
                                        onchange="showNest(this.value)" required>
                                        <!-- Subcategory options will be fetched and populated here -->
                                    </select>
                                    <label for="floatingSelect">Current live Sub Categories Avaliable!</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nested Category</label>
                                <div class="form-floating">
                                    <select class="form-select" name="nested_cat" id="fetch_nest" required>
                                        <!-- Nested options will be fetched and populated here -->
                                    </select>
                                    <label for="floatingSelect">Current Nested Avaliable!</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="service_desc" id="service_desc_inp" rows=4
                                    class="form-control shadow-none" required></textarea>
                                <div id="points-container">
                                    <button type="button" class="btn btn-warning mt-2" id="addPointBtn">Add
                                        Point</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline border text-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success shadow">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Modal  -->

    <!-- Modal -->
    <div class="modal fade" id="service-img" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Service Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_img_form">
                            <label class="form-label fw-bold">Add Image:</label>
                            <input type="file" accept=".jpg, .png, .webp, .jpeg" name="image"
                                class="form-control shadow-none mb-3" required>
                            <button class="btn btn-success text-white shadow-none">ADD</button>
                            <input type="hidden" name="service_id">
                        </form>
                    </div>
                    <div class="table-responsive-md" style="height: 340px; overflow-y: scroll;">
                        <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="50%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="service-image-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Update Sub-Categories Modal unfinish  -->
    <div class="modal fade" id="subupdate_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="upd_subcat_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Sub-Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">id</label>
                            <input type="text" name="subcat_id" id="updsubcat_id_inp" class="form-control shadow-none"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="sub_category_name" id="updsubcategory_name_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Names</label>
                            <div class="form-floating">
                                <select class="form-select" id="updselect_category_id_inp" required>
                                    <option selected value="">select category</option>
                                    <?php
                                    $q = "SELECT `id`, `category_name` FROM `categories` WHERE `status`='0'";
                                    $data = mysqli_query($con, $q);

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        echo <<<query
                                        <option value="$row[id]">$row[category_name]</option>
                                    query;
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Current live Categories Avaliable!</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".svg" name="sub_category_icon" id="updsub_category_icon_inp"
                                class="form-control shadow-none" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline border text-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success shadow">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>

        let add_service_form = document.getElementById('service-form');

        add_service_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_service();
        });

        function add_service() {
            let data = new FormData();
            data.append('subcategory_id', add_service_form.elements['subcategory'].value);
            data.append('category_id', add_service_form.elements['category'].value);
            data.append('nested_category_id', add_service_form.elements['nested_cat'].value);
            data.append('title', add_service_form.elements['service_title'].value);
            data.append('price', add_service_form.elements['service_price'].value);
            data.append('description', add_service_form.elements['service_desc'].value);
            data.append('add_service', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('add_services');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'Service Added sucessfully');
                    add_service_form.reset();
                    get_services();
                } else if (this.responseText == 1) {
                    alert('error', 'Failed To Add');
                    // nest_category_name_inp.value = '';
                    // nest_category_icon_inp.value = '';
                    // select_category_id_inp.value = '';
                    // select_Subcategory_id_inp.value = '';
                    // get_nestedcategory();
                }
            }
            xhr.send(data);
        }

        function get_services(nest_category, id, cat_id, sub_id) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('service-data').innerHTML = this.responseText;
                // document.getElementById('updsubcategory_name_inp').value = sub_category;
                // document.getElementById('updsubcat_id_inp').value = id;
                // document.getElementById('updselect_category_id_inp').value = cat_id;
            }
            xhr.send('get_services');
        }


        function showSubCat(id) {
            console.log('Sending request with parameter:', id);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/subcat_curd.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                console.log('Response received:', this.responseText);
                document.getElementById('fetch_sub_category').innerHTML = '<option value="">select sub category</option>' + this.responseText;;
            }
            xhr.send('showSubCategory=true&id=' + id);
        }

        function showNest(val) {
            console.log('Sending request with parameter:', val);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/nested_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                console.log('Response received:', this.responseText);
                document.getElementById('fetch_nest').innerHTML = '<option value="">select nest category</option>' + this.responseText;
            }
            xhr.send('showNestCategory=true&val=' + val);
        }

        // JavaScript to handle adding new points
        document.getElementById('addPointBtn').addEventListener('click', function () {
            var newPointText = prompt("Enter a new point:");
            if (newPointText !== null && newPointText.trim() !== "") {
                var serviceDescription = document.getElementById('service_desc_inp');
                if (serviceDescription.value.trim() === "") {
                    serviceDescription.value = "- " + newPointText.trim() + ",";
                } else {
                    var pointsContainer = document.getElementById('points-container');
                    var pointsCount = pointsContainer.querySelectorAll('button').length;
                    if (pointsCount < 3) {
                        serviceDescription.value += "\n- " + newPointText.trim() + ",";
                        if (pointsCount === 2) {
                            pointsContainer.innerHTML = '<p class="text-muted">Maximum 3 points reached</p>';
                        }
                    } else {
                        pointsContainer.innerHTML = '<p class="text-muted">Maximum 3 points reached</p>';
                    }
                }
            }
        });

        let add_img_form = document.getElementById('add_img_form');

        add_img_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_image();
        });

        function add_image() {
        let data = new FormData();
        data.append('image', add_img_form.elements['image'].files[0]);
        data.append('service_id', add_img_form.elements['service_id'].value);
        data.append('add_image', '');

        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/services_crud.php", true);

        xhr.onload = function () {

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed', 'image-alert');
                
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB', 'image-alert');
               
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Uploaded sucessfully','image-alert');
                service_img(add_img_form.elements['service_id'].value , document.querySelector("#service-img .modal-title").innerText)
                add_img_form.reset(); // Clear the input val
            }
        }
        xhr.send(data);
    }

    function service_img(id , sname){
        document.querySelector("#service-img .modal-title").innerText = sname
        add_img_form.elements['service_id'].value = id;
        add_img_form.elements['image'].value = '';

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/services_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            document.getElementById('service-image-data').innerHTML = this.responseText;
        }
        xhr.send('get_service_images='+id);
    }

    function rem_image(img_id , service_id){
        let data = new FormData();
        data.append('image_id', img_id);
        data.append('service_id', service_id);
        data.append('rem_image', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/services_crud.php", true);

        xhr.onload = function () {

            if (this.responseText == 1) {
                alert('Success', 'Successfully Removed', 'image-alert');
                service_img(service_id, document.querySelector("#service-img .modal-title").innerText)
            } else {
                alert('error', 'Failed to delete','image-alert');
                add_img_form.reset(); // Clear the input val
            }
        }
        xhr.send(data);
    }


    function thumb_image(img_id , service_id){
        let data = new FormData();
        data.append('image_id', img_id);
        data.append('service_id', service_id);
        data.append('thumb_image', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/services_crud.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Thumb-nail Changed', 'image-alert');
                service_img(service_id, document.querySelector("#service-img .modal-title").innerText)
            } else {
                alert('error', 'Failed to Changed','image-alert');
            }
        }
        xhr.send(data);
    }

    function remove_service(service_id){
        if(confirm("Are You Sure, you want to delete this room?")){
            let data = new FormData();
            data.append('service_id', service_id);
            data.append('remove_service', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);
    
            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('success', 'Room removed');
                    get_services();
                } else {
                    alert('error', 'Failed to Remove');
                }
            }
            xhr.send(data);
        }
    }

    window.onload = function () {
        get_services();
    }


    </script>

    <?php
    require("component/scripts.php");
    ?>


</body>

</html>