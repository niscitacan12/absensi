<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex align-items-center">
<section id="content-wrapper" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="m-0">Absensi</h5>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('karyawan/aksi_ubah_karyawan'); ?>" enctype="multipart/form-data" method="post">
                   <div class="mb-3 col-6">
                      <label for="kegiatan" class="form-label">Kegiatan</label>
                      <textarea class="form-control" name="kegiatan" id="kegiatan" rows="5"></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Tambahkan input tersembunyi untuk id -->
                    <div class="mb-3 col-6 text-left">
                       <button type="submit" class="btn btn-primary">
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