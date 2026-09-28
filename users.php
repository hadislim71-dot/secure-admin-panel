<?php

require_once "auth.php";
require_once __DIR__ . "/db.php";
?>

<?php

$sql = "SELECT id, name, email, role, created_at
        FROM users
        ORDER BY id DESC";

$result = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created</th>

        </tr>

    </thead>

    <tbody>

        <?php while ($user = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?php echo $user["id"]; ?>
                </td>

                <td>
                    <?php echo $user["name"]; ?>
                </td>

                <td>
                    <?php echo $user["email"]; ?>
                </td>

                <td>
                    <?php echo $user["role"]; ?>
                </td>

                <td>
                    <?php echo $user["created_at"]; ?>
                </td>

            </tr>

        <?php } ?>

    </tbody>

</table>
</body>
</html>
