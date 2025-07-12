<?php

//Front-end Purpose 

define('SITE_URL','http://127.0.0.1/homeCareFix/');
define("TEAM_IMG_PATH", SITE_URL.'assets/images/team/');
define("CAROUSEL_IMG_PATH", SITE_URL.'assets/images/promotional/');
define("CATEGORY_ICON_PATH", SITE_URL.'assets/images/menu_icon/');
define("SUBCATEGORY_ICON_PATH", SITE_URL.'assets/images/menu_icon/sub_icon/');
define("VIDEO_PATH", SITE_URL.'assets/images/videos/');
define("NESTCATEGORY_ICON_PATH", SITE_URL.'assets/images/menu_icon/nest_icon/');
define("SERVICES_IMG_PATH", SITE_URL.'assets/images/service_img/');
define("LOGO_IMG_PATH", SITE_URL.'assets/images/logo/');






// Backend Upload Process needs this data

define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . '/homeCareFix/assets/images/');

define("TEAM_FOLDER", 'team/');

define("CAROUSEL_FOLDER", 'promotional/');

define("MENU_ICON_FOLDER", 'menu_icon/');

define("SUB_ICON_FOLDER", 'menu_icon/sub_icon/');

define("VIDEO_FOLDER", 'videos/');

define("NEST_ICON_FOLDER", 'menu_icon/nest_icon/');

define("SERVICE_IMG_FOLDER", 'service_img/');

define("SITE_LOGO_FOLDER", 'logo/');





function adminLogin()
{
    session_start();
    if (!(isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
        echo "<script>
                window.location.href='index.php';
            </script>";
        exit;
    }
}


function redirect($url)
{
    echo "<script>
            window.location.href='$url';
        </script>";
    exit;
}


function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
                <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            alert;
}


function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return "inv_img";
    } else if ($image['size'] / (1024 * 1024) > 2) {
        return "inv_size";
    } else {
        $text = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(1111, 9999) . ".$text";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }

}

function uploadVideo($video, $folder)
{

    if ($video['size'] / (1024 * 1024) > 15) {
        return "inv_size";
    } else {
        $text = pathinfo($video['name'], PATHINFO_EXTENSION);
        $rname = 'VID_' . random_int(1111, 9999) . ".$text";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($video['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }

}

function uploadSvg($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return "inv_img";
    } else if ($image['size'] / (1024 * 1024) > 2) {
        return "inv_size";
    } else {
        $text = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(1111, 9999) . ".$text";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }

}

function deleteImage($image , $folder){
    if(unlink(UPLOAD_IMAGE_PATH .$folder .$image)){
        return true;
    }else{
        return false;
    }
}


?>