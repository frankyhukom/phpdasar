<?php 

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require("functions.php");

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if(isset($_POST["submit"])){

    if (ubah($_POST) > 0 ){
        echo "
           <script>
              alert('data berhasil diubah');
              document.location.href = 'index.php';
           </script>
        ";   
    }else{
        echo "
           <script>
              alert('data gagal diubah');
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
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h1>Edit data mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required autofocus value="<?= $mhs["nrp"]; ?>">
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required autocomplete="off" value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required autocomplete="off"value="<?= $mhs["email"]; ?>" >
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required autocomplete="off" value="<?= $mhs["jurusan"]; ?>" >
            </li>
            <li>
                <label for="gambar">Gambar :</label> <br>
                <img src="img/<?= $mhs["gambar"]; ?>" width="40"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
    
</body>
</html>