<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home Page</title>
</head>

<body>
    <!-- Navigation Bar -->
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">Welcome <?php if(session()->get('is_logged_in') == true): ?><?= esc($_SESSION['email']) ?><?php endif; ?></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <?php if(session()->get('is_logged_in') == true):?>
                        <?php if($_SESSION['role'] == 'admin'):?>
                            <a href="/admin/dashboard/user" class="btn btn-outline-secondary me-2">Admin Mode</a>
                            <a href="/logout" class="btn btn-danger ms-2">Logout</a>
                        <?php elseif($_SESSION['role'] == 'member'): ?>
                            <a href="/member/dashboard/item" class="btn btn-outline-secondary me-2">Manage Item</a>
                            <a href="/logout" class="btn btn-danger ms-2">Logout</a>
                        <?php endif;?>
                    <?php else: ?>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#registerModal"
                        class="btn btn-outline-secondary me-2">Register</a>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#loginModal"
                        class="btn btn-primary ms-2">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </section>
    <!-- /navbar -->
    <?php if(session()->has('msg')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
        <!-- Container Fluid -->
        <div class="container-fluid mt-5">
            <!--row-->
            <div class="row">
                <!--Col-3-->
                <div class="col-3">
                    <input type="text" class="form-control" id="search-input" placeholder="Search Product">
                </div>
                <!--/col-3-->
                <!--col-9-->
                <div class="col-9" id="myCards">
                    <!--row-->
                    <div class="row mb-3">
                        <?php if(!empty($getItem)):?>
                            <?php foreach($getItem as $item): ?>
                            <!--col-4-->
                            <div class="col-4">
                                <!--Card-->
                                <div class="card mb-4" style="width: 18rem; height: 50vh; display: flex;">
                                    <img src="<?= esc($item['img']) ?>" class="card-img-top" alt="..." style="max-height:20vh;">
                                    <div class="card-body d-flex flex-column">
                                        <h4 class="card-title"><?= esc($item['category']) ?></h4>
                                        <h5 class="card-text">Rp. <?= esc($item['price']) ?></h5>
                                        <h6 class="card-text">Stok : <?= esc($item['stock']) ?>
                                        </h6>
                                        <p class="card-text d-inline-block text-truncate"><?= esc($item['name_item']) ?>
                                        </p>
                                        <a type="button" class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#detailItem<?= $item['uuid'] ?>">View Detail</a>
                                    </div>
                                </div>
                                <!--/card-->
                            </div>
                            <!--/col-4-->
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!--/row-->
                </div>
                <!--/col-9-->
            </div>
            <!--/row-->
        </div>
        <!-- /Container -->
    <!-- /main content -->


</body>
<!--Register Modal-->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Create UMKM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/register/post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputRegister2" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputRegister2" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="inputRegister2" class="form-label">Nama UMKM</label>
                        <input type="text" class="form-control" id="inputRegister2" name="umkm">
                    </div>
                    <div class="mb-3">
                        <label for="inputRegister3" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputRegister3" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="inputRegister4" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="inputRegister4" name="confirmpassword">
                    </div>
                    <p>Note : Account activation requires admin approval.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Login Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Welcome Back!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/login/post" enctype="multipart/form-data" method="post">
                    <?= csrf_field()?>
                    <div class="mb-3">
                        <label for="inputLogin1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputLogin1" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="inputLogin2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputLogin2" name="password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Item Detail Modal -->
<?php foreach($getItem as $item): ?>
<div class="modal fade" id="detailItem<?= $item['uuid'] ?>" tabindex="-1" aria-labelledby="detailItemLabel <?= $item['uuid'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailItemLabel <?= $item['uuid'] ?>">Item Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-5">
                        <img src="<?= esc($item['img']) ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="col-7">
                        <h6>Item Name : <?= esc($item['name_item']) ?></h6>
                        <h6>Category  : <?= esc($item['category']) ?></h6>
                        <h6>Stok      : <?= esc($item['stock']) ?></h6>
                        <h6>Harga     : Rp <?= esc($item['price']) ?></h6>
                        <p>Deskripsi Produk : <br><br>
                            <?= esc($item['description']) ?>
                        </p>
                    </div>
                    <hr>
                    <div class="col-12">
                        <p><strong><br>Created by : <?= esc($item['umkm']) ?></strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Place an Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!--Custom JS-->
<script>
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', handleSearch);

    function handleSearch() {
        const searchValue = this.value.toLowerCase();
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            if (searchValue === '' || title.includes(searchValue)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>