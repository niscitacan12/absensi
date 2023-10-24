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
<body class="min-vh-100 d-flex align-items-center">
    <section id="content-wrapper" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                <h1>Absensi</h1>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('karyawan/aksi_ubah_karyawan') ?>" enctype="multipart/form-data"
                        method="post" class="row">
                        <div class="mb-3">
                        <label for="Kegiatan" class="form-label">Kegiatan:</label><br>
                        <textarea type="text" id="Kegiatan" name="Kegiatan" rows="4" cols="50"></textarea>  <br>
                        </div>
                        <div class="mb-3 col-6 text-left"> <!-- Tambahkan kelas text-left -->
                        <button type="submit" name="action" value="masuk" class="btn btn-info">
                           <span>Ubah</span>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
