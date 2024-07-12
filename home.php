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
    <title>Home</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- home section starts -->
    <div class="home">
        <section class="center">
            <form action="search.php" method="post">
                <h3>find your perfect home</h3>
                <div class="box">
                    <p><label for="h_address">property address <span>*</span></label></p>
                    <input type="text" name="h_address" id="h_address" maxlength="100" placeholder="enter property address" class="input" required>
                </div>
                <div class="flex">
                    <div class="box">
                        <p><label for="h_type">property type <span>*</span></label></p>
                        <select name="h_type" id="h_type" class="input" required>
                            <option value="flat">flat</option>
                            <option value="hosue">hosue</option>
                            <option value="shop">shop</option>
                        </select>
                    </div>
                    <div class="box">
                        <p><label for="h_offer">offer type <span>*</span></label></p>
                        <select name="h_offer" id="h_offer" class="input" required>
                            <option value="sale">sale</option>
                            <option value="resale">resale</option>
                            <option value="rent">rent</option>
                        </select>
                    </div>
                    <div class="box">
                        <p><label for="h_min">minimum budget <span>*</span></label></p>
                        <select name="h_min" id="h_min" class="input" required>
                            <option value="5000">5k</option>
                            <option value="6000">6k</option>
                            <option value="7000">7k</option>
                        </select>
                    </div>
                    <div class="box">
                        <p><label for="h_max">maximum budget <span>*</span></label></p>
                        <select name="h_max" id="h_max" class="input" required>
                            <option value="8000">8k</option>
                            <option value="9000">9k</option>
                            <option value="10000">10k</option>
                        </select>
                    </div>
                </div>
                <input type="submit" name="h_search" value="search property" class="btn">
            </form>
        </section>
    </div>
    <!-- home section ends -->
    <!-- services section starts -->
    <section class="services">
        <h1 class="heading">our services</h1>
        <div class="box-container">
            <div class="box">
                <img src="./images/icon-1.png" alt="">
                <h3>buy house</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
            <div class="box">
                <img src="./images/icon-2.png" alt="">
                <h3>rent house</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
            <div class="box">
                <img src="./images/icon-3.png" alt="">
                <h3>sall house</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
            <div class="box">
                <img src="./images/icon-4.png" alt="">
                <h3>flats and buildings</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
            <div class="box">
                <img src="./images/icon-5.png" alt="">
                <h3>shops and malls</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
            <div class="box">
                <img src="./images/icon-6.png" alt="">
                <h3>24/7 services</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente provident tempore, distinctio tempora aliquam voluptas.</p>
            </div>
        </div>
    </section>
    <!-- services section ends -->
    <!-- listings section stats -->
    <section class="listings">
        <h1 class="heading">latest listings</h1>
        <div class="box-container">
            <?php
            $select_listings = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
            $select_listings->execute();
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
                                <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>saved</span></button>
                            <?php } else { ?>
                                <button type="submit" name="save" class="save"><i class="fa-solid fa-heart"></i><span>save</span></button>
                            <?php } ?>
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
            ?>
        </div>
        <div style="margin-top: 2rem; text-align: center;">
            <a href="listings.php" class="inline-btn">view all</a>
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