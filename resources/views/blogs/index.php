<?php include_once 'resources/views/layouts/header.php'; ?>
<h1 class="text-center">Blogs Table</h1>
    <div class="table-responsive">
        <table class="table">
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
                    <td><img src="<?=baseUrl. '/storage/uploads/blogs' .$blog['cover'];?>" alt="Cover image" height="100px" width="100px"></td>
                    <td><?=$blog['status'];?></td>
                    <td>Delete | Edit</td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
<h1 class="text-center">All Blogs</h1>
<?php include_once 'resources/views/widgets/blogs.php'; ?>
<?php include_once 'resources/views/layouts/footer.php'; ?>