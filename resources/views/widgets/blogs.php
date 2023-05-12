<div class="container">
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="card col-6" style="width: 18rem;">
                <img class="card-img-top" src="<?=$blog['cover'];?>" alt="Card image cap" height="300px">
                <div class="card-body">
                    <h5 class="card-title"><?=$blog['title'];?></h5>
                    <p class="card-text"><?=str_limit($blog['description'], 200, '...');?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>