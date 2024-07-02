<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

$uri = 'mongodb+srv://praneswara2003:pranes2wara8@cluster-1.ttlr5pr.mongodb.net/?appName=Cluster-1';

$apiVersion = new ServerApi(ServerApi::V1);

$client = new Client($uri, [], ['serverApi' => $apiVersion]);

// Select the database and collection
$database = $client->login;
$collection = $database->create;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Create a new document
    $document = [
        "username" => $username,
        "email" => $email,
        "password" => $password
    ];

    // Insert the document into the collection
    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() == 1) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}
?>
