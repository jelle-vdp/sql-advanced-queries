<?php

// Disclaimer: some actions, like creating the databases and tables and populating them with data were done via PHPMyAdmin.

define("DB_HOST", "localhost");
define("DB_USER", "jelle");
define("DB_PASS", "shrimp123");
define("DB_NAME", "classicmodels");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Question 1
echo "<h3>Question 1: How many customers do we have?</h3>";

$sql = "SELECT COUNT(*) as total FROM customers";
$result = mysqli_query($conn, $sql);
$amountOfCustomers = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>There are " . $amountOfCustomers[0]["total"] . " customers in the database.</p>";
echo "<br>";

// Question 2
echo "<h3>Question 2: What is the customer number of Mary Young?</h3>";

$sql = "SELECT customerNumber FROM customers WHERE contactFirstName='Mary' AND contactLastName='Young'";
$result = mysqli_query($conn, $sql);
$customerNumberMaryYoung = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>Mary Young's customer number is " . $customerNumberMaryYoung[0]["customerNumber"] . ".</p>";
echo "<br>";

// Question 3
echo "<h3>Question 3: What is the customer number of the person living at Magazinweg 7, Frankfurt 60528?</h3>";

$sql = "SELECT customerNumber FROM customers WHERE addressLine1='Magazinweg 7' AND city='Frankfurt' AND postalCode='60528'";
$result = mysqli_query($conn, $sql);
$customerNumberFrankfurt = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The Frankfurt based customer has the customer number " . $customerNumberFrankfurt[0]["customerNumber"] . ".</p>";
echo "<br>";

// Question 4
echo "<h3>Question 4: If you sort the employees on their last name, what is the email of the first employee?</h3>";

$sql = "SELECT email FROM employees ORDER BY lastName LIMIT 1";
$result = mysqli_query($conn, $sql);
$emailFirstEmployee = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The e-mail address of the first employee is " . $emailFirstEmployee[0]["email"] . ".</p>";
echo "<br>";


// Question 5
echo "<h3>Question 5: If you sort the employees on their last name, what is the email of the last employee?</h3>";

$sql = "SELECT email FROM employees ORDER BY lastName DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$emailFirstEmployeeDesc = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The e-mail address of the first employee is " . $emailFirstEmployeeDesc[0]["email"] . ".</p>";
echo "<br>";

// Question 6
echo "<h3>Question 6: What is first the product code of all the products from the line 'Trucks and Buses', sorted first by productscale, then by productname.</h3>";

$sql = "SELECT productCode FROM products ORDER BY productscale, productname LIMIT 1";
$result = mysqli_query($conn, $sql);
$productCode = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The first productcode after sorting is " . $productCode[0]["productCode"] . ".</p>";
echo "<br>";

// Question 7
echo "<h3>Question 7: What is the email of the first employee, sorted on their last name that starts with a 't'?</h3>";

$sql = "SELECT email FROM employees WHERE lastName LIKE 't%' ORDER BY lastName LIMIT 1";
$result = mysqli_query($conn, $sql);
$sortedEmail = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The email of the first employee who's last name starts with an 't' is " . $sortedEmail[0]["email"] . ".</p>";
echo "<br>";

// Question 8
echo "<h3>Question 8: Which customer (give customer number) payed by check on 2004-01-19?</h3>";

$sql = "SELECT customerNumber FROM payments WHERE paymentDate='2004-01-19'";
$result = mysqli_query($conn, $sql);
$customerNumber01192004 = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The customer number of the person who payed by check on 2004-01-19 is " . $customerNumber01192004[0]["customerNumber"] . ".</p>";
echo "<br>";


// Question 9
echo "<h3>Question 9: How many customers do we have living in the state Nevada or New York?</h3>";

$sql = "SELECT COUNT(*) as total FROM customers WHERE state='Nevada' OR 'New York'";
$result = mysqli_query($conn, $sql);
$totalCustomersNevadaNewYork = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of customers living in Nevada or New York is " . $totalCustomersNevadaNewYork[0]["total"] . ".</p>";
echo "<br>";

// Question 10
echo "<h3>Question 10: How many customers do we have living in the state Nevada or New York or outside the united states?</h3>";

$sql = "SELECT COUNT(*) as total FROM customers WHERE state='Nevada' OR 'New York' OR country<>'United States'";
$result = mysqli_query($conn, $sql);
$totalCustomersNevadaNewYorkNotUS = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of customers living in Nevada, New York or abroad is " . $totalCustomersNevadaNewYorkNotUS[0]["total"] . ".</p>";
echo "<br>";

?>

