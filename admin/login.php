<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $verify_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ? LIMIT 1");
    $verify_admin->execute([$name, $pass]);
    $row = $verify_admin->fetch(PDO::FETCH_ASSOC);

    if ($verify_admin->rowCount() > 0) {
        setcookie('admin_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
        header('location:dashboard.php');
    } else {
        $warning_msg[] = 'incorrect name or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href=".././css/admin_style.css">
</head>

<body style="padding-left: 0;">
    <!-- login section starts -->
    <section class="form-container">
        <form action="" method="post">
            <h3>welcome back!</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="login now" name="submit" class="btn">
        </form>
    </section>
    <!-- login section ends -->

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include '.././components/message.php' ?>
</body>

</html>