<?php include_once 'resources/views/admin/layouts/header.php'; ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title fw-semibold mb-4">Create Blog Page</h1>
                <div class="card">
                    <div class="card-body">
                        <?php
                        if(isset($_POST['submit'])) :
                            $result = updateBlog($blog['id']);
                            if($result['status']) :
                                echo "<div class='alert alert-success'>" . $result["message"] . "</div>";
                            else :
                                echo "<div class='alert alert-danger'>" . $result["message"] . "</div>";
                            endif;
                        endif;
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?=$blog['title'];?>">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" rows="7" name="description"><?=$blog['description'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cover">Cover</label>
                                <img src="<?=baseUrl . $blog['cover'];?>" alt="Blog Cover" width="100px" height="100px" class="my-2">
                                <input type="file" name="cover" class="form-control" id="cover">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" id="status"
                                    <?php if($blog['status']){ echo 'checked'; }?> />
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'resources/views/admin/layouts/footer.php'; ?>