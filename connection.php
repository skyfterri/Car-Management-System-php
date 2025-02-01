<?php

$conn = new mysqli('localhost', 'root', '', 'database');

if (!$conn) {
    die(mysqli_error($conn));
}

?>
