<?php

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM user WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);

    $params = array(
        ":username" => $username,
        ":email" => $username
    );
    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if(password_verify($password, $user["password"])){
            session_start();
            $_SESSION["user"] = $user;
            // Tambahkan baris berikut untuk menyimpan id_user dalam session
            $_SESSION["user_id"] = $user["id_user"];
            header("Location: index.php");
        }
    }
}
?>

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
            <h1 class="wb">New Here?</h1>
            <p>Sign up and discover a great amount of opportunities!</p>
            <a href="signup.php" class="tombol">Sign Up</a>
        </div>
    </div>
    <div class="kanan">
        <div class="container">
            <h1>Login to Your Account</h1>
            <form action="" method="POST">
                Masuk ke Situs Web
                <input type="text" name="username" for="username" placeholder="Username" />
                <input type="password" name="password" for="password" placeholder="Password" />
                <input type="submit" class="signup" name="login" value="Login" />
            </form>
        </div>
    </div>
</body>
</html>
