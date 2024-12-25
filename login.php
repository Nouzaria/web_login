<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if (isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hash_password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
        
        $result = $db->query($sql);

        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;

            header("location: dashboard.php");

        }else {
            $login_message = "Account can't be found";
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
    <h3>Log In Account</h3>
    <i><?= $login_message ?></i>

    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="login">Log In Now</button>
    </form>
    <?php include "layout/footer.html" ?>
</body>
</html>