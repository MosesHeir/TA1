<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2><?= $room['type'] ?></h2>
                    <div class="bt-option">
                        <a href="<?= base_url() ?>home">Home</a>
                        <a href="<?= base_url() ?>rooms">Rooms</a>
                        <span><?= $room['type'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="kamar-section mt-2 mb-5">
    <div class="container">
        <div class="col-lg-12 mx-auto">
            <div class="kamar-slider owl-carousel">
                <div class="ts-item">
                    <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" alt="Room Image">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="room-details-section spad">
    <div class="container pl-4 pr-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3><?= $room['type'] ?></h3>
                            <div class="rdt-right">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <a href="<?= base_url() ?>booking/index/<?= time(); ?>/<?= time() + 86400 ?>">Booking Now</a>
                            </div>
                        </div>

                        <?php $converted_price = $room['price'] * 0.0037; ?>
                        <h2>
                            <small style="font-size: 14px; color: #999;">
                                ₱<?= number_format($room['price'], 2, ",", ".") ?>
                            </small><br>
                            ₱<?= number_format($converted_price, 2) ?><span>/Night</span>
                        </h2>

                        <p class="f-para">
                            Combining comfort and style, <?= $room['type'] ?> offers guests a tranquil space with a range of luxurious amenities.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Room Details Section End -->
