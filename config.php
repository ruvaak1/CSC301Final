<?php
$user = 'flynnj5';
$password = 'MGfMdWbw';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring17_flynnj5', $user, $password);

include('functions.php');

session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

function autoloader($class) {
	include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');


if (!isset($_SESSION["playerid"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

elseif (isset($_SESSION["playerid"])) {
	$player = new Player($_SESSION['playerid'], $database);
}
?>