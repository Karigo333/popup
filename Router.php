<?php

require_once "ArticlesController.php";


class Router {

    static public function run()
    {
        $request = $_REQUEST;
        $page = 1;


        switch ($request['action']) {
            case ('get-articles'):
            {
                return ArticlesController::getArticlesByPage($page);
            }
        }
    }
}

Router::run();