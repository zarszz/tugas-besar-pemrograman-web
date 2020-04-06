<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("template/header.php", $title); ?>
</head>
<?php $this->load->view('template/navbar.php', $jenis_obat); ?>
<body>
    <!-- <?php foreach ($obats as $obat):
        echo $obat->nama_obat . '<br/>';
      endforeach
    ?> -->
    <div class="container">
        <a href="<?php echo base_url() . 'index.php/public/user/create_account_with_admin'; ?>" class="btn btn-primary" style="margin-bottom: 30px;">
            Tambah User
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="table_contents">
                <thead>
                    <tr>
                        <th>ID USER</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <?php $this->load->view('template/js.php') ?>
    <script type="text/javascript">
        var table = null;
        $(document).ready(function(){
            table = $('#table_contents').DataTable({
                "ajax": {
                    "url": "<?php echo base_url('index.php/public/user/ajax') ?>",
                    "type": "POST"
                },
                "columns": [
                    { "data": "id_user"},
                    { "data": "nama"},
                    { "data": "email"},
                    {
                        "render": function(data, type, row){
                            update_link = `http://localhost/tugas-besar-pemrograman-web/index.php/public/user/edit_with_admin/${row.id_user}`
                            html = `<a href = ${update_link} class="btn btn-primary btn-sm">EDIT</a> | `;
                            html += `<button type="submit" class="btn btn-danger btn-sm" id="remove" value=${row.id_user}>DELETE</input>`;
                            return html;
                        }
                    }
                ]
            });
        })
        $(document).on('click', '#remove', function(){
            var id = $(this).val();
            Swal.fire({
                title: 'Apa Anda yakin ?',
                text: "Anda tidak dapat mengembalikan data tersebut",
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButtonClass: "btn btn-danger"
                },
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        url: 'http://localhost/tugas-besar-pemrograman-web/index.php/public/user/delete_ajax/' + id,
                        type: "GET",
                        success: function (){
                            table.ajax.reload();
                            Swal.fire({
                            icon: 'success',
                            title: 'Berhasil.',
                            text: 'Data tersebut berhasil di hapus'
                            });
                        },
                        error: function (){
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                            });
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>