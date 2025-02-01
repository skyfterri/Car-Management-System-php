<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
        <h1>Log In</h1>

        <label>Username</label><br><br>
        <input type="text" name="username" class="form-control">
        <br><br><br>

        <label>Password</label>
        <br><br>
        <input type="password" name="password" class="form-control">
        <br><br>

        <a href="signup.php">Sign Up</a>
        <br><br><br>

        <input type="submit" value="Log In" name="submit" class="form-control">
        <br>
    </div>               
</form>
</body>
</html>

<?php
if (isset($_POST["submit"])) {

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (empty($username) && empty($password)) {
        session_unset();
        session_destroy();
        echo '<script>alert("Please enter a credentials!")</script>';
    } else if (empty($username)) {
        session_unset();
        session_destroy();
        echo '<script>alert("Please enter a username!")</script>';
    } else if (empty($password)) {
        session_unset();
        session_destroy();
        echo '<script>alert("Please enter a password!")</script>';
    } else {

        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        $sql = "SELECT * FROM users WHERE user = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $stored_password = $row["password_"];
                
                if (password_verify($password, $stored_password)) {
                    header("Location: show.php");
                } else {
                    session_unset();
                    session_destroy();
                    echo '<script>alert("Incorrect password.")</script>';
                }
            } else {
                session_unset();
                session_destroy();
                echo '<script>alert("Enter Correct credentials!")</script>';
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
