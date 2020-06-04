<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php echo $this->session->flashdata('message'); ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $sm['name']; ?></td>
                            <td><?php echo $sm['email']; ?></td>
                            <td><?php if ($sm['role_id'] == 1) :
                                    echo "Admin";
                                elseif ($sm['role_id'] == 2) :
                                    echo "Member";
                                else :
                                    echo "Menu / Penjadwal";
                                endif ?>
                            </td>
                            <td>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#newSubMenuModal<?= $sm['id']; ?>">edit</a>
                                <a href="" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- MODAL -->

<!-- Modal -->
<?php foreach ($subMenu as $k) : ?>
    <div class="modal fade" id="newSubMenuModal<?= $k['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('menu/user'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="id" name="id" value="<?= $k['id']; ?>" hidden>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $k['name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" value="<?= $k['email']; ?>">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : if ($k['role_id'] == $m['id']) : ?>
                                        <option value="<?php echo $m['id']; ?>" selected><?php echo $m['role']; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $m['id']; ?>"><?php echo $m['role']; ?></option>
                                <?php endif;
                                endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>