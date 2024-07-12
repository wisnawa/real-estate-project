<?php
include 'components/connect.php';
include 'rupiah.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}
include 'components/save_send.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saved listings</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- listings section stats -->
    <section class="listings">
        <h1 class="heading">saved listings</h1>
        <div class="box-container">
            <?php
            $select_saved_property = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
            $select_saved_property->execute([$user_id]);
            if ($select_saved_property->rowCount() > 0) {
                while ($fetch_saved = $select_saved_property->fetch(PDO::FETCH_ASSOC)) {
                    $select_listings = $conn->prepare("SELECT * FROM `property` WHERE id = ? ORDER BY date DESC");
                    $select_listings->execute([$fetch_saved['property_id']]);
                    if ($select_listings->rowCount() > 0) {
                        while ($fetch_listing = $select_listings->fetch(PDO::FETCH_ASSOC)) {
                            $property_id = $fetch_listing['id'];
                            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                            $select_users->execute([$fetch_listing['user_id']]);
                            $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

                            if (!empty($fetch_listing['image_02'])) {
                                $count_image_02 = 1;
                            } else {
                                $count_image_02 = 0;
                            }
                            if (!empty($fetch_listing['image_03'])) {
                                $count_image_03 = 1;
                            } else {
                                $count_image_03 = 0;
                            }
                            if (!empty($fetch_listing['image_04'])) {
                                $count_image_04 = 1;
                            } else {
                                $count_image_04 = 0;
                            }
                            if (!empty($fetch_listing['image_05'])) {
                                $count_image_05 = 1;
                            } else {
                                $count_image_05 = 0;
                            }
                            $total_images = (1 + $count_image_02 + $count_image_03 + $count_image_04 + $count_image_05);
                            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? AND user_id = ?");
                            $select_saved->execute([$property_id, $user_id]);
            ?>
                            <form action="" method="post">
                                <div class="box">
                                    <input type="hidden" name="property_id" value="<?= $property_id; ?>">
                                    <?php if ($select_saved->rowCount() > 0) { ?>
                                        <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>remove from saved</span></button>
                                    <?php } else { ?>
                                        <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>save</span></button>
                                    <?php }; ?>
                                    <div class="thumb">
                                        <p><i class="fa-solid fa-image"></i><span><?= $total_images; ?></span></p>
                                        <img src="./upload_files/<?= $fetch_listing['image_01']; ?>" alt="">
                                    </div>
                                    <div class="admin">
                                        <h3><?= substr($fetch_users['name'], 0, 1); ?></h3>
                                        <div>
                                            <p><?= $fetch_users['name']; ?></p>
                                            <span><?= $fetch_listing['date']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <p class="price"><i class="fa-solid fa-rupiah-sign"></i><span>&nbsp;<?= rupiah($fetch_listing['price']); ?></span></p>
                                    <h3 class="name"><?= $fetch_listing['property_name']; ?></h3>
                                    <p class="address"><i class="fa-solid fa-location-dot"></i><span>&nbsp;<?= $fetch_listing['address']; ?></span></p>
                                    <div class="flex">
                                        <p>
                                            <i class="fa-solid fa-house"></i>&nbsp;<span><?= $fetch_listing['type']; ?></span>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-tag"></i>&nbsp;<span><?= $fetch_listing['offer']; ?></span>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-bed"></i>&nbsp;<span><?= $fetch_listing['bhk']; ?>&nbsp;BHK</span>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-trowel"></i>&nbsp;<span><?= $fetch_listing['status']; ?></span>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-couch"></i>&nbsp;<span><?= $fetch_listing['furnished']; ?></span>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-maximize"></i>&nbsp;<span><?= $fetch_listing['carpet']; ?>&nbsp;sqft</span>
                                        </p>
                                    </div>
                                    <div class="flex-btn">
                                        <a href="view_property.php?get_id=<?= $property_id; ?>" class="btn">view property</a>
                                        <input type="submit" value="send equiry" name="send" class="btn">
                                    </div>
                                </div>
                            </form>
            <?php
                        }
                    } else {
                        echo '<p class="empty">no property listed yet!</p>';
                    }
                };
            } else {
                echo '<p class="empty">nothing saved yet!</p>';
            }
            ?>
        </div>
    </section>
    <!-- listings section ends -->
    <!-- footer section starts -->
    <?php include 'components/footer.php' ?>
    <!-- footer section ends -->
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src="./js/script.js"></script>
    <?php include 'components/message.php' ?>
</body>

</html>