<link rel="stylesheet" href="styles.css">

<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header('location: /myclass/login.php');
}
?>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myclass";

    // Create a connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM students WHERE id=$id";
    $connection->query($sql);
}

header("location: /myclass/all_students.php");
exit;
?>