<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
    background: #f3f2f2;
    }
    .row {
    min-height: 100vh;
    }
    .form {
    background: #ffffff;
    border-radius: 4px;
    box-shadow: 0px 2px 6px -1px rgba(252, 240, 240, 0.12);
    }
    .image img {
    width: 220px;
    height: 600px;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    }
    .my-form {
    padding: 2.5rem;
    }
    .my-form h4 {
    color: #92aad0;
    }
    .my-form p {
    font-size: .875rem;
    font-weight: 400;
    }
    .btn {
    background-color: #92aad0;
    right: 0;
    }
    .btn:hover, .btn:active, .btn:focus {
    color: #fff;
    }
    a {
    bottom: 0;
    }
    .space {
    padding-bottom: 4rem;
    }
    .link {
    font-size: .875rem;
    float: right;
    color: #6582B0;
    }
    .link:hover, .link:active {
    color: #426193;
    }
    @-webkit-keyframes autofill {
    to {
    color: #666;
    background: transparent; } }
    @keyframes autofill {
    to {
    color: #666;
    background: transparent; } }
    input:-webkit-autofill {
    -webkit-animation-name: autofill;
    animation-name: autofill;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both; }
    </style>
</head>
<body>
<div class="container">
<div class="row d-flex justify-content-center align-items-center">
<div class="col-md-7">
<div class="form d-flex justify-content-between">
<div class="image">
<img src="https://mdbootstrap.com/img/Photos/Others/sidenav2.jpg">
</div>
<form action="<?php echo base_url('auth/aksi_register'); ?>" method="post" class="my-form">
<h4 class="font-weight-bold mb-3">create a new account</h4>
<br>
<br>
<br>
<!-- username -->
<div class="md-form md-outline">
<i class="fas fa-envelope prefix"></i>
<label for="usernameExample">Username</label>
<input type="username" name="username" id="usernameExample" class="form-control">
</div>
<!-- email -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<label for="emailExample">Email</label>
<input type="email" name="email" id="emailExample" class="form-control">
</div>
<!-- password  -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<label for="exampleInputPassword1">Password</label>
<input type="password" name="password" id="exampleInputPassword1" class="form-control">
</div>
 <!-- nama -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<label for="nama">Nama Depan</label>
<input type="nama" name="nama_depan" id="nama" class="form-control">
</div>
 <!-- nama  -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<label for="nama">Nama Belakang</label>
<input type="nama" name="nama_belakang" id="nama" class="form-control">
</div> 
<br>
<div class="float-right">
    <a href="<?php echo base_url('auth/login')?>" class="btn btn-rounded" type="submit">Register</a></a></p>
</div>
<hr>
<p class="text-center">already have an account? <a href="./login">account login</a></p>
<!-- <a class="link" href="#!">Forgot password? Click here.</a> -->
</form>
</div>
</div>
</div>
</div> 
        
</body>
</html>