<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "homecarefix";

$con = mysqli_connect($hostname, $username, $password, $database);

if (!$con) {
    die("Cannot Connect to database" . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        $data[$key] = $value;
    }
    return $data;
}

function selectAll($table)
{
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}

function select($sql, $value, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Qurey cannot be executed- Select");
        }

    } else {
        die('Query Cannot be Executed - Select' . mysqli_error($con));
    }
}

function update($sql, $value, $datatypes)
{

    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Qurey cannot be executed- update");
        }

    } else {
        die('Query Cannot be Executed - update');
    }
}

function insert($sql, $value, $datatypes)
{

    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Qurey cannot be executed- insert");
        }

    } else {
        die('Query Cannot be Executed - insert');
    }
}


function delete($sql, $value, $datatypes)
{

    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Qurey cannot be executed- Delete");
        }

    } else {
        die('Query Cannot be Executed - Delete');
    }
}

?>