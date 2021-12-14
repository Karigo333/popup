<?php
session_start();
require_once "db/db_connect.php";
require_once "db/News.php";


$news = new News(DB::query());
$value = $news->getById($_GET['id']);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="public/icons.png">
    <title>Update News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>news</title>
</head>
<body>
<?php include_once 'header.php';?>
<div class="container">
    <div class="input_form">
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
            <div class="form-group">
                <label for="exampleInputHeading1">Heading</label>
                <input type="text" class="form-control" id="exampleInputHeading1" value="<?= $value['heading']?>"  name="heading">
            </div>
            <div class="form-group">
                <label for="exampleInputDescription1">Description</label>
                <textarea  class="form-control" id="exampleInputDescription1"  name="description"><?= $value['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputImage1">Image</label>
                <input type="file" class="form-control" id="exampleInputImage1" value="<?= $value['image']?>" name="image">
            </div>
            <div class="form-group">
                <label for="exampleInputData1">Date</label>
                <input type="date" class="form-control" id="exampleInputData1" value="<?= $value['data']?>" name="data">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <br>
</div>
</body>
</html>

