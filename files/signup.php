<?php

//session_start();
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/realistic-car-headlights-ad-composition-headlights-with-green-purple-illumination_1284-56577.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login {
            color: white;
            width: 400px;
            margin: 0 auto;
            margin-top: 36px;
            padding: 20px;

            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            justify-content: flex-end;
        }

        h1 {
            margin-bottom: 36px;
        }

        label {
            font-size: 22px;
        }

        input {
            font-size: 21px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
        }

        input[type="text"],
        input[type="password"],
        input[type="confirm-password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        a {
            font-size: 16px;
            display: block;
            text-align: right;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<form method="post">
    <div class="login">

        <h1>Sign Up</h1>

        <label>Email</label>
        <br><br>
        <input type="text" name="email" class="form-control">
        <br><br>

        <label>Username</label><br><br>
        <input type="text" name="username" class="form-control">
        <br><br>

        <label>Password</label>
        <br><br>
        <input type="password" name="password" class="form-control">
        <br><br>

        <label>Confirm Password</label>
        <br><br>
        <input type="confirm-password" name="password" class="form-control">
        <br>
        <a href="index.php">Log In</a>
        <br><br><br>

        <input type="submit">
        <br>

    </div>
</form>

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate input data
    if (empty($username) || empty($password) || empty($email)) {
        echo '<script>alert("Please enter all data!")</script>';
    } else if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Please enter a valid email address!")</script>';
    } else if ($confirm_password != $password) {
        echo '<script>alert("Reconfirm password!")</script>';
    } else {
        $check_query = "SELECT * FROM users WHERE user = ?";

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt_check = $conn->prepare($check_query);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Username already exists
            echo '<script>alert("Username already exists.")</script>';
        } else {
            // Insert new user into database
            $currentDateTime = date("Y-m-d H:i:s");
            $insert_query = "INSERT INTO users (email, user, password_) 
                             VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("sss", $email, $username, $hash);

            if ($stmt_insert->execute()) {
                // Sign up successful
                echo '<script>alert("You are signed up.")</script>';
            } else {
                // Error inserting into database
                echo '<script>alert("Error signing up. Please try again later.")</script>';
                error_log("Error: " . $stmt_insert->error);
            }

            // Close statement
            $stmt_insert->close();
        }

        // Close statement
        $stmt_check->close();
    }
}

?>
