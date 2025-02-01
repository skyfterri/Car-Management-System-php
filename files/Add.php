<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $body = $_POST['body'];
    $fuel = $_POST['fuel'];
    $color = $_POST['color'];

    $sql = "INSERT INTO cars (make_, model_, body_type, fuel_type, color)
             VALUES('$make', '$model', '$body', '$fuel', '$color');";
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
    <title>Add Car</title>
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
            color: white;
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
            <h1>Add Car</h1>

            <div class="mb-3">
                <label class="form-label">Make</label>
                <select name="make" class="form-control">
                    <option value="Toyota">Toyota</option>
                    <option value="Honda">Honda</option>
                    <option value="Ford">Ford</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Model</label>
                <select name="model" class="form-control">
                    <option value="Corolla">Corolla</option>
                    <option value="Civic">Civic</option>
                    <option value="F-150">F-150</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Body Type</label>
                <select name="body" class="form-control">
                    <option value="Sedan">Sedan</option>
                    <option value="SUV">SUV</option>
                    <option value="Truck">Truck</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fuel Type</label>
                <select name="fuel" class="form-control">
                    <option value="Gasoline">Gasoline</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <input type="color" name="color" style="margin-left:10px; height: 30px; width:540px;">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>