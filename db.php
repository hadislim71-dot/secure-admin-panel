<?php
$connection = mysqli_connect(
    "localhost",
    "root",
    "",
    "task16"
);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>