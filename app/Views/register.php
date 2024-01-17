<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('AdminAssets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('AdminAssets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminAssets/dist/css/adminlte.min.css') ?>">

</head>

<body class="hold-transition login-page">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New User </h3>
                        </div> 
                        <!-- /.card-header -->
                        <!-- form start -->

                        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php elseif (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form id="quickForm" method="post" action="/addNewUser" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" class="form-control" id="first_name"
                                                placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" id="last_name"
                                                placeholder="Enter Last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dob">DOB</label>
                                            <input type="date" name="dob" class="form-control" id="dob"
                                                placeholder="Enter dob">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="custom-select rounded-0" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="custom-select rounded-0" id="role" name="role">
                                                <option value="">Select Role</option>
                                                <?php foreach ($roles as $role): ?>
                                                <option value="<?= $role['role_id']; ?>"><?= $role['role_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="profile_pic">Profile Pic</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile_pic"
                                                name="profile_pic">
                                            <label class="custom-file-label" for="profile_pic">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        placeholder="Enter address">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Enter password">
                                </div>

                                <div class="social-auth-links text-center mb-2">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
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
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminAssets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminAssets/dist/js/adminlte.min.js') ?>"></script>


    <script src="<?= base_url('AdminAssets/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('AdminAssets/plugins/jquery-validation/additional-methods.min.js') ?>"></script>

    <script>
    $(function() {
        $('#quickForm').validate({
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                dob: {
                    required: true,
                    date: true,
                },
                gender: {
                    required: true,
                },
                role: {
                    required: true,
                },
                profile_pic: {
                    required: true,
                    extension: "png|jpg|jpeg|gif",
                },
                address: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "Please enter the first name",
                },
                last_name: {
                    required: "Please enter the last name",
                },
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address",
                },
                dob: {
                    required: "Please enter a date of birth",
                    date: "Please enter a valid date",
                },
                gender: "Please select a gender",
                profile_pic: {
                    required: "Please choose a file",
                    extension: "Please choose a valid image file (png, jpg, jpeg, gif)",
                },
                address: "Please enter an address",
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>

</body>

</html>