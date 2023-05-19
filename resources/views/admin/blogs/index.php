<?php include_once 'resources/views/admin/layouts/header.php';?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Blogs Page</h5>
                <?php
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
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Cover</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($blogs as $blog) : ?>
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?=$blog['id'];?></h6></td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1"><?=$blog['title'];?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal"><?=str_limit($blog['description'], 20);?></p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <img src="<?=baseUrl . '/' . $blog['cover'];?>" alt="Blog Cover" width="100px" height="100px">
                                </h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <?php if($blog['status'] == 0) :?>
                                        <span class="badge bg-primary rounded-3 fw-semibold">Passive</span>
                                    <?php elseif($blog['status'] == 1) :?>
                                        <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                                    <?php endif;?>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <form action="" method="post">
                                    <button name="delete" class="btn btn-danger" type="submit" value="<?=$blog['id'];?>">Delete</button>
                                </form>
                            </td>
x                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'resources/views/admin/layouts/footer.php';?>