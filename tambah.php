<?php 

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require("functions.php");

if(isset($_POST["submit"])){
    // var_dump($_POST); 
    // var_dump($_FILES);
    // die;
    if (tambah($_POST) > 0 ){
        echo "
           <script>
              alert('data berhasil ditambahkan');
              document.location.href = 'index.php';
           </script>
        ";   
    }else{
        echo "
           <script>
              alert('data gagal ditambahkan');
              document.location.href = 'index.php';
           </script>
        ";
    }
  // cek data berhasil atau tidak di tambahkan
//   if(mysqli_affected_rows($conn) > 0){
//     echo "Berhasil";
//   }else{
//     echo "gagal";
//     echo "<br>";
//     echo mysqli_error($conn);
//   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required autofocus>
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required autocomplete="off">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required autocomplete="off">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required autocomplete="off">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar" autocomplete="off">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
    
</body>
</html>