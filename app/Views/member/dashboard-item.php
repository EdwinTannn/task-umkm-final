<!DOCTYPE html>

<?php 
  // TODO : Change to proprietary folder on the future
?>

<html lang="en">
<head>
    <title>Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('member/components/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('member/components/sidebar'); ?>
        <!-- / -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <!-- Add users -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><strong>Create an Item</strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="/member/dashboard/item/create/post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <?php if(session()->has('errors')): ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                                            <p><?= $error ?></p>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if(session()->has('success')): ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <?= session()->getFlashdata('success') ?>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- category -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4"><strong><span>Category</span></strong></div>
                                                <div class="col-12 col-md-8">
                                                    <select class="form-control" name="category">
                                                    <option value="" selected>Select.</option>
                                                    <option value="makanan">Makanan</option>
                                                    <option value="minuman">Minuman</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <!-- / -->

                                                 <!-- nama barang -->
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-4"><strong><span>Nama Barang</span></strong></div>
                                                    <div class="col-12 col-md-8">
                                                        <input class="form-control" type="text" name="name_item">
                                                    </div>
                                                </div>
                                                <!-- / -->

                                                <!-- umkm gambarl -->
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-4">
                                                        <strong><span>Gambar</span></strong>
                                                        <br>
                                                        <span class="text-danger" style="font-size: 12px;">Gambar Produk</span>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input class="form-control" type="file" placeholder="pic.jpg" name="img">
                                                    </div>
                                                </div>
                                                <!-- / -->

                                                 <!-- stok barang -->
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-4"><strong><span>Stok Barang</span></strong></div>
                                                    <div class="col-12 col-md-8">
                                                        <input class="form-control" type="number" name="stock">
                                                    </div>
                                                </div>
                                                <!-- / -->

                                                <!-- harga barang -->
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-4">
                                                        <strong><span>Harga Barang</span></strong>
                                                    <br>
                                                    <span class="text-danger" style="font-size: 12px;">Isi dengan angka (ex: 100.000)</span>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input class="form-control" type="text" name="price">
                                                    </div>
                                                </div>
                                                <!-- / -->

                                                <!-- Deskripsi barang -->
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-4">
                                                        <strong><span>Deskripsi Barang</span></strong>
                                                        <br>
                                                        <span class="text-danger" style="font-size: 12px;">Isi nama UMKM dengan lengkap</span>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input class="form-control" type="text-area" placeholder="Produk ini merupakan..." name="description">
                                                    </div>
                                                </div>
                                                <!-- / -->

                                                <!-- submit button -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4"></div>
                                                <div class="col-12 col-md-8">
                                                    <button class="btn btn-dark" type="submit">Create</button>
                                                </div>
                                                </div>
                                                <!-- / -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users list -->
                    <div class="card">
                        <div class="card-header" onclick="elementToggle(document.getElementById('calendarWrapper'))">
                            <h3 class="card-title"><strong>My Item</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Category</th>
                                                <th>Nama Barang</th>
                                                <th>Gambar</th>
                                                <th>Stok Barang</th>
                                                <th>Harga Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($getItem)): ?>
                                                <?php $count=1; foreach($getItem as $item): ?>
                                                    <tr>
                                                        <td><?= esc($count++) ?></td>
                                                        <td><?= esc($item['category']) ?></td>
                                                        <td><?= esc($item['name_item']) ?></td>
                                                        <td>
                                                            <?php if (!empty($item['img'])): ?>
                                                                <a href="#" data-toggle="modal" data-target="#imgItemMember<?= $item['uuid'] ?>">Image</a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= esc($item['stock']) ?></td>
                                                        <td>Rp. <?= esc($item['price']) ?></td>
                                                        <td><a href="#" data-toggle="modal" data-target="#descriptionItemMember<?= $item['uuid'] ?>">Description</a></td>
                                                        <td><?= esc($item['created_at']) ?></td>
                                                        <td>
                                                            <a class="btn btn-primary" data-toggle="modal" data-target="#editItemMember<?= $item['uuid'] ?>">Edit</a>
                                                            /
                                                            <a class="btn btn-danger" data-toggle="modal" data-target="#deleteItemMember<?= $item['uuid'] ?>">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>          
                    <!-- / -->
                </div>
            </div>
            <!-- /.content-header -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <!-- / -->
    </div>
    <!-- ./wrapper -->
</body>
<!-- Modal Description -->
<?php foreach ($getItem as $item): ?>
<div class="modal fade" id="descriptionItemMember<?= $item['uuid'] ?>" tabindex="-1" role="dialog" aria-labelledby="descriptionItemModalLabel<?= $item['uuid'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="descriptionItemModalLabel<?= $item['id'] ?>">Description <?= esc($item['name_item']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <?= esc($item['description']) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Image Detail -->
<?php foreach ($getItem as $item): ?>
<div class="modal fade" id="imgItemMember<?= $item['uuid'] ?>" tabindex="-1" role="dialog" aria-labelledby="imgItemModalLabel<?= $item['uuid'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="imgItemModalLabel<?= $item['id'] ?>">Image <?= esc($item['name_item']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <img width="100%" src="<?= esc($item['img']) ?>" alt="<?= esc($item['name_item']) ?>" width="100%">
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Edit Item Modal -->
<?php foreach ($getItem as $item): ?>
<div class="modal fade" id="editItemMember<?= $item['uuid'] ?>" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel<?= $item['uuid'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="editItemModalLabel<?= $item['id'] ?>">Item <?= esc($item['name_item']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/member/dashboard/item/edit/post/<?= esc($item['uuid']) ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <!-- category -->
                    <div class="row mb-2">
                    <div class="col-12 col-md-4"><strong><span>Category</span></strong></div>
                    <div class="col-12 col-md-8">
                        <select class="form-control" name="category">
                        <option value="" selected>Select.</option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                        </select>
                    </div>
                    </div>
                    <!-- / -->

                        <!-- nama barang -->
                    <div class="row mb-2">
                        <div class="col-12 col-md-4"><strong><span>Nama Barang</span></strong></div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="text" placeholder="<?= esc($item['name_item']) ?>" name="name_item">
                        </div>
                    </div>
                    <!-- / -->

                    <!-- umkm gambarl -->
                    <div class="row mb-2">
                        <div class="col-12 col-md-4">
                            <strong><span>Gambar</span></strong>
                            <br>
                            <span class="text-danger" style="font-size: 12px;">Gambar Produk</span>
                        </div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="file" placeholder="pic.jpg" name="img">
                        </div>
                    </div>
                    <!-- / -->

                        <!-- stok barang -->
                    <div class="row mb-2">
                        <div class="col-12 col-md-4"><strong><span>Stok Barang</span></strong></div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="number" placeholder="<?= esc($item['stock']) ?>" name="stock">
                        </div>
                    </div>
                    <!-- / -->

                    <!-- harga barang -->
                    <div class="row mb-2">
                        <div class="col-12 col-md-4">
                            <strong><span>Harga Barang</span></strong>
                        <br>
                        <span class="text-danger" style="font-size: 12px;">Isi dengan angka (ex: 100.000)</span>
                        </div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="text" placeholder="Rp. <?= esc($item['price']) ?>" name="price">
                        </div>
                    </div>
                    <!-- / -->

                    <!-- umkm name -->
                    <div class="row mb-2">
                        <div class="col-12 col-md-4">
                            <strong><span>Deskripsi Barang</span></strong>
                            <br>
                            <span class="text-danger" style="font-size: 12px;">Isi nama UMKM dengan lengkap</span>
                        </div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="text-area" placeholder="<?= esc($item['description']) ?>" name="description">
                        </div>
                    </div>
                    <!-- / -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Delete Item Modal -->
<?php foreach ($getItem as $item): ?>
<div class="modal fade" id="deleteItemMember<?= $item['uuid'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteItemLabel<?= $item['uuid'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteItemLabel<?= $item['uuid'] ?>">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this item?
                    <br>
                    <strong><?= esc($item['name_item']) ?></strong> Created by You?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/member/dashboard/item/delete/<?= esc($item['uuid']) ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <?= $this->include('member/components/datatable-plugin'); ?>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</html>
