<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();

if(isset($_POST['add_service'])){
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `services`(`service_name`, `price`, `description`, `category_id`, `sub_category_id`, `nested_id`) VALUES (?,?,?,?,?,?)";
    $values = [$frm_data['title'],$frm_data['price'],$frm_data['description'],$frm_data['category_id'],$frm_data['subcategory_id'],$frm_data['nested_category_id']];
    $res = insert($q, $values, 'sisiii');
    echo $res;
}

if(isset($_POST['get_services'])) 
    {
        $q = "SELECT services.id, services.service_name, services.price, services.description, categories.category_name, sub_categories.sub_category, nested_categories.nested_category
        FROM services
        INNER JOIN categories ON services.category_id = categories.id 
        INNER JOIN sub_categories ON services.sub_category_id = sub_categories.id
        INNER JOIN nested_categories ON services.nested_id = nested_categories.id
        WHERE services.removed = 0";

        $i=1;
        $data = mysqli_query($con,$q);
            
        while ($row = mysqli_fetch_assoc($data)){
            echo <<<data
                <tr>
                <td>$i</td>
                <td>$row[service_name]</td>
                <td>$row[price]</td>
                <td>$row[description]</td>
                <td>$row[category_name]</td>
                <td>$row[sub_category]</td>
                <td>$row[nested_category]</td>
                <td>
                <button onclick="service_img($row[id],'$row[service_name]')" data-bs-toggle='modal' data-bs-target='#service-img' class='btn btn-info'><i class="bi bi-card-image"> </i></button>
                <button onclick='remove_service($row[id])' class='btn btn-danger'><i class="bi bi-trash"></i></button></td>
                </tr>
                data;
                $i++;
                // onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")'
        }
    }

    if(isset($_POST["add_image"])) {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'], SERVICE_IMG_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `services_images`(`service_id`, `image`) VALUES (?,?)";
            $values = [$frm_data['service_id'], $img_r];
            $res = insert($q, $values, 'is');
            echo $res;
        }
    }


    if(isset($_POST["get_service_images"])) {
        $frm_data = filteration($_POST);

        $res = select("SELECT * FROM `services_images` WHERE `service_id`=?",[$frm_data['get_service_images']],'i');

        $path = SERVICES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){

            if($row['thumb']==1){
                $thumb_btn = "<i class='bi bi-check2-all text-light bg-success px-2 py-1 rounded shadow fs-5'></i>";
            }else{
                $thumb_btn = "<button onclick='thumb_image($row[id],$row[service_id])' class='btn btn-outline border-0'><i class='bi bi-check2 text-light bg-warning px-2 py-1 rounded shadow fs-5'></i></button>";
            }
            echo <<<data
            <tr class='align-middle'>
            <td><img src="$path$row[image]" class='img-fluid'></td>
            <td>$thumb_btn</td>
            <td><button onclick='rem_image($row[id],$row[service_id])' class='btn btn-danger'><i class="bi bi-trash"> </i>Delete</button></td>
            </tr>
            data;
        }
    }

    if(isset($_POST['rem_image'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'],$frm_data['service_id']];

        $pre_q = "SELECT * FROM `services_images` WHERE `id`=? AND `service_id`=?";
        $res = select($pre_q, $values, "ii");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['image'], SERVICE_IMG_FOLDER)){
            $q = "DELETE FROM `services_images` WHERE `id`=? AND `service_id`=?";
            $res = delete($q, $values, "ii");
            echo $res;
        } else {
            echo 0;
        }
    }

    if(isset($_POST['thumb_image'])){
        $frm_data = filteration($_POST);
        
        $pre_q = "UPDATE `services_images` SET `thumb`= ? WHERE `service_id`=?";
        $pre_v = [0,$frm_data['service_id']];
        $pre_res = update($pre_q,$pre_v,'ii');

        $q = "UPDATE `services_images` SET `thumb`=? WHERE `id`=? AND `service_id`=?";
        $v = [1,$frm_data['image_id'],$frm_data['service_id']];
        $res = update($q,$v,'iii');

        echo $res;
    }

    if(isset($_POST['remove_service'])){
        $frm_data = filteration($_POST);
        
        $res1 = select("SELECT * FROM `services_images` WHERE `service_id`=?",[$frm_data['service_id']],'i');

        while($row = mysqli_fetch_assoc($res1)){
            deleteImage($row['image'],SERVICE_IMG_FOLDER);
        }

        $res2 = delete("DELETE FROM `services_images` WHERE `service_id`=?",[$frm_data['service_id']],'i');
        $res3 = update("UPDATE `services` SET `removed`=? WHERE `id`=?",[1,$frm_data['service_id']],'ii');
        
        if($res2 || $res3){
            echo 1;
        }else{
            echo 0;
        }
    }
   
?>