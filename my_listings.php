<?php
include 'components/connect.php';
include 'rupiah.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['property_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM  `property` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $select_images = $conn->prepare("SELECT * FROM `property` WHERE id = ? LIMIT 1");
        $select_images->execute([$delete_id]);
        $fetch_images = $select_images->fetch(PDO::FETCH_ASSOC);
        $delete_image_01 = $fetch_images['image_01'];
        $delete_image_02 = $fetch_images['image_02'];
        $delete_image_03 = $fetch_images['image_03'];
        $delete_image_04 = $fetch_images['image_04'];
        $delete_image_05 = $fetch_images['image_05'];

        unlink('./upload_files/' . $delete_image_01);

        if (!empty($delete_image_02)) {
            unlink('./upload_files/' . $delete_image_02);
        }
        if (!empty($delete_image_03)) {
            unlink('./upload_files/' . $delete_image_03);
        }
        if (!empty($delete_image_04)) {
            unlink('./upload_files/' . $delete_image_04);
        }
        if (!empty($delete_image_05)) {
            unlink('./upload_files/' . $delete_image_05);
        }

        $delete_saved = $conn->prepare("DELETE FROM `saved` WHERE property_id = ?");
        $delete_saved->execute([$delete_id]);
        $delete_requests = $conn->prepare("DELETE FROM `requests` WHERE property_id = ?");
        $delete_requests->execute([$delete_id]);
        $delete_listing = $conn->prepare("DELETE FROM `property` WHERE id = ?");
        $delete_listing->execute([$delete_id]);
        $success_msg[] = 'listing deleted!';
    } else {
        $warning_msg[] = 'listing deleted already!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my listings</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- my listings section starts -->
    <section class="my-listings">
        <h1 class="heading" id="coba_merah">my listings</h1>
        <div class="box-container">
            <?php
            $select_listings = $conn->prepare("SELECT * FROM `property` WHERE user_id = ? ORDER BY date DESC");
            $select_listings->execute([$user_id]);
            if ($select_listings->rowCount() > 0) {
                while ($fetch_listings = $select_listings->fetch(PDO::FETCH_ASSOC)) {
                    $listing_id = $fetch_listings['id'];
                    if (!empty($fetch_listings['image_02'])) {
                        $image_02 = 1;
                    } else {
                        $image_02 = 0;
                    }
                    if (!empty($fetch_listings['image_03'])) {
                        $image_03 = 1;
                    } else {
                        $image_03 = 0;
                    }
                    if (!empty($fetch_listings['image_04'])) {
                        $image_04 = 1;
                    } else {
                        $image_04 = 0;
                    }
                    if (!empty($fetch_listings['image_05'])) {
                        $image_05 = 1;
                    } else {
                        $image_05 = 0;
                    }
                    $total_image = (1 + $image_02 + $image_03 + $image_04 + $image_05);
            ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="property_id" value="<?= $listing_id; ?>">
                        <div class="thumb">
                            <p><i class="fa-regular fa-image"></i><span><?= $total_image; ?></span></p>
                            <img src="./upload_files/<?= $fetch_listings['image_01']; ?>" alt="">
                        </div>
                        <p class="price"><i class="fa-solid fa-rupiah-sign"></i>&nbsp;<?= rupiah($fetch_listings['price']); ?></p>
                        <h3 class="name"><?= $fetch_listings['property_name']; ?></h3>
                        <p class="address"><i class="fa-solid fa-map-marker-alt"></i>&nbsp;<?= $fetch_listings['address']; ?></p>
                        <div class="flex-btn">
                            <a href="update_property.php?get_id=<?= $listing_id; ?>" class="btn">update</a>
                            <input type="submit" value="delete" class="btn" name="delete" onclick="return checkDelete()">
                        </div>
                        <a href="view_property.php?get_id=<?= $listing_id; ?>" class="btn">view property</a>
                    </form>
            <?php
                }
            } else {
                echo '
                <p class="empty">no listings found!</p>
                ';
            }
            ?>
        </div>
    </section>
    <!-- my listings section ends -->
    <!-- footer section starts -->
    <?php include 'components/footer.php' ?>
    <!-- footer section ends -->
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src="./js/script.js"></script>
    <script>
        function checkDelete() {
            return confirm('Are you sure delete?');
        }
    </script>
    <?php include 'components/message.php' ?>
</body>

</html>