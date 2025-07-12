<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();

    if(isset($_POST["get_general"])) {
        $q = "SELECT * FROM `settings` WHERE `id`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST["upd_general"])){
        $frm_data = filteration($_POST);
        
        // Assuming you have defined SITE_LOGO_FOLDER somewhere
        $img_r = uploadImage($_FILES['pics'], SITE_LOGO_FOLDER);
        
        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else{
            $pre_q = "SELECT * FROM `settings` WHERE `id`=?";
            $img_val = [1];
            $res = select($pre_q, $img_val, "i");
            $img = mysqli_fetch_assoc($res);
            if (deleteImage($img['site_logo'], SITE_LOGO_FOLDER)){
                echo $res;
            } else {
                echo 0;
            }
            $q = "UPDATE `settings` SET `site_logo`=?, `site_about`=? WHERE `id` = ?";
            $values = [$img_r, $frm_data['about'], 1];
            $res = update($q, $values, 'ssi');
            echo $res;
        }
    }

    if(isset($_POST["upd_shutdown"])) {
        $frm_data = ($_POST["upd_shutdown"] == 0) ? 1 : 0;
        $q = "UPDATE `settings` SET `shutdown`=? WHERE `id` = ?";
        $values = [$frm_data, 1];
        $res = update($q, $values, 'ii');
        echo $res;
    }

    if(isset($_POST["get_contacts"])) {
        $q = "SELECT * FROM `contact_details` WHERE `id`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST["upd_contacts"])) {
        $frm_data = filteration($_POST);
        $q = "UPDATE `contact_details` SET `address`=?,`google_map`=?,`phone1`=?,`phone2`=?,`email`=?,`fb`=?,`insta`=?,`twt`=?,`iframe`=? WHERE `id`= ?";
        $values = [$frm_data['address'], $frm_data['google_map'], $frm_data['phone1'], $frm_data['phone2'], $frm_data['email'], $frm_data['fb'], $frm_data['insta'], $frm_data['twt'], $frm_data['iframe'], 1];
        $res = update($q, $values, 'sssssssssi');
        echo $res;
    }

    if(isset($_POST["add_member"])) {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'], TEAM_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `team_details`(`name`, `picture`, `position`, `info`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'], $img_r, $frm_data['position'], $frm_data['info'] ];
            $res = insert($q, $values, 'ssss');
            echo $res;
        }
    }

    if(isset($_POST['get_members'])) 
    {
        $res = selectAll('team_details');

        while ($row = mysqli_fetch_assoc($res)){
            $path = TEAM_IMG_PATH;
            $info = $row['info'];
            $trimmed_info = implode(' ', array_slice(explode(' ', $info), 0, 150));
            echo <<<data
                <div class="col-lg-4 col-md-6 my-2 mb-3">
                    <div class="card" style="max-width: 350px; margin: auto;">
                        <img src="$path$row[picture]"
                            class="card-img-top" alt="...">
                        <div class="card-img-overlay text-end">
                            <button class="btn btn-danger btn-md shadow border-dark " onclick="del_members($row[id])" type="submit">
                                <i class="bi bi-trash-fill"> </i>Delete
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2 fw-bold text-center">$row[name]</h5>
                            <div class="features mb-2">
                                <h6 class="mb-3 text-muted text-center ">$row[position]
                                </h6>
                                <p>
                                    $trimmed_info.....
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            data;
        }
    }

    if(isset($_POST['del_members'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['del_members']];

        $pre_q = "SELECT * FROM `team_details` WHERE `id`=?";
        $res = select($pre_q, $values, "i");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['picture'], TEAM_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `id`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }


?>