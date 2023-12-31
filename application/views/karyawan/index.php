<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  </head>
  <style>
          /* Tombol */
          .btn-default {
        background-color: #007BFF; /* Warna latar belakang */
        color: #FFFFFF; /* Warna teks */
        border: none; /* Hapus garis tepi */
        padding: 10px 20px; /* Spasi padding */
        border-radius: 5px; /* Sudut tombol */
        cursor: pointer; /* Menunjukkan tombol bisa diklik */
    }

    .profile-details { 
        background: #f3f1f6; 
 
    } 
 
    .profile-details { 
        background: none; 
    } 
 
    .profile-details { 
        width: 78px; 
    } 
 
    .profile-details img { 
        height: 52px; 
        width: 52px; 
        object-fit: cover; 
        border-radius: 20px; 
 
        background: #1d1b31; 
    } 
 
    .profile-details .profile_name, 
    .profile-details .job { 
        color: #fff; 
        font-size: 18px; 
 
    } 

    .profile-details .job { 
        font-size: 12px; 
    }

    .card { 
 text-align: center; 
 border: 1px solid #ccc; 
 background-color: #f9f9f9; 
 border-radius: 5px; 
}

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
  </style>
<body>
 <!-- navbar -->
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

    <!-- sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-black" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <a href="#" class="flex flex-col items-center mb-5">
                <span class="text-xl font-semibold whitespace-nowrap dark:text-white">ABSENSI</span>
                <i class="fa-solid fa-fingerprint text-4xl mt-2 self-center dark:text-white"></i>
            </a>
            <hr>
            <br>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="karyawan" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover-bg-gray-700 group">
                        <i class="fa-solid fa-house"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('karyawan/history_absen')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fas fa-file mr-2"></i>
                        <span class="ml-3">History Absen</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('karyawan/absensi')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <span class="ml-3">Absen Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('karyawan/izin_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover-bg-gray-700 group">
                        <i class="fas fa-user-check mr-2"></i>
                        <span class="ml-3">Izin Karyawan</span>
                    </a>
                </li>
                <!-- Sidebar item lainnya -->
                <!-- ... -->
                <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>
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
    <?php foreach ($profile as $users): ?><a href="<?php echo base_url('karyawan/profil_karyawan') ?>" 
                            class="text-light"> 
                            <img src="<?php echo base_url('assets/images/user/' . $users->image); ?>" alt="" width="50" 
                                class="rounded-circle mb-3"></a> 
                        <?php endforeach ?>
    </div>
</div>
<br>
<h1 class="text-5xl font-bold" style="margin-left: 500px;">Dashboard <?php echo $this->session->userdata(
    'username'
); ?></h1>
<br>
    <div class="flex space-x-4 p-2 my-5" style="margin-left: 400px;">
    <div class="w-1/4 bg-blue-600 p-4 text-stone-50 rounded-lg shadow-md flex items-center">
    <i class="fas fa-user text-2xl mr-2"></i> <!-- Ikon Font Awesome -->
    <div>
        <p>Total Karyawan</p>
    </div>
    <div class="flex-grow"></div>
    <div>
        <h1 class="text-4xl font-bold">4</h1>
    </div>
</div>
<div class="w-1/4 bg-blue-600 p-4 text-stone-50 rounded-lg shadow-md flex items-center">
<i class="fas fa-bed text-2xl mr-2"></i> <!-- Ikon Font Awesome -->
    <div>
        <p>Total Cuti</p>
    </div>
    <div class="flex-grow"></div>
    <div>
        <h1 class="text-4xl font-bold">4</h1>
    </div>
</div>
        <div class="w-1/4 bg-blue-600 p-4 text-stone-50 rounded-lg shadow-md flex items-center">
    <i class="fas fa-calendar text-2xl mr-2"></i>  <!-- Ikon Font Awesome -->
    <div>
        <p>Jumlah Izin</p>
    </div>
    <div class="flex-grow"></div>
    <div>
        <h1 class="text-4xl font-bold">4</h1>
    </div>
</div>
<div class="w-1/4 bg-blue-600 p-4 text-stone-50 rounded-lg shadow-md flex items-center">
    <div>
        <i class="fas fa-clock text-2xl mr-2"></i> <!-- Ikon Font Awesome -->
        <p>Total Masuk Kerja</p>
    </div>
    <div class="flex-grow"></div>
    <h1 class="text-4xl font-bold">4</h1>
</div>
    </div>
<br>
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

<script>
    // Mengambil nilai jumlah masuk dan jumlah izin dari PHP dan menampilkannya dalam elemen HTML 
    const jumlahMasukElement = document.getElementById('jumlahMasuk'); 
    const jumlahIzinElement = document.getElementById('jumlahIzin'); 
    const jumlahTotalElement = document.getElementById('jumlahTotal'); 
 
    // Menetapkan nilai yang dihitung ke dalam elemen HTML 
    jumlahMasukElement.textContent = '<?php echo $jumlahMasuk; ?>'; 
    jumlahIzinElement.textContent = '<?php echo $jumlahIzin; ?>'; 
    jumlahTotalElement.textContent = '<?php echo $jumlahTotal; ?>'; 
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
    <script> 
    function toggleSidebar() { 
        var sidebar = document.getElementById("sidebar"); 
        var content = document.getElementById("content"); 
        sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px"; 
        content.style.marginLeft = content.style.marginLeft === "250px" ? "0" : "250px"; 
    } 
    </script> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>