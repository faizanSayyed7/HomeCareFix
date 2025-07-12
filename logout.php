<?php

require("admin/component/essential.php");

session_start();
session_destroy();

redirect("index.php");



?>