<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>history</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0-beta2/css/all.min.css">
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
                <!-- <img src="https://binusasmg.sch.id/ppdb/logobinusa.png" class="h-6 mr-3 sm:h-7" alt="Flowbite Logo" /> -->
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">ABSENSI</span>
            </a>
            <hr>
            <br>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="index" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover-bg-gray-700 group">
                        <i class="fa-solid fa-house"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('karyawan/absensi')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-user fa-xl"></i>
                        <span class="ml-3">Absen Karyawan</span>
                    </a>
                </li>
                <li>
                <a href="<?php echo base_url('karyawan/izin_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fa-solid fa-layer-group"></i>
                  <span class="ml-3">Izin Karyawan</span>
                </li>
                <li>
                <a href="<?php echo base_url('karyawan/history_absen')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fa-solid fa-bookmark fa-flip-horizontal"></i>
                  <span class="ml-3">History Absen</span>
                </li>
                <li>
                <a href="<?php echo base_url('karyawan/profil_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fa-solid fa-users"></i>
                  <span class="ml-3">profil Karyawan</span>
                </li>
                <br><br> <br><br> <br><br> <br><br> <br>
                <div> 
               <!-- Mengganti teks "Keluar" dengan gambar kecil dan transparan --> 
             <a href="<?php echo base_url('auth/login')?>" style="color: #fff; text-decoration: none;"> 
                <img src="https://png.pngtree.com/png-vector/20190505/ourmid/pngtree-vector-logout-icon-png-image_1022628.jpg" 
                alt="Logout" style="width: 20px; opacity: 0.5; margin-right: 10px;" /> 
             </a> 
             Logout
         </div>
            </ul>
        </div>
    </aside>

<div id="content" class="mx-auto w-3/4">
<table class="table table-striped table-hover" style="margin-left: 150px">
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan</th>
            <th>Tanggal</th>
            <th>Jam Pulang</th>
            <th>Jam Masuk</th>
         
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no= 0; foreach ($absensi as $row): $no++ ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $row->kegiatan ?></td>
            <td><?php echo $row->date ?></td>
            <td><?php echo $row->jam_masuk ?></td>
            <td><?php echo $row->jam_pulang ?></td>
           
            <td><?php echo $row->status ?></td>
            <td>
                <?php if ($row->status !== 'Done') : ?>
                    <form action="<?php echo base_url('karyawan/aksi_pulang')?>" method="post">
                         <input type="hidden" name="id_karyawan" value="<?php echo $row->id_karyawan ?>">
                         <button type="submit" class="btn btn-primary">Pulang</button>
                    </form>
                    <?php endif; ?>
                    <a href="<?php echo base_url('karyawan/aksi_ubah' . $row->id_karyawan)?>"
                    class="btn btn-primary">Ubah</a>
                    <button onClick="hapus(<?php echo $row->id_karyawan?>)"
                    class="btn btn-danger">Hapus</button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
</body>
</html>