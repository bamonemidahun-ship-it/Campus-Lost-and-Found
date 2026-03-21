<?php
include 'config/db.php';
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$item_id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$conn->query("INSERT INTO claims(item_id,claimed_by)
VALUES('$item_id','$user_id')");

$conn->query("UPDATE items SET status='claimed' WHERE id='$item_id'");

header("Location: dashboard.php");
?>