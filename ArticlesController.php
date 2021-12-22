<?php

require_once "db/db_connect.php";
require_once "db/News.php";
require_once "Router.php";

class ArticlesController
{

    public static function getArticlesByPage()
    {

        $news = new News();
        $jsonContent = json_encode($news);
        echo($jsonContent);

    }
}