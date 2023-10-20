<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
         <div> 
               <!-- Mengganti teks "Keluar" dengan gambar kecil dan transparan --> 
             <a href="<?php echo base_url('auth/logout')?>" style="color: #fff; text-decoration: none;"> 
                <img src="https://png.pngtree.com/png-vector/20190505/ourmid/pngtree-vector-logout-icon-png-image_1022628.jpg" 
                alt="Logout" style="width: 20px; opacity: 0.5; margin-right: 10px;" /> 
             </a> 
             Logout
         </div>
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
<div class="flex space-x-4 p-2 my-5" style="margin-left: 400px;">
        <div class="w-1/4 bg-blue-600 p-4 text-stone-50  rounded-lg shadow-md">
            <p>Total Karyawan</p>
            <br>
            <h1 class="text-4xl font-bold">4</h1>
        </div>
        <div class="w-1/4 bg-blue-600 text-stone-50  p-4 rounded-lg shadow-md">
            <p>Jumlah Izin</p>
            <br>
            <h1 class="text-4xl font-bold">4</h1>
        </div>
        <div class="w-1/4 bg-blue-600 text-stone-50  p-4 rounded-lg shadow-md">
            <p>Total Masuk Kerja</p>
            <br>
            <h1 class="text-4xl font-bold">4</h1>
        </div>
    </div>

</body>
</html>