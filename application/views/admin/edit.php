<div class="col-md-8 container mb-5">

    <h3 class="mb-4">Update Customer</h3>

    <form action="<?= base_url('admin/customer/update/' . $customer['id']) ?>" method="post" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $customer['title'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $customer['name'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $customer['email'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?= $customer['phone'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="image">Profile Image</label><br>
            <img src="<?= base_url('assets/img/profile/' . $customer['image']) ?>" width="100px" class="rounded mb-2"><br>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-warning">Update Customer</button>

    </form>

</div>
