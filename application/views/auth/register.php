<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
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
<form action="" class="my-form">
<h4 class="font-weight-bold mb-3">create a new account</h4>
<br>
<br>
<br>
<!-- username -->
<div class="md-form md-outline">
<i class="fas fa-envelope prefix"></i>
<input type="username" id="usernameExample" class="form-control">
<label for="usernameExample">Username</label>
</div>
<!-- email -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<input type="email" id="emailExample" class="form-control">
<label for="emailExample">Email</label>
</div>
<!-- nama -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<input type="nama" id="nama" class="form-control">
<label for="nama">Nama Depan</label>
</div>
<!-- nama -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<input type="nama" id="nama" class="form-control">
<label for="nama">Nama Belakang</label>
</div>
<!-- password -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<input type="password" id="exampleInputPassword1" class="form-control">
<label for="exampleInputPassword1">Password</label>
</div>
<!-- password -->
<div class="md-form md-outline">
<i class="fas fa-lock prefix"></i>
<input type="role" id="exampleInputPassword1" class="form-control">
<label for="role">Role</label>
</div>
<div class="float-right">
<form action="./login" class="my-form" method="post"><button class="btn btn-rounded" type="submit">Log In</button>
</div>
<hr>
<!-- <a class="link" href="#!">Forgot password? Click here.</a> -->
</form>
</div>
</div>
</div>
</div> 
        
</body>
</html>