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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
        <!-- Tautan ke Font Awesome CSS (jika Anda ingin menggunakannya) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

<!-- Tautan ke Bootstrap JavaScript (JQuery dan Popper.js diperlukan) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

    <style>
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

    /* CSS untuk tombol Export */
    button {
        margin-bottom: 50px; /* Membuat jarak antara tombol dan tabel */
        display: block; /* Membuat tombol menjadi blok, sehingga muncul di atas tabel */
    }
         /* Gaya awal untuk menyembunyikan ikon dropdown */
.toggle-icon {
    transform: rotate(0deg);
    transition: transform 0.2s;
}

/* Gaya saat dropdown dibuka (ikon diputar) */
#collapseExample1.show + .list-group-item .toggle-icon {
    transform: rotate(180deg);
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
                    <a href="<?php echo base_url('admin')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-school-flag"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
      <li>
                    <a href="<?php echo base_url('admin/data_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-user"></i> 
                        <span class="ml-3">Data Karyawan</span>
                    </a>
                </li>
                         <!-- Menu dropdown -->
<div class="container">
            <!-- Menu dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Rekapan
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('admin/tabel_karyawan')?>">
                    <i class="fa-solid fa-users"></i>
            <span class="ml-3">Keseluruhan</span>
                    </a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('admin/rekap_harian')?>">
                    <i class="fa-solid fa-calendar-day"></i>
            <span class="ml-3">Harian</span>
                    </a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('admin/rekap_mingguan')?>">
                    <i class="fa-solid fa-calendar-days"></i>
            <span class="ml-3">Mingguan</span>
                </a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('admin/rekap_bulanan')?>">
                    <i class="fa-solid fa-calendar-week"></i>
            <span class="ml-3">Bulanan</span>
                </a></li>
                </ul>
            </li>
        </div>
         <!-- untuk memberikan jarak -->
      <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> 
      <li>
      <a href="javascript:void(0);" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover-bg-gray-700 group" onclick="confirmLogout()">
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
    <?php foreach ($profile as $users): ?><a href="<?php echo base_url('admin/profil_admin') ?>" 
                            class="text-light"> 
                            <img src="<?php echo base_url('assets/images/user/' . $users->image); ?>" alt="" width="50" 
                                class="rounded-circle mb-3"></a> 
                        <?php endforeach ?> 
    </div>
</div>
<br>
<div id="content" class="mx-auto w-3/4">
    <!-- tombol export --> 
    <a href="<?php echo base_url('admin/export_rekap_mingguan')?>" class="btn btn-success ml-20">Export</a>
        <br>
<!-- untuk tabel -->
<table class="table table-striped table-hover" style="margin-left: 150px">
    <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-xs text-gray-500">NO</th>
                                <!-- <th class="px-3 py-2 text-xs text-gray-500">NAMA</th> -->
                                <th class="px-3 py-2 text-xs text-gray-500">
                                    KEGIATAN
                                </th>
                                <th class="px-3 py-2 text-xs text-gray-500">TANGGAL</th>
                                <th class="px-3 py-2 text-xs text-gray-500">JAM MASUK</th>
                                <th class="px-3 py-2 text-xs text-gray-500">JAM PULANG</th>
                                <th class="px-3 py-2 text-xs text-gray-500">KETERANGAN IZIN</th>
                                <!-- <th class="px-3 py-2 text-xs text-gray-500">AKSI</th> -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            <?php $no=0; foreach ($absensi as $absen): $no++ ?>
                            <tr class="whitespace-nowrap">
                                <td class="px-3 py-4 text-sm text-gray-500"><?php echo $no ?></td>
                                <!-- <td class="px-3 py-4"><?php echo tampil_nama_karyawan_byid($absen->id_karyawan)?></td> -->
                                <td class="px-3 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo $absen->kegiatan; ?>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo $absen->date; ?>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo $absen->jam_masuk; ?>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo $absen->jam_pulang; ?>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo $absen->keterangan_izin; ?>
                                    </div>
                                </td>
                                <!-- <td>
                                HAPUS 
                                <button onClick="hapus('<?php echo $absen->id_karyawan ?>')" class="btn btn-sm btn-danger mx-1">
                                <i class="fa-solid fa-trash"></i></button>
                            </td> -->
                            </tr>
                            <?php endforeach?>
                        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- HAPUS -->
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Apakah Kamu Ingin Menghapusnya?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('admin/hapus_karyawan/') ?>" + id;
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
    <!-- LOGOUT --> 
    <script>
   function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau Logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo base_url('/auth') ?>";
        }
    });
}
</script>
</body>
</html>