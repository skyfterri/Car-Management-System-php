<?php

session_start();

include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 30px;
            margin-bottom: 50px;
            background-image: url('https://i3.wp.com/image-1.uhdpaper.com/wallpaper/sports-car-digital-art-phone-wallpaper-hd-uhdpaper.com-755@1@l.jpg?ssl=1');
            background-size: cover;
            background-position: center;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-top: 20px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        table {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 10px;
        }

        th, td {
            color: white;
        }

        th {
            background-color: rgba(255, 255, 255, 0.1);
        }

        button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: #ddd;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Cars</h1>
    <a href="Add.php" class="text-light">
        <button>Add Car</button>
    </a>
    <a href="session_destroy.php" class="text-light">
        <button class="btn-custom" name="log_out">Log Out</button>
    </a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Make</th>
            <th scope="col">Model</th>
            <th scope="col">Body Type</th>
            <th scope="col">Fuel Type</th>
            <th scope="col">Color</th>
            <th scope="col">Operations</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM cars";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {

                $id = $row['id'];
                $make = $row['make_'];
                $model = $row['model_'];
                $body = $row['body_type'];
                $fuel = $row['fuel_type'];
                $color = $row['color'];

                echo '<tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $make . '</td>
                    <td>' . $model . '</td>
                    <td>' . $body . '</td>
                    <td>' . $fuel . '</td>
                    <td style="background-color:' . $color . '; width:150px;"></td>
                    <td>
                        <a href="update.php?updateid=' . $id . '" class="text-light"><button>Update</button></a>
                        <a href="delete.php?deleteid=' . $id . '" class="text-light"><button>Delete</button></a>
                    </td>
                </tr>';
            }

        }
        ?>

        </tbody>

    </table>

</div>
</body>
</html>

<?php

if (isset($_POST["log_out"])) {

    session_destroy();

}
?>
