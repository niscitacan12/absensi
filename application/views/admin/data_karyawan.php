<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script> -->

    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>

</head>
<body>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-black" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="#" class="flex items-center pl-2.5 mb-5">
         <img src="https://binusasmg.sch.id/ppdb/logobinusa.png" class="h-6 mr-3 sm:h-7" alt="Flowbite Logo" />
         <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Bina Nusantara</span>
      </a>
      <ul class="space-y-2 font-medium">
        <hr>
        <br>
                <li>
                    <a href="<?php echo base_url('admin/data_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-user"></i> 
                        <span class="ml-3">Data Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/tabel_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     <i class="fa-solid fa-users"></i>
                        <span class="ml-3">Rekap Keseluruhan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/rekap_harian')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-calendar-day"></i>
                        <span class="ml-3">Rekap Harian</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/rekap_mingguan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-calendar-days"></i>
                        <span class="ml-3">Rekap Mingguan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/rekap_bulanan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-calendar-week"></i>
                        <span class="ml-3">Rekap Bulanan</span>
                    </a>
                </li>
         <!-- untuk memberikan jarak -->
      <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>
      <li>
                    <a href="<?php echo base_url('auth')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover-bg-gray-700 group">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="ml-3">Logout</span>
                    </a>
                </li>
      </ul>
   </div>
</aside>

<!-- profil -->
<div id="content" role="main" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: space-between; height: 10vh;">
    <div style="text-align: center;">
        <?php
        $image_url = isset($this->session->userdata['image']) ? base_url('./assets/images/user/' . $this->session->userdata('image')) : base_url('./assets/images/user/User.png');
        ?>
        <a href="<?php echo base_url('admin/profil_admin') ?>">
            <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin: 0 auto; background: url('<?php echo $image_url; ?>') center center no-repeat; background-size: cover;">
                <img src="<?php echo $image_url; ?>" alt="profileImg" style="visibility: hidden; width: 100%; height: 100%; object-fit: cover;">
            </div>
        </a>
    </div>
</div>
<br>
<div id="content" class="mx-auto w-3/4">
     <!-- tombol export -->
     <a href="<?php echo base_url('admin/export_data_karyawan')?>" class="btn btn-success ml-20">Export</a>
     <br>
     <br>
    <table class="table table-striped table-hover" style="margin-left: 150px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no= 0; foreach ($user as $row): $no++ ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo $row->nama_depan ?></td>
                <td><?php echo $row->nama_belakang ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>