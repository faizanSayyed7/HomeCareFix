<?php
require("../component/essential.php");
require("../component/db_config.php");
// adminLogin();


    if(isset($_POST['get_nestedcategory'])) 
    {
        $q = "SELECT nested_categories.id, nested_categories.icon_img, nested_categories.nested_category, categories.category_name, sub_categories.sub_category 
        FROM nested_categories 
        INNER JOIN categories ON nested_categories.category_id = categories.id 
        INNER JOIN sub_categories ON nested_categories.sub_category_id = sub_categories.id;";

        $i=1;
        $data = mysqli_query($con,$q);
        $path = NESTCATEGORY_ICON_PATH;
            
        while ($row = mysqli_fetch_assoc($data)){
            echo <<<data
                <tr>
                <td>$i</td>
                <td><img src="$path$row[icon_img]" width="70px"></td>
                <td>$row[nested_category]</td>
                <td>$row[category_name]</td>
                <td>$row[sub_category]</td>
                <td><button data-bs-toggle='modal' data-bs-target='#nestupdate_cat' class='btn btn-primary' onclick='get_nestedcategory({$row['id']}, "{$row['nested_category']}")'><i class="bi bi-pencil-square"> </i>Update</button>
                <button onclick='del_nest("$row[id]")' class='btn btn-danger'><i class="bi bi-trash"> </i>Delete</button></td>
                </tr>
                data;
                $i++;
            }
        }
        
        // onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")'

    // Front-End Display

    if(isset($_POST['showNestCat'])) {
        $frm_data = filteration($_POST);
        $q = "SELECT nested_categories.id, nested_categories.icon_img, nested_categories.nested_category, categories.category_name, sub_categories.sub_category 
        FROM nested_categories 
        INNER JOIN categories ON nested_categories.category_id = categories.id 
        INNER JOIN sub_categories ON nested_categories.sub_category_id = sub_categories.id;";
        $values = [$frm_data['id']];
        $data = select($q,$values,'i');
        $path = NEST_ICON_FOLDER;
        
        while ($row = mysqli_fetch_assoc($data)){
          echo <<<data
            <div class="crd col-3 py-2 smcrd">
              <a href="services.php?category_name-?" class="text-dark text-decoration-none">
                <div class="bb p-1 rounded border bg-light shadow justify-content-center">
                  <img src="$path$row[sub_icon]" max-width="150px" alt="" srcset="">
                </div>
              </a>
              <p class="fw-bold text-center mt-2">$row[sub_category]</p>
            </div>  
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

    if(isset($_POST['showNestCategory'])) {
        $frm_data = filteration($_POST);
        $q = "SELECT * FROM `nested_categories` WHERE `sub_category_id`=?";
        $values = [$frm_data['val']];
        $data = select($q,$values,'i');
        while($row = mysqli_fetch_assoc($data)){
        echo <<<query
        <option value="$row[id]">$row[nested_category]</option>
        query;
    }
    }


    if(isset($_POST["add_nestcategory"])) {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['nest_icon'], NEST_ICON_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `nested_categories`(`nested_category`, `category_id`, `sub_category_id`, `icon_img`) VALUES (?,?,?,?)";
            $values = [$frm_data['nested_category'],$frm_data['category_id'],$frm_data['subcategory_id'], $img_r];
            $res = insert($q, $values, 'siis');
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

    if(isset($_POST["upd_nestcategory"])){
        $frm_data = filteration($_POST);
        $img_r = uploadImage($_FILES['nest_icon'], NEST_ICON_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $pre_q = "SELECT * FROM `nested_categories` WHERE `id`=?";
            $img_val = [$frm_data['id']];
            $res = select($pre_q, $img_val, "i");
            $img = mysqli_fetch_assoc($res);
            if (deleteImage($img['icon_img'], NEST_ICON_FOLDER)){
                $q = "UPDATE `nested_categories` SET `nested_category`=?,`category_id`=?,`sub_category_id`=?,`icon_img`=? WHERE `id`=?";
                $values = [$frm_data['nest_category'],$frm_data['category_id'], $frm_data['subcategory_id'], $img_r, $frm_data['id']];
                $res = update($q, $values, 'siisi');
                echo $res;
            } else {
                echo 0;
            }
        }
    } 


    if(isset($_POST['del_nest'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['del_nest']];

        $pre_q = "SELECT * FROM `nested_categories` WHERE `id`=?";
        $res = select($pre_q, $values, "i");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['icon_img'], NEST_ICON_FOLDER)){
            $q = "DELETE FROM `nested_categories` WHERE `id`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }


?>