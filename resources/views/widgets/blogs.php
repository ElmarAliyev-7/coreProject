<div class="container">
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="card col-6" style="width: 18rem;">
                <img class="card-img-top" src="<?=baseUrl. '/storage/uploads/blogs' .$blog['cover'];?>"
                     alt="Card image cap" height="300px">
                <div class="card-body">
                    <h5 class="card-title"><?=$blog['title'];?></h5>
                    <p class="card-text"><?=str_limit($blog['description'], 200, '...');?></p>
                    <a href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>" class="btn btn-primary">Show More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>