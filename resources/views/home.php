<?php include_once 'resources/views/layouts/header.php'; ?>
<h1 class="text-center">Home Page</h1>
<div class="container">
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="card col-6" style="width: 18rem;">
                <img class="card-img-top" src="<?=$blog['cover'];?>" alt="Card image cap" height="300px">
                <div class="card-body">
                    <h5 class="card-title"><?=$blog['title'];?></h5>
                    <p class="card-text"><?=$blog['description'];?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include_once 'resources/views/layouts/footer.php'; ?>
