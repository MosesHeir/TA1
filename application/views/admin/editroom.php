<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Room</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/editroom/') . $room['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="room_number">Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value="<?= $room['room_number']; ?>">
                            <?= form_error('room_number', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="type" class="col-sm-3 col-form-label">Room Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select Room Type</option>
                                    <option value="Deluxe Room" <?= ($room['type'] == 'Deluxe Room') ? 'selected' : ''; ?>>Deluxe Room</option>
                                    <option value="Deluxe Balcony Room" <?= ($room['type'] == 'Deluxe Balcony Room') ? 'selected' : ''; ?>>Deluxe Balcony Room</option>
                                    <option value="Family Suite" <?= ($room['type'] == 'Family Suite') ? 'selected' : ''; ?>>Family Suite</option>
                                    <option value="Gallery Suite" <?= ($room['type'] == 'Gallery Suite') ? 'selected' : ''; ?>>Gallery Suite</option>
                                    <option value="Hillside Studio" <?= ($room['type'] == 'Hillside Studio') ? 'selected' : ''; ?>>Hillside Studio</option>
                                    <option value="Premier Balcony Suite" <?= ($room['type'] == 'Premier Balcony Suite') ? 'selected' : ''; ?>>Premier Balcony Suite</option>
                                    <option value="Premier Room" <?= ($room['type'] == 'Premier Room') ? 'selected' : ''; ?>>Premier Room</option>
                                    <option value="Premier Suite" <?= ($room['type'] == 'Premier Suite') ? 'selected' : ''; ?>>Premier Suite</option>
                                </select>
                                <?= form_error('type', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per Night</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= $room['price']; ?>" step="0.01">
                            <?= form_error('price', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status">
                                    <option value="available" <?= ($room['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                                    <option value="occupied" <?= ($room['status'] == 'occupied') ? 'selected' : ''; ?>>Occupied</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="image" class="col-sm-3 col-form-label">Room Image</label>
                            <div class="col-sm-9">
                                <?php if (!empty($room['image'])): ?>
                                    <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" alt="Room Image" width="120" class="mb-2 rounded"><br>
                                <?php endif; ?>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <small class="form-text text-muted">Upload a new image to replace the current one.</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Room</button>
                        <a href="<?= base_url('admin/roomlist'); ?>" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->