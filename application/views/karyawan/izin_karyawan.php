<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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

    <styl>
        /* Tombol */
        .btn-default {
        background-color: #007BFF; /* Warna latar belakang */
        color: #FFFFFF; /* Warna teks */
        border: none; /* Hapus garis tepi */
        padding: 10px 20px; /* Spasi padding */
        border-radius: 5px; /* Sudut tombol */
        cursor: pointer; /* Menunjukkan tombol bisa diklik */
    }

    <>
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
        margin-left: 250px; 
        transition: 0.3s; 
        /* padding: 20px;  */
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
                <a href="<?php echo base_url('karyawan/izin_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-user-check mr-2"></i>
                  <span class="ml-3">Izin Karyawan</span>
                </a>
                </li>
                <!-- <li>
                <a href="<?php echo base_url('karyawan/profil_karyawan')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fa-solid fa-users"></i>
                  <span class="ml-3">profil Karyawan</span>
                </li> -->
                <br><br> <br><br> <br><br> <br>
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

     <!-- profil -->
  <div id="content" role="main" style="display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
    <h1 style="margin-bottom: 20px;">Profil Karyawan</h1>
    <div class="profile-details">
        <div class="profile-content" style="text-align: center;">
            <?php
            $image_url = isset($this->session->userdata['image']) ? base_url('images/user/' . $this->session->userdata('image')) : base_url('images/user/User.png');
            ?>
            <a href="<?php echo base_url('karyawan/profil_karyawan') ?>">
                <img src="<?php echo $image_url; ?>" alt="profileImg" style="max-width: 100px; height: auto;">
            </a>
        </div>
    </div>
</div>

    <section id="content-wrapper" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="m-0">Menu Absen Izin</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('karyawan/aksi_izin') ?>" method="post">
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan:</label>
                            <input type="text" class="form-control" id="kegiatan" name="kegiatan">
                        </div>
                        <div class="mb-3 col-6 text-left"> <!-- Tambahkan kelas text-left -->
                        <button type="submit" name="action" value="masuk" class="btn btn-info">
                           <span>Izin</span>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
            title: 'Yakin mau LogOut?', 
            icon: 'warning', 
            showCancelButton: true, 
            confirmButtonColor: '#3085d6', 
            cancelButtonColor: '#d33', 
            confirmButtonText: 'Ya', 
            cancelButtonText: 'Batal' 
        }).then((result) => { 
            if (result.isConfirmed) { 
                window.location.href = "<?php echo base_url('/') ?>"; 
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