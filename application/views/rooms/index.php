<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="<?= base_url() ?>home">Home</a>
                        <span>Rooms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            <?php 
            $unique_types = [];
            foreach ($rooms as $room) { 
                if (isset($unique_types[$room['type']])) continue;
                $unique_types[$room['type']] = true;
                $price_php = $room['price'] * 0.0037;
            ?>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="room-item">
                        <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" alt="Room Image">
                        <div class="ri-text">
                            <h4><?= $room['type'] ?></h4>
                            <h3>₱<?= number_format($price_php, 2) ?><span>/Night</span></h3>
                            <a href="<?= base_url('rooms/details/') . $room['id']; ?>" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Rooms Section End -->
