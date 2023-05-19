<?php
include_once 'resources/views/front/layouts/header.php';

if(isset($_POST['delete'])) :
    $result = destroyBlog($_POST['delete']);
    if($result['status']) :
        echo "<div class='alert alert-success'>" . $result['message'] . "</div>";
    else :
        echo "<div class='alert alert-danger'>" . $result['message'] . "</div>";
    endif;
    header("Refresh:1");
endif;
?>
<div class="table-responsive">
    <table class="table table-light">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Cover</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($blogs as $blog) : ?>
            <tr>
                <th scope="row"><?=$blog['id'];?></th>
                <td><?=$blog['title'];?></td>
                <td><?=str_limit($blog['description'], 20);?></td>
                <td><img src="<?=baseUrl . "/" . $blog['cover'];?>" alt="Cover image" height="100px" width="100px"></td>
                <td><?=$blog['status'];?></td>
                <td>
                    <form action="" method="post">
                        <button name="delete" class="btn btn-danger" type="submit" value="<?=$blog['id'];?>">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include_once 'resources/views/front/layouts/footer.php'; ?>
