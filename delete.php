<?php
session_start();
require_once "db/db_connect.php";
require_once "db/News.php";

$news = new News(DB::query());

if(isset($_GET['delete']) && $_GET['delete'] == 1 && isset($_GET['delete_id'])){
    $news->delete($_GET['delete_id']);
    header('Location: adminPanel.php');
}