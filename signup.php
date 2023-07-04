<?php

require_once("config.php");

if(isset($_POST['sign-up'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    $sql = "INSERT INTO user (username, email, password)
            VALUES (:username, :email, :password)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    $saved = $stmt->execute($params);

    if($saved) header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/register.css">
    <title>Buat Akun</title>
</head>
<body>
    <div class="kiri">
        <div class="container">
            <h1><a href="index.html">Authentic Store</a></h1>
            <h1 class="wb">Welcome Back</h1>
            <p>To keep connected with us please login with your personal account</p>
            <a href="login.php" class="tombol">Login</a>
        </div>
    </div>
    <div class="kanan">
        <div class="container">
            <h1>Create New Account</h1>
            <form action="" method="POST">
                Buat Akun Untuk Masuk ke Situs Web
                <input type="text" name="username" for="username" placeholder="Username" />
                <input type="email" name="email" for="email" placeholder="Email" />
                <input type="password" name="password" for="password" placeholder="Password" />
                <input type="submit" class="signup" name="sign-up" value="Sign Up" />
            </form>
        </div>
    </div>
</body>
</html>