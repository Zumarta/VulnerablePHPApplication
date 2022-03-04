<?php
$host = "localhost";
$user = "hacking_example1337";
$db = "hacking_example1337";
$pw = "SuperVeryNiceSecretUnhackableWow2022!";

$conn = new mysqli($host, $user, $pw, $db);

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
