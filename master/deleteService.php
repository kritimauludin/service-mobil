<?php 
    session_start();
    if(!$_SESSION['login']){
        header('location:../index.php');
        exit;
    }
    include_once('../library/modul.php');

    if(isset($_GET['kode'])){
        $id = $_GET['kode'];
        if(deleteDataService($id) > 0){
            echo "<script>alert('Data berhasil dihapus!!'); document.location.href = 'showService.php'</script>";
        }else{
            echo "<script>alert('Data gagal dihapus!!'); document.location.href = 'showService.php'</script>";
        }
    }else{
        echo "<script>alert('Error 403 : You dont have access to this page!!');";
    }