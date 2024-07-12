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
    <title>search page</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- filter section starts -->
    <section class="filter-search">
        <form action="" method="post">
            <div id="close-filter"><i class="fa-solid fa-xmark"></i></div>
            <h3>filter your search</h3>
            <div class="flex">
                <div class="box">
                    <p><label for="address">property address <span>*</span></label></p>
                    <input type="text" name="address" id="address" maxlength="100" placeholder="enter property address" class="input" required>
                </div>
                <div class="box">
                    <p><label for="type">property type <span>*</span></label></p>
                    <select name="type" id="type" class="input" required>
                        <option value="flat">flat</option>
                        <option value="hosue">hosue</option>
                        <option value="shop">shop</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="offer">offer type <span>*</span></label></p>
                    <select name="offer" id="offer" class="input" required>
                        <option value="sale">sale</option>
                        <option value="resale">resale</option>
                        <option value="rent">rent</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="bhk">how many BHK <span>*</span></label></p>
                    <select name="bhk" id="bhk" class="input" required>
                        <option value="1">1 BHK</option>
                        <option value="2">2 BHK</option>
                        <option value="3">3 BHK</option>
                        <option value="4">4 BHK</option>
                        <option value="5">5 BHK</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="min">minimum budget <span>*</span></label></p>
                    <select name="min" id="min" class="input" required>
                        <option value="5000">5000</option>
                        <option value="6000">6000</option>
                        <option value="7000">7000</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="max">maximum budget <span>*</span></label></p>
                    <select name="max" id="max" class="input" required>
                        <option value="8000">8000</option>
                        <option value="9000">9000</option>
                        <option value="10000">10000</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="status">property status <span>*</span></label></p>
                    <select name="status" id="status" class="input" required>
                        <option value="ready to move">ready to move</option>
                        <option value="under construction">under construction</option>
                    </select>
                </div>
                <div class="box">
                    <p><label for="furnished">furnished <span>*</span></label></p>
                    <select name="furnished" id="furnished" class="input" required>
                        <option value="ufurnished">unfurnished</option>
                        <option value="semi-furnished">semi-furnished</option>
                        <option value="furnished">furnished</option>
                    </select>
                </div>
            </div>
            <input type="submit" name="filter_search" value="filter search" class="btn">
        </form>
    </section>
    <!-- filter section ends -->
    <div id="open-filter" class="fas fa-filter"></div>
    <?php
    if (isset($_POST['h_search'])) {
        $h_address = $_POST['h_address'];
        $h_address = filter_var($h_address, FILTER_SANITIZE_STRING);
        $h_offer = $_POST['h_offer'];
        $h_offer = filter_var($h_offer, FILTER_SANITIZE_STRING);
        $h_type = $_POST['h_type'];
        $h_type = filter_var($h_type, FILTER_SANITIZE_STRING);
        $h_min = $_POST['h_min'];
        $h_min = filter_var($h_min, FILTER_SANITIZE_STRING);
        $h_max = $_POST['h_max'];
        $h_max = filter_var($h_max, FILTER_SANITIZE_STRING);

        $select_listings = $conn->prepare("SELECT * FROM `property` WHERE address LIKE '%{$h_address}%' AND type LIKE '%{$h_type}%' AND offer LIKE '%{$h_offer}%' AND price BETWEEN $h_min AND $h_max ORDER BY date DESC");
        $select_listings->execute();
    } elseif (isset($_POST['filter_search'])) {
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $offer = $_POST['offer'];
        $offer = filter_var($offer, FILTER_SANITIZE_STRING);
        $type = $_POST['type'];
        $type = filter_var($type, FILTER_SANITIZE_STRING);
        $bhk = $_POST['bhk'];
        $bhk = filter_var($bhk, FILTER_SANITIZE_STRING);
        $min = $_POST['min'];
        $min = filter_var($min, FILTER_SANITIZE_STRING);
        $max = $_POST['max'];
        $max = filter_var($max, FILTER_SANITIZE_STRING);
        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_STRING);
        $furnished = $_POST['furnished'];
        $furnished = filter_var($furnished, FILTER_SANITIZE_STRING);

        $select_listings = $conn->prepare("SELECT * FROM `property` WHERE address LIKE '%{$address}%' AND type LIKE '%{$type}%' AND offer LIKE '%{$offer}%' AND status LIKE '%{$status}%' AND furnished LIKE '%{$furnished}%' AND bhk LIKE '%{$bhk}%' AND price BETWEEN $min AND $max ORDER BY date DESC");
        $select_listings->execute();
    } else {
        $select_listings = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
        $select_listings->execute();
    }
    ?>
    <!-- listings section stats -->
    <section class="listings">
        <?php if (isset($_POST['h_search']) or isset($_POST['filter_search'])) {
            echo '<h1 class="heading">search result</h1>';
        } else {
            echo '<h1 class="heading">latest property</h1>';
        } ?>
        <div class="box-container">
            <?php
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
                echo '<p class="empty">no results found!</p>';
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
    <script>
        let filter = document.querySelector('.filter-search');
        document.querySelector('#open-filter').onclick = () => {
            filter.classList.add('active');
        };
        document.querySelector('#close-filter').onclick = () => {
            filter.classList.remove('active');
        };
    </script>
    <?php include 'components/message.php' ?>
</body>

</html>