<?php
include 'lib/library.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nis                = $_POST['nis'];
    $nama_lengkap       = $_POST['nama_lengkap'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $kelas              = $_POST['kelas'];
    $jurusan            = $_POST['jurusan'];
    $alamat             = $_POST['alamat'];
    $golongan_darah     = $_POST['golongan_darah'];
    $nama_ibu_kandung   = $_POST['nama_ibu_kandung'];
    $file               = $_POST['foto'];

    $foto               = $_FILES['foto'];

    if(!empty($foto) AND $foto['error'] == 0){      
        $path = './asset/upload/';
        $upload = move_uploaded_file($foto['tmp_name'], $path . $foto['name']);

        if(!$upload){
            flash('error', "Upload file gagal");
            header('location:index.php');
        }
        $file = $foto['name'];
    }

    
    $sql = "UPDATE siswa SET nis = '$nis', nama_lengkap = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', kelas = '$kelas', jurusan = '$jurusan', alamat = '$alamat', golongan_darah = '$golongan_darah', nama_ibu_kandung = '$nama_ibu_kandung', file = '$file' WHERE nis = '$nis' ";
    
    $mysqli -> query($sql) or die ($mysqli -> error);

    header('location: edit.php');
}

$nis = $_GET['nis'];

if(empty($nis)) header('location: index.php');

$sql = "SELECT * FROM siswa WHERE nis = '$nis'";
$query = $mysqli -> query($sql);
$siswa = $query -> fetch_array();

if(empty($siswa)) header('location: index.php');

include 'views/v_tambah.php';
?>