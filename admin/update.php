<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
}

$select_admins = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
$select_admins->execute([$admin_id]);
$fetch_admin = $select_admins->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    if (!empty($name)) {
        $verify_name = $conn->prepare("SELECT name FROM `admins` WHERE name = ? LIMIT 1");
        $verify_name->execute([$name]);
        if ($verify_name->rowCount() > 0) {
            $warning_msg[] = 'Name already taken!';
        } else {
            $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $admin_id]);
            $success_msg[] = 'name update';
        }
    }
    $prev_pass = $fetch_admin['password'];
    $empty_pass = '40bd001563085fc35165329ea1ff5c5ecbdbb1ef';
    $old_pass = sha1(($_POST['old_pass']));
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1(($_POST['new_pass']));
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $c_pass = sha1(($_POST['c_pass']));
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'old password not matched!';
        } elseif ($c_pass != $new_pass) {
            $warning_msg[] = 'confirm password not matched!';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
                $update_pass->execute([$c_pass, $admin_id]);
                $success_msg[] = 'password updated!';
            } else {
                $warning_msg[] = 'place enter new password!';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href=".././css/admin_style.css">
</head>

<body>
    <!-- header section stars -->
    <?php include '../components/admin_header.php' ?>
    <!-- header section ends -->
    <!-- update section starts -->
    <section class="form-container">
        <form action="" method="post">
            <h3>update profile</h3>
            <input type="text" name="name" placeholder="<?= $fetch_admin['name']; ?>" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="c_pass" placeholder="confirm your new password" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="update now" name="submit" class="btn">
        </form>
    </section>
    <!-- update section ends -->

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link -->
    <script src=".././js/admin_script.js"></script>
    <?php include '.././components/message.php' ?>
</body>

</html>