<?php
require("../component/essential.php");
require("../component/db_config.php");
adminLogin();

if(isset($_POST['get_users'])) 
    {
        $res = selectAll('user_cred');
        $i=1;
        $data = "";
            
        while ($row = mysqli_fetch_assoc($res)){
            $del_btn = " <button type='button' class='btn btn-danger btn-md shadow border-dark' onclick='del_user($row[id])'>
            <i class='bi bi-trash-fill'></i>
            </button>";
            $verified = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";
            
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-success btn-sm shadow-none'>Active</button>";
            if($row['is_verified']){
                $verified = "<span class='badge bg-success'><i class='bi bi-check'></i></span>";
                $del_btn = "";
            }

            if(!$row['status']){
                $status= "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Banned</button>";
            }
            $date = date("d-m-Y", strtotime($row['datentime']));
            $data.="
                <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address] | $row[pincode]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            ";
            $i++;
                // onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")'
        }
        echo $data;
    }

    if(isset($_POST['toggle_status'])){
        $frm_data = filteration($_POST);

        $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q, $v, 'ii')){
            echo 1;
        }else{
            echo 0;
        }

    }

    if(isset($_POST['del_user'])){
        $frm_data = filteration($_POST);
        
        $res1 = delete("DELETE FROM `user_cred` WHERE `id`=? AND `is_verified`=?",[$frm_data['user_id'],0],'ii');
        
        if($res1){
            echo 1;
        }else{
            echo 0;
        }
    }

    if(isset($_POST['search_user'])) 
    {
        $frm_data = filteration($_POST);
        $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";
        $res = select($query , ["%$frm_data[value]%"],'s');
        $i=1;
        $data = "";
            
        while ($row = mysqli_fetch_assoc($res)){
            $del_btn = " <button type='button' class='btn btn-danger btn-md shadow border-dark' onclick='del_user($row[id])'>
            <i class='bi bi-trash-fill'></i>
            </button>";
            $verified = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";
            
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-success btn-sm shadow-none'>Active</button>";
            if($row['is_verified']){
                $verified = "<span class='badge bg-success'><i class='bi bi-check'></i></span>";
                $del_btn = "";
            }

            if(!$row['status']){
                $status= "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Banned</button>";
            }
            $date = date("d-m-Y", strtotime($row['datentime']));
            $data.="
                <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address] | $row[pincode]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            ";
            $i++;
                // onclick='get_subcategory("$row[sub_category]","$row[id]","$row[category_id]")'
        }
        echo $data;
    }
   
?>