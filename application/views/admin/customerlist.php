    <div class="col-md-10 container mb-5">

        <h3 class="mb-4">Customer List</h3>

        <!-- Form for Delete Selected -->
        <form action="<?= base_url('admin/customer/delete') ?>" method="post">

            <!-- Top Buttons -->
            <div class="mb-3">
                <a href="<?= base_url('admin/customer/add') ?>" class="btn btn-warning">Add</a>
                <button type="submit" class="btn btn-warning">Delete</button>
            </div>

            <!-- Customer Table -->
            <table class="table table-striped table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">Select</th>
                        <th scope="col">No.</th>
                        <th scope="col">User</th>
                        <th scope="col"></th>
                        <th scope="col">Phone</th>
                        <th scope="col">Member Since</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($customers as $row) { ?>
                        <tr>
                            <td class="align-middle">
                                <input type="checkbox" name="selected_ids[]" value="<?= $row['id'] ?>">
                            </td>
                            <th class="align-middle" scope="row"><?= $i ?></th>
                            <td class="align-middle">
                                <img src="<?= base_url('assets/img/profile/' . $row['image']) ?>" width="70px" class="rounded">
                            </td>
                            <td class="align-middle">
                                <?= $row['title'] ?> <?= $row['name'] ?><br>
                                <span style="color: gray;"><small><?= $row['email'] ?></small></span>
                            </td>
                            <td class="align-middle"><?= $row['phone'] ?></td>
                            <td class="align-middle"><?= date("d F Y", $row['date_created']) ?></td>
                            <td class="align-middle">
                                <a href="<?= base_url('admin/customer/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Update</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </form>

    </div>
