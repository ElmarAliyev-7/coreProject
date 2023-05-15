<?php include_once 'resources/views/layouts/header.php'; ?>
<div class="container text-center" style="word-break: break-all;">
    <h1><?=$blog['title'];?></h1>
    <img src="<?=baseUrl . "/" . $blog['cover'];?>" alt="Cover" height="200px" width="200px">
    <p><?=$blog['description'];?></p>
    <h5>Status : <span class="text-danger"><?=$blog['status'];?></span></h5>
</div>
<?php include_once 'resources/views/layouts/footer.php'; ?>