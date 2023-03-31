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
    <!-- Container -->
    <div class="container mt-5">
        <!--row-->
        <div class="row">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="category-select" class="form-label">Filter by Category:</label>
                    <select class="form-select" id="category-select">
                        <option value="">View All</option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="search-input" class="form-label">Search by Item Name:</label>
                    <input type="text" class="form-control" id="search-input" placeholder="Enter item name">
                </div>
            </div>
            <div class="row">
            <?php if(!empty($getItem)): ?>
                <?php foreach($getItem as $item): ?>
                <div class="col-6 filter-item" id="myCards" category="<?= esc($item['category']) ?>" name="<?= esc($item['name_item']) ?>">
                    <div class="card mb-3 mt-3">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="<?= esc($item['img']) ?>" class="card-img" alt="<?= esc($item['name_item']) ?>" style="max-height:27.5vh; height:27.5vh" width="100vh">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($item['name_item']) ?></h5>
                                    <p class="card-text">Stock: <?= esc($item['stock']) ?></p>
                                    <p class="card-text">Price: Rp.<?= esc($item['price']) ?></p>
                                    <p class="card-text">
                                        <strong>Created by : <?= esc($item['umkm']) ?></strong>
                                    </p>
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="badge bg-danger"><?= esc($item['category']) ?></span>
                                            <?php if(session()->get('is_logged_in') == true): ?>
                                                <?php if($item['umkm'] == $_SESSION['umkm']): ?>
                                                    <span class="badge bg-success">My Item</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6">
                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailItem<?= $item['uuid'] ?>">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
                <h5 class="modal-title" id="registerModalLabel">Fill the Form</h5>
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

<script>
    //Filter Category and Search by Item Name
    const categorySelect = document.querySelector('#category-select');
    const filterItems = document.querySelectorAll('.filter-item');
    const searchInput = document.querySelector('#search-input');

    const filterItemsByCategoryAndSearch = () => {
        const selectedCategory = categorySelect.value.toLowerCase();
        const searchValue = searchInput.value.toLowerCase();

        filterItems.forEach(item => {
            const category = item.getAttribute('category').toLowerCase();
            const itemName = item.getAttribute('name').toLowerCase();

            if ((selectedCategory === '' || selectedCategory === category) && itemName.includes(searchValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    };

    //Filter Category
    categorySelect.addEventListener('change', () => {
        filterItemsByCategoryAndSearch();
    });

    //Search by Item Name
    searchInput.addEventListener('input', () => {
        filterItemsByCategoryAndSearch();
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>