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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add Jadwal</a>
            <a href="<?= base_url('Admin/setjadwal'); ?>" class="btn btn-primary mb-3">Random</a>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Juz</th>
                        <th scope="col">Url</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $st = array(); ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $sm['name']; ?></td>
                            <td><?php echo $sm['juz']; ?></td>
                            <td><?php echo $sm['url']; ?></td>
                            <td>
                                <?php foreach ($darus as $d) :
                                    array_push($st, $d['juz']);

                                    if ($sm['id_user'] == $d['id_user']) {
                                        if ($sm['juz'] == $d['juz']) {
                                            array_push($st, 'Valid' . $d['juz'] . $d['id_user']);
                                        }
                                    }
                                endforeach;

                                $cr = array_search('Valid' . $sm['juz'] . $sm['id_user'], $st);
                                if ($cr != null) {
                                    echo "Valid";
                                } else {
                                    echo "Tanggungan";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('Admin/acak/') . $sm['id_user'] ?>" class="badge badge-success">Acak</a>
                            </td>
                        </tr>
                        <?php $i++;?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('Admin/jadwal'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                    </div>
                    <div class="form-group">
                        <select name="user" id="user" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : if($m['role_id'] == 2): ?>
                                <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?></option>
                            <?php endif; endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>