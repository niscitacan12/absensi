<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
    height: auto;
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
<form action="<?php echo base_url();?>Auth/aksi_login" method="post" class="my-form">
<h4 class="font-weight-bold mb-3">Log in to your account</h4>
<br>
<br>
<br>
<!-- <p class="mdb-color-text">To log in, please fill in these text fiels with your e-mail address and password.</p> -->
<!-- Email address -->
<div class="md-form md-outline">
<i class="fas fa-envelope prefix"></i>
<label for="emailExample">E-mail address</label>
<input type="email" id="emailExample" name="email" class="form-control">
</div>
<!-- Password -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<label for="passwordExample">Password</label>
<input type="password" id="passwordExample" name="password" class="form-control">
</div>
<div class="space">
<br>
<div class="float-right">
<a href="<?php echo base_url('karyawan')?>" class="btn btn-rounded" type="button">Log in</a>
</div>
</div>
<hr>
        <br>  
           <p class="text-center">don't have an account yet? <a href="./">register account</a></p>  
        <br>  
</form>
</div>
</div>
</div>
</div> 
        
</body>
</html>