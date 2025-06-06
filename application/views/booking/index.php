<style>
    .card-body a {
        color: black;
        text-decoration: underline;
    }

    .card-body a:hover {
        color: grey;
    }

    .modal-body a {
        text-decoration: underline;
    }

    .modal-body a:hover {
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
        padding: 14px 25px 13px;
        background: #dfa974;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: none;
    }
</style>

<main class="mt-4">
    <div class="container">
        <h4 class="mb-4">Select a Room</h4>
        <div class="row mb-5">


            <div class="col-md-8 bg-white padding-2 container">
                <?php
                // Filter unique rooms by 'type' (or 'id' if you want unique by id)
                $uniqueRooms = [];
                $seen = [];
                foreach ($rooms as $room) {
                    if (!in_array($room['type'], $seen)) {
                        $uniqueRooms[] = $room;
                        $seen[] = $room['type'];
                    }
                }

                // Ensure $allBookings and $allRooms are always arrays to prevent errors
                if (!isset($allBookings) || !is_array($allBookings)) {
                    $allBookings = [];
                }
                if (!isset($allRooms) || !is_array($allRooms)) {
                    $allRooms = [];
                }
                ?>
                <?php foreach ($uniqueRooms as $room) { ?>
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5 p-3">
                                            <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" style="width: 100% !important;" class="rounded" alt="Room Image">
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="card-title"><?= $room['type'] ?></h5>
                                            <p class="card-text">
                                                <small>
                                                    Room Number: <?= $room['room_number'] ?><br>
                                                    Status: <?= ucfirst($room['status']) ?>
                                                </small>
                                            </p>
                                            <p class="card-text">
                                                <strong>Price per night:</strong> ₱<?= number_format($room['price'], 2) ?>
                                            </p>
                                            <hr class="mt-4 mb-2">
                                            <div class="text-right">
                                                <h5 class="card-text font-weight-bold">₱<?= number_format(($room['price'] * $count_days), 2) ?></h5>
                                                <p class="card-text"><?= $count_days ?> Night <br> <small class="font-weight-light">Excluding Taxes & Services</small></p>
                                                <?php
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
                <?php } ?>
            </div>

            <div class="col-md-4">
                <div class="booking-form border shadow">
                    <form action="<?= base_url() ?>booking/checkavailability" method="post">
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="text" class="date-input" id="date-in" name="ci" value="<?= date("d F, Y", $ci); ?>">
                            <i class=" icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="text" class="date-input" id="date-out" name="co" value="<?= date("d F, Y", $co); ?>">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="select-option">
                            <label for="guest">Guests:</label>
                            <select id="guest">
                                <option value="">2 Adults</option>
                                <option value="">3 Adults</option>
                            </select>
                        </div>
                        <button id="checkAvailability" type="submit">Check Availability</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                To make a hotel room reservation, you must login to your account. If you don't have an account yet, please <a href="<?= base_url() ?>auth/registration">click here</a> to create one.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?= base_url() ?>auth"><button type="button" class="btn btn-primary">Login Page</button></a>
            </div>
        </div>
    </div>
</div>
