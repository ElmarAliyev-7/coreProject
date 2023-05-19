<?php
const baseUrl = 'http://localhost:8080/';
require_once 'System\helpers.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="<?=baseUrl . 'public/back/src/';?>/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="<?=baseUrl . 'public/back/src/';?>/assets/css/styles.min.css" />
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="<?=baseUrl;?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="<?=baseUrl . 'public/back/src/';?>/assets/images/logos/dark-logo.svg" width="180" alt="">
                            </a>
                            <p class="text-center">
                                <?php
                                if(isset($_POST['submit'])){
                                    $post = loginPost();
                                    if($post['status'] == 1) {
                                        echo "<div class='alert alert-success'>". $post["message"]. "</div>";
                                        header("refresh:2;url=Location:http://localhost:8080/admin/dashboard");
                                    }elseif ($post['status'] == 0) {
                                        echo "<div class='alert alert-danger'>". $post["message"]. "</div>";
                                    }
                                }
                                ?>
                            </p>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                            Remeber this Device
                                        </label>
                                    </div>
                                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=baseUrl . 'public/back/src/';?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?=baseUrl . 'public/back/src/';?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>