<?php

require_once 'db/User.php';
require_once 'db/db_connect.php';
if(isset($_POST['register'])){
    if($_POST['register'] == 'to register'){
        $user = new User(DB::query());
        $res = $user->register($_POST['name'],$_POST['email'], $_POST['password']);
        mail($_POST['email'], "Welcome", "Thank you for registration");
        if ($res) {
            $smsg = "Success";
        } else $fmsg = 'error: A user with this login is already register or not found';
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Registration</title>
    </head>
    <body>
    <?php include 'header.php' ?>
    <div class="container w-50 p-3 mx-auto">
        <h1>Registration</h1>
        <form method="post" action="registr.php">
            <div class="form-group">
                <?php if(isset($smsg)){?><div class="alert alert-success mt-2" role="alert"><?php echo $smsg;?></div><?php }?>
                <?php if(isset($fmsg)){?><div class="alert alert-danger mt-2" role="alert"><?php echo $fmsg;?></div><?php }?>
                <label for="formGroupExampleInput">Name</label>
                <input name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Login</label>
                <input name="email" type="email" class="form-control" id="formGroupExampleInput2" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput3">Password</label>
                <input name="password" type="password" class="form-control" id="formGroupExampleInput3" placeholder="Password" required>
            </div>
            <button name="register" type="submit" class="btn btn-primary btn_reg" value="to register">Registration</button>

        </form>
    </div>
    </body>
    </html>