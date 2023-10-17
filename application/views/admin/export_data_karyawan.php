<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>

<body>
    <h1>DATA KARYAWAN</h1>
    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $this->session->userdata('email') ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><?php echo $this->session->userdata('username') ?></td>
        </tr>
    </table>
    <hr>
    <br>
    <table border="1">
        <tr style="font-weight: bold;">
            <td>ID</td>
            <td>Nama</td>
            <td>Email</td>
        </tr>
        <?php $no= 1; 
    foreach ($data_karyawan as $key) { 
        $kelas = tampilan_full_kelas_byid($key->id_karyawan);
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $key->username; ?></td>
            <td><?php echo $key->email; ?></td>
        </tr>
        <?php } ?>
    </table>

</body>

</html>