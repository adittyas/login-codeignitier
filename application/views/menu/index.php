<!-- Begin Page Content -->
<div class="container-fluid">
    <a href="#" data-href='menu/index' data-met='menu' id='add-btn' class='btn btn-primary mb-3' data-toggle="modal"
        data-target="#addMenu">Add New Menu</a>

    <h3>Menu Management</h3>
    <table class="table table-hover">
        <thead class='bg-gradient-custom-dark'>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Menu</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($managementMenu as $val) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $val['menu'] ?></td>
                <td class='text-light'>
                    <a href='<?= base_url('menu/delete/') . $val['id'] ?>.' class="dele-menu btn btn-sm btn-danger"
                        data-id='<?= $val['id']; ?>'>
                        <i class='fas fa-fw fa-trash'></i>
                    </a>
                    <a type="button" data-toggle="modal" data-target="#addMenu" class="edit-menu btn btn-sm btn-success"
                        data-id='<?= $val['id']; ?>' data-seg='menu' data-met='updateMenu' data-ajx='menu'>
                        <i class='fas fa-fw fa-user-edit'></i>
                    </a>
                </td>
            </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id='modalTitle'></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if (validation_errors()) : ?>
            <div class="modal-body mb-n4">
                <?php else : ?>
                <div class="modal-body mb-n3">
                    <?php endif; ?>

                    <form action="" method="post" autocomplete="off" id='menu-modal'>
                        <input type="hidden" name='id' id='id'>
                        <div class="form-group">
                            <label class="sr-only" for="inlineFormInputGroup">Menu name...</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class=' fas fa-fw fa-folder'></i>
                                    </div>

                                </div>
                                <input type="text" class="form-control" id="menu" name='menu'
                                    placeholder="Menu name...">
                            </div>
                            <small class="form-text text-danger"><?php echo form_error('menu'); ?></small>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->session->flashdata('flash'); ?>