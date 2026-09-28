<?php

require_once __DIR__ . "/db.php";
$message = "";

if (isset($_POST["add"])) {

    $name = trim($_POST["name"]);
    $category = trim($_POST["category"]);
    $price = trim($_POST["price"]);
    $quantity = trim($_POST["quantity"]);
    $description = trim($_POST["description"]);

    if (
        $name == "" ||
        $category == "" ||
        $price == "" ||
        $quantity == "" ||
        $description == ""
    ) {

        $message = "Please fill in all fields.";

    } elseif (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
//$_FILES["image"] contains infos about the uploaded file
//$_FILES["image"]["name"] gets the original filename.
//$_FILES["image"]["type"] gets the MIME type
//$_FILES["image"]["tmp_name"] gives PHP the temporary location of the uploaded file.
        $message = "Please select an image.";

    } else {

        $imageName = $_FILES["image"]["name"];
        $imageType = $_FILES["image"]["type"];
        $imageTmp = $_FILES["image"]["tmp_name"];

        $allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/webp"
        ];

        if (!in_array($imageType, $allowedTypes)) {

            $message = "Unsupported image type.";

        } else {

            $newImageName = uniqid("product_") . "_" . basename($imageName);

            $uploadPath = "uploads/" . $newImageName;

            if (move_uploaded_file($imageTmp, $uploadPath)) {

                $sql = "INSERT INTO products
                        (name, category, price, quantity, description, image)
                        VALUES
                        ('$name', '$category', '$price', '$quantity', '$description', '$newImageName')";

                if (mysqli_query($connection, $sql)) {

                    header("Location: index.php");
                    exit;

                } else {

                    $message = "Error adding product.";

                }

            } else {

                $message = "Failed to upload image.";

            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

    <div class="form-container">

        <h1 class="mb-4">
            Add Product
        </h1>

        <?php if ($message != "") { ?>

            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>

        <?php } ?>

        <form method="POST" enctype="multipart/form-data">
<!-- method POST is for normal text, but an image is a file so we need multipart/form-data -->

            <div class="mb-3">

                <label class="form-label">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    class="form-control"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Price
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                ></textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Product Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept="image/*"
                >

            </div>

            <button
                type="submit"
                name="add"
                class="btn btn-primary"
            >
                Add Product
            </button>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

<script src="Bootstrap/bootstrap.js"></script>

</body>

</html>