<?php
require '../csv_util.php';
require '../auth/auth.php';

session_start();

if (!is_logged())
	header('Location: ../index.php');

if (isset($_GET['index']) && empty($_POST['name']) && empty($_POST['desc']) && empty($_POST['price']) && empty($_POST['quantity']) && empty($_POST['category'])) 
{
    $productArray = getProductArray();
    displayHTML();
}
else if (isset($_POST['index']) && isset($_POST['name']) || isset($_POST['desc']) || isset($_POST['price']) || isset($_POST['quantity']) || isset($_POST['category'])) 
{
    print_r("Q: ".$_POST['quantity']);
    editProduct($_POST['index'], $_POST['name'], $_POST['desc'], $_POST['price'], $_POST['quantity'], $_POST['category'], isset($_POST['visible']) ? 1 : 0);
    header("Location: ../index.php");
}
?>

<?php
function displayHTML() 
{
    $productArray = getProductArray();
?>
     <!doctype html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <link rel="stylesheet" href="../resources/css/index.css" />
         <title>Edit</title>
     </head>
     <body>
     <div class="container text-center">
     <div  id="space" class="card mb-3 bg-dark text-light">
            <div class="container">
                <form action="modify.php" method="post">
                    <h5>Edit Product: <?php echo getIndex($productArray, $_GET['index'])->name; ?></h5>
                    <form name="post" action="/products/modify.php">
                        <div class="form-group">
                        <input type="index" name="index" value=<?= $_GET['index'] ?> hidden>
                        <label>Product Name <input type="name" name="name"></label>
                        <p> </p>
                        <label>Product Description <input type="desc" name="desc"></label>
                        <p> </p>
                        <label>Product Price <input type="price" name="price"></label>
                        <p> </p>
                        <label>Product Quantity <input type="quantity" name="quantity"></label>
                        <p> </p>
                        <label>Visible <input type="checkbox" name="visible" checked=true value=1></label>
                        <p> </p>
                        <div class="form-group">
                        <label>Product Category
                        <select class="form-control" type="category" name="category">
                            <?php
                             $categoriesArray = getCategories();
                            for($i=0; $i<count($categoriesArray); $i++) 
                            {
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $categoriesArray[$i];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </label>
                        </div>
                        <p> </p>
                        <button class="btn btn-primary" type="submit">Edit Product</button>
                        </div>
                    </form>

                </form>
                <a onclick="window.location.href='../index.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to index</a>
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
