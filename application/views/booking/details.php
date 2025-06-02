<style>
    .room-info a {
        color: black;
        text-decoration: underline;
    }

    .room-info a:hover {
        color: grey;
    }

    .back a {
        color: black;
        text-decoration: underline;
    }

    .back a:hover {
        color: grey;
    }

    .nav-link {
        background: none;
        border: 0;
        border-radius: 0.25rem;
    }

    .nav-link.active,
    .show>.nav-link {
        color: white;
        background-color: #dfa974;
    }

    .book-btn {
        display: inline-block;
        font-size: 13px;
        font-weight: 700;
        padding: 16px 28px 15px;
        background: #dfa974;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: none;
    }
</style>

<main class="mt-4">
    <div class="container">

        <h4 class="mb-4 back"><a href="<?= base_url() ?>booking/index/<?= $ci_s ?>/<?= $co_s ?>"><i class="fa fa-arrow-left" aria-hidden="true"></a></i> Finalize your stay</h4>
        <div class="row mb-5">


            <div class="col-md-8 bg-white padding-2 container">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 p-3">
                                        <?php if (!empty($room['image'])) { ?>
                                            <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" style="width: 100% !important;" class="rounded" alt="Room Image">
                                        <?php } else { ?>
                                            <span class="text-muted">No Image</span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-7">
                                        <h5 class="card-title"><?= isset($room['type']) ? $room['type'] : 'Room' ?></h5>
                                        <p class="card-text">
                                            <small>
                                                Room Number: <?= isset($room['room_number']) ? $room['room_number'] : '-' ?><br>
                                                Status: <?= isset($room['status']) ? ucfirst($room['status']) : '-' ?>
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <strong>Price per night:</strong> ₱<?= isset($room['price']) ? number_format($room['price'], 2) : 'N/A' ?>
                                        </p>
                                        <hr class="mt-4 mb-2">
                                        <div class="text-right">
                                            <h5 class="card-text font-weight-bold">₱<?= isset($room['price']) ? number_format(($room['price'] * $count_days), 2) : 'N/A' ?></h5>
                                            <p class="card-text"><?= $count_days ?> Night <br> <small class="font-weight-light">Excluding Taxes & Services</small></p>
                                            <?php
                                            // Ensure $allBookings and $allRooms are always arrays to prevent errors
                                            if (!isset($allBookings) || !is_array($allBookings)) {
                                                $allBookings = [];
                                            }
                                            if (!isset($allRooms) || !is_array($allRooms)) {
                                                $allRooms = [];
                                            }
                                            $check = 0;
                                            $unavail = 0;
                                            foreach ($allBookings as $booking) {
                                                if ($booking['id_kamar'] === $room['id'] && (($ci < $booking['check_out'] && $co > $booking['check_out']) || ($ci < $booking['check_in'] && $co > $booking['check_in']) || ($ci >= $booking['check_in'] && $co <= $booking['check_out']) || ($ci <= $booking['check_in'] && $co >= $booking['check_out']))) {
                                                    $check++;
                                                }
                                            }
                                            foreach ($allRooms as $roomtest) {
                                                if ($roomtest['jenis_kamar'] === $room['id'] && $roomtest['row_count'] <= $check) {
                                                    $unavail = 1;
                                                }
                                            }
                                            ?>
                                            <?php if ($ci >= $co || $unavail === 1) { ?>
                                                <button type="button" class="btn btn-secondary" disabled>Unavailable</button>
                                            <?php } else if ($unavail === 0) { ?>
                                                <?php if ($this->session->userdata('email')) { ?>
                                                    <a href="<?= base_url() ?>booking/details/<?= $room['id'] ?>/<?= $ci ?>/<?= $co ?>"><button class="btn book-btn">Book Now</button></a>
                                                <?php } else { ?>
                                                    <button type="button" class="btn book-btn" data-toggle="modal" data-target="#login">Book Now</button>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <form action="<?= base_url() ?>booking/bookingroom" method="post">
                                <input type="hidden" value="<?= $user['id'] ?>" name="id_customer">
                                <input type="hidden" value="<?= $room['id'] ?>" name="id_kamar">
                                <input type="hidden" value="<?= $ci_s ?>" name="check_in">
                                <input type="hidden" value="<?= $co_s ?>" name="check_out">
                                <input type="hidden" value="<?= $room['price'] ?>" name="harga_kamar">
                                <input type="hidden" value="<?= $tax ?>" name="pajak">
                                <input type="hidden" value="<?= $service_charge ?>" name="service">
                                <input type="hidden" value="<?= $total_harga ?>" name="total_harga">
                                <input type="hidden" value="<?= $count_days ?>" name="jumlah_malam">

                                <h3 class="mb-4">Contact Info</h3>
                                <!-- title -->
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <select id="title" name="title" disabled>
                                            <?php foreach ($title as $t) { ?>
                                                <?php if ($t == $user['title']) { ?>
                                                    <option value="<?= $t ?>" selected><?= $t ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $t ?>"><?= $t ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" readonly>
                                        <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>

                                <!-- email -->
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>

                                <!-- phone -->
                                <div class=" form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" readonly>
                                        <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>

                                <!-- change info button -->
                                <div class="row mt-5">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">To change contact info, click the button below</label>
                                        <a href="<?= base_url() ?>user/edit">
                                            <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Change Contact Info</button>
                                        </a>
                                    </div>
                                </div>

                                <hr class="mt-4 mb-4">

                                <h3 class="mb-4">Payment Information</h3>
                                <!-- card number -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cardnumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardnumber" name="cardnumber" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <!-- exp -->
                                            <div class="col-md-8">
                                                <label for="exp" class="form-label">Expration Date (MM/YY)</label>
                                                <input type="text" class="form-control" id="exp" name="exp" required>
                                            </div>
                                            <!-- cvv -->
                                            <div class="col-md-4">
                                                <label for="cvv" class="form-label">CVV</label>
                                                <input type="text" class="form-control" id="cvv" name="cvv" required maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nameoncard" class="form-label">Name on Card</label>
                                        <input type="text" class="form-control" id="nameoncard" name="nameoncard" required autocomplete="off">
                                    </div>
                                </div>

                                <hr class="mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p>This reservation cannot be cancelled nor modified. <br>
                                            In case of no-show, a penalty of 1 night will apply. <br></p>
                                        <p class="mb-3"> <input type="checkbox" required>
                                            By choosing to book, I acknowledge having read and agreed to the terms and conditions.
                                        </p>
                                    </div>
                                    <button type="submit" class="book-btn mx-auto">Booking</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-flex flex-column flex-shrink-0">
                    <div class="card bg-light mb-3">
                        <div class="card-header font-weight-bold">Your Stay</div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6 class="card-text font-weight-bold">Luxe Hotel Bandung</h6>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <p class="card-text font-weight-bold">Address</p>
                                </div>

                                <div class="col-md-8">
                                    <p class="card-text">Quiapo, Manila, Metro Manila, Philippines</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text font-weight-bold">Check-in</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text font-weight-bold">Check-out</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text">After 3:00 PM</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text">Before 12:00 PM</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="card-text"><?= $ci ?> - <?= $co ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text">1 Adult</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h6 class="card-text font-weight-bold"><?= $room['type'] ?></h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text float-right font-weight-bold">₱<?= number_format(($room['price'] * $count_days), 2) ?></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <p class="card-text"><?= $count_days ?> Night</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="card-text">Service Charge (5%)</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text float-right">₱<?= number_format(($service_charge), 2) ?></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="card-text">Tax (10%)</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text float-right">₱<?= number_format(($tax), 2) ?></p>
                                </div>
                            </div>


                            <hr class="mt-4 mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text font-weight-bold">TOTAL : </p>
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text font-weight-bold float-right">₱<?= number_format(($total_harga), 2) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
