<?= $this->extend('Templates/MainLayout') ?>
<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Users</h3>
                        <?php if (in_array('Add', session()->get('user_data')['permissions'])) : ?>
                        <a href="/addNewUser">
                            <button class="btn btn-success btn-sm float-right" title="Add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php elseif (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $srNo = 1; ?>
                                <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $srNo++ ?></td>
                                    <td><?= $user['first_name'] ?></td>
                                    <td><?= $user['last_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td>
                                        <?php if (in_array('Edit', session()->get('user_data')['permissions'])) : ?>
                                        <a href="/editUser/<?= $user['user_id'] ?>" class="btn btn-primary btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php else : ?>
                                        <button class="btn btn-primary btn-sm" title="Edit" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php endif; ?>

                                        <?php if (in_array('View', session()->get('user_data')['permissions'])) : ?>
                                        <a href="/viewUser/<?= $user['user_id'] ?>" class="btn btn-info btn-sm"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php else : ?>
                                        <button class="btn btn-info btn-sm" title="View" disabled>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php endif; ?>

                                        <a href="#" class="btn btn-danger btn-sm" title="Delete"
                                            <?php if (!in_array('Delete', session()->get('user_data')['permissions'])) : ?>
                                            onclick="event.preventDefault(); alert('You don\'t have permission to delete.');"
                                            <?php else: ?> onclick="confirmDelete(<?= $user['user_id'] ?>)"
                                            <?php endif; ?>>
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


<script>
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = "/deleteUser/" + userId;
    }
}
</script>

<?= $this->endSection() ?>