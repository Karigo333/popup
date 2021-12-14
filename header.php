<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand d-flex align-items-center ml-5">
            <strong>Fresh News</strong>
        </a>
        <div class="d-flex pl-3">
            <?php if ($_SESSION) { ?><?php ?>
                <div class="form-row align-items-center">
                <form class="form-inline" action="search.php" method="get">
                    <input class="" type="search" placeholder="Search by title" name="search" value="<?=isset($_GET['search'])?$_GET['search']: ''?>" required>
                    <button class="btn btn-primary my-2 my-sm-0 mx-2" type="submit">Search</button>
                </form>
                </div>
            <?php } ?>
            <?php if (!$_SESSION) { ?><?php ?><a href="login.php" class="btn btn-outline-dark bg-success mx-3" type="submit">Login</a><?php } ?>
            <?php if ($_SESSION) { ?><?php ?><a href="logout.php" class="btn btn-outline-dark bg-danger" type="submit">Logout</a><?php } ?>
        </div>
    </div>
</div>