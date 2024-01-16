<?= $this->extend('Templates/MainLayout') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?= base_url('uploads/profile_pics/' . $userData['user_info']['profile_pic']) ?>"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">
                            <?= $userData['user_info']['first_name'].' '.$userData['user_info']['last_name'] ?></h3>

                        <p class="text-muted text-center"><?= $userData['user_info']['email'] ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>DOB</b> <a class="float-right"><?= $userData['user_info']['dob'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Address</b> <a class="float-right"><?= $userData['user_info']['address'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a class="float-right"><?= $userData['user_info']['gender'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Permissions</b>
                                <?php foreach($userData['permissions'] as $permission) { ?>
                                <a class="float-right"><?= $permission ?>/</a>
                                <?php } ?>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>