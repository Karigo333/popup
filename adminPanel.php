<?php

session_start();
require_once "db/db_connect.php";
require_once "db/News.php";
require_once "ArticlesController.php";

$news = new News(DB::query());

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$pagination = new News();
--$page;

//$jsonContent = json_encode($pagination);
//var_dump($jsonContent);

$news = $pagination->get(6, $page);
$newsCount = $pagination->getCount() / 6;



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="public/icons.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <title>Fresh News</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a href="adminPanel.php" class="navbar-brand d-flex align-items-center ml-5">
            <strong>Fresh News</strong>
        </a>
        <div class="d-flex pl-3">
            <a href="parser.php" onclick="load(); return false;" id="parser" class="btn btn-outline-dark bg-info">Parse
                News</a>
            <a href="add.php" class="btn btn-outline-dark bg-warning mx-3">Add new news</a>
            <a href="logout.php" class="btn btn-outline-dark bg-danger" type="submit">Logout</a>
        </div>
    </div>
</div>
<div class="container bgcont center-block pt-2">
    <button class="btn btn-outline-secondary" onclick="changeToRow(); return false;"><img
                src="https://img.icons8.com/plumpy/24/000000/column.png"/></button>
    <button class="btn btn-outline-secondary" onclick="changeToList(); return false;"><img
                src="https://img.icons8.com/material-two-tone/24/000000/rounded-rectangle-stroked.png"/></button>
</div>

<div class="album py-5 bg-light">
    <div id="mydiv" class="container">
        <div id="content" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            if (!empty($news)):
                foreach ($news as $key => $value):?>
                    <?php $images = str_replace('https://dailytargum.imgix.net/images/', '', $news[$key]['image']); ?>
                    <div class="col">
                        <div id="editimg" class="card shadow-sm h-100">
                            <div style="background-image: url('images/<?= $images ?>'); width: 100%; height: 300px"
                                 class="bd-placeholder-img card-img-top img">
                            </div>
                            <div class="card-body">
                                <h2 class="card-text"><?= $news[$key]['heading'] ?></h2>
                                <p class="card-text"><?= $news[$key]['description'] ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mx-3">
                                <small class="text-muted"><?= str_replace('-', '.', $news[$key]['sort_date']); ?></small>
                                <div class="d-flex pl-3 pt-1">
                                    <a href="updateForm.php?id=<?= $news[$key]['id']; ?>"
                                       class="btn btn-warning mx-2 edit" id="update">Edit</a>
                                    <a href="delete.php?delete=1&delete_id=<?= $news[$key]['id']; ?>"
                                       class="btn btn-danger del" id="delete">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
        </div>
    </div>

    <div class="col text-center after-posts mt-3">
        <button id="pagination" class="btn btn-outline-dark load-more" onclick="getNews(); return false;" type="button">
            Load more
        </button>
    </div>
<!--    <div class="container bgcont center-block pt-2">-->
<!--    --><?php //if ($newsCount): ?>
<!--        <nav aria-label="Page navigation example">-->
<!--            <ul class="pagination ">-->
<!--                <li class="page-item">-->
<!--                    <a class="page-link" href="?page=1" aria-label="Previous">-->
<!--                        <span aria-hidden="true">&laquo;</span>-->
<!--                        <span class="sr-only">Previous</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                --><?php //for ($i = 1; $i <= $newsCount; $i++): ?>
<!--                    <li class="page-item"><a class="page-link" href="?page=--><?//= $i ?><!--">--><?//= $i ?><!--</a></li>-->
<!--                --><?php //endfor; ?>
<!--                <li class="page-item">-->
<!--                    <a class="page-link" href="--><?//= $newsCount ?><!--" aria-label="Next">-->
<!--                        <span aria-hidden="true">&raquo;</span>-->
<!--                        <span class="sr-only">Next</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </nav>-->
<!--    --><?php //endif; ?>
<!--</div>-->
<!--</div>-->
<!---->
<?php //if ($news): ?>
<!--    <div id="news-page-data" data-test="--><?//=htmlspecialchars(json_encode($news))?><!--"></div>-->
<?php //endif; ?>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New news</h5>
                <button type="button" onclick="document.querySelector('.modal').classList.remove('show')" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" onclick="document.querySelector('.modal').classList.remove('show')"
                        class="btn btn-secondary" data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>
    <script src="main.js" defer></script>
</body>
</html>
