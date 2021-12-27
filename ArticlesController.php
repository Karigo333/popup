<?php

require_once "db/db_connect.php";
require_once "db/News.php";

class ArticlesController
{

    public static function getArticlesByPage($page)
    {

        $pagination = new News();
        --$page;
        $news = $pagination->get(6, $page);
        $jsonContent = json_encode($news);
        echo $jsonContent;

    }



}