<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('library/header.php') ?>

    <!-- Custom fonts for this template-->
    <link href="library/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="library/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto col-lg-5">
                <div class="p-4 p-md-5 border rounded-3 bg-light">
                    <form action="checkAccount.php" method="POST">
                        <div class="text-center h3">Service APP</div>
                        <div class="mb-3 p-2">
                            <input type="text" name="username" class="form-control mb-2" placeholder="Username">
                            <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                        </div>            
                        <button type="submit" name="buttonLogin" class="btn btn-outline-primary btn-sm">Masuk</button>
                        <a href="index.php" type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- footer -->

<!-- end footer -->
</body>
</html>