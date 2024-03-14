<?php
session_start();

include "Controllers/Controller.php";

$controller = new MainController();

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->{$_GET['action']}();
}
