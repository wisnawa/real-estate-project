<?php
include 'components/connect.php';
include 'rupiah.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:home.php');
}

include 'components/save_send.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view property</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- view property section starts -->
    <section class="view-property">
        <?php
        $select_property = $conn->prepare("SELECT * FROM `property` WHERE id = ? LIMIT 1");
        $select_property->execute([$get_id]);
        if ($select_property->rowCount() > 0) {
            while ($fetch_property = $select_property->fetch(PDO::FETCH_ASSOC)) {
                $property_id = $fetch_property['id'];
                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
                $select_user->execute([$fetch_property['user_id']]);
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? AND user_id = ?");
                $select_saved->execute([$property_id, $user_id]);
        ?>
                <div class="details">
                    <div class="swiper image-container">
                        <div class="swiper-wrapper">
                            <img src="./upload_files/<?= $fetch_property['image_01']; ?>" class="swiper-slide">
                            <?php if (!empty($fetch_property['image_02'])) {
                                echo '<img src="./upload_files/' . $fetch_property['image_02'] . '" class="swiper-slide">';
                            } ?>
                            <?php if (!empty($fetch_property['image_03'])) {
                                echo '<img src="./upload_files/' . $fetch_property['image_03'] . '" class="swiper-slide">';
                            } ?>
                            <?php if (!empty($fetch_property['image_04'])) {
                                echo '<img src="./upload_files/' . $fetch_property['image_04'] . '" class="swiper-slide">';
                            } ?>
                            <?php if (!empty($fetch_property['image_05'])) {
                                echo '<img src="./upload_files/' . $fetch_property['image_05'] . '" class="swiper-slide">';
                            } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
                    <p class="address"><i class="fa-solid fa-location-dot"></i><span>&nbsp;<?= $fetch_property['address']; ?></span></p>
                    <div class="info">
                        <p><i class="fa-solid fa-rupiah-sign"></i><span>&nbsp;<?= rupiah($fetch_property['price']); ?></span></p>
                        <p><i class="fa-regular fa-user"></i><span>&nbsp;<?= $fetch_user['name']; ?></span></p>
                        <p><i class="fa-solid fa-phone"></i><a href="tel:<?= $fetch_user['number']; ?>">&nbsp;<?= $fetch_user['number']; ?></a></p>
                        <p><i class="fa-solid fa-building"></i><span>&nbsp;<?= $fetch_property['offer']; ?></span></p>
                        <p><i class="fa-solid fa-house"></i><span>&nbsp;<?= $fetch_property['type']; ?></span></p>
                        <p><i class="fa-solid fa-calendar"></i><span>&nbsp;<?= $fetch_property['date']; ?></span></p>
                    </div>
                    <h3 class="title">details</h3>
                    <div class="flex">
                        <div class="box">
                            <p><i>room:&nbsp;</i><span><?= $fetch_property['bhk']; ?></span></p>
                            <p><i>deposit amount:&nbsp;</i><span class="fa-solid fa-rupiah-sign" style="margin-right: .5rem;"></span><?= $fetch_property['deposite']; ?></p>
                            <p><i>status:&nbsp;</i><span><?= $fetch_property['status']; ?></span></p>
                            <p><i>bedroom:&nbsp;</i><span><?= $fetch_property['bedroom']; ?></span></p>
                            <p><i>bathroom:&nbsp;</i><span><?= $fetch_property['bathroom']; ?></span></p>
                            <p><i>balcony:&nbsp;</i><span><?= $fetch_property['balcony']; ?></span></p>
                        </div>
                        <div class="box">
                            <p><i>carpet area:&nbsp;</i><span><?= $fetch_property['carpet']; ?>&nbsp;sqft</span></p>
                            <p><i>age:&nbsp;</i><span><?= $fetch_property['age']; ?>&nbsp;years</span></p>
                            <p><i>total floors:&nbsp;</i><span><?= $fetch_property['total_floors']; ?></span></p>
                            <p><i>room floors:&nbsp;</i><span><?= $fetch_property['room_floors']; ?></span></p>
                            <p><i>furnished:&nbsp;</i><span><?= $fetch_property['furnished']; ?></span></p>
                            <p><i>loan:&nbsp;</i><span><?= $fetch_property['loan']; ?></span></p>
                        </div>
                    </div>
                    <h3 class="title">amenities</h3>
                    <div class="flex">
                        <div class="box">
                            <p><i class="fas fa-<?php if ($fetch_property['lift'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;lifts</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['security_guard'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;security</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['play_ground'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;play ground</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['garden'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;gardens</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['water_supply'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;water supply</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['power_backup'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;power backup</span></p>
                        </div>
                        <div class="box">
                            <p><i class="fas fa-<?php if ($fetch_property['parking_area'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;parking area</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['gym'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;gym</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['shopping_mall'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;shopping mall</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['hospital'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;hospital</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['school'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;schools</span></p>
                            <p><i class="fas fa-<?php if ($fetch_property['market_area'] == 'yes') {
                                                    echo 'check';
                                                } else {
                                                    echo 'times';
                                                } ?>"></i><span>&nbsp;market area</span></p>
                        </div>
                    </div>
                    <h3 class="title">description</h3>
                    <p class="description"><?= $fetch_property['description']; ?></p>
                    <form method="post" action="" class="flex-btn">
                        <input type="hidden" name="property_id" value="<?= $property_id; ?>">
                        <?php if ($select_saved->rowCount() > 0) { ?>
                            <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>saved</span></button>
                        <?php } else { ?>
                            <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>save</span></button>
                        <?php } ?>
                        <input type="submit" value="send equiry" name="send" class="btn">
                    </form>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">property was not found!</p>';
        }
        ?>
    </section>
    <!-- view property section ends -->
    <!-- swiper slide -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- footer section starts -->
    <?php include 'components/footer.php' ?>
    <!-- footer section ends -->
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src="./js/script.js"></script>
    <?php include 'components/message.php' ?>
    <!--  -->
    <script>
        var swiper = new Swiper(".image-container", {
            loop: true,
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 200,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
</body>

</html>