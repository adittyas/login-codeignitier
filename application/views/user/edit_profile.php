<!-- Begin Page Content -->

<div class="container-fluid">
    <?= form_open_multipart('user/edit'); ?>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" value='<?= $acount['email'] ?>' readonly class="form-control" id="email" name='email'>
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" value='<?= $acount['username'] ?>' class="form-control" id="username" name='username'>
            <small class="form-text text-danger"><?php echo form_error('username'); ?></small>
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Profile Picture</label>
        <div class="col-sm-10">
            <div class="row form-group">
                <img class="col-sm-4" src="<?= base_url('assets/images/profile/') . $acount['image'] ?>" alt="profile"
                    class='img-fluid'>
                <div class="custom-file col-sm-4 ">
                    <input type="file" class="custom-file-input" id="pic" name='pic'>
                    <label class="custom-file-label" for="pic">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <button type="submit" class='col-sm-10 offset-sm-2 btn btn-primary'>save</button>
        </div>

    </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->session->flashdata('flash'); ?>