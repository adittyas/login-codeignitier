<!-- Begin Page Content -->
<div class="container-fluid">
    <a href="#" data-href='menu/submenu' data-met='submenu' id='add-btn' class='btn btn-primary mb-3'
        data-toggle="modal" data-target="#addMenu">Add New
        Submenu</a>

    <h3>Submenu Management</h3>
    <table class="table table-hover">
        <thead class='bg-gradient-custom-dark'>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Menu</th>
                <th scope="col">URL</th>
                <th scope="col">icon</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($subMenu as $val) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= ucfirst($val['title']); ?></td>
                <td><?= ucfirst($val['menu']); ?></td>
                <td><?= ucfirst($val['field_url']); ?></td>
                <td><i class=' <?= $val['icon'] ?>'></i></td>
                <?php if ($val['is_active'] == 1) : ?>
                <td>Active</td>
                <?php else : ?>
                <td>Non Active</td>
                <?php endif; ?>

                <td class='text-light'>
                    <a href='<?= base_url('menu/delete/') . $val['id'] ?>/submenu' type="button"
                        class="dele-menu btn btn-sm btn-danger">
                        <i class='fas fa-fw fa-trash'></i>
                    </a>
                    <a type="button" data-toggle="modal" data-target="#addMenu" class="edit-menu btn btn-sm btn-success"
                        data-id='<?= $val['id']; ?>' data-seg='menu' data-met='updateSub' data-ajx='submenu'>
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
                <h5 class="modal-title" id="modalTitle">New Submenu</h5>
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
                        <input type="hidden" name="id" id='id'>
                        <div class="form-group">
                            <label class="sr-only" for="inlineFormInputGroup">Title</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class='fas fa-fw fa-heading'></i>
                                    </div>

                                </div>
                                <input type="text" value="<?= set_value('title'); ?>" class=" form-control" id="title"
                                    name='title' placeholder="Title....">
                            </div>
                            <small class="form-text text-danger"><?php echo form_error('title'); ?></small>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class=' fas fa-fw fa-users-cog'></i>
                                    </div>

                                </div>
                                <select class="custom-select" id='menu_id' name='menu_id'>
                                    <option selected hidden disabled>Open this select menu</option>
                                    <?php foreach ($userMenu as $val) : ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['menu'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <small class="form-text text-danger"><?php echo form_error('menu_id'); ?></small>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="inlineFormInputGroup">Url</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class='fas fa-fw fa-link'></i>
                                    </div>

                                </div>
                                <input type="text" class="form-control" id='field_url' name='field_url'
                                    value="<?= set_value('title'); ?>" placeholder="Url...">
                            </div>
                            <small class="form-text text-danger"><?php echo form_error('field_url'); ?></small>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="inlineFormInputGroup">Icon</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class='fas fa-fw fa-icons'></i>
                                    </div>

                                </div>
                                <input value="<?= set_value('icon'); ?>" type="text" class="form-control" id="icon"
                                    name='icon' placeholder="icon...">
                            </div>
                            <small class="form-text text-danger"><?php echo form_error('icon'); ?></small>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class='fas fa-fw fa-question'></i>
                                    </div>

                                </div>
                                <select class="custom-select" id='is_active' name='is_active'>
                                    <option value='0'>Non Active</option>
                                    <option selected value='1'>Active</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Menu</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->session->flashdata('flash'); ?>