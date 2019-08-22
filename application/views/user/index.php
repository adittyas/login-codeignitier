<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-3" style="max-width: 640px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/images/profile/') . $acount['image'] ?>" class="card-img"
                    alt="profile   ">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $acount['username']; ?></h5>
                    <p class="card-text"><?= $acount['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since :
                            <?= date('d F Y', $acount['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->session->flashdata('flash'); ?>