<?php
require("component/essential.php");
require("component/db_config.php");
adminLogin();

// Seen Code

if(isset($_GET['seen'])){
    $frm_data = filteration($_GET);

    if($frm_data['seen']== 'all'){
        $q = "UPDATE `user_inqueries` SET `seen`= ?";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','Marked all Read');
        }else{
            alert('error','Operation Failed');
        }
    }else{
        $q = "UPDATE `user_inqueries` SET `seen`= ? WHERE `id`=?";
        $values = [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','Marked as Read');
        }else{
            alert('error','Operation Failed');
        }
    }
}

// Delete Code

if(isset($_GET['del'])){
    $frm_data = filteration($_GET);

    if($frm_data['del']== 'all'){
        $q = "DELETE FROM `user_inqueries`";
        if(mysqli_query($con,$q)){
            alert('success','All Data Deleted Sucessfully');
        }else{
            alert('error','Operation Failed');
        }
    }else{
        $q = "DELETE FROM `user_inqueries` WHERE `id`=?";
        $values = [$frm_data['del']];
        if(delete($q,$values,'i')){
            alert('success','Deleted Sucessfully');
        }else{
            alert('error','Operation Failed');
        }
    }
}
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
    <title>Admin Panel - User Inqueries</title>
</head>

<body cclass="bg-light">

    <?php
    require("component/header.php");
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 fs-2">User Inqueries</h3>

                <div class="card border-1 shadow mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow"><i class='bi bi-check-all'> </i>Mark all Read</a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow"><i class='bi bi-trash'> </i>Delete All</a>
                        </div>

                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM `user_inqueries` ORDER BY `id` DESC";
                                        $data = mysqli_query($con,$q);
                                        $i = 1;
                                        
                                        while($row = mysqli_fetch_assoc($data)){
                                            $seen = '';
                                            if($row['seen'] != 1 ){
                                                $seen = "<a href='?seen=$row[id]' class='btn btn-success rounded-pill mt-2 '><i class='bi bi-check-all'> </i>Seen</a>";
                                            }
                                            $seen.="<a href='?del=$row[id]' class='btn btn-danger rounded-pill mt-2 mx-2'><i class='bi bi-trash'> </i>Delete</a>";
                                            echo <<<query
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[name]</td>
                                                <td>$row[email]</td>
                                                <td>$row[subject]</td>
                                                <td>$row[message]</td>
                                                <td>$row[date]</td>
                                                <td>$seen</td>
                                                
                                            </tr>
                                            query;
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Carousel Model -->


                </div>
            </div>
        </div>

        <?php
        require("component/scripts.php");
        ?>


</body>

</html>