<div class="wrap blog-grid grey" id="blog">
    <div class="grid grid-pad">
        <div class="content" >
            <h2>Our Blog</h2>
            <?php foreach ($blogs as $blog): ?>
                <div class="col-1-2" >
                <article class="post-wrap">
                    <div class="post-img">
                        <a href="#0"><img src="<?=baseUrl . "/" . $blog['cover'];?>" alt=""></a>
                    </div>
                    <div class="post">
                        <h2 class="entry-title"><a href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>">
                                <?=$blog['title'];?>
                            </a></h2>
                        <div class="post-meta">
                            <a href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>">2 Februar, 2014</a> <span class="mid-sep">·</span> <a href="#0">Photography</a>
                        </div>
                        <p><?=str_limit($blog['description'], 200, '...');?></p>
                        <a class="btn read-more" href="<?=baseUrl;?>/blogs/show/<?=$blog['id'];?>">Read More</a>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
            <div class="col-1-1"><a class="btn" href="<?=baseUrl;?>blogs>">View All</a></div>
        </div>
    </div>
</div>
