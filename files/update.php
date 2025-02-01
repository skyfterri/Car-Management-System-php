<?php
session_start();
include("connection.php");

$notcorrect = false;

$id = $_GET['updateid'];

$sql = "SELECT * FROM cars WHERE id = '$id';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$make = $row['make_'];
$model = $row['model_'];
$body = $row['body_type'];
$fuel = $row['fuel_type'];
$color = $row['color'];

if (isset($_POST['submit'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $body = $_POST['body'];
    $fuel = $_POST['fuel'];
    $color = $_POST['color'];

    $sql = "UPDATE cars SET  make_= '$make'  , model_ = '$model' ,  body_type  = '$body' , fuel_type =   '$fuel', color=   '$color' WHERE id ='$id';";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: show.php");
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: white;
            background-image: url('https://i3.wp.com/image-1.uhdpaper.com/wallpaper/sports-car-digital-art-phone-wallpaper-hd-uhdpaper.com-755@1@l.jpg?ssl=1');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: black;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<div class="container">

    <form method="post">
        <h1>Modify Car</h1>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold;">Make</label>
            <select name="make" class="form-control">
                <option value="Toyota" <?php if($make == "Toyota") echo "selected"; ?>>Toyota</option>
                <option value="Honda" <?php if($make == "Honda") echo "selected"; ?>>Honda</option>
                <option value="Ford" <?php if($make == "Ford") echo "selected"; ?>>Ford</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold;">Model</label>
            <select name="model" class="form-control">
                <option value="Corolla" <?php if($model == "Corolla") echo "selected"; ?>>Corolla</option>
                <option value="Civic" <?php if($model == "Civic") echo "selected"; ?>>Civic</option>
                <option value="F-150" <?php if($model == "F-150") echo "selected"; ?>>F-150</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold;">Body Type</label>
            <select name="body" class="form-control">
                <option value="Sedan" <?php if($body == "Sedan") echo "selected"; ?>>Sedan</option>
                <option value="SUV" <?php if($body == "SUV") echo "selected"; ?>>SUV</option>
                <option value="Truck" <?php if($body == "Truck") echo "selected"; ?>>Truck</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold;">Fuel Type</label>
            <select name="fuel" class="form-control">
                <option value="Gasoline" <?php if($fuel == "Gasoline") echo "selected"; ?>>Gasoline</option>
                <option value="Diesel" <?php if($fuel == "Diesel") echo "selected"; ?>>Diesel</option>
                <option value="Electric" <?php if($fuel == "Electric") echo "selected"; ?>>Electric</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="color" name="color" style="margin-left:10px; height: 30px; width:540px;">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>

</div>

</body>
</html>
