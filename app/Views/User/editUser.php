<?= $this->extend('Templates/MainLayout') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit User </h3>
                    </div> <br>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form id="quickForm" method="post" action="/updateUser/<?= $userData[0]['user_id'] ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                            value="<?= $userData[0]['first_name'] ?>" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                            value="<?= $userData[0]['last_name'] ?>" placeholder="Enter Last name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="<?= $userData[0]['email'] ?>" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="date" name="dob" class="form-control" id="dob"
                                            value="<?= $userData[0]['dob'] ?>" placeholder="Enter dob">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="custom-select rounded-0" id="gender" name="gender">
                                            <option value="">Select Gender</option>
                                            <option <?= $userData[0]['gender'] == 'Male' ? "selected" : "" ?>
                                                value="Male">Male</option>
                                            <option <?= $userData[0]['gender'] == 'Female' ? "selected" : "" ?>
                                                value="Female">Female</option>
                                            <option <?= $userData[0]['gender'] == 'Other' ? "selected" : "" ?>
                                                value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="custom-select rounded-0" id="role" name="role">
                                            <option value="">Select Role</option>
                                            <?php foreach ($roles as $role): ?>
                                            <option <?= $userData[0]['role_id'] == $role['role_id'] ? "selected" : "" ?>
                                                value="<?= $role['role_id']; ?>"><?= $role['role_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="profile_pic">Profile Pic</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" value="<?= $userData[0]['profile_pic'] ?>"
                                            class="custom-file-input" id="profile_picc" name="profile_picc">
                                        <label class="custom-file-label" for="profile_picc">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="pic" value="<?= $userData[0]['profile_pic'] ?>">

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    value="<?= $userData[0]['address'] ?>" placeholder="Enter address">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="<?= $userData[0]['password'] ?>" placeholder="Enter password">
                            </div>

                            <div class="social-auth-links text-center mb-2">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>