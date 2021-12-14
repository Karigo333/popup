<?php
session_start();
require_once "db/db_connect.php";
require_once "db/News.php";

        $news = new News(DB::query());
        $news->update($_POST);

header('Location: adminPanel.php');