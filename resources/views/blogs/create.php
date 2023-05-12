<?php include_once 'resources/views/layouts/header.php'; ?>
    <h1 class="text-center">Create Blog Page</h1>
    <div class="container my-1">
        <form method="post" enctype="multipart/form-data">
            <?php storeBlog();?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" rows="7" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="cover">Cover</label>
                <input type="file" name="cover" class="form-control" id="cover">
            </div>
            <div class="form-check">
                <input type="checkbox" name="status" class="form-check-input" id="status">
                <label class="form-check-label" for="status">Status</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include_once 'resources/views/layouts/footer.php'; ?>