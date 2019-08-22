<!-- Begin Page Content -->

<div class="container-fluid">

    <h3>Change Password</h3>
    <form action="<?= base_url('user/pass'); ?>" method="post">
        <div class="form-group">
            <!-- <label for="currentPass">Current Password</label> -->
            <input type="password" class="form-control" id="currentPass" name='currentPass'
                placeholder="Current Password">
            <small class="form-text text-danger"><?php echo form_error('currentPass'); ?></small>
        </div>
        <div class="form-group">
            <!-- <label for="currentPass">New Password</label> -->
            <input type="password" class="form-control" id="newPass1" name='newPass1' placeholder="New Password">
            <small class="form-text text-danger"><?php echo form_error('newPass1'); ?></small>

        </div>
        <div class="form-group">
            <!-- <label for="currentPass">Confirm New Password</label> -->
            <input type="password" class="form-control" id="newPass2" name='newPass2' placeholder="Confirm Password">
            <small class="form-text text-danger"><?php echo form_error('newPass2'); ?></small>
        </div>
        <button type='submit' class='btn btn-primary'>Change Password</button>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->session->flashdata('flash'); ?>