<?php 
session_start();
require("functions.php");

// if(isset($_COOKIE['login'])){
//     if($_COOKIE['login'] == 'true'){
//         $_SESSION['login'] = true;
//     }
// }
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarka id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ( $key === hash('sha256', $row['username'])){
        $_SESSION['LOGIN'] = true;
    }
}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}



if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1){

        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            // set session
            $_SESSION["login"] = true;
            // cek remeber me
            if(isset($_POST["remember"])){
                // buat cookie
                //setcookie('login', 'true', time() + 60);
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']),time()+60);
            }
            header("location: index.php");
            exit;
        }
    }
    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="title">Form Login</div>
        <form action="" method="post">
            <div class="field">
                <input type="text" name="username" id="username" required autocomplete="off">
                <label for="username">Masukan Nama</label>
            </div>
            <div class="field">
                <input type="password" name="password"  id="password" required>
                <label for="password">Masukkan Password</label>
            </div>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingatkan Saya</label>
                </div>
                <div class="forget">
                    <a href="#">Lupa password</a>
                </div>
            </div>
            <div class="field">
                <input type="submit" name="login" value="Login">
            </div>
            <div class="sigup">
                Belum punya akun? <a href="#">Daftar Sekarang</a>
            </div>
        </form>
    </div>
</body>
</html>