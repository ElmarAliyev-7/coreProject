<?php include_once 'resources/views/admin/layouts/header.php';?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Sliders Page</h5>
                <a class="btn btn-success" href="<?=baseUrl . 'admin/sliders/create';?>">Create New Blog</a>
                <?php
                if(isset($_POST['delete'])) :
                    $result = destroySlider($_POST['delete']);
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
                                <h6 class="fw-semibold mb-0">SubHead</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title Bold</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Image</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sliders as $slider) : ?>
                            <tr>
                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?=$slider['id'];?></h6></td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"><?=$slider['subhead'];?></h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"><?=$slider['title'];?></h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"><?=$slider['title_bold'];?></h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?=str_limit($slider['description'], 20);?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">
                                        <img src="<?=baseUrl . '/' . $slider['image'];?>" alt="Slider Image" width="100px" height="100px">
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <form action="" method="post">
                                        <button name="delete" class="btn btn-danger" type="submit" value="<?=$slider['id'];?>">Delete</button>
                                    </form>
                                </td>
                                x
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'resources/views/admin/layouts/footer.php';?>