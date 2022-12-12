<?php
require '../auth/auth.php';
require '../csv_util.php';

session_start();

// if the user is alreay signed in, redirect them to the members_page.php page
if (is_logged())
	header('Location: ../index.php');

if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['password'])) 
{
    signup();
}
?>

<!doctype html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <link rel="stylesheet" href="../resources/css/index.css" />
         <title>Signup</title>
     </head>
     <body>
     <div class="container text-center">
     <div  id="space" class="card mb-3 bg-dark text-light">
            <div class="container">
                <form action="/auth/signup.php" method="post">
                    <h5>Sign Up</h5>
                    <form name="post" action="/auth/signup.php">
                        <div class="form-group">
							<label>First <input type="first" name="first"></label>
                            <label>Last <input type="last" name="last"></label>
                            <label>Email <input type="email" name="email"></label>
                            <label>Password <input type="password" name="password"></label>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </form>

                </form>
				<a onclick="window.location.href='/auth/signin.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Sign In</a>
                <a onclick="window.location.href='../index.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to index</a>
            </div>
        </div>
     </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
