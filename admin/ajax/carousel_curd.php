<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();


    if(isset($_POST["add_image"])) {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$img_r];
            $res = insert($q, $values, 's');
            echo $res;
        }
    }

    if(isset($_POST['get_carousel'])) 
    {
        $res = selectAll('carousel');

        while ($row = mysqli_fetch_assoc($res)){
            $path = CAROUSEL_IMG_PATH;
            echo <<<data
                <div class="col-lg-4 col-md-6 my-2 mb-3">
                    <div class="card" style="max-width: 350px; margin: auto;">
                        <img src="$path$row[image]"
                            class="card-img-top" alt="...">
                        <div class="card-img-overlay text-end">
                            <button class="btn btn-danger btn-md shadow border-dark " onclick="del_image($row[id])" type="submit">
                                <i class="bi bi-trash-fill"> </i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            data;
        }
    }

    if(isset($_POST['del_image'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['del_image']];

        $pre_q = "SELECT * FROM `carousel` WHERE `id`=?";
        $res = select($pre_q, $values, "i");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['image'], CAROUSEL_FOLDER)){
            $q = "DELETE FROM `carousel` WHERE `id`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }


?>