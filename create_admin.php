<?php

require_once __DIR__ . "/db.php";

$name = "Admin";
$email = "admin@gmail.com";
$password = "admin123";
$role = "admin";

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, role)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $name,
    $email,
    $hashedPassword,
    $role
);

if (mysqli_stmt_execute($stmt)) {

    echo "Admin created successfully.";

} else {

    echo "Error: " . mysqli_error($connection);

}

mysqli_stmt_close($stmt);

?>