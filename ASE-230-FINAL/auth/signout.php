<?php
require '../auth/auth.php';
session_start();
// if the user is not logged in, redirect them to the public page

// use the following guidelines to create the function in auth.php
signout();
// redirect the user to the public page.