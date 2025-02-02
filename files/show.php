<?php

session_start();

include("connection.php");

// Define the number of results per page
$results_per_page = 5; 

// Initialize filter variables
$make_filter = isset($_GET['make_filter']) ? $_GET['make_filter'] : '';
$model_filter = isset($_GET['model_filter']) ? $_GET['model_filter'] : '';
$body_type_filter = isset($_GET['body_type_filter']) ? $_GET['body_type_filter'] : '';
$fuel_type_filter = isset($_GET['fuel_type_filter']) ? $_GET['fuel_type_filter'] : '';

// Fetch unique values for dropdown filters
$make_options = [];
$model_options = [];
$body_type_options = [];
$fuel_type_options = [];

// Fetch unique Makes
$sql = "SELECT DISTINCT make_ FROM cars";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $make_options[] = $row['make_'];
}

// Fetch unique Models
$sql = "SELECT DISTINCT model_ FROM cars";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $model_options[] = $row['model_'];
}

// Fetch unique Body Types
$sql = "SELECT DISTINCT body_type FROM cars";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $body_type_options[] = $row['body_type'];
}

// Fetch unique Fuel Types
$sql = "SELECT DISTINCT fuel_type FROM cars";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $fuel_type_options[] = $row['fuel_type'];
}

// Build the base SQL query for counting total records
$sql = "SELECT COUNT(id) AS total FROM cars WHERE 1=1";
if (!empty($make_filter)) {
    $sql .= " AND make_ = '$make_filter'";
}
if (!empty($model_filter)) {
    $sql .= " AND model_ = '$model_filter'";
}
if (!empty($body_type_filter)) {
    $sql .= " AND body_type = '$body_type_filter'";
}
if (!empty($fuel_type_filter)) {
    $sql .= " AND fuel_type = '$fuel_type_filter'";
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_results = $row['total'];

// Calculate the number of pages needed
$total_pages = ceil($total_results / $results_per_page);

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1; // default to first page
}

// Calculate the starting record for the current page
$start_from = ($current_page - 1) * $results_per_page;

// Fetch the records for the current page with filters
$sql = "SELECT * FROM cars WHERE 1=1";
if (!empty($make_filter)) {
    $sql .= " AND make_ = '$make_filter'";
}
if (!empty($model_filter)) {
    $sql .= " AND model_ = '$model_filter'";
}
if (!empty($body_type_filter)) {
    $sql .= " AND body_type = '$body_type_filter'";
}
if (!empty($fuel_type_filter)) {
    $sql .= " AND fuel_type = '$fuel_type_filter'";
}
$sql .= " LIMIT $start_from, $results_per_page";

$result = mysqli_query($conn, $sql);

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
    <!-- Filter Form -->
    <form method="GET" action="show.php" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="make_filter">Make</label>
                <select class="form-control" id="make_filter" name="make_filter">
                    <option value="">All Makes</option>
                    <?php
                    foreach ($make_options as $make) {
                        $selected = ($make == $make_filter) ? 'selected' : '';
                        echo "<option value='$make' $selected>$make</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="model_filter">Model</label>
                <select class="form-control" id="model_filter" name="model_filter">
                    <option value="">All Models</option>
                    <?php
                    foreach ($model_options as $model) {
                        $selected = ($model == $model_filter) ? 'selected' : '';
                        echo "<option value='$model' $selected>$model</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="body_type_filter">Body Type</label>
                <select class="form-control" id="body_type_filter" name="body_type_filter">
                    <option value="">All Body Types</option>
                    <?php
                    foreach ($body_type_options as $body_type) {
                        $selected = ($body_type == $body_type_filter) ? 'selected' : '';
                        echo "<option value='$body_type' $selected>$body_type</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="fuel_type_filter">Fuel Type</label>
                <select class="form-control" id="fuel_type_filter" name="fuel_type_filter">
                    <option value="">All Fuel Types</option>
                    <?php
                    foreach ($fuel_type_options as $fuel_type) {
                        $selected = ($fuel_type == $fuel_type_filter) ? 'selected' : '';
                        echo "<option value='$fuel_type' $selected>$fuel_type</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
        <a href="show.php" class="btn btn-secondary mt-2">Reset Filters</a>
    </form>

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

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php
            // Display previous page button
            if ($current_page > 1) {
                echo '<li class="page-item"><a class="page-link" href="show.php?page=' . ($current_page - 1) . '&make_filter=' . $make_filter . '&model_filter=' . $model_filter . '&body_type_filter=' . $body_type_filter . '&fuel_type_filter=' . $fuel_type_filter . '">Previous</a></li>';
            }

            // Display page numbers
            for ($page = 1; $page <= $total_pages; $page++) {
                if ($page == $current_page) {
                    echo '<li class="page-item active"><a class="page-link" href="show.php?page=' . $page . '&make_filter=' . $make_filter . '&model_filter=' . $model_filter . '&body_type_filter=' . $body_type_filter . '&fuel_type_filter=' . $fuel_type_filter . '">' . $page . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="show.php?page=' . $page . '&make_filter=' . $make_filter . '&model_filter=' . $model_filter . '&body_type_filter=' . $body_type_filter . '&fuel_type_filter=' . $fuel_type_filter . '">' . $page . '</a></li>';
                }
            }

            // Display next page button
            if ($current_page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="show.php?page=' . ($current_page + 1) . '&make_filter=' . $make_filter . '&model_filter=' . $model_filter . '&body_type_filter=' . $body_type_filter . '&fuel_type_filter=' . $fuel_type_filter . '">Next</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

</body>
</html>

<?php

if (isset($_POST["log_out"])) {
    session_destroy();
}
?>
