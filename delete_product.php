<?php

require_once __DIR__ . "/db.php";

$id = $_GET["id"];

$sql = "DELETE FROM products WHERE id = $id";

mysqli_query($connection, $sql);

header("Location: index.php");
exit;

?>