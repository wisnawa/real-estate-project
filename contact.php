<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['send'])) {
    $message_id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $verify_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ? ");
    $verify_message->execute([$name, $email, $number, $message]);

    if ($verify_message->rowCount() > 0) {
        $warning_msg[] = 'message sent already!';
    } else {
        $insert_message = $conn->prepare("INSERT INTO `messages` (id, name, email, number, message) VALUES (?,?,?,?,?)");
        $insert_message->execute([$message_id, $name, $email, $number, $message]);
        $success_msg[] = 'message sent succesfull!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- contact section starts -->
    <section class="contact">
        <div class="row">
            <div class="image">
                <img src="./images/contact-img.svg" alt="">
            </div>
            <form action="" method="post">
                <h3>get in touch</h3>
                <input type="text" name="name" placeholder="enter your name" class="box" maxlength="50" required>
                <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
                <input type="number" name="number" placeholder="enter your number" class="box" maxlength="13" min="0" max="9999999999999" required>
                <textarea name="message" class="box" cols="30" rows="10" placeholder="enter your message" maxlength="1000" required></textarea>
                <input type="submit" value="send message" name="send" class="inline-btn">
            </form>
        </div>
    </section>
    <!-- contact section ends -->
    <!-- faq section starts -->
    <section class="faq" id="faq">
        <h1 class="heading">FAQ</h1>
        <div class="box-container">
            <div class="box">
                <h3><span>how to cancle booking?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
            <div class="box">
                <h3><span>when will get the possession?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
            <div class="box">
                <h3><span>when can i pay the rent?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
            <div class="box">
                <h3><span>how to contact with the buyers?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
            <div class="box">
                <h3><span>when my listing not showing up?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
            <div class="box">
                <h3><span>how to promote my listing?&nbsp;</span><i class="fa-solid fa-angle-down"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae expedita dicta placeat dolore inventore at, deserunt repellendus provident cumque ipsa?</p>
            </div>
        </div>
    </section>
    <!-- faq section ends -->
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