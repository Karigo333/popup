<?php


session_start();
require_once "db/db_connect.php";
require_once "db/News.php";

if(isset($_GET['search'])){
    $news = new News(DB::query());
    $news_id = $news->search($_GET['search']);
}   else header('Location: index.php');


if(empty($news_id)){
    $mess = 'Ничего не найдено!';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="public/icons.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Search</title>
</head>
<body>
<?php include 'header.php' ?>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            if(!empty($news_id)):
                foreach ($news_id as $value):?>
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div class="card-body h-100">
                                <h2 class="card-text"><?=$value['heading']?></h2>
                                <p class="card-text"><?=$value['description']?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?=$value['data']?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                     else:
                ?>
                <div class="alert alert-primary" role="alert">
                    <p><?=$mess?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
