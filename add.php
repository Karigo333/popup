<?php
//session_start();
require_once "db/db_connect.php";
require_once "db/News.php";

if(isset($_POST['ad'])){
    if($_POST['ad'] == 'add'){
        $news = new News(DB::query());
        $news->add($_POST['heading'], $_POST['description'], $_POST['image'], $_POST['data']);


//        file_put_contents("/Applications/MAMP/htdocs/main/images/fgfg.png", $_POST['image']);
        header("Location: adminPanel.php");

    }
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
    <title>Add News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>news</title>
</head>
<body>
<?php include_once 'header.php';?>
<div class="container">
    <div class="input_form">
        <form action="add.php" method="post">
            <div class="form-group">
                <label for="exampleInputHeading1">Heading</label>
                <input type="text" class="form-control" id="exampleInputHeading1"  name="heading" required>
            </div>
            <div class="form-group">
                <label for="exampleInputDescription1">Description</label>
                <input type="text" class="form-control" id="exampleInputDescription1" name="description" required>
            </div>
            <div class="form-group">
                <label for="exampleInputImage1">Image</label>
                <input type="file" class="form-control" id="exampleInputImage1" name="image" required>
            </div>
            <div class="form-group">
                <label for="exampleInputData1">Date</label>
                <input type="date" class="form-control" id="exampleInputData1" name="data" required>
            </div>
            <button name="ad" type="submit" value="add" class="btn btn-primary">Add</button>
        </form>
    </div>
    <br>
</div>
</body>
</html>
