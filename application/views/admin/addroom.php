<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Room</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/addroom'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="room_number">Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value="<?= set_value('room_number'); ?>">
                            <?= form_error('room_number', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="type" class="col-sm-3 col-form-label">Room Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select Room Type</option>
                                    <option value="Deluxe Room">Deluxe Room</option>
                                    <option value="Deluxe Balcony Room">Deluxe Balcony Room</option>
                                    <option value="Family Suite">Family Suite</option>
                                    <option value="Gallery Suite">Gallery Suite</option>
                                    <option value="Hillside Studio">Hillside Studio</option>
                                    <option value="Premier Balcony Suite">Premier Balcony Suite</option>
                                    <option value="Premier Room">Premier Room</option>
                                    <option value="Premier Suite">Premier Suite</option>
                                </select>
                                <?= form_error('type', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per Night</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= set_value('price'); ?>" step="0.01">
                            <?= form_error('price', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status">
                                    <option value="available">Available</option>
                                    <option value="occupied">Occupied</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="image" class="col-sm-3 col-form-label">Room Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="image" name="image">
                                <small class="form-text text-muted">Upload an image for the room.</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Room</button>
                        <a href="<?= base_url('admin/roomlist'); ?>" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->