<?php
require 'auth/auth.php';
require 'csv_util.php';

session_start();

function getProducts() 
{
    $index = $_GET['index'];
    $productArray = getProductArray();

    for($i=0; $i<count($productArray); $i++)
    {
        if (!$productArray[$i]->visible && !is_Admin())
            continue;
        if ($productArray[$i]->category != $index + 1)
            continue;
?>
        <div  id="space" class="card mb-3 bg-dark text-light">
            <h3><?= $productArray[$i]->name ?></h3>       
            <p><?= $productArray[$i]->details ?></p>
            <p> </p>

            <h5><?= "Only ".$productArray[$i]->quantity." Left" ?></h5>
            <h4><?= "Price: $".$productArray[$i]->price ?></h4>

            <row id="spacing_controls">
            <?php
            if (is_logged())
            {
            ?>
            <a href=<?= "buy.php?index=".$productArray[$i]->id ?> class="btn btn-primary" style="width: 30%">Buy</a>

            <?php
            if (is_Admin())
            {
            ?>
            <a href=<?= "/products/modify.php?index=".$productArray[$i]->id ?> class="btn btn-primary" >[ADMIN] Edit Product</a>
            <a href=<?= "/products/delete.php?index=".$productArray[$i]->id ?> class="btn btn-primary" >[ADMIN] Delete Product</a>
            <?php
            }
            ?>

            <?php
            }
            ?>
            </row>
        </div>
<?php
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="resources/css/index.css" />
        <title>FooCommerce</title>
    </head>
    <body>
        <div class="container">

            <div id="space" class="card mb-3 bg-dark text-light">
				<h1 class="display-4" style="text-align: center">FooCommerce</h1>

            <?php
            if (is_logged())
            {
            ?>
            <a onclick="window.location.href='/auth/signout.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Logout</a>
            <?php
            }
            else
            {
            ?>
            <a onclick="window.location.href='/auth/signin.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Login</a>
            <?php
            }
            ?>

            <?php
            if (is_Admin())
            {
            ?>
            <a onclick="window.location.href='/products/create.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">[ADMIN] Create Product</a>
            <?php
            }
            ?>

                <row id="spacing_controls">
                    <a onclick="window.location.href='index.php'" class="btn btn-primary">All</a>

                    <?php
                    $categoriesArray = getCategories();

                    for($i=0; $i<count($categoriesArray); $i++)
                    { 
                    ?>

                    <a href=<?= "category.php?index=".$i ?> class="btn btn-primary"><?= $categoriesArray[$i] ?></a>

                    <?php
                    }
                    ?>
                </row>
            </div>

            <?php getProducts(); ?>
        </div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    </body>
</html>