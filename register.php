<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $c_pass = sha1($_POST['c_pass']);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_email->execute($email);

    if ($select_email->rowCount() > 0) {
        $warning_msg[] = 'email already taken!';
    } else {
        if ($pass != $c_pass) {
            $warning_msg[] = 'password not matched!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users` (id, name, number, email, password) VALUES (?,?,?,?,?)");
            $insert_user->execute([$id, $name, $number, $email, $c_pass]);

            if ($insert_user) {
                $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
                $verify_user->execute([$email, $c_pass]);
                $row = $verify_user->fetch(PDO::FETCH_ASSOC);

                if ($verify_user->rowCount() > 0) {
                    setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
                    header('location:home.php');
                } else {
                    $error_msg[] = 'something went wrong!';
                }
            }
        }
    }
}
// echo create_unique_id();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- register section starts -->
    <section class="form-container">
        <form action="" method="post">
            <h3>create an account</h3>
            <input type="text" class="box" name="name" required maxlength="50" placeholder="enter your name">
            <input type="email" class="box" name="email" required maxlength="50" placeholder="enter your email">
            <input type="number" class="box" name="number" required min="0" max="9999999999999" maxlength="13" placeholder="enter your number">
            <input type="password" class="box" name="pass" required maxlength="50" placeholder="enter your password">
            <input type="password" class="box" name="c_pass" required maxlength="50" placeholder="confirm your password">
            <p>already have an account?<a href="./login.php">login now</a></p>
            <input type="submit" value="register new" name="submit" class="btn">
        </form>
    </section>
    <!-- register section ends -->
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