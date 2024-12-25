<?php
    include "service/database.php";
    session_start();

    $register_message = "";

    if (isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hash_password = hash("sha256", $password);

        try {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";

            if($db->query($sql)) {
                $register_message = "Sign Up Successfully, Log In Now";
            } else {
                $register_message = "Sign Up Failed";
            }
        } catch (mysqli_sql_exception) {
            $register_message = "Username has been taken";
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB LOGIN</title>
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>Sign Up Account</h3>
    <i><?= $register_message ?></i>

    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="register">Sign Up Now</button>
    </form>
    <?php include "layout/footer.html" ?>
</body>
</html>