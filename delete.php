<?php
session_start();
include("connection.php");

if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];
    $sql = "DELETE FROM cars WHERE id=$id;";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: show.php");
    } else {
        die(mysqli_error($conn));
    }
}
?>
