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
    <title>Admin Panel - Nested Category</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">Nested Category</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3">Add Sub-Category</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#nest_cat">
                                <i class="bi bi-person-plus-fill"> </i>ADD
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 555px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon Image(Svg/Img)</th>
                                        <th scope="col">Title/Icon Name</th>
                                        <th scope="col">Under Category Name</th>
                                        <th scope="col">Under Sub-Category Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="nestedCategory-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--ADD Sub-Categories Modal  -->
    <div class="modal fade" id="nest_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="nest-cat-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Nested-Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon name/Title </label>
                            <input type="text" name="nest_category_name" id="nest_category_name_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Names</label>
                            <div class="form-floating">
                                <select class="form-select" id="category_id_inp" onchange="showSubCat(this.value)" required>
                                    <option selected value="">select category</option>
                                    <?php
                                    $q = "SELECT `id`, `category_name` FROM `categories` WHERE `status`='0'";
                                    $data = mysqli_query($con,$q);
                                    
                                    while($row = mysqli_fetch_assoc($data)){
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
                            <label class="form-label fw-bold">Sub Category Names</label>
                            <div class="form-floating">
                                <select class="form-select" id="fetch_sub_category" required>
                                    <!-- Subcategory options will be fetched and populated here -->
                                </select>
                                <label for="floatingSelect">Current live Sub Categories Avaliable!</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".jpeg .JPEG .jpg .png" name="nest_category_icon"
                                id="nest_category_icon_inp" class="form-control shadow-none" required>
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


    <!--Update Sub-Categories Modal  -->
    <div class="modal fade" id="nestupdate_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="upd_nestcat_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Nested-Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">id</label>
                            <input type="text" name="nestcat_id" id="updnestcat_id_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="sub_category_name" id="updnestcategory_name_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Names</label>
                            <div class="form-floating">
                            <select class="form-select" id="updselect_category_id_inp" onchange="showSubCat(this.value)" required>
                                <option selected value="">select category</option>
                                <?php
                                $q = "SELECT `id`, `category_name` FROM `categories` WHERE `status`='0'";
                                $data = mysqli_query($con,$q);
                                
                                while($row = mysqli_fetch_assoc($data)){
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
                            <label class="form-label fw-bold">Sub Category Names</label>
                            <div class="form-floating">
                                <select class="form-select" id="fetch_updsub_category" required>
                                    <!-- Subcategory options will be fetched and populated here -->
                                </select>
                                <label for="floatingSelect">Current live Sub Categories Avaliable!</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".jpg .png .jpeg" name="nest_category_icon"
                                id="updnest_category_icon_inp" class="form-control shadow-none" required>
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

    
    <?php
    require("component/scripts.php");
    ?>

</body>

<script>

    let subcategory_name_inp = document.getElementById('category_name_inp');
    let subcategory_icon_inp = document.getElementById('category_icon_inp');

    // Add Sub Category
    let nest_category_name_inp = document.getElementById('nest_category_name_inp');
    let nest_category_icon_inp = document.getElementById('nest_category_icon_inp');
    let select_category_id_inp = document.getElementById('category_id_inp');
    let select_Subcategory_id_inp = document.getElementById('fetch_sub_category');
    let nest_category_form = document.getElementById('nest-cat-form');
    
    // Update Sub Category
    let updnestcategory_name_inp = document.getElementById('updnestcategory_name_inp');
    let updnest_category_icon_inp = document.getElementById('updnest_category_icon_inp');
    let updselect_category_id_inp = document.getElementById('updselect_category_id_inp');
    let updselect_subcategory_id_inp = document.getElementById('fetch_updsub_category');
    let upd_nestcategory_form = document.getElementById('upd_nestcat_form');

    // let category_data;

    let category_form = document.getElementById('cat-form');

    nest_category_form.addEventListener('submit', function(e){
        e.preventDefault();
        add_nestcategory();
    });


    upd_nestcategory_form.addEventListener('submit', function(e){
        e.preventDefault();
        upd_nestcategory();
    });

    function add_nestcategory() {
        let data = new FormData();
        data.append('category_id', select_category_id_inp.value);
        data.append('subcategory_id', select_Subcategory_id_inp.value);
        data.append('nested_category', nest_category_name_inp.value);
        data.append('nest_icon', nest_category_icon_inp.files[0]);
        data.append('add_nestcategory', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/nested_crud.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('nest_cat');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Nested Category Added sucessfully');
                nest_category_name_inp.value = '';
                nest_category_icon_inp.value = '';
                select_category_id_inp.value = '';
                select_Subcategory_id_inp.value = '';
                get_nestedcategory();
            }
        }
        xhr.send(data);
    }

    function get_nestedcategory(id,nested_category) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/nested_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('nestedCategory-data').innerHTML = this.responseText;
            document.getElementById('updnestcat_id_inp').value = id;
            document.getElementById('updnestcategory_name_inp').value = nested_category;
        }
        xhr.send('get_nestedcategory');
    }


    function upd_nestcategory() {
        let id = document.getElementById('updnestcat_id_inp').value;
        let data = new FormData();
        data.append('nest_category', updnestcategory_name_inp.value);
        data.append('nest_icon', updnest_category_icon_inp.files[0]);
        data.append('category_id', updselect_category_id_inp.value);
        data.append('subcategory_id', updselect_subcategory_id_inp.value);
        data.append('id', id);
        data.append('upd_nestcategory', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/nested_crud.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('nestupdate_cat');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'JPEG PNG & JPG Images Not Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Nested Category Updated sucessfully');
                updnestcategory_name_inp.value = '';
                updselect_category_id_inp.value = '';
                updselect_subcategory_id_inp.value = '';
                updnestcategory_name_inp.value = '';
                get_subcategory();
            }
        }
        xhr.send(data);
    }

    function del_nest(id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/nested_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success','Nested Removed');
                get_nestedcategory();
            } else {
                alert('error','Server Down');
            }
        }

        xhr.send('del_nest=' + id); // Send the id of the Sub_Category to be deleted
    }

    function showSubCat(id) {
        console.log('Sending request with parameter:', id);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
        console.log('Response received:', this.responseText);
        document.getElementById('fetch_sub_category').innerHTML = this.responseText;
        document.getElementById('fetch_updsub_category').innerHTML = this.responseText;
        }
        xhr.send('showSubCategory=true&id=' + id); 
    }


    window.onload = function () {
        get_nestedcategory();
    }
    

</script>

</html>