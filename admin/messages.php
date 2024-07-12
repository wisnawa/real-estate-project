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
    $verify_delete = $conn->prepare("SELECT * FROM `messages` WHERE id = ?");
    $verify_delete->execute([$delete_id]);
    if ($verify_delete->rowCount() > 0) {
        $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
        $delete_message->execute([$delete_id]);
        $success_msg[] = 'Message deleted?';
    } else {
        $warning_msg[] = 'Message deleted already!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href=".././css/admin_style.css">
</head>

<body>
    <!-- header section stars -->
    <?php include '../components/admin_header.php' ?>
    <!-- header section ends -->
    <!-- message section starts -->
    <section class="grid">
        <h1 class="heading">message</h1>
        <form action="" method="post" class="search-form">
            <input type="text" name="search_box" placeholder="search listings..." required maxlength="100">
            <button type="submit" name="search_btn" class="fa-solid fa-magnifying-glass"></button>
        </form>
        <div class="box-container">
            <?php if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
                $search_box = $_POST['search_box'];
                $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
                $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE name LIKE '%{$search_box}%' OR email LIKE '%{$search_box}%' OR number LIKE '%{$search_box}%'");
                $select_messages->execute();
            } else {
                $select_messages = $conn->prepare("SELECT * FROM `messages`");
                $select_messages->execute();
            }
            if ($select_messages->rowCount() > 0) {
                while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <p>name: <span><?= $fetch_messages['name']; ?></span></p>
                        <p>email: <a href="mailto:<?= $fetch_messages['email']; ?>"><?= $fetch_messages['email']; ?></a></p>
                        <p>phone: <a href="tel:<?= $fetch_messages['number']; ?>"><?= $fetch_messages['number']; ?></a></p>
                        <p>message: <span><?= $fetch_messages['message']; ?></span></p>
                        <form action="" method="post">
                            <input type="hidden" name="delete_id" value="<?= $fetch_messages['id']; ?>">
                            <input type="submit" name="delete" value="delete message" class="delete-btn" onclick="return confirm('delete this message?')">
                        </form>
                    </div>
            <?php
                }
            } elseif (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
                echo '<p class="empty">no results found!</p>';
            } else {
                echo '<p class="empty">You have no messages!</p>';
            }
            ?>
        </div>
    </section>
    <!-- message section ends -->

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src=".././js/admin_script.js"></script>
    <?php include '.././components/message.php' ?>

</body>

</html>