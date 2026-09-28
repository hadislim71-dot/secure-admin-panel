<?php

require_once "auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">

        <h1 class="text-end" id="TitlepageTxt">
            Admin Panel
        </h1>

        <a
            href="logout.php"
            class="btn btn-danger"
        >
            Logout
        </a>

    </div>

    <h4 class="mb-4">
        Welcome, <?php echo $_SESSION["user_name"]; ?>
    </h4>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card">

                <div class="card-body">

                    <h4>
                        Products
                    </h4>

                    <p>
                        Manage products.
                    </p>

                    <a
                        href="products.php"
                        class="btn btn-primary"
                    >
                        View Products
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card">

                <div class="card-body">

                    <h4>
                        Orders
                    </h4>

                    <p>
                        View customer orders.
                    </p>

                    <a
                        href="orders.php"
                        class="btn btn-primary"
                    >
                        View Orders
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card">

                <div class="card-body">

                    <h4>
                        Users
                    </h4>

                    <p>
                        Manage users.
                    </p>

                    <a
                        href="users.php"
                        class="btn btn-primary"
                    >
                        View Users
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>