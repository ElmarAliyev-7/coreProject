<?php include_once 'resources/views/admin/layouts/header.php'; ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title fw-semibold mb-4">Create Slider Page</h1>
                <div class="card">
                    <div class="card-body">
                        <?php
                        if(isset($_POST['submit'])) :
                            $result = storeSlider();
                            if($result['status']) :
                                echo "<div class='alert alert-success'>" . $result["message"] . "</div>";
                            else :
                                echo "<div class='alert alert-danger'>" . $result["message"] . "</div>";
                            endif;
                        endif;
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="subhead">SubHead</label>
                                <input type="text" name="subhead" class="form-control" id="subhead" placeholder="Enter SubHead">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="title_bold">Title Bold</label>
                                <input type="text" name="title_bold" class="form-control" id="title_bold" placeholder="Enter Title Bold">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" rows="7" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'resources/views/admin/layouts/footer.php'; ?>