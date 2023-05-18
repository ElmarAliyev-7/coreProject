<section class="ftco-section" id="blog-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h1 class="big big-2">Blog</h1>
                <h2 class="mb-4">Our Blog</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
        <div class="row d-flex">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>" class="block-20"
                       style="background-image: url(<?=baseUrl . '/' . $blog['cover'];?>);">
                    </a>
                    <div class="text mt-3 float-right d-block">
                        <div class="d-flex align-items-center mb-3 meta">
                            <p class="mb-0">
                                <span class="mr-2">June 21, 2019</span>
                                <a href="#" class="mr-2">Admin</a>
                                <a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
                            </p>
                        </div>
                        <h3 class="heading"><a href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>"><?=$blog['title'];?></a></h3>
                        <p><?=str_limit($blog['description'], 200, '...');?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
