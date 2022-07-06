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


// Question 11
echo "<h3>Question 11: How many customers do we have with the following conditions (only 1 query needed):  - Living in the state Nevada or New York OR - Living outside the USA and with a credit limit above 1000 dollar?</h3>";

$sql = "SELECT COUNT(*) as total FROM customers WHERE (state='Nevada' OR 'New York' OR country<>'United States') AND creditLimit > 1000";
$result = mysqli_query($conn, $sql);
$totalCustomersNevadaNewYorkNotUSWithHighCreditLimit = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of customers living in Nevada, New York or abroad, with a credit limit of $1000 or more is " . $totalCustomersNevadaNewYorkNotUSWithHighCreditLimit[0]["total"] . ".</p>";
echo "<br>";


// Question 12
echo "<h3>Question 12: How many customers don't have an assigned sales representative?</h3>";

$sql = "SELECT COUNT(*) as total FROM customers WHERE salesRepEmployeeNumber IS NULL";
$result = mysqli_query($conn, $sql);
$totalCustomersWithoutSalesRepresentative = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of customers without an assigned sales representative is " . $totalCustomersWithoutSalesRepresentative[0]["total"] . ".</p>";
echo "<br>";


// Question 13
echo "<h3>Question 13: How many orders have a comment?</h3>";

$sql = "SELECT COUNT(*) as total FROM orders WHERE comments IS NOT NULL";
$result = mysqli_query($conn, $sql);
$ordersWithComment = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of orders with a comment is " . $ordersWithComment[0]["total"] . ".</p>";
echo "<br>";


// Question 14
echo "<h3>Question 14: How many orders do we have where the comment mentions the word 'caution'?</h3>";

$sql = "SELECT COUNT(*) as total FROM orders WHERE comments LIKE '%caution%'";
$result = mysqli_query($conn, $sql);
$ordersWithCommentContainingCaution = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>The amount of orders with a comment that contains the word 'caution' is " . $ordersWithCommentContainingCaution[0]["total"] . ".</p>";
echo "<br>";


// Question 15
echo "<h3>Question 15: What is the average credit limit of our customers from the USA? (rounded)</h3>";

$sql = "SELECT ROUND(AVG(creditLimit)) FROM customers WHERE COUNTRY='USA'";
$result = mysqli_query($conn, $sql);
$averageUSCustomerCreditLimit = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The average credit limit of the custommers is " . $averageUSCustomerCreditLimit[0]["ROUND(AVG(creditLimit))"] . ".</p>";
echo "<br>";


// Question 16
echo "<h3>Question 16: What is the most common last name from our customers?</h3>";

$sql = "SELECT contactLastName, COUNT(*) as total FROM customers GROUP BY contactLastName ORDER BY COUNT(*) DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$mostCommonLastName= mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>The most common last name of the custommers is " . $mostCommonLastName[0]["contactLastName"] . ".</p>";
echo "<br>";


// Question 17
echo "<h3>Question 17: What are valid statuses of the orders?</h3>";

$sql = "SELECT DISTINCT status FROM orders";
$result = mysqli_query($conn, $sql);
$validOrderStatuses = mysqli_fetch_all($result, MYSQLI_ASSOC);

$validOrderStatusesArray = [];
foreach ($validOrderStatuses as $validOrderStatus) {
    array_push($validOrderStatusesArray, $validOrderStatus["status"]);
}

echo "<p>Valid order statuses are: " . implode(", ", $validOrderStatusesArray) . ".</p>";
echo "<br>";


// Question 18
echo "<h3>Question 18: In which countries don't we have any customers?</h3>";

$sql = "SELECT DISTINCT country FROM customers";
$result = mysqli_query($conn, $sql);
$allCountriesWithCustomers = mysqli_fetch_all($result, MYSQLI_ASSOC);

$allCountriesWithCustomersArray = [];
foreach ($allCountriesWithCustomers as $country) {
    array_push($allCountriesWithCustomersArray, $country["country"]);
};
$searchedCountries = ["Austria", "Canada", "China", "Germany", "Greece", "Japan", "Philippines", "South Korea"];
$noCustomersInTheseCountries = [];

foreach($searchedCountries as $searchedCountry) {
    if(!in_array($searchedCountry, $allCountriesWithCustomersArray)) {
        array_push($noCustomersInTheseCountries, $searchedCountry);
    }
};

echo "<p>The company has customers in: " . implode(", ", $noCustomersInTheseCountries) . ".</p>";
echo "<br>";


// Question 19
echo "<h3>Question 19: How many orders where never shipped?</h3>";

$sql = "SELECT COUNT(*) AS total FROM orders WHERE shippedDate IS NULL";
$result = mysqli_query($conn, $sql);
$amountOfNotShippedOrders = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>" . $amountOfNotShippedOrders[0]['total'] . " orders were never shipped.</p>";
echo "<br>";


// Question 20
echo "<h3>Question 20: How many customers does Steve Patterson have with a credit limit above 100 000 EUR?</h3>";

$sql = "SELECT COUNT(*) AS total FROM customers WHERE creditLimit > 100000 AND salesRepEmployeeNumber = (SELECT employeeNumber FROM employees WHERE firstName = 'Steve' AND lastName = 'Patterson')";
$result = mysqli_query($conn, $sql);
$stevePattersonCustomers = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>Steve Patterson has " . $stevePattersonCustomers[0]['total'] . " customers wth a credit limit bigger than 100 000 EUR.</p>";
echo "<br>";


// Question 21
echo "<h3>Question 21: How many orders have been shipped to our customers?</h3>";

$sql = "SELECT COUNT(*) AS total FROM orders WHERE customerNumber 
IN (SELECT customerNumber FROM customers) AND status = 'Shipped'";

$result = mysqli_query($conn, $sql);
$amountOfOrdersToOurCustomers = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>" . $amountOfOrdersToOurCustomers[0]['total'] . " orders have been sent to our customers.</p>";
echo "<br>";


// Question 22
echo "<h3>Question 22: On average, how many products do we have in each product line?</h3>";

$sql = "SELECT ROUND((SELECT COUNT(*) FROM products) / (SELECT COUNT(*) FROM productlines)) AS average";
$result = mysqli_query($conn, $sql);
$averageProductLine = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>On average each product line has " . $averageProductLine[0]['average'] . " products.</p>";
echo "<br>";

// Question 23
echo "<h3>Question 23: How many products are low in stock? (below 100 pieces)</h3>";

$sql = "SELECT COUNT(*) AS total FROM products WHERE quantityInStock < 100";
$result = mysqli_query($conn, $sql);
$amountOfProductsLowInStock = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<p>" . $amountOfProductsLowInStock[0]['total'] . " products are low in stock.</p>";
echo "<br>";
?>

