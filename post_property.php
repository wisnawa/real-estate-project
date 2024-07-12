<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:./login.php');
}

if (isset($_POST['post'])) {
    $id = create_unique_id();
    $property_name = $_POST['property_name'];
    $property_name = filter_var($property_name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $deposite = $_POST['deposite'];
    $deposite = filter_var($deposite, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $offer = $_POST['offer'];
    $offer = filter_var($offer, FILTER_SANITIZE_STRING);
    $type = $_POST['type'];
    $type = filter_var($type, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $furnished = $_POST['furnished'];
    $furnished = filter_var($furnished, FILTER_SANITIZE_STRING);
    $bhk = $_POST['bhk'];
    $bhk = filter_var($bhk, FILTER_SANITIZE_STRING);
    $bedroom = $_POST['bedroom'];
    $bedroom = filter_var($bedroom, FILTER_SANITIZE_STRING);
    $bathroom = $_POST['bathroom'];
    $bathroom = filter_var($bathroom, FILTER_SANITIZE_STRING);
    $balcony = $_POST['balcony'];
    $balcony = filter_var($balcony, FILTER_SANITIZE_STRING);
    $carpet = $_POST['carpet'];
    $carpet = filter_var($carpet, FILTER_SANITIZE_STRING);
    $age = $_POST['age'];
    $age = filter_var($age, FILTER_SANITIZE_STRING);
    $total_floors = $_POST['total_floors'];
    $total_floors = filter_var($total_floors, FILTER_SANITIZE_STRING);
    $room_floors = $_POST['room_floors'];
    $room_floors = filter_var($room_floors, FILTER_SANITIZE_STRING);
    $loan = $_POST['loan'];
    $loan = filter_var($loan, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    if (isset($_POST['lift'])) {
        $lift = $_POST['lift'];
        $lift = filter_var($lift, FILTER_SANITIZE_STRING);
    } else {
        $lift = 'no';
    }
    if (isset($_POST['security_guard'])) {
        $security_guard = $_POST['security_guard'];
        $security_guard = filter_var($security_guard, FILTER_SANITIZE_STRING);
    } else {
        $security_guard = 'no';
    }
    if (isset($_POST['play_ground'])) {
        $play_ground = $_POST['play_ground'];
        $play_ground = filter_var($play_ground, FILTER_SANITIZE_STRING);
    } else {
        $play_ground = 'no';
    }
    if (isset($_POST['garden'])) {
        $garden = $_POST['garden'];
        $garden = filter_var($garden, FILTER_SANITIZE_STRING);
    } else {
        $garden = 'no';
    }
    if (isset($_POST['water_supply'])) {
        $water_supply = $_POST['water_supply'];
        $water_supply = filter_var($water_supply, FILTER_SANITIZE_STRING);
    } else {
        $water_supply = 'no';
    }
    if (isset($_POST['power_backup'])) {
        $power_backup = $_POST['power_backup'];
        $power_backup = filter_var($power_backup, FILTER_SANITIZE_STRING);
    } else {
        $power_backup = 'no';
    }
    if (isset($_POST['parking_area'])) {
        $parking_area = $_POST['parking_area'];
        $parking_area = filter_var($parking_area, FILTER_SANITIZE_STRING);
    } else {
        $parking_area = 'no';
    }
    if (isset($_POST['gym'])) {
        $gym = $_POST['gym'];
        $gym = filter_var($gym, FILTER_SANITIZE_STRING);
    } else {
        $gym = 'no';
    }
    if (isset($_POST['shopping_mall'])) {
        $shopping_mall = $_POST['shopping_mall'];
        $shopping_mall = filter_var($shopping_mall, FILTER_SANITIZE_STRING);
    } else {
        $shopping_mall = 'no';
    }
    if (isset($_POST['hospital'])) {
        $hospital = $_POST['hospital'];
        $hospital = filter_var($hospital, FILTER_SANITIZE_STRING);
    } else {
        $hospital = 'no';
    }
    if (isset($_POST['school'])) {
        $school = $_POST['school'];
        $school = filter_var($school, FILTER_SANITIZE_STRING);
    } else {
        $school = 'no';
    }
    if (isset($_POST['market_area'])) {
        $market_area = $_POST['market_area'];
        $market_area = filter_var($market_area, FILTER_SANITIZE_STRING);
    } else {
        $market_area = 'no';
    }

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_01_ext = pathinfo($image_01, PATHINFO_EXTENSION);
    $rename_image_01 = create_unique_id() . '.' . $image_01_ext;
    $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
    $image_01_size = $_FILES['image_01']['size'];
    $image_01_folder = 'upload_files/' . $rename_image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_02_ext = pathinfo($image_02, PATHINFO_EXTENSION);
    $rename_image_02 = create_unique_id() . '.' . $image_02_ext;
    $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
    $image_02_size = $_FILES['image_02']['size'];
    $image_02_folder = 'upload_files/' . $rename_image_02;

    if (!empty($image_02)) {
        if ($image_02_size > 2000000) {
            $warning_msg[] = 'image 02 size is too large!';
        } else {
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
        }
    } else {
        $rename_image_02 = '';
    }

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_03_ext = pathinfo($image_03, PATHINFO_EXTENSION);
    $rename_image_03 = create_unique_id() . '.' . $image_03_ext;
    $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
    $image_03_size = $_FILES['image_03']['size'];
    $image_03_folder = 'upload_files/' . $rename_image_03;

    if (!empty($image_03)) {
        if ($image_03_size > 2000000) {
            $warning_msg[] = 'image 03 size is too large!';
        } else {
            move_uploaded_file($image_03_tmp_name, $image_03_folder);
        }
    } else {
        $rename_image_03 = '';
    }

    $image_04 = $_FILES['image_04']['name'];
    $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
    $image_04_ext = pathinfo($image_04, PATHINFO_EXTENSION);
    $rename_image_04 = create_unique_id() . '.' . $image_04_ext;
    $image_04_tmp_name = $_FILES['image_04']['tmp_name'];
    $image_04_size = $_FILES['image_04']['size'];
    $image_04_folder = 'upload_files/' . $rename_image_04;

    if (!empty($image_04)) {
        if ($image_04_size > 2000000) {
            $warning_msg[] = 'image 04 size is too large!';
        } else {
            move_uploaded_file($image_04_tmp_name, $image_04_folder);
        }
    } else {
        $rename_image_04 = '';
    }

    $image_05 = $_FILES['image_05']['name'];
    $image_05 = filter_var($image_05, FILTER_SANITIZE_STRING);
    $image_05_ext = pathinfo($image_05, PATHINFO_EXTENSION);
    $rename_image_05 = create_unique_id() . '.' . $image_05_ext;
    $image_05_tmp_name = $_FILES['image_05']['tmp_name'];
    $image_05_size = $_FILES['image_05']['size'];
    $image_05_folder = 'upload_files/' . $rename_image_05;

    if (!empty($image_05)) {
        if ($image_05_size > 2000000) {
            $warning_msg[] = 'image 05 size is too large!';
        } else {
            move_uploaded_file($image_05_tmp_name, $image_05_folder);
        }
    } else {
        $rename_image_05 = '';
    }

    if ($image_01_size > 2000000) {
        $warning_msg[] = 'image 01 size is too large!';
    } else {
        $post_property = $conn->prepare("INSERT INTO `property` (id, user_id, property_name, address, price, type, offer, status, furnished, bhk, deposite, bedroom, bathroom, balcony, carpet, age, total_floors, room_floors, loan, lift, security_guard, play_ground, garden, water_supply, power_backup, parking_area, gym, shopping_mall, hospital, school, market_area, image_01, image_02, image_03, image_04, image_05, description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $post_property->execute([$id, $user_id, $property_name, $address, $price, $type, $offer, $status, $furnished, $bhk, $deposite, $bedroom, $bathroom, $balcony, $carpet, $age, $total_floors, $room_floors, $loan, $lift, $security_guard, $play_ground, $garden, $water_supply, $power_backup, $parking_area, $gym, $shopping_mall, $hospital, $school, $market_area, $rename_image_01, $rename_image_02, $rename_image_03, $rename_image_04, $rename_image_05, $description]);
        move_uploaded_file($image_01_tmp_name, $image_01_folder);
        $success_msg[] = 'property posted!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post property</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custome css fiel link -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header section starts -->
    <?php include 'components/user_header.php' ?>
    <!-- header section ends -->
    <!-- post property section starts -->
    <section class="property-form">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>property details</h3>
            <div class="box">
                <label for="property_name">property name <span>*</span></label>
                <input type="text" name="property_name" maxlength="50" required id="property_name" class="input" placeholder="enter property name">
            </div>
            <div class="flex">
                <div class="box">
                    <label for="price">property price <span>*</span></label>
                    <input type="number" name="price" maxlength="10" min="0" max="9999999999" required id="price" class="input" placeholder="enter property price">
                </div>
                <div class="box">
                    <label for="deposite">deposite amount <span>*</span></label>
                    <input type="number" name="deposite" maxlength="10" min="0" max="9999999999" required id="deposite" class="input" placeholder="enter deposite amount">
                </div>
                <div class="box">
                    <label for="address">property address <span>*</span></label>
                    <input type="text" name="address" maxlength="100" required id="address" class="input" placeholder="enter property address">
                </div>
                <div class="box">
                    <label for="offer">offer type <span>*</span></label>
                    <select name="offer" id="offer" class="input" required>
                        <option value="sale">sale</option>
                        <option value="resale">resale</option>
                        <option value="rent">rent</option>
                    </select>
                </div>
                <div class="box">
                    <label for="type">property type <span>*</span></label>
                    <select name="type" id="type" class="input" required>
                        <option value="flat">flat</option>
                        <option value="resale">resale</option>
                        <option value="rent">rent</option>
                    </select>
                </div>
                <div class="box">
                    <label for="status">property status <span>*</span></label>
                    <select name="status" id="status" class="input" required>
                        <option value="ready to move">ready to move</option>
                        <option value="under construction">under construction</option>
                    </select>
                </div>
                <div class="box">
                    <label for="furnished">furnished status <span>*</span></label>
                    <select name="furnished" id="furnished" class="input" required>
                        <option value="ufurnished">ufurnished</option>
                        <option value="semi-furnished">semi-furnished</option>
                        <option value="furnished">furnished</option>
                    </select>
                </div>
                <div class="box">
                    <label for="bhk">how many BHK <span>*</span></label>
                    <select name="bhk" id="bhk" class="input" required>
                        <option value="1">1 BHK</option>
                        <option value="2">2 BHK</option>
                        <option value="3">3 BHK</option>
                        <option value="4">4 BHK</option>
                        <option value="5">5 BHK</option>
                        <option value="6">6 BHK</option>
                        <option value="7">7 BHK</option>
                        <option value="8">8 BHK</option>
                        <option value="9">9 BHK</option>
                    </select>
                </div>
                <div class="box">
                    <label for="bedroom">how many bedrooms <span>*</span></label>
                    <select name="bedroom" id="bedroom" class="input" required>
                        <option value="1">1 bedroom</option>
                        <option value="2">2 bedrooms</option>
                        <option value="3">3 bedrooms</option>
                        <option value="4">4 bedrooms</option>
                        <option value="5">5 bedrooms</option>
                        <option value="6">6 bedrooms</option>
                        <option value="7">7 bedrooms</option>
                        <option value="8">8 bedrooms</option>
                        <option value="9">9 bedrooms</option>
                    </select>
                </div>
                <div class="box">
                    <label for="bathrooms">how many bedrooms <span>*</span></label>
                    <select name="bathroom" id="bathroom" class="input" required>
                        <option value="1">1 bathroom</option>
                        <option value="2">2 bathrooms</option>
                        <option value="3">3 bathrooms</option>
                        <option value="4">4 bathrooms</option>
                        <option value="5">5 bathrooms</option>
                        <option value="6">6 bathrooms</option>
                        <option value="7">7 bathrooms</option>
                        <option value="8">8 bathrooms</option>
                        <option value="9">9 bathrooms</option>
                    </select>
                </div>
                <div class="box">
                    <label for="balconys">how many bedrooms <span>*</span></label>
                    <select name="balcony" id="balcony" class="input" required>
                        <option value="0">0 balcony</option>
                        <option value="1">1 balcony</option>
                        <option value="2">2 balconys</option>
                        <option value="3">3 balconys</option>
                        <option value="4">4 balconys</option>
                        <option value="5">5 balconys</option>
                        <option value="6">6 balconys</option>
                        <option value="7">7 balconys</option>
                        <option value="8">8 balconys</option>
                        <option value="9">9 balconys</option>
                    </select>
                </div>
                <div class="box">
                    <label for="carpet">carpet area(sqft) <span>*</span></label>
                    <input type="number" name="carpet" maxlength="10" min="0" max="9999999999" required id="carpet" class="input" placeholder="how many squarefits">
                </div>
                <div class="box">
                    <label for="age">property age <span>*</span></label>
                    <input type="number" name="age" maxlength="2" min="0" max="99" required id="age" class="input" placeholder="how old is property">
                </div>
                <div class="box">
                    <label for="total_floors">total floors <span>*</span></label>
                    <input type="number" name="total_floors" maxlength="2" min="0" max="99" required id="total_floors" class="input" placeholder="how many floors available?">
                </div>
                <div class="box">
                    <label for="room_floors">room floor <span>*</span></label>
                    <input type="number" name="room_floors" maxlength="2" min="0" max="99" required id="room_floors" class="input" placeholder="property floor number">
                </div>
                <div class="box">
                    <label for="loan">loan <span>*</span></label>
                    <select name="loan" id="loan" class="input" required>
                        <option value="available">available</option>
                        <option value="not available">not available</option>
                    </select>
                </div>
            </div>
            <div class="box">
                <label for="description">property description <span>*</span></label>
                <textarea name="description" id="description" cols="30" rows="10" maxlength="1000" required placeholder="enter property description" class="input"></textarea>
            </div>
            <div class="checkbox">
                <div class="box">
                    <p>
                        <input type="checkbox" name="lift" id="lift" value="yes">
                        <label for="lift">lifts</label>
                    </p>
                    <p>
                        <input type="checkbox" name="security_guard" id="security_guard" value="yes">
                        <label for="security_guard">security guard</label>
                    </p>
                    <p>
                        <input type="checkbox" name="play_ground" id="play_ground" value="yes">
                        <label for="play_ground">play ground</label>
                    </p>
                    <p>
                        <input type="checkbox" name="garden" id="garden" value="yes">
                        <label for="garden">garden</label>
                    </p>
                    <p>
                        <input type="checkbox" name="water_supply" id="water_supply" value="yes">
                        <label for="water_supply">water supply</label>
                    </p>
                    <p>
                        <input type="checkbox" name="power_backup" id="power_backup" value="yes">
                        <label for="power_backup">power backup</label>
                    </p>
                </div>
                <div class="box">
                    <p>
                        <input type="checkbox" name="parking_area" id="parking_area" value="yes">
                        <label for="parking_area">parking area</label>
                    </p>
                    <p>
                        <input type="checkbox" name="gym" id="gym" value="yes">
                        <label for="gym">gym</label>
                    </p>
                    <p>
                        <input type="checkbox" name="shopping_mall" id="shopping_mall" value="yes">
                        <label for="shopping_mall">shopping mall</label>
                    </p>
                    <p>
                        <input type="checkbox" name="hospital" id="hospital" value="yes">
                        <label for="hospital">hospital</label>
                    </p>
                    <p>
                        <input type="checkbox" name="school" id="school" value="yes">
                        <label for="school">school</label>
                    </p>
                    <p>
                        <input type="checkbox" name="market_area" id="market_area" value="yes">
                        <label for="market_area">market area</label>
                    </p>
                </div>
            </div>
            <div class="box">
                <label for="image_01">image 01 <span>*</span></label>
                <input type="file" name="image_01" id="image_01" class="input" accept="image/*" required>
            </div>
            <div class="flex">
                <div class="box">
                    <label for="image_02">image 02</label>
                    <input type="file" name="image_02" id="image_02" class="input" accept="image/*">
                </div>
                <div class="box">
                    <label for="image_03">image 03</label>
                    <input type="file" name="image_03" id="image_03" class="input" accept="image/*">
                </div>
                <div class="box">
                    <label for="image_04">image 04</label>
                    <input type="file" name="image_04" id="image_04" class="input" accept="image/*">
                </div>
                <div class="box">
                    <label for="image_05">image 05</label>
                    <input type="file" name="image_05" id="image_05" class="input" accept="image/*">
                </div>
            </div>
            <input type="submit" value="post property" name="post" class="btn">
        </form>
    </section>
    <!-- post property section ends -->
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