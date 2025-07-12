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
    <title>Admin Panel - Users</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">Users</h3>
                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width:1500px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Verified</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <?php
    require("component/scripts.php");
    ?>

    <script src="scripts/users.js"></script>


</body>

</html>