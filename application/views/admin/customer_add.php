<div class="col-md-8 container mt-5">
    <h3 class="mb-4">Add New Customer</h3>

    <form action="<?= base_url('admin/customer/add') ?>" method="post">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <select name="title" class="form-select">
                <option value="Mr.">Mr.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mrs.">Mrs.</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= set_value('phone') ?>">
            <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
        </div>

        <button type="submit" class="btn btn-warning">Save</button>
        <a href="<?= base_url('admin/customer') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
