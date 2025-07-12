<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();


    if(isset($_POST['get_category'])) 
    {
        $res = selectAll('categories');
        $i=1;
        $path = CATEGORY_ICON_PATH;
           
        while ($row = mysqli_fetch_assoc($res)){
            $status = "";
            $bs_cls = "";
            if($row['status']==0){
                $status = "Active";
                $bs_cls = "success";
            }else{
                $status = "Inactive";
                $bs_cls = "warning";
            }
            echo <<<data
                <tr>
                <td>$i</td>
                <td><img src="$path$row[category_img]" width="70px"></td>
                <td>$row[category_name]</td>
                <td><button onclick='upd_status("$row[id]","$row[status]")' class='btn btn-$bs_cls'>$status</button></td>
                <td><button data-bs-toggle='modal' data-bs-target='#update_cat' onclick='get_category("$row[category_name]","$row[id]")' class='btn btn-primary'><i class="bi bi-pencil-square"> </i>Update</button></td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST["upd_status"])) {
        $frm_data = filteration($_POST);
        $status_data = ($_POST["val"] == 0) ? 1 : 0;
        $q = "UPDATE `categories` SET `status`=? WHERE `id`=?";
        $values = [$status_data, $frm_data['id']];
        $res = update($q, $values, 'ii');
        echo $res;
    }

    if(isset($_POST["upd_category"])){
        $frm_data = filteration($_POST);
        $img_r = uploadSvg($_FILES['picture'], MENU_ICON_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $q = "UPDATE `categories` SET `category_img`= ?,`category_name`= ? WHERE `id` = ?";
            $values = [$img_r,$frm_data['name'], $frm_data['id']];
            $res = update($q, $values, 'ssi');
            echo $res;
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