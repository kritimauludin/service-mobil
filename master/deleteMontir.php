<?php
    session_start();

    if(!$_SESSION['login']){
        header("location:../index.php");
        exit;
    }
    
    include_once('../library/modul.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        if(deleteMontir($id) > 0){
            echo "
                <script>
                    alert('Data Berhasil dihapus');
                    document.location.href = 'showMontir.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data Gagal dihapus');
                    document.location.href = 'showMontir.php';
                </script>
            ";
        }
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!')</script>";
    }