<?php ob_start();

include_once 'classes/user.php';


global $pdo;
session_start();

$getFromU = new User($pdo);

define('BASE_URL', '');

?>