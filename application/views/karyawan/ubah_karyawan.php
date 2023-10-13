<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="min-vh-100 d-flex align-items-center">
    <div class="card w-50 m-auto p-3">
        <div class="content">
            <h3 class="text-center p-3">Absensi</h3>
            <?php foreach ($absensi as $absen): ?>
                <form action="<?php echo base_url('keuangan/aksi_ubah_bayar'); ?>" method="post" class="row" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="<?php echo $absen->id; ?>">
                    <div class="mb-3 col-6">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <textarea name="kegiatan" id="kegiatan" cols="30" rows="5"><?php echo $absen->kegiatan; ?></textarea>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
