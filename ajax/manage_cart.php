<?php

require("../admin/component/essential.php");
require("../admin/component/db_config.php");

session_start();

// Function to add item to cart
function addToCart($serviceName, $price, $cardId) {
    if(!isset($_SESSION['cartData'])) {
        $_SESSION['cartData'] = [];
    }

    // Check if item already exists in cart
    $found = false;
    foreach($_SESSION['cartData'] as &$item) {
        if($item['serviceName'] == $serviceName && $item['cardId'] == $cardId) {
            $item['quantity']++;
            $item['totalPrice'] += $price;
            $found = true;
            break;
        }
    }
    unset($item);

    // If item does not exist, add it to cart
    if(!$found) {
        $_SESSION['cartData'][] = [
            'serviceName' => $serviceName,
            'quantity' => 1,
            'totalPrice' => $price,
            'cardId' => $cardId
        ];
    }
}

// Function to remove item from cart
function removeFromCart($serviceName) {
    if(isset($_SESSION['cartData'])) {
        foreach($_SESSION['cartData'] as $key => $item) {
            if($item['serviceName'] == $serviceName) {
                unset($_SESSION['cartData'][$key]);
                break;
            }
        }
    }
}

// Add item to cart
if(isset($_POST['addToCart'])) {
    $serviceName = $_POST['serviceName'];
    $price = floatval($_POST['price']);
    $cardId = $_POST['cardId'];
    addToCart($serviceName, $price, $cardId);
}

// Remove item from cart
if(isset($_POST['removeFromCart'])) {
    $serviceName = $_POST['serviceName'];
    removeFromCart($serviceName);
}

// Display cart table
if(isset($_SESSION['cartData'])) {
    foreach($_SESSION['cartData'] as $item) {
        echo "<tr>";
        echo "<td>{$item['serviceName']}</td>";
        echo "<td>{$item['quantity']}</td>";
        echo "<td>{$item['totalPrice']}</td>";
        echo "<td><button class='btn btn-danger btn-remove' data-service='{$item['serviceName']}'>x</button></td>";
        echo "</tr>";
    }
}



?>