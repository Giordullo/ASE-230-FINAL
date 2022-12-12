<?php

function SQL() // Setup SQL and check if a connection has been made
{	
	$servername = "212.1.208.51:3306";
	$db_name = "u766013994_test";
	$username = "u766013994_test";
	$password = "jM~wi84[fR";
	$con = new mysqli($servername, $username, $password, $db_name);	

	while (!isset($con))
		$con = new mysqli($servername, $username, $password, $db_name);	
	
	return $con;
}

function consoleLog($output, $with_script_tags = true) // Console Logging for Error Handling
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function Alert($message) 
{     
    echo "<script>alert('".$message."');</script>";
}

function isUser($email, $password)
{
	$sql = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."' AND banned=0";
	$result = SQL()->query($sql);

	if ($result->num_rows > 0) 
		return true;
	else
		return false;
}

function isAdmin($email)
{
	$sql = "SELECT * FROM users WHERE email='".$email."' AND admin=1";
	$result = SQL()->query($sql);

	if ($result->num_rows > 0) 
		return true;
	else
		return false;
}

function isEmail($email)
{
	$sql = "SELECT * FROM users WHERE email='".$email."'";
	$result = SQL()->query($sql);

	if ($result->num_rows > 0)
		return true;
	else
		return false;
}

function getUserId($email)
{
	$sql = "SELECT * FROM users WHERE email='".$email."'";
	$result = SQL()->query($sql);

    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc()) 
        {
            return $row['id'];
        }
	else
		return false;
}

function registerUser($first, $last, $email, $password)
{
	if (!isEmail($email))
	{
		$sql = "INSERT INTO users (first, last, email, password) VALUES ('".$first."','".$last."','".$email."','".$password."')";
		SQL()->query($sql);
	}
	else
	{
		Alert("Email ".$email." is already registered");
	}
}

function getIndex($array, $index)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if ($array[$i]->id == $index)
            return $array[$i];
    }
    return [];
}

function getProductArray()
{
	$sql = "SELECT * FROM products";
	$result = SQL()->query($sql);
    $return = [];


    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            $temp = new stdClass();
            $temp->id = $row["id"];
			$temp->name = $row["name"];
            $temp->category = $row["category_id"];
            $temp->details = $row["details"];
            $temp->price = $row["price"];
            $temp->quantity = $row["quantity"];
            $temp->visible = $row["visible"];

            array_push($return, $temp);       
        }
        return $return;
    }
	else
		return [];
}

function getCategories()
{
	$sql = "SELECT * FROM categories";
	$result = SQL()->query($sql);
    $return = [];


    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            array_push($return, $row["name"]);       
        }
        return $return;
    }
	else
		return [];
}


function getStatus()
{
	$sql = "SELECT * FROM status";
	$result = SQL()->query($sql);
    $return = [];


    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            array_push($return, $row["status"]);       
        }
        return $return;
    }
	else
		return [];
}

function getOrderArray()
{
	$sql = "SELECT orders.*, orders.quantity * price as total, products.name, status FROM `orders` inner join products on products.id = product_id inner join status on status.id = status_id";
	$result = SQL()->query($sql);
    $return = [];


    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            $temp = new stdClass();
            $temp->id = $row["id"];
			$temp->product_id = $row["product_id"];
            $temp->user_id = $row["user_id"];
            $temp->status_id = $row["status_id"];
            $temp->address = $row["address"];
            $temp->quantity = $row["quantity"];
            $temp->total = $row["total"];
            $temp->name = $row["name"];
            $temp->status = $row["status"];

            array_push($return, $temp);       
        }
        return $return;
    }
	else
		return [];
}

function createProduct($name, $desc, $price, $amt, $cat)
{
    $sql = "INSERT INTO products(name, category_id, details, price, quantity) VALUES ('".$name."','".($cat + 1)."','".$desc."','".$price."','".$amt."')";
	SQL()->query($sql);
}

function editProduct($index, $name, $desc, $price, $amt, $cat, $vis)
{
    $changes = "";

    if (isset($name) && !empty(trim($name)))
        $changes = $changes . "name='" . $name . "',";
    if (isset($desc) && !empty(trim($desc)))
        $changes = $changes . "details='" . $desc . "',";
    if (isset($price) && !empty(trim($price)))
        $changes = $changes . "price=" . $price . ",";
    if (isset($amt)&& !empty(trim($amt)))
        $changes = $changes . "quantity=" . $amt . ",";
    if (isset($cat)&& !empty(trim($cat)))
        $changes = $changes . "category_id=" . ($cat + 1) . ",";
    if (isset($vis))
        $changes = $changes . "visible=" . $vis . ",";

    $changes = substr($changes, 0, -1);

    $sql = "UPDATE products SET ".$changes." WHERE id=".$index;
    consoleLog($sql);
	SQL()->query($sql);
}

function deleteProduct($index)
{
    $sql = "DELETE FROM products WHERE id=".$index;
	SQL()->query($sql);
}

function buyProduct($id, $address, $email, $amt)
{
    $sql = "INSERT INTO orders(product_id, user_id, status_id, address, quantity) VALUES ('".$id."','".getUserId($email)."','"."1"."','".$address."','".$amt."')";
	SQL()->query($sql);
    $sql = "UPDATE products SET quantity=quantity - ".$amt." WHERE id=".$id;
    SQL()->query($sql);
}

function editStatus($index, $status)
{
    $sql = "UPDATE orders SET status_id=".($status + 1)." WHERE id=".$index;
	SQL()->query($sql);
}


?>