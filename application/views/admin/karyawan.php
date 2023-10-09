<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Konten -->
    <!-- Tabel -->
    <div class="content">
        <div class="container table-container">
            <table class="table table-striped">
    </div>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Siswa</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Gender</th>
                        <th>Kelas</th>
                        <th class="text-center">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php $no = 0; 
                                foreach ($absensi as $data_absen): 
                                    $no++ ?> 
                    <tr> 
                        <td> 
                            <?php echo $no ?> 
                        </td> 
                        <td class="text-center">
                        <a href="<?php echo base_url('') . $row->id_siswa ?>"
                                class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onClick="hapus(<?php echo $row->id_siswa; ?>)" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
 
                    </tr> 
                </tbody> 
            </table> 
            </table> 
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
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
                        window.location.href = "<?php echo base_url('') ?>" + id; 
                    } 
                }); 
            } 
            </script> 
 
            <?php if($this->session->flashdata('success')): ?> 
            <script> 
            Swal.fire({ 
                icon: 'success', 
                title: '<?=$this->session->flashdata('success')?>', 
                showConfirmButton: false, 
                timer: 1500 
            }); 
            </script> 
            <?php endif; ?>
        </div>

    </div>

    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementsByClassName("content")[0].style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementsByClassName("content")[0].style.marginLeft = "0";
    }
    </script>
    </div>

</body>

</html>