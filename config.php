<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarymanagementsystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}
?>
