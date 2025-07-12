<?php
require("../admin/component/essential.php");
require("../admin/component/db_config.php");

    if(isset($_POST['search_service'])) 
    {
        $frm_data = filteration($_POST);
        $query = "SELECT services.service_name, services.sub_category_id, services.price, sub_categories.sub_category, services_images.image FROM services
        INNER JOIN services_images ON services_images.service_id = services.id
        INNER JOIN sub_categories ON sub_categories.id = services.sub_category_id
        WHERE `service_name` LIKE ? AND `removed`=?";
        $res = select($query , ["%$frm_data[value]%", 0],'si');
        $i=1;
        $data = "";
        $path = SERVICES_IMG_PATH;
        
        while ($row = mysqli_fetch_assoc($res)){
            $data.="
            <tr>
                <td><img src='$path$row[image]' style='width: 100px; height: 100px; border-radius: 15px; overflow: hidden;'></td>
                <td>$row[service_name]</td>
                <td>$row[price]</td>
                <td><a href='services.php?category={$row['sub_category']}&id={$row['sub_category_id']}' class='btn btn-dark me-2 h-100' role='button'><i class='bi bi-arrow-bar-right'></i></a></td>
            </tr>
            ";
            $i++;
        }
        echo $data;
    }
   
?>