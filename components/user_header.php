<header class="header">
    <div class="nav nav-1">
        <section class="flex">
            <a href="./home.php" class="logo"><i class="fa-solid fa-house"></i>MyHome.</a>
            <ul>
                <li><a href="./post_property.php">post property <i class="fa-solid fa-paper-plane"></i></a></li>
            </ul>
        </section>
    </div>
    <div class="nav nav-2">
        <section class="flex">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div class="menu">
                <ul>
                    <li>
                        <a href="#">my listings <i class="fa-solid fa-angle-down"></i></a>
                        <ul>
                            <li><a href="./dashboard.php">dashboard</a></li>
                            <li><a href="./post_property.php">post property</a></li>
                            <li><a href="./my_listings.php">my listings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">options <i class="fa-solid fa-angle-down"></i></a>
                        <ul>
                            <li><a href="./search.php">fiter search</a></li>
                            <li><a href="./listings.php">all listings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">help <i class="fa-solid fa-angle-down"></i></a>
                        <ul>
                            <li><a href="./about.php">about us</a></li>
                            <li><a href="./contact.php">contact us</a></li>
                            <li><a href="./contact.php#faq">FAQ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <ul>
                <li><a href="./saved.php">saved <i class="fa-solid fa-heart"></i></a></li>
                <li><a href="#">account <i class="fa-solid fa-angle-down"></i></a>
                    <ul>
                        <li>
                            <a href="./login.php">login now</a>
                        </li>
                        <li>
                            <a href="./register.php">register</a>
                        </li>
                        <?php if ($user_id != '') { ?>
                            <li>
                                <a href="./update.php">update profile</a>
                            </li>
                            <li>
                                <a href="./components/user_logout.php" onclick="return confirm('logout from this website')">logout</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</header>