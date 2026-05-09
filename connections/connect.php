<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connection = new mysqli('localhost', 'root', '', 'dbccsfacultysystem');

if ($connection->connect_error) {
    die('Connect failed (' . $connection->connect_errno . '): ' . $connection->connect_error);
}
