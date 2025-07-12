<?php
require('component/db_config.php');
require('component/essential.php');


session_start();

if ((isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
    redirect("dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Pannel</title>
    <?php
    require('component/links.php');
    ?>

    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center shadow rounded bg-white overflow-hidden">
        <form action="" method="POST">
            <h4 class="bg-dark rounded-top text-white py-3">Admin Login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center"
                        placeholder="username">
                </div>
                <div class="mb-3">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center"
                        placeholder="password">
                </div>
                <button name="login" type="submit" class="btn btn-dark fw-bold shadow-none">Login</button>
            </div>
        </form>
    </div>



    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_auth` WHERE `admin_name`=? AND `admin_pass`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

        $res = select($query, $values, "ss");

        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION["adminLogin"] = true;
            $_SESSION["adminId"] = $row["admin_id"];
            redirect('dashboard.php');
        } else {
            alert("error", "Login Failed- Invalid Credentials!");
        }
    }
    ?>


    <?php
    require('component/scripts.php');
    ?>
</body>

</html>