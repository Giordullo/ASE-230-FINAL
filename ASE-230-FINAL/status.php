<?php
require 'csv_util.php';
require 'auth/auth.php';

session_start();

if (!is_logged())
	header('Location: index.php');

if (isset($_GET['index']) && empty($_POST['status'])) 
{
    $productArray = getProductArray();
    displayHTML();
}
else if (isset($_POST['index']) && isset($_POST['status'])) 
{
    editStatus($_POST['index'], $_POST['status']);
    header("Location: orders.php");
}
?>

<?php
function displayHTML() 
{
    $OrderArray = getOrderArray();
?>
     <!doctype html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <link rel="stylesheet" href="resources/css/index.css" />
         <title>Edit</title>
     </head>
     <body>
     <div class="container text-center">
     <div  id="space" class="card mb-3 bg-dark text-light">
            <div class="container">
                <form action="status.php" method="post">
                    <h5>Edit Status: <?php echo getIndex($OrderArray, $_GET['index'])->name; ?></h5>
                    <form name="post" action="status.php">
                    <input type="index" name="index" value=<?= $_GET['index'] ?> hidden>
                        <div class="form-group">
                        <label>Status
                        <select class="form-control" type="status" name="status">
                            <?php
                             $statusArray = getStatus();
                            for($i=0; $i<count($statusArray); $i++) 
                            {
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $statusArray[$i];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </label>
                        </div>
                        <p> </p>
                        <button class="btn btn-primary" type="submit">Edit Status</button>
                        </div>
                    </form>

                </form>
                <a onclick="window.location.href='orders.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to orders</a>
            </div>
        </div>
     </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
     </html>
<?php
}
