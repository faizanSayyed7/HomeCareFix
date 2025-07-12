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
    <title>Admin Panel - Sub Category</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">Sub Category</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex aign-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 mb-3">Add Sub-Category</h5>
                            <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                                data-bs-target="#sub_cat">
                                <i class="bi bi-person-plus-fill"> </i>ADD
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 555px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon Image(Svg)</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Sub_Category Name</th>
                                        <th scope="col">Under Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subcategory-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--ADD Sub-Categories Modal  -->
    <div class="modal fade" id="sub_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="sub-cat-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Sub-Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="sub_category_name" id="sub_category_name_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Names</label>
                            <div class="form-floating">
                            <select class="form-select" id="category_id_inp" required>
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
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".svg" name="sub_category_icon"
                                id="sub_category_icon_inp" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Video For Display!</label>
                            <input type="file" accept=".mp4 .mkv" name="sub_category_video"
                                id="sub_category_video_inp" class="form-control shadow-none" required>
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
    <div class="modal fade" id="subupdate_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="upd_subcat_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Sub-Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="subcat_id" id="updsubcat_id_inp"
                                class="form-control shadow-none" required>
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
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".svg" name="sub_category_icon"
                                id="updsub_category_icon_inp" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Video For Display!</label>
                            <input type="file" accept=".mp4 .mkv" name="updsub_category_video"
                                id="updsub_category_video_inp" class="form-control shadow-none" required>
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

    // let subcategory_name_inp = document.getElementById('category_name_inp');
    // let subcategory_icon_inp = document.getElementById('category_icon_inp');

    // Add Sub Category
    let sub_category_name_inp = document.getElementById('sub_category_name_inp');
    let sub_category_icon_inp = document.getElementById('sub_category_icon_inp');
    let sub_category_video_inp = document.getElementById('sub_category_video_inp');
    let select_category_id_inp = document.getElementById('category_id_inp');
    let sub_category_form = document.getElementById('sub-cat-form');
    
    // Update Sub Category
    let updsubcategory_name_inp = document.getElementById('updsubcategory_name_inp');
    let updsub_category_icon_inp = document.getElementById('updsub_category_icon_inp');
    let updsub_category_video_inp = document.getElementById('updsub_category_video_inp');
    let updselect_category_id_inp = document.getElementById('updselect_category_id_inp');
    let upd_subcategory_form = document.getElementById('upd_subcat_form');

    // let category_data;

    let category_form = document.getElementById('cat-form');

    sub_category_form.addEventListener('submit', function(e){
        e.preventDefault();
        add_subcategory();
    });


    upd_subcategory_form.addEventListener('submit', function(e){
        e.preventDefault();
        upd_subcategory();
    });

    function add_subcategory() {
        let data = new FormData();
        data.append('category_id', select_category_id_inp.value);
        data.append('sub_category', sub_category_name_inp.value);
        data.append('sub_icon', sub_category_icon_inp.files[0]);
        data.append('sub_video', sub_category_video_inp.files[0]);
        data.append('add_subcategory', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('sub_cat');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Subcategory Added sucessfully');
                sub_category_name_inp.value = '';
                sub_category_icon_inp.value = '';
                sub_category_video_inp.value = '';
                select_category_id_inp.value = '';
                get_subcategory();
            }
        }
        xhr.send(data);
    }

    function get_subcategory(sub_category,id,cat_id) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('subcategory-data').innerHTML = this.responseText;
            document.getElementById('updsubcategory_name_inp').value = sub_category;
            document.getElementById('updsubcat_id_inp').value = id;
            document.getElementById('updselect_category_id_inp').value = cat_id;
        }
        xhr.send('get_subcategory');
    }

    function upd_status(id,val) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                if(val == 0){
                    alert('success', 'SubCategory Status is set to Inactive');
                }else {
                    alert('success', 'SubCategory Status is set to active');
                } 
            }else{
                alert('error','Failed to update SubCategory!!!!')
            }
            get_subcategory();
        }
        xhr.send('upd_status=' + '&id=' + id + '&val=' + val);

    }

    function upd_subcategory() {
        let id =document.getElementById('updsubcat_id_inp').value;
        let data = new FormData();
        data.append('sub_category', updsubcategory_name_inp.value);
        data.append('sub_icon', updsub_category_icon_inp.files[0]);
        data.append('video', updsub_category_video_inp.files[0]);
        data.append('category_id', updselect_category_id_inp.value);
        data.append('id', id);
        data.append('upd_subcategory', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('subupdate_cat');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'JPEG PNG & JPG Images Not Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Sub-Category Updated sucessfully');
                updsubcategory_name_inp.value = '';
                updsub_category_icon_inp.value = '';
                updsub_category_video_inp.value = '';
                select_category_id_inp.value = '';
                get_subcategory();
            }
        }
        xhr.send(data);
    }

    function del_subcat(id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/subcat_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success','Sub_Category Removed');
                get_subcategory();
            } else {
                alert('error','Server Down');
            }
        }

        xhr.send('del_subcat=' + id); // Send the id of the Sub_Category to be deleted
    }


    window.onload = function () {
        get_subcategory();
    }
    

</script>

</html>