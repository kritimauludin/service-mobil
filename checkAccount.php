<?php
    session_start();

    include_once('library/modul.php');
    if (isset($_POST["buttonLogin"])){
        $username   = $_POST['username'];
        $password   = $_POST['password'];

        $query   = mysqli_query($connect, "SELECT * FROM login WHERE username = '$username'");

        //cek apakah akun ditemukan
        if(mysqli_num_rows($query) === 1){
            //cek password
            $akun   = mysqli_fetch_assoc($query);
            if(password_verify($password, $akun['password'])){
                $_SESSION["login"] = true;
                $_SESSION["akun"] = $akun;

                header("Location: master/showDashboard.php");
                exit;
            }else{
                echo "<script>alert('Password salah!!'); document.location.href = 'index.php';</script>";
            }
        }else{
            echo "<script>alert('Gagal Login!!'); document.location.href = 'index.php';</script>";
        }
    }else{
        echo "<script>alert('Eror 403 : You Dont Have Access To This Page !!'); document.location.href = 'index.php'</script>";
    }
?>