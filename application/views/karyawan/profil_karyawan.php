<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    /* Tombol */
    .btn-default {
        background-color: #007BFF;
        /* Warna latar belakang */
        color: #FFFFFF;
        /* Warna teks */
        border: none;
        /* Hapus garis tepi */
        padding: 10px 20px;
        /* Spasi padding */
        border-radius: 5px;
        /* Sudut tombol */
        cursor: pointer;
        /* Menunjukkan tombol bisa diklik */
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
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <!-- Profil Navbar -->
            <div class="navbar-profile">
                <a href="<?php echo base_url('karyawan/profil_karyawan') ?>" class="text-gray-900 dark:text-white">
                    <i class="fa-regular fa-user"></i>
                    <span class="ml-3"></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-2">
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
        </div>
        <div class="col-10">
            <!-- content profil-->
            <div class="container">
                <div class="row ">
                    <?php foreach($akun as $user) : ?>
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header bg-primary text-white text-center">Foto Profil</div>
                            <div class="card-body text-center justify-content-center">
                                <img class="img-account-profile rounded-circle mb-2 w-25 mx-auto d-block"
                                src="<?php echo base_url('assets/images/user/' .$user->image) ?>" alt="">
                                <div class="small font-italic text-muted">Harus berbentuk jpg/jpeg/png.</div>
                                <p class="small font-italic text-muted mb-4">Disarankan berukuran 1:1</p>
                                <form action="<?php echo base_url('karyawan/edit_foto'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <label for="image_upload" class="btn btn-info">
                                        Edit Foto
                                        <input type="file" id="image_upload" name="userfile" style="display: none;">
                                    </label>
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- content data -->
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white text-center">Informasi Data</div>
                            <div class="card-body">
                                <form action="<?php echo base_url('karyawan/edit_profile'); ?>"
                                    enctype="multipart/form-data" method="post">
                                    <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Masukan email"
                                            value="<?php echo $user->email ?>" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" id="username" type="text"
                                            placeholder="Masukan username" value="<?php echo $user->username ?>"
                                            name="username">
                                    </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_depan">Nama Depan</label>
                                            <input class="form-control" id="nama_depan" type="text"
                                                placeholder="Masukan nama depan" value="<?php echo $user->nama_depan ?>"
                                                name="nama_depan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_belakang">Nama Belakang</label>
                                            <input class="form-control" id="nama_belakang" type="text"
                                                placeholder="Masukan nama belakang"
                                                value="<?php echo $user->nama_belakang ?>" name="nama_belakang">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="small mb-1" for="password">Password Lama</label>
        <div class="input-group">
            <input class="form-control" id="password" type="password" placeholder="Masukkan password lama" name="password_lama">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="showPassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label class="small mb-1" for="password">Password Baru</label>
        <div class="input-group">
            <input class="form-control" id="newPassword" type="password" placeholder="Masukan password baru" name="password_baru">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="showNewPassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <label class="small mb-1" for="password">Konfirmasi Password</label>
        <div class="input-group">
            <input class="form-control" id="konfirmasi_password" type="password" placeholder="Konfirmasi password" name="konfirmasi_password">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="showConfirmPassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
<br>
                                    <button class="btn btn-info" type="submit">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>


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

    <!-- script untuk password -->
    <script>
    document.getElementById('showPassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordInput.placeholder = 'Password Lama';
        } else {
            passwordInput.type = 'password';
            passwordInput.placeholder = '•••••••••';
        }
    });

    document.getElementById('showNewPassword').addEventListener('click', function() {
        var newPasswordInput = document.getElementById('newPassword');
        if (newPasswordInput.type === 'password') {
            newPasswordInput.type = 'text';
            newPasswordInput.placeholder = 'Password Baru';
        } else {
            newPasswordInput.type = 'password';
            newPasswordInput.placeholder = '•••••••••';
        }
    });

    document.getElementById('showConfirmPassword').addEventListener('click', function() {
        var confirmPasswordInput = document.getElementById('konfirmasi_password');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            confirmPasswordInput.placeholder = 'Konfirmasi Password';
        } else {
            confirmPasswordInput.type = 'password';
            confirmPasswordInput.placeholder = '•••••••••';
        }
    });
</script>
</body>

</html>