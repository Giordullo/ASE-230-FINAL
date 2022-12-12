<?php
require "../csv_util.php";
require '../auth/auth.php';

session_start();

if (!is_logged())
	header('Location: ../index.php');

$author = $_GET['author'];
$quote = $_GET['quote'];
$quoteCSV = getCSVElement('../products.csv', $author);
$authorCSV = getCSVElement('../authors.csv', $author);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../resources/css/index.css" />
        <title>Products</title>
    </head>
    <body>
    <div class="container">
        <div  id="space" class="card mb-3 bg-dark text-light">
            <div class="container">
                    <h3><?= $quoteCSV[$quote] ?></h3>
                    <p><?php echo 'Author: ' . $authorCSV[0]  . ' ' . $authorCSV[1] ?></p>
                <form method="post" action="/products/delete.php">
                    <div class="form-group">
                        <input type="hidden" name="author" value="<?=$author?>" />
                        <input type="hidden" name="quote" value="<?=$quoteCSV[$quote]?>" />
                        <input type="submit" name="submit" class="btn btn-primary" value="Delete Quote">
                    </div>
                </form>
                <form method="post" action="/products/modify.php">
                    <div class="form-group">
                        <input type="hidden" name="author" value="<?=$author?>" />
                        <input type="hidden" name="quote" value="<?=$quoteCSV[$quote]?>" />
                        <input type="submit" name="ModifyQuote" class="btn btn-primary" value="Modify Quote">
                    </div>
                </form>
                <a onclick="window.location.href='/products/index.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to index</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>

