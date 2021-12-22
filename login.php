<?php

session_start();
require_once 'db/User.php';
require_once 'db/db_connect.php';




if ($_POST['email'] == 'karigo333@gmail.com' and $_POST['password'] == 1111) {
    header("Location: adminPanel.php");

} elseif (isset($_POST['email']) && $_POST['password']) {
    $user = new User(DB::query());
    $_SESSION['email'] = $user->in($_POST['email'], $_POST['password']);
    header("Location: index.php");
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>news</title>
</head>
<body>
<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand d-flex align-items-center ml-5">
            <strong>Fresh News</strong>
        </a>
        <div class="d-flex pl-3 ">
            <a href="registr.php" class="btn btn-outline-info " type="submit">Registration</a>
            <?php if (!$_SESSION) { ?><?php ?><a href="login.php" class="btn btn-outline-dark bg-success mx-3" type="submit">Login</a>><?php } ?>
            <?php if ($_SESSION) { ?><?php ?><a href="logout.php" class="btn btn-outline-dark bg-danger" type="submit">Logout</a><?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="input_form w-50 p-3 mx-auto">
        <h1>Login</h1>
        <form action="#" method="post">
            <div class="form-group pt-4">
                <label for="exampleInputEmail1">Login</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       name="email" placeholder="Email" required>
            </div>
            <div class="form-group pt-4">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                       placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <br>
</div>
</body>
</html>