<?php
require("../component/essential.php");
require("../component/db_config.php");
// adminLogin();


    if(isset($_POST['get_subcategory'])) 
    {
        $q = "SELECT sub_categories.id, sub_categories.sub_icon, sub_categories.video , sub_categories.sub_category, categories.category_name, sub_categories.category_id, sub_categories.status FROM sub_categories INNER JOIN categories ON categories.id = category_id;";
        $i=1;
        $data = mysqli_query($con,$q);
        $path = SUBCATEGORY_ICON_PATH;
        $vpath = VIDEO_PATH;
           
        while ($row = mysqli_fetch_assoc($data)){
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
                <td><img src="$path$row[sub_icon]" width="70px"></td>
                <td><video src="$vpath$row[video]" width="80px"></td>
                <td>$row[sub_category]</td>
                <td>$row[category_name]</td>
                <td><button onclick='upd_status("$row[id]","$row[status]")' class='btn btn-$bs_cls'>$status</button></td>
                <td><button data-bs-toggle='modal' data-bs-target='#subupdate_cat' onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")' class='btn btn-primary'><i class="bi bi-pencil-square"> </i>Update</button>
                <button onclick='del_subcat($row[id])' class='btn btn-danger'><i class="bi bi-trash"> </i>Delete</button></td>
                </tr>
            data;
            $i++;
        }
    }


    // Front-End Display

    if(isset($_POST['showSubCat'])) {
        $frm_data = filteration($_POST);
        $q = "SELECT sub_categories.sub_icon, sub_categories.id, sub_categories.sub_category, categories.category_name, sub_categories.category_id 
        FROM sub_categories 
        INNER JOIN categories ON categories.id = sub_categories.category_id
        WHERE sub_categories.category_id = ?";
        $values = [$frm_data['id']];
        $data = select($q,$values,'i');
        $path = SUBCATEGORY_ICON_PATH;
        
        if(mysqli_num_rows($data) > 0) {
            // Display cards
            while ($row = mysqli_fetch_assoc($data)){
                echo <<<data
                    <div class="crd col-3 py-2 smcrd">
                      <a href="services.php?category={$row['sub_category']}&id={$row['id']}" class="text-dark text-decoration-none">
                        <div class="bb p-1 rounded border bg-light shadow justify-content-center">
                          <img src="$path$row[sub_icon]" max-width="150px" alt="" srcset="">
                        </div>
                      </a>
                      <p class="fw-bold text-center mt-2">$row[sub_category]</p>
                    </div>  
                data;
            }
        } else {
            echo <<<data
             <img src="$path/Unavaliable_service.png" alt="No data found">
            data;
        }
    }

    // Back-End Display

    if(isset($_POST['showSubCategory'])) {
        $frm_data = filteration($_POST);
        $q = "SELECT * FROM `sub_categories` WHERE `category_id`=? AND `status`='0'";
        $values = [$frm_data['id']];
        $data = select($q,$values,'i');
        while($row = mysqli_fetch_assoc($data)){
        echo <<<query
        <option value="$row[id]">$row[sub_category]</option>
        query;
    }
    }
    

    if(isset($_POST["add_subcategory"])) {
        $frm_data = filteration($_POST);

        $img_r = uploadSvg($_FILES['sub_icon'], SUB_ICON_FOLDER);
        $vid_r = uploadVideo($_FILES['sub_video'], VIDEO_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else if ($vid_r == 'inv_size') {
            echo $vid_r;
        } else {
            $q = "INSERT INTO `sub_categories`(`category_id`, `sub_category`, `sub_icon`, `video`,`status`) VALUES (?,?,?,?,?)";
            $values = [$frm_data['category_id'],$frm_data['sub_category'], $img_r, $vid_r, 0];
            $res = insert($q, $values, 'isssi');
            echo $res;
        }
    }

    if(isset($_POST["upd_status"])) {
        $frm_data = filteration($_POST);
        $status_data = ($_POST["val"] == 0) ? 1 : 0;
        $q = "UPDATE `sub_categories` SET `status`=? WHERE `id`=?";
        $values = [$status_data, $frm_data['id']];
        $res = update($q, $values, 'ii');
        echo $res;
    }

    if(isset($_POST["upd_subcategory"])){
        $frm_data = filteration($_POST);
        $img_r = uploadSvg($_FILES['sub_icon'], SUB_ICON_FOLDER);
        $vid_r = uploadVideo($_FILES['video'], VIDEO_FOLDER);
    
        if ($img_r == 'inv_img' || $img_r == 'inv_size' || $img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $pre_q = "SELECT * FROM `sub_categories` WHERE `id`=?";
            $img_val = [$frm_data['id']];
            $res = select($pre_q, $img_val, "i");
            $row = mysqli_fetch_assoc($res); // Corrected variable name
    
            // Delete previous images
            if (deleteImage($row['sub_icon'], SUB_ICON_FOLDER) && deleteImage($row['video'], VIDEO_FOLDER)){
                echo "Previous_images_deleted_successfully.";
            } else {
                echo "Failed_to_delete";
            }
    
            $q = "UPDATE `sub_categories` SET `category_id`=?, `sub_category`=?, `sub_icon`=?, `video`=? WHERE `id`=?";
            $values = [$frm_data['category_id'], $frm_data['sub_category'], $img_r, $vid_r, $frm_data['id']];
            $res = update($q, $values, 'isssi');
            echo $res;
        }
    }     


    if(isset($_POST['del_subcat'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['del_subcat']];

        $pre_q = "SELECT * FROM `sub_categories` WHERE `id`=?";
        $res = select($pre_q, $values, "i");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['sub_icon'], SUB_ICON_FOLDER) && deleteImage($img['video'], VIDEO_FOLDER)){
            $q = "DELETE FROM `sub_categories` WHERE `id`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }


?>