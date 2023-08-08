<?php 
    session_start();

    if(!$_SESSION['login']){
        header('location:../index.php');
        exit;
    }else if($_SESSION['akun']['role'] != 'superadmin'){
        header("location:showDashboard.php");
    }

    include_once('../library/modul.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if(deleteAdmin($id) > 0){
            echo "<script>alert('Data Berhasil Dihapus!!'); document.location.href = 'showAdmin.php'</script>";
        }else{
            echo "<script>alert('Data Gagal Dihapus!!'); document.location.href = 'showAdmin.php'</script>";        
        }
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
    }