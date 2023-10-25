<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Sertakan Bootstrap CSS dari sumber yang benar -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/css/bootstrap.min.css">
  </head>
  <style>
    #content { 
        /* flex: 1;  */
        margin-left: 200px; 
        transition: 0.3s; 
        /* padding: 20px;  */
    }

    table {
    width: 100%;
    border-collapse: collapse;
  }

  table, th, td {
    border: 1px solid #ddd;
  }

  th, td {
    padding: 10px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
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
      <br>
      <hr>
      <br>
      <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?php echo base_url('admin/data_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-user"></i> 
                        <span class="ml-3">Data Karyawan</span>
                    </a>
                </li>
<!-- Menu dropdown -->
<li class="dropdown">
    <a class="nav_link submenu_item">
    <i class="fa-solid fa-chevron-down"></i>
        <span class="ml-3">Rekap</span>
    </a>
</li>
<ul class="submenu">
    <li>
        <a href="<?php echo base_url('admin/tabel_karyawan')?>" class="nav_link">
        <i class="fa-solid fa-users"></i>
        <span class="ml-3">Keseluruhan</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('admin/rekap_harian')?>" class="nav_link">
        <i class="fa-solid fa-calendar-day"></i>
            <span class="ml-3">Harian</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('admin/rekap_mingguan')?>" class="nav_link">
        <i class="fa-solid fa-calendar-days"></i>
            <span class="ml-3">Mingguan</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('admin/rekap_bulanan')?>" class="nav_link">
        <i class="fa-solid fa-calendar-week"></i>
            <span class="ml-3">Bulanan</span>
        </a>
    </li>
</ul>
         <!-- untuk memberikan jarak -->
      <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>
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
    <br><br>
    <div id="content" class="mx-auto w-3/4">
    <table class="table table-striped table-hover" style="margin-left: 150px">
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Keterangan izin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 0; foreach ($absensi as $row): $no++ ?>
<tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->kegiatan ?></td>
                <td><?php echo $row->date ?></td>
                <td><?php echo $row->jam_masuk ?></td>
                <td><?php echo $row->jam_pulang ?></td>
                <td><?php echo $row->keterangan_izin ?></td>
                <td><?php echo $row->status ?></td>
</tr>
<?php endforeach ?>
        </tbody>
    </table>
</div>
</div>
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
<!-- Script JavaScript untuk toggle dropdown -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.min.js"></script>
<script>
    // Mengambil elemen tombol yang memiliki atribut data-mdb-toggle
    const dropdownToggle = document.querySelector('[data-mdb-toggle="collapse"]');

    dropdownToggle.addEventListener('click', function() {
        const icon = dropdownToggle.querySelector('i');

        // Toggle ikon dropdown antara atas dan bawah
        if (icon.classList.contains('fa-chevron-down')) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    });
</script>
</body>
</html>