<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
}
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $verify_delete = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
    $verify_delete->execute([$delete_id]);
    if ($verify_delete->rowCount() > 0) {
        $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
        $delete_admin->execute([$delete_id]);
        $success_msg[] = 'Admin delete!';
    } else {
        $warning_msg[] = 'Admin deleted already!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href=".././css/admin_style.css">
</head>

<body>
    <!-- header section stars -->
    <?php include '../components/admin_header.php' ?>
    <!-- header section ends -->
    <!-- admins section starts -->
    <section class="grid">
        <h1 class="heading">admins account</h1>
        <form action="" method="post" class="search-form">
            <input type="text" name="search_box" placeholder="search listings..." required maxlength="100">
            <button type="submit" name="search_btn" class="fa-solid fa-magnifying-glass"></button>
        </form>
        <div class="box-container">
            <?php
            if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
                $search_box = $_POST['search_box'];
                $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
                $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name LIKE '%{$search_box}%'");
                $select_admins->execute();
            } else {
                $select_admins = $conn->prepare("SELECT * FROM `admins`");
                $select_admins->execute();
            }
            if ($select_admins->rowCount() > 0) {
                while ($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <?php if ($fetch_admins['id'] == $admin_id) { ?>
                        <div class="box" style="order: -1;">
                            <p>name: <span><?= $fetch_admins['name']; ?></span></p>
                            <div class="flex-btn">
                                <a href="update.php" class="btn">update</a>
                                <a href="register.php" class="option-btn">register</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="box">
                            <p>name: <span><?= $fetch_admins['name']; ?></span></p>
                            <form action="" method="post">
                                <input type="hidden" name="delete_id" value="<?= $fetch_admins['id']; ?>">
                                <input type="submit" name="delete" value="delete admin" class="delete-btn" onclick="return confirm('delete this admin?')">
                            </form>
                        </div>
                    <?php } ?>
            <?php
                }
            } elseif (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
                echo '<p class="empty">no results found!</p>';
            }
            ?>
        </div>
    </section>
    <!-- admins section ends -->

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src=".././js/admin_script.js"></script>
    <?php include '.././components/message.php' ?>
</body>

</html>