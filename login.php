<?php


$error_message = isset($_GET['error']) ? urldecode($_GET['error']) : '';
$success_message = isset($_GET['success']) ? urldecode($_GET['success']) : '';

$page_header = "";

include "public_base.php";

include "login_form.php";


?>
