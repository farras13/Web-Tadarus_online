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

            <!-- <a href="<?= base_url('Admin/setjadwal'); ?>" class="btn btn-primary mb-3">Add New Submenu</a> -->

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
                                <a href="<?= base_url('User/valid/') . $sm['id_jadwal']; ?>" class="badge badge-success">DONE</a>
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