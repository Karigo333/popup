<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

require_once "db/db_connect.php";
//require_once "parser.php";
require_once "db/News.php";
$news = new News(DB::query());



$page = 1;
if (isset($_GET['page']))
{
    $page = $_GET['page'];
}
$pagination = new News();
--$page;
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
</head>
<body>
<?php include_once 'header.php'; ?>
<div class="album py-5 bg-light">
    <div class="container">
        <div id="content" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            if(!empty($news)):
                foreach ($news as $key => $value):?>
                    <?php $images = str_replace( 'https://dailytargum.imgix.net/images/', '', $news[$key]['image']);?>

                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img alt="<?=$news[$key]['heading']?>" class="bd-placeholder-img card-img-top" width="100%" height="250px" src="images/<?=$images?>">
                            <div class="card-body">
                                <h2 class="card-text"><?=$news[$key]['heading']?></h2>
                                <p class="card-text"><?=$news[$key]['description']?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mx-3">
                                <small class="text-muted"><?=$news[$key]['sort_date']?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $newsCount; $i++): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $newsCount ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</div>

</body>
</html>