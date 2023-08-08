<?php 
    session_start();
    if(!$_SESSION['login']){
        header('location:../index.php');
        exit;
    }
    include_once('../library/modul.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if(deletePelanggan($id) > 0){
            echo "<script>alert('Data berhasil dihapus!!'); document.location.href = 'showPelanggan.php'</script>";
        }else{
            echo "<script>alert('Data gagal dihapus!!'); document.location.href = 'showPelanggan.php'</script>";
        }
    }else{
        echo "<script>alert('Error 403 : You dont have access to this page!!');";
    }