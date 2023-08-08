<?php

    $connect = mysqli_connect('localhost', 'root', '', 'db_service') or die(mysqli_error($connect));

    $base_url = 'http://localhost/servicemobil/';

    //for get data
    function query($query)
    {
        global $connect;
        $returnQuery = mysqli_query($connect, $query);

        $temp = [];
        while ($line = mysqli_fetch_assoc($returnQuery)) {
            $temp[] = $line;
        }

        return $temp;
    }


    // function add
    function addNewAdmin($data){
        global $connect;

        $username = strtolower(stripcslashes($data['username']));
        $password = mysqli_real_escape_string($connect, $data['password']);
        $role      = htmlspecialchars($data['role']);

        //check username
        $checkUsername = mysqli_query($connect, "SELECT username FROM login WHERE username = '$username'");
        if(mysqli_fetch_assoc($checkUsername)){
            echo "<script>alert('Username telah terdaftar!!');</script>";

            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO login VALUES ('', '$username', '$password', '$role')";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function addNewMontir($data){
        global $connect;

        $id_montir      = htmlspecialchars($data['id_montir']);
        $nama           = htmlspecialchars($data['nama_montir']);
        $no_telepon     = htmlspecialchars($data['no_telepon']);

        $query = "INSERT INTO montir VALUES ('$id_montir', '$nama', '$no_telepon')";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function addNewPelanggan($data){
        global $connect;

        $id_pelanggan       = htmlspecialchars($data['id_pelanggan']);         // kriti
        $nama       = htmlspecialchars($data['nama_pelanggan']);        
        $no_mobil   = htmlspecialchars($data['no_mobil']);
        $merk       = htmlspecialchars($data['merk']);
        $alamat     = htmlspecialchars($data['alamat']);
        $no_telepon = htmlspecialchars($data['no_telepon']);

        $query  = "INSERT INTO pelanggan VALUES ('$id_pelanggan', '$nama', '$alamat', '$no_telepon', '$no_mobil', '$merk')";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function addNewSparepart($data){
        global $connect;

        $id       = htmlspecialchars($data['id_sparepart']);
        $nama       = htmlspecialchars($data['nama_sparepart']);
        $harga      = htmlspecialchars($data['harga']);

        $query  = "INSERT INTO sparepart VALUES ('$id', '$nama', '$harga')";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function addNewTransaction($data){
        global $connect;

        $kd_service        = htmlspecialchars($data['kd_service']);
        $id_pelanggan      = htmlspecialchars($data['id_pelanggan']);
        $id_montir         = htmlspecialchars($data['id_montir']);
        $tgl_service       = date('Y-m-d');
        $keluhan           = htmlspecialchars($data['keluhan']);
        
        $transaksiList     = count($data['id_sparepart']);
        $i = 0;
        for($i = 0; $i<$transaksiList; $i++){
            //for table transaksi
            $id_sparepart      = $data['id_sparepart'][$i];
            $jumlah            = $data['jumlah'][$i];
            $queryTransaksi = "INSERT INTO transaksi VALUES('','$kd_service', '$id_sparepart', '$jumlah')";
            mysqli_query($connect, $queryTransaksi);
        }
        

        $query  =  "INSERT INTO service VALUES('$kd_service', '$id_pelanggan', '$id_montir', '$tgl_service', '$keluhan', '', '')";
        
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    //function update data
    function updateDataService($data){
        global $connect;

        $kd_service        = htmlspecialchars($data['kd_service']);
        $id_pelanggan      = htmlspecialchars($data['id_pelanggan']);
        $id_montir         = htmlspecialchars($data['id_montir']);
        $tgl_service       = date('Y-m-d');
        $keluhan           = htmlspecialchars($data['keluhan']);
        
        //for new sparepart add
        if(isset($data['id_sparepart'])){
            $transaksiList     = count($data['id_sparepart']);
            $i = 0;
            for($i = 0; $i<$transaksiList; $i++){
                //for table transaksi
                $id_sparepart      = $data['id_sparepart'][$i];
                $jumlah            = $data['jumlah'][$i];
                $queryTransaksi = "INSERT INTO transaksi VALUES('','$kd_service', '$id_sparepart', '$jumlah')";
                mysqli_query($connect, $queryTransaksi);
            }
        }

        //for transaksi update
        if(isset($data['update_sparepart'])){
            $updateTransaksiList     = count($data['update_sparepart']);
            $i = 0;
            for($i = 0; $i<$updateTransaksiList; $i++){
                //for table transaksi
                $id_transaksi      = $data['update_id'][$i];
                $id_sparepart      = $data['update_sparepart'][$i];
                $jumlah            = $data['update_jumlah'][$i];
                $queryTransaksi = "UPDATE transaksi SET kd_service = '$kd_service',
                                                        id_sparepart = '$id_sparepart',
                                                        jumlah = '$jumlah' WHERE id = '$id_transaksi'";
                mysqli_query($connect, $queryTransaksi);
            }
        }
        

        $query  =  "UPDATE service SET id_pelanggan = '$id_pelanggan', 
                                       id_montir = '$id_montir', 
                                       tgl_service = '$tgl_service', 
                                       keluhan = '$keluhan'
                                       WHERE kd_service = '$kd_service'";
        
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updateDataAdmin($data){
        global $connect;
        
        $id         = htmlspecialchars($data['id']);
        $username   = htmlspecialchars($data['username']);
        $password   = mysqli_real_escape_string($connect, $data['password']);

        //check passoword
        if(!empty($password)){
            $password   = password_hash($password , PASSWORD_DEFAULT);
            
            $query  = "UPDATE login SET 
                            username = '$username',
                            password = '$password' WHERE id = $id";
        }else{
            $query  = "UPDATE login SET 
                            username = '$username' WHERE id = $id";
        }
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }
    function updateAdmin($data){
        global $connect;
        
        $id         = htmlspecialchars($data['id']);
        $password   = mysqli_real_escape_string($connect, $data['password']);
        $password2  = mysqli_real_escape_string($connect, $data['password2']);

        //check passoword
        if($password !== $password2){
            echo "<script>alert('Konfirmasi gagal, password tidak sama!!'); </script>";
            
            return false;
        }

        $password   = password_hash($password , PASSWORD_DEFAULT);

        $query  = "UPDATE login SET password = '$password' WHERE id = $id";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updateMontir($data){
        global $connect;

        $id = htmlspecialchars($data['id_montir']);
        $nama = htmlspecialchars($data['nama_montir']);
        $no_telepon = htmlspecialchars($data['no_telepon']);

        $query = "UPDATE montir SET nama = '$nama',
                                no_telepon = '$no_telepon'
                                WHERE id_montir = '$id'";

        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updatePelanggan($data){
        global $connect;

        $id         = htmlspecialchars($data['id_pelanggan']);
        $nama       = htmlspecialchars($data['nama_pelanggan']);
        $alamat     = htmlspecialchars($data['alamat']);
        $no_telepon = htmlspecialchars($data['no_telepon']);
        $no_mobil   = htmlspecialchars($data['no_mobil']);
        $merk       = htmlspecialchars($data['merk']);

        $query      = "UPDATE pelanggan SET nama = '$nama',
                                        alamat = '$alamat',
                                        no_telepon = '$no_telepon',
                                        no_mobil   = '$no_mobil',
                                        merk    = '$merk'
                                        WHERE id_pelanggan = '$id'";
        
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

    function updateSparepart($data){
        global $connect;

        $id     = htmlspecialchars($data['id_sparepart']);
        $nama   = htmlspecialchars($data['nama_sparepart']);
        $harga  = htmlspecialchars($data['harga']);

        $query  =   "UPDATE sparepart SET nama  =   '$nama',
                                        harga   =   '$harga'
                                        WHERE id_sparepart = '$id'";
        
        mysqli_query($connect, $query);

        return mysqli_affected_rows($connect);
    }

//function delete
function deleteMontir($id)
{
    global $connect;

    $query = "DELETE FROM montir WHERE id_montir = $id";
    
    mysqli_query($connect, $query);
    
    return mysqli_affected_rows($connect);
}

function deleteAdmin($id){
    global $connect;

    $query = "DELETE FROM login WHERE id = '$id' AND role = 'admin'";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function deletePelanggan($id){
    global $connect;

    $query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function deleteSparepart($id){
    global $connect;

    $query = "DELETE FROM sparepart WHERE id_sparepart = '$id'";
    
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function deleteDataService ($kode){
    global $connect;

    $query  = "DELETE FROM service WHERE kd_service = '$kode'";
    $queryTransaksi  = "DELETE FROM transaksi WHERE kd_service = '$kode'";

    mysqli_query($connect, $query);
    mysqli_query($connect, $queryTransaksi);

    return mysqli_affected_rows($connect);
}

function saveInvoice($data){
    global $connect;

    $kd_service     = htmlspecialchars($data['kd_service']);
    $total_biaya    = $data['total_bayar'];

    $query = "UPDATE service SET status = 1,
                                total_biaya   = '$total_biaya'
                                WHERE kd_service = '$kd_service'";
    
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

?>