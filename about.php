<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- about us serction starts -->
    <section class="about">
        <div class="row">
            <div class="image"><img src="./images/about-img.svg" alt=""></div>
            <div class="content">
                <h3>why choose use?</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Impedit itaque aperiam placeat, sed aliquid eveniet. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic enim vitae porro dolorum maiores aliquam facere nostrum rerum tempora ratione!</p>
                <a href="contact.php" class="inline-btn">contact us</a>
            </div>
        </div>
    </section>
    <!-- about us serction ends -->
    <!-- steps section starts -->
    <section class="steps">
        <h1 class="heading">3 simple steps</h1>
        <div class="box-container">
            <div class="box">
                <img src="./images/step-1.png" alt="">
                <h3>search property</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, maiores.</p>
            </div>
            <div class="box">
                <img src="./images/step-2.png" alt="">
                <h3>contact dealer</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, maiores.</p>
            </div>
            <div class="box">
                <img src="./images/step-3.png" alt="">
                <h3>enjoy property</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, maiores.</p>
            </div>
        </div>
    </section>
    <!-- steps section ends -->
    <!-- review section stars -->
    <section class="reviews">
        <h1 class="heading">client's reviews</h1>
        <div class="box-container">
            <div class="box">
                <div class="user">
                    <img src="./images/pic-1.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
            <div class="box">
                <div class="user">
                    <img src="./images/pic-2.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
            <div class="box">
                <div class="user">
                    <img src="./images/pic-3.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
            <div class="box">
                <div class="user">
                    <img src="./images/pic-4.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
            <div class="box">
                <div class="user">
                    <img src="./images/pic-5.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
            <div class="box">
                <div class="user">
                    <img src="./images/pic-6.png" alt="">
                    <div>
                        <h3>john doe</h3>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, nobis veniam! Sunt facere impedit corrupti sint, dignissimos quae aut vero?</p>
            </div>
        </div>
    </section>
    <!-- review section ends -->
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