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
        <?= $this->include('admin/components/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('admin/components/sidebar'); ?>
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
                                    <h3 class="card-title"><strong>Add Users</strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="/admin/dashboard/user/create/post" enctype="multipart/form-data">
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

                                                <!-- email -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4">
                                                    <strong><span>Email</span></strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input class="form-control" type="email" placeholder="email@gmail.com" name="email">
                                                </div>
                                                </div>
                                                <!-- / -->

                                                <!-- role -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4"><strong><span>Role</span></strong></div>
                                                <div class="col-12 col-md-8">
                                                    <select class="form-control" name="role">
                                                    <option value="" selected>Select.</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="member">Member</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <!-- / -->

                                                <!-- umkm -->
                                                <div class="row mb-2" id="umkm-form">
                                                <div class="col-12 col-md-4">
                                                    <strong><span>UMKM Name</span></strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input class="form-control" type="text" placeholder="UMKM" name="umkm">
                                                </div>
                                                </div>
                                                <!-- / -->

                                                <!-- password -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4"><strong><span>Password</span></strong></div>
                                                <div class="col-12 col-md-8">
                                                    <input class="form-control" type="password" placeholder="••••••••" name="password">
                                                </div>
                                                </div>
                                                <!-- / -->

                                                <!-- confirm password -->
                                                <div class="row mb-2">
                                                <div class="col-12 col-md-4"><strong><span>Confirm Password</span></strong></div>
                                                <div class="col-12 col-md-8">
                                                    <input class="form-control" type="password" placeholder="••••••••" name="confirmpassword">
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
                            <h3 class="card-title"><strong>Users</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="card card-dark card-outline card-outline-tabs">
                                        <div class="card-header p-0 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link text-dark active" data-toggle="pill" href="#active-users" role="tab" aria-selected="true">Active</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link text-dark" data-toggle="pill" href="#inactive-users" role="tab" aria-selected="false">Inactive</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                                <div class="tab-pane fade show active" id="active-users" role="tabpanel" >
                                                    <table id="example2" class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>No.</td>
                                                                <td>Email</td>
                                                                <td>Role</td>
                                                                <td>UMKM</td>
                                                                <td>Joined Since</td>
                                                                <td>Action</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($getActiveUser)): ?>
                                                                <?php $count = 1; foreach($getActiveUser as $user): ?>
                                                                <tr>
                                                                    <td><?= esc($count++) ?></td>
                                                                    <td><?= esc($user['email']) ?></td>
                                                                    <td><?= esc($user['role']) ?></td>
                                                                    <td><?= esc($user['umkm']) ?></td>
                                                                    <td><?= esc($user['created_at']) ?></td>
                                                                    <td>
                                                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#deactivateUserModal<?= $user['id'] ?>">Deactivate</a>
                                                                        /
                                                                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserActiveModal<?= $user['id'] ?>">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="inactive-users" role="tabpanel">
                                                    <table id="example3" class="table">
                                                        <thead>
                                                            <tr>
                                                                <td>No.</td>
                                                                <td>Email</td>
                                                                <td>Role</td>
                                                                <td>UMKM</td>
                                                                <td>User Since</td>
                                                                <td>Action</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($getInactiveUser)): ?>
                                                                <?php $count = 1; foreach($getInactiveUser as $user): ?>
                                                                <tr>
                                                                    <td><?= esc($count++) ?></td>
                                                                    <td><?= esc($user['email']) ?></td>
                                                                    <td><?= esc($user['role']) ?></td>
                                                                    <td><?= esc($user['umkm']) ?></td>
                                                                    <td><?= esc($user['created_at']) ?></td>
                                                                    <td>
                                                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#activateUserModal<?= $user['id'] ?>">Activate</a>
                                                                        /
                                                                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserInactiveModal<?= $user['id'] ?>">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
<!-- Activate User Modal -->
<?php foreach ($getInactiveUser as $user): ?>
<div class="modal fade" id="activateUserModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="activateUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="activateUserModalLabel<?= $user['id'] ?>">Activate User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to activate this user's account?
                    <br>
                    <?= esc($user['email']) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/admin/dashboard/user/toggle/<?= esc($user['id']) ?>" class="btn btn-primary">Activate</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Deactivate User Modal -->
<?php foreach ($getActiveUser as $user): ?>
<div class="modal fade" id="deactivateUserModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deactivateUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="deactivateUserModalLabel<?= $user['id'] ?>">Deactivate User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to deactivate this user's account?
                    <br>
                    <?= esc($user['email']) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/admin/dashboard/user/toggle/<?= esc($user['id']) ?>" class="btn btn-primary">Deactivate</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Delete User Active Modal -->
<?php foreach ($getActiveUser as $user): ?>
<div class="modal fade" id="deleteUserActiveModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserActiveModalLabel<?= $user['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteUserActiveModalLabel<?= $user['id'] ?>">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this user's account?
                    <br>
                    <?= esc($user['email']) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/admin/dashboard/user/delete/<?= esc($user['id']) ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Delete User Inactive Modal -->
<?php foreach ($getInactiveUser as $user): ?>
<div class="modal fade" id="deleteUserInactiveModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUserInactiveModalLabel<?= $user['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteUserInactiveModalLabel<?= $user['id'] ?>">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this user's account?
                    <br>
                    <?= esc($user['email']) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/admin/dashboard/user/delete/<?= esc($user['id']) ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <?= $this->include('admin/components/datatable-plugin'); ?>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
        const roleDropdown = document.querySelector('[name="role"]');
        const umkmForm = document.querySelector('#umkm-form');

        roleDropdown.addEventListener('change', () => {
            if (roleDropdown.value === 'admin') {
            umkmForm.style.display = 'none';
            } else {
            umkmForm.style.display = '';
            }
        });
    </script>
    <!--Table Script -->
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
