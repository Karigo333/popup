<?php

require_once "ArticlesController.php";

class Router {

    static public function run()
    {
        $request = $_REQUEST;

        switch ($request['action']) {
            case ('get-articles'):
            {
                return ArticlesController::getArticlesByPage(); break;
            }
        }
    }
}

Router::run();