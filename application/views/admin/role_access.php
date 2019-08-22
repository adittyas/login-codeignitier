<!-- Begin Page Content -->
<div class="container-fluid">
    <h3>Access <?= $role['role'] ?></h3>
    <table class="table table-hover">
        <thead class='bg-gradient-custom-dark'>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Role</th>
                <th scope="col">Access</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($userMenu as $val) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $val['menu'] ?></td>
                <td class='text-light'>
                    <div class="form-check">
                        <input <?= checkedAccess($role['id'], $val['id']); ?> class="form-check-input" type="checkbox"
                            value="" id="checkAcc<?= $i; ?>" data-menu='<?= $val['id']; ?>'
                            data-role='<?= $role['id']; ?>'>
                        <label class="form-check-label text-dark" for="checkAcc<?= $i; ?>">
                            Active
                        </label>
                    </div>
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
<?= $this->session->flashdata('flash'); ?>