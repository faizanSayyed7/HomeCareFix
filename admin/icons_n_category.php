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
    <title>Admin Panel - Icons & Category</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">Category Preview & Only Updates</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <h5 class="card-title m-0 mb-3">Categories</h5>
                        </div>
                        <div class="table-responsive-md" style="height: 550px;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon Image(Svg)</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="category-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Modal  -->
    <div class="modal fade" id="update_cat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="cat-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Category</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="cat_id" id="cat_id_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="category_name" id="category_name_inp"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".svg" name="category_icon"
                                id="category_icon_inp" class="form-control shadow-none" required>
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

    let category_name_inp = document.getElementById('category_name_inp');
    let category_icon_inp = document.getElementById('category_icon_inp');
    let category_data;

    let category_form = document.getElementById('cat-form');

    category_form.addEventListener('submit', function(e){
        e.preventDefault();
        upd_category();
    });

    function get_category(categoryName,id) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/category_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            document.getElementById('category-data').innerHTML = this.responseText;
            document.getElementById('category_name_inp').value = categoryName;
            document.getElementById('cat_id_inp').value = id;
        }
        xhr.send('get_category');
    }

    function upd_status(id,val) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/category_curd.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.responseText == 1) {
                if(val == 0){
                    alert('success', 'Category Status is set to Inactive');
                }else {
                    alert('success', 'Category Status is set to active');
                } 
            }else{
                alert('error','Failed to update Category!!!!')
            }
            get_category();
        }
        xhr.send('upd_status=' + '&id=' + id + '&val=' + val);

    }

    function upd_category() {
        let id =document.getElementById('cat_id_inp').value;
        let data = new FormData();
        data.append('name', category_name_inp.value);
        data.append('picture', category_icon_inp.files[0]);
        data.append('id', id);
        data.append('upd_category', '');


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/category_curd.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('update_cat');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == "inv_img") {
                alert('error', 'Only JPEG PNG & JPG Images Allowed');
            } else if (this.responseText == "inv_size") {
                alert('error', 'Invalid Size, Size Must be Greater than 2MB');
            } else if (this.responseText == "upd_failed") {
                alert('error', 'Server Down');
            } else {
                alert('success', 'Category Updated sucessfully');
                category_name_inp.value = '';
                category_icon_inp.value = '';
                get_category();
            }
        }
        xhr.send(data);
    }

    

    window.onload = function () {
        get_category();
        
    }
    

</script>

</html>