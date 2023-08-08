<?php 
    session_start();

    if(!$_SESSION['login']){
        header('location:../index.php');
        exit;
    }
    include_once('../library/modul.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if(deleteSparepart($id) > 0){
            echo "<script>alert('Data Berhasil Dihapus!!'); document.location.href = 'showSparepart.php'</script>";
        }else{
            echo "<script>alert('Data Gagal Dihapus!!'); document.location.href = 'showSparepart.php'</script>";        
        }
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
    }