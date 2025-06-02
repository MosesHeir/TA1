<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Room List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room Number</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($rooms as $room) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $room['room_number']; ?></td>
                                        <td><?= $room['type']; ?></td>
                                        <td>₱<?= number_format($room['price'], 2); ?></td>
                                        <td>
                                            <?php if (!empty($room['image']) && file_exists(FCPATH . 'assets/img/room/' . $room['image'])): ?>
                                                <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" alt="Room Image" width="60" class="rounded">
                                            <?php else: ?>
                                                <span class="text-muted">No Image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($room['status'] == 'available') : ?>
                                                <span class="badge badge-success">Available</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">Occupied</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/editroom/') . $room['id']; ?>" class="badge badge-warning">Edit</a>
                                            <a href="<?= base_url('admin/deleteroom/') . $room['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this room?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('admin/addroom'); ?>" class="btn btn-primary mb-3">Add New Room</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->