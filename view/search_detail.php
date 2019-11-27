<?php error_reporting(E_ALL ^ E_NOTICE)?>

<?php
session_start();
@require_once "../model/Login.php";
@require_once "../model/Person.php";
@require_once "../controller/PersonController.php";
$username = "";
$name = "";
$email = "";
$phone = "";
$password = "";
$address = "";

// for login=============================================================>
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (strlen($username) == 0 || strlen($password) == 0) {
        @include_once "./errors/blankEntry.php";
    } else {
        $login = new Login($username,  $password);
        $result = loginPerson($login);

        if ($result->status == 1) {
            if ($result !== null) {
                $_SESSION['username'] = $result->user_name;
                $_SESSION['name'] = $result->name;
                $_SESSION['email'] = $result->email;
                $_SESSION['phone'] = $result->phone;
                $_SESSION['password'] = $result->password;
                $_SESSION['address'] = $result->address;
                @include_once "./errors/success.php";
            }
            if ($result === null) {
                @include_once "./errors/wrong.php";
            }
        } else {
            // header('Location: ' . $_SERVER['REQUEST_URI']);
            @include_once "./errors/invalidUser.php";
        }
    }
}

// for register==========================================================>
if (isset($_POST['insertPerson'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    if (strlen($username) == 0 || strlen($name) == 0 || strlen($email) == 0 || strlen($address) == 0 || strlen($phone) == 0 || strlen($password) == 0) {
        @include_once "./errors/blankEntry.php";
    } else {
        $person = new Person($username, $name, $email, $phone, $password, $address);
        $result = insertPerson($person);

        if ($result == 1) {
            @include_once "./errors/success.php";
        }
        if ($result == -1) {
            @include_once "./errors/exist.php";
        }
        if ($result == 0) {
            @include_once "./errors/wrong.php";
        }
    }
}

// for logout============================================================>
if (isset($_POST['logoutPerson'])) {
    session_destroy();
    @include_once "./errors/success.php";
    header('Location: ./search_detail.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Event Organizer</title>

    <link rel="shortcut icon" href="images/Favicon.ico">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/datepicker.css" rel="stylesheet" />
    <link href="css/loader.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/jquery.selectbox.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Domine:400,700%7COpen+Sans:300,300i,400,400i,600,600i,700,700i%7CRoboto:400,500" rel="stylesheet">

</head>

<body class="inner-page">
    <div class="page">
        <header id="header">
            <div class="quck-link">
                <div class="container">
                    <div class="mail"><a href="MailTo:eventorganizer@gmail.com"><span class="icon icon-envelope"></span>eventorganizer@gmail.com</a></div>
                    <div class="right-link">
                        <ul>
                            <li><a href="register.php"><span class="icon icon-multi-user"></span>Become a Vendor</a>
                            </li>
                            <?php
                            if ($_SESSION['name'] == "") {
                                echo '<li>';
                                echo '    <a href="javascript:;" data-toggle="modal" data-target="#registrationModal">Registration</a>';
                                echo '</li>';
                                echo '<li>';
                                echo '    <a href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a>';
                                echo '</li>';
                            } else {
                                echo '<li>';
                                echo '    <a href="javascript:;" data-toggle="modal" data-target="#logoutModal">Logout</a>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <nav id="nav-main">
                <div class="container">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a href="index.php" class="navbar-brand"><img src="images/logo.png" alt="" style="max-width: 80px"></a>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon1-barMenu"></span>
                                <span class="icon1-barMenu"></span>
                                <span class="icon1-barMenu"></span>
                            </button>

                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="single-col ">
                                    <a href="index.php">Home </a>
                                </li>
                                <li class="single-col ">
                                    <a href="#">Services <span class="icon icon-arrow-down"></span></a>
                                    <ul>
                                        <li>
                                            <a href="#">Single Package <span class="icon icon-arrow-right"></span></a>
                                            <ul>
                                                <li><a href="services/caterers/caterers.php">Caterers</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Bundle Package <span class="icon icon-arrow-right"></span></a>
                                            <ul>
                                                <li><a href="services/caterers/caterers.php">Caterers</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="single-col active">
                                    <a href="">Pages <span class="icon icon-arrow-down"></span></a>
                                    <ul>
                                        <li><a href="search-result.php">listing Page</a></li>
                                        <li><a href="search_detail.php">Details Page</a></li>

                                        <li><a href="news-details.php">News Details</a></li>
                                        <li><a href="career.php">Career</a></li>

                                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                                        <li>
                                            <a href="account_profile.php">My Account <span class="icon icon-arrow-right"></span></a>
                                            <ul>
                                                <li><a href="account_profile.php">Profile</a></li>
                                                <li><a href="account_booking.php">Orders</a></li>
                                                <li><a href="account_password.php">Change Password</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="team.php">Team</a></li>
                                    </ul>
                                </li>
                                <li class="single-col">
                                    <a href="">Booking <span class="icon icon-arrow-down"></span></a>
                                    <ul>
                                        <li><a href="booking_step1.php">Booking Step1</a></li>
                                    </ul>
                                </li>
                                <li><a href="aboutUs.php">About Us</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                            </ul>
                            <div class="search-box">
                                <div class="search-icon"><span class="icon icon-search"></span></div>
                                <div class="search-view">
                                    <div class="input-box">
                                        <form>
                                            <input type="text" placeholder="Search here">
                                            <input type="submit" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="modal modal-vcenter fade" id="loginModal" role="dialog">
            <div class="modal-dialog login-popup" role="document">
                <div class="modal-content">
                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                    <div class="left-img"><img src="images/login-leftImg.png" alt=""></div>
                    <div class="right-info">
                        <h1>Login</h1>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="input-form">
                                <div class="input-box">
                                    <div class="icon icon-user"></div>
                                    <input type="text" placeholder="Username" name="username" required>
                                </div>
                                <div class="input-box">
                                    <div class="icon icon-lock"></div>
                                    <input type="text" placeholder="Password" name="password" required>
                                </div>
                                <div class="submit-slide">
                                    <input type="submit" class="btn" name="login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-vcenter fade" id="logoutModal" role="dialog">
            <div class="modal-dialog login-popup" role="document">
                <div class="modal-content">
                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                    <div class="left-img"><img src="images/login-leftImg.png" alt=""></div>
                    <div class="right-info">
                        <h1>Are you sure ? </h1>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="input-form">
                                <div class="submit-slide">
                                    <input type="submit" class="btn" name="logoutPerson">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-vcenter fade" id="registrationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog registration-popup" role="document">
                <div class="modal-content" style="margin-top: 99px;">
                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                    <h1>New Member Registration</h1>
                    <div class="registration-form">
                        <div class="info">
                            <h2>Why to sign up</h2>
                            <ul>
                                <li>Exclusive discounts for all bookings</li>
                                <li>Full access all discounted prices</li>
                                <li>Dedicated wed-ordination for your event</li>
                                <li>Custom event planner for your event</li>
                            </ul>
                        </div>
                        <form method="POST" action="">
                            <div class="form-filde">
                                <div class="input-box">
                                    <input type="text" placeholder="Username" name="username" required>
                                </div>
                                <div class="input-box">
                                    <input type="text" placeholder="Name" name="name" required>
                                </div>
                                <div class="input-box">
                                    <input type="email" placeholder="Email ID" name="email">
                                </div>
                                <div class="input-box">
                                    <input type="text" placeholder="Phone" name="phone" required>
                                </div>
                                <div class="input-box">
                                    <input type="text" placeholder="Password" name="password" required>
                                </div>
                                <div class="input-box">
                                    <input type="text" placeholder="Address" name="address">
                                </div>
                                <div class="submit-slide">
                                    <input type="submit" class="btn" name="insertPerson">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-banner">
            <div class="banner-img">
                <img src="images/banner-img/search-resultBanner.png" alt="">
            </div>
            <div class="text">
                <div class="inner-text">
                    <h2>Leipzig Marriott Hotel </h2>
                    <p>Am Hallischen Tor 1 Saxony Leipzig, <br>04109 - Germany</p>
                </div>
            </div>
        </div>
        <section class="content">

            <div class="search-resultPage">
                <div class="fiexd-nav">
                    <div class="container">
                        <div class="back-link"><a href="search_detail.php#"><span class="icon icon-back-filled"></span>Back</a></div>
                        <ul>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-info"></span>
                                    <span class="text">Information</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-hands"></span>
                                    <span class="text">Amenities</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-thumb-image"></span>
                                    <span class="text">Photo Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-special-features"></span>
                                    <span class="text">Special Features</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-meal"></span>
                                    <span class="text">Meal Plans</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-pricing-plan"></span>
                                    <span class="text">Pricing Plan</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-term-condition"></span>
                                    <span class="text"> Terms & Conditions</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <span class="icon icon-cancellation-policy"></span>
                                    <span class="text">Cancellation Policy</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container">

                    <div class="row">
                        <div class="col-lg-9 col-sm-9 col-md-9">
                            <div class="hotel-info tab-content">
                                <h2>About the Hotel</h2>
                                <div class="inner-info">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                        with the release of Letraset sheets containing Lorem Ipsum passages, and more
                                        recently with desktop publishing software like Aldus PageMaker including
                                        versions of Lorem Ipsum.</p>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        that it has a more-or-less normal distribution of letters, as opposed to using
                                        'Content here, content here', making it look like readable English. Many desktop
                                        publishing packages and web page editors now use Lorem Ipsum as their default
                                        model text, and a search for 'lorem ipsum' will uncover many web sites still in
                                        their infancy. Various versions have evolved over the years, sometimes by
                                        accident, sometimes on purpose (injected humour and the like).</p>
                                    <div class="address">
                                        <div class="map-view">
                                            <img src="images/map-img1.png" alt="">
                                            <div class="link"><a href="search_detail.php#">See Location</a></div>
                                        </div>
                                        <div class="address-view">
                                            <h3>Address :</h3>
                                            <div class="address-slide full">
                                                <div class="icon icon-location-2"></div>
                                                <label>Leipzig Marriott Hotel </label>
                                                <p>Am Hallischen Tor 1 Saxony Leipzig, 04109 - Germany</p>
                                            </div>
                                            <h3>Near by :</h3>
                                            <div class="address-slide">
                                                <div class="icon icon-plane"></div>
                                                <label>13 km</label>
                                                <p>from Sardar Vallabhbhai Patel Airport....</p>
                                            </div>
                                            <div class="address-slide">
                                                <div class="icon icon-train"></div>
                                                <label>05 km</label>
                                                <p>from Kalupur Railway Station</p>
                                            </div>
                                            <div class="address-slide">
                                                <div class="icon icon-bus"></div>
                                                <label>04 km</label>
                                                <p>from Gita Mandir Bus Stop</p>
                                            </div>
                                            <div class="address-slide">
                                                <div class="icon icon-cart"></div>
                                                <label>02 km</label>
                                                <p>Raipur Shopping Mall</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amenities-list tab-content">
                                <h2>Amenities for You and Guests</h2>
                                <div class="amenities-view">
                                    <div class="amenities-box">
                                        <div class="icon icon-tea"></div>
                                        <span>Coffee Shop</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-wifi"></div>
                                        <span>Wifi</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-parking"></div>
                                        <span>Parking</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-airport-shuttle"></div>
                                        <span>Airport Shuttle</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-bar"></div>
                                        <span>Bar</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-road-guide"></div>
                                        <span>Guide Service</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-yoga"></div>
                                        <span>Yoga Centre</span>
                                    </div>
                                    <div class="amenities-box disabled">
                                        <div class="icon icon-ayurved"></div>
                                        <span>Ayurveda Centre</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-payment"></div>
                                        <span>Payment Mode</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-ac"></div>
                                        <span>A/C</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-meeting"></div>
                                        <span>Conference Hall</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-apple"></div>
                                        <span>Health Club</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-gym"></div>
                                        <span>Gym</span>
                                    </div>
                                    <div class="amenities-box disabled">
                                        <div class="icon icon-flower"></div>
                                        <span>Florist on Request</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-swimming"></div>
                                        <span>Swimming Pool</span>
                                    </div>
                                    <div class="amenities-box disabled">
                                        <div class="icon icon-steam-bath"></div>
                                        <span>Steam Sauna</span>
                                    </div>
                                    <div class="amenities-box disabled">
                                        <div class="icon icon-shirt"></div>
                                        <span>Laundry Service</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-spa"></div>
                                        <span>Spa</span>
                                    </div>
                                    <div class="amenities-box disabled">
                                        <div class="icon icon-beauty-saloon"></div>
                                        <span>Beauty Salon</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-sun-bed"></div>
                                        <span>Sun Beds</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-bag"></div>
                                        <span>Business Centre</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-doctor"></div>
                                        <span>Doctor on Call</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-massage-center"></div>
                                        <span>Massage Centre</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-taxi"></div>
                                        <span>Taxi Service</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-currency-xchg"></div>
                                        <span>Currency Exchange</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-handicape"></div>
                                        <span>Handicap Facilities</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-spoon"></div>
                                        <span>Restaurant</span>
                                    </div>
                                    <div class="amenities-box">
                                        <div class="icon icon-room-service"></div>
                                        <span>Room Service</span>
                                    </div>
                                </div>
                            </div>
                            <div class="photo-gallery tab-content">
                                <h2>Photo Gallery</h2>
                                <div class="gallery-view">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery1.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery1.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery2.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery3.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery3.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery4.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery4.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery5.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery5.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="img">
                                                <a href="images/gallery-img/gallery6.jpg" data-lightbox="example-set" data-title="Lorem Ipsum is simply">
                                                    <img src="images/gallery-img/gallery6.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="name">Lorem Ipsum is simply </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="special-features tab-content">
                                <h2>Special Features</h2>
                                <div class="featuresInfo">
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem Ipsum.</p>
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged.</p>
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. </p>
                                </div>
                            </div>
                            <div class="meal-info tab-content">
                                <h2>Meal Plan In the Hotel</h2>
                                <div class="meal-infoInner">
                                    <div class="meal-tab">
                                        <ul>
                                            <li><a href="javascript:;" id="breakfast">Breakfast Plan</a></li>
                                            <li class="active"><a href="javascript:;" id="lunch">Lunch Plan</a></li>
                                            <li><a href="javascript:;" id="tea">Hi-Tea Plan</a></li>
                                            <li><a href="javascript:;" id="dinner">Dinner Plan</a></li>
                                        </ul>
                                    </div>
                                    <div class="meal-view">
                                        <div class="breakfast-view meal-details">
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="title">Menu 1</div>
                                                </div>
                                                <div class="col">
                                                    <div class="title">Menu 2</div>
                                                </div>
                                            </div>
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Welcome Drink</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Snacks</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>8</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>8</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Desserts</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Tea</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Coffee</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Cookies</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row odd">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="totle">$ 1100</div>
                                                </div>
                                                <div class="col">
                                                    <div class="totle">$ 1400</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lunch-view meal-details">
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="title">Menu 1</div>
                                                </div>
                                                <div class="col">
                                                    <div class="title">Menu 2</div>
                                                </div>
                                                <div class="col">
                                                    <div class="title">Menu 3</div>
                                                </div>
                                            </div>
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Welcome Drink</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Starter </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>6</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>NA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Soup</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>2</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Salad</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Main Course </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>6</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Rice </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Daal</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>NA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Assorted Breads </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Desserts</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>6</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="totle">$ 1100</div>
                                                </div>
                                                <div class="col">
                                                    <div class="totle">$ 1400</div>
                                                </div>
                                                <div class="col">
                                                    <div class="totle">$ 1600</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tea-view meal-details">
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="title">Menu 1</div>
                                                </div>
                                            </div>
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Welcome Drink</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Snacks</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>8</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Desserts</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Tea</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Coffee</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Cookies</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="totle">$ 1100</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dinner-view meal-details">
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="title">Menu 1</div>
                                                </div>
                                                <div class="col">
                                                    <div class="title">Menu 2</div>
                                                </div>
                                                <div class="col">
                                                    <div class="title">Menu 3</div>
                                                </div>
                                            </div>
                                            <div class="row headBlock">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag"><label>Veg</label></div>
                                                        <div class="nonVag text-left"><label>Non-Veg</label></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Welcome Drink</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Starter </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>6</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>NA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Daal</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>1</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>2</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>NA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="menu-item">Assorted Breads </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>3</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">
                                                    <div class="menu-item">Desserts</div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>4</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="foodType">
                                                        <div class="vag">
                                                            <span>6</span>
                                                        </div>
                                                        <div class="nonVag">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row odd">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">
                                                    <div class="totle">$ 1100</div>
                                                </div>
                                                <div class="col">
                                                    <div class="totle">$ 1400</div>
                                                </div>
                                                <div class="col">
                                                    <div class="totle">$ 1600</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="price-plane tab-content">
                                <h2>Price Plan</h2>
                                <div class="price-inner">
                                    <div class="day-rent">
                                        <label>Rent Per Day</label>
                                        <span>$ 10,000</span>
                                    </div>
                                    <table class="price-table">
                                        <tr>
                                            <th>Meal type</th>
                                            <th>Min($)</th>
                                            <th>Max($)</th>
                                        </tr>
                                        <tr>
                                            <td><label for="radio-01" class="label_radio"><input type="radio" value="1" id="radio-01" name="sample-radio">Breakfast</label></td>
                                            <td>300</td>
                                            <td>500</td>
                                        </tr>
                                        <tr>
                                            <td><label for="radio-02" class="label_radio"><input type="radio" value="1" id="radio-02" name="sample-radio">Lunch</label></td>
                                            <td>400</td>
                                            <td>600</td>
                                        </tr>
                                        <tr>
                                            <td><label for="radio-03" class="label_radio"><input type="radio" value="1" id="radio-03" name="sample-radio">Dinner</label></td>
                                            <td>500</td>
                                            <td>750</td>
                                        </tr>
                                        <tr>
                                            <td><label for="radio-04" class="label_radio"><input type="radio" value="1" id="radio-04" name="sample-radio">Hi-Tea</label></td>
                                            <td>350</td>
                                            <td>500</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="note">* The prices are indicative and may vary based on the menu
                                    customization</div>
                            </div>
                            <div class="terms-conditions tab-content">
                                <h2>Terms & Conditions</h2>
                                <div class="conditions">
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem Ipsum.</p>
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged.</p>
                                    <h3>Lorem Ipsum is simply dummy </h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                            </div>
                            <div class="cancellation-policy tab-content">
                                <h2>Cancellation Policy</h2>
                                <div class="policy">
                                    <h3>1 policy</h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of
                                        Lorem Ipsum.</p>
                                    <h3>2 policy</h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged.</p>
                                    <h3>3 policy</h3>
                                    <p>text of the printing and typesetting industry. Lorem Ipsum has been the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer
                                        took a galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                            </div>


                        </div>
                        <div class="col-log-3 col-sm-3 col-md-3">
                            <div class="booking-formMain">
                                <div class="book-title">Enter Booking Details </div>
                                <div class="book-form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-box has-error">
                                                <input type="text" placeholder="Name">
                                                <div class="help-block">Date cannot be blank.</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <input type="text" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <input type="text" placeholder="Mobile">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="input-box">
                                                <input type="text" placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="input-box">
                                                <input type="text" placeholder="Time">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="input-box">
                                                <input type="text" placeholder="Min Guest">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="input-box">
                                                <input type="text" placeholder="Max Guest">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <a href="javascript:;" data-toggle="modal" data-target="#seatingModal" class="select-seating">
                                                <span class="select-value">Select Seating</span>
                                                <span class="arrow"><img src="images/select-arrow.png" alt=""></span>
                                            </a>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <input type="text" placeholder="Meal Type">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <input type="text" placeholder="Amount to Pay">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <input type="text" placeholder="Special Instruction">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="submit-box">
                                                <input type="submit" value="Book Now" class="btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-vcenter fade" id="seatingModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog seating-popup" role="document">
                            <div class="modal-content">
                                <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                                <h1>Seating Availability</h1>
                                <div class="facility-view">
                                    <div class="facility-box">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-theater"></div>
                                            <div class="name">Theatre</div>
                                            <div class="count">500</div>
                                        </div>
                                    </div>
                                    <div class="facility-box">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-classroom"></div>
                                            <div class="name">Classroom</div>
                                            <div class="count">250</div>
                                        </div>
                                    </div>
                                    <div class="facility-box">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-banquet"></div>
                                            <div class="name">Banquet</div>
                                            <div class="count">140</div>
                                        </div>
                                    </div>
                                    <div class="facility-box">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-u-shape"></div>
                                            <div class="name">U-Shape</div>
                                            <div class="count">120</div>
                                        </div>
                                    </div>
                                    <div class="facility-box">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-reception"></div>
                                            <div class="name">Reception</div>
                                            <div class="count">1000</div>
                                        </div>
                                    </div>
                                    <div class="facility-box active">
                                        <div class="inner-box">
                                            <div class="radio-icon"></div>
                                            <div class="icon icon-boardroom"></div>
                                            <div class="name">Boardroom</div>
                                            <div class="count">10</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="select-btn"><a href="javascript:;" class="btn">select</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-sm6 col-md-4 ">
                            <div class="footer-link">
                                <h5>Company</h5>
                                <ul>
                                    <li><a href="aboutUs.php">About Us</a></li>
                                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                                    <li><a href="career.php">Careers</a></li>
                                    <li><a href="blog.php">Blogs</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <div class="footer-contact">
                                <h5>Contact us</h5>
                                <div class="contact-slide">
                                    <div class="icon icon-location-1"></div>
                                    <p>Khilkhet, Nikunjo-2, Dhaka, Bangladesh </p>
                                </div>
                                <div class="contact-slide">
                                    <div class="icon icon-phone"></div>
                                    <p>01948510951</p>
                                </div>

                                <div class="contact-slide">
                                    <div class="icon icon-message"></div>
                                    <a href="MailTo:eventorganizer@gmail.com">eventorganizer@gmail.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-4">
                            <div class="contact-form">
                                <h5>Connect with us</h5>
                                <p>Connect with us so that u can get update news and offer. </p>

                                <div class="sosal-midiya">
                                    <ul>
                                        <li><a href="#"><span class="icon icon-facebook"></span></a></li>
                                        <li><a href="#"><span class="icon icon-twitter"></span></a></li>
                                        <li><a href="#"><span class="icon icon-linkedin"></span></a></li>
                                        <li><a href="#"><span class="icon icon-skype"></span></a></li>
                                        <li><a href="#"><span class="icon icon-google-plus"></span></a></li>
                                        <li><a href="#"><span class="icon icon-play"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <p>Copyright &copy; <span></span> - EventOrganizer | All Rights Reserved</p>
                </div>
            </div>
        </footer>
        <div class="booking-btnTop">book now</div>
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/scroll.js"></script>
    <script type="text/javascript" src="js/lightbox-plus-jquery.js"></script>
    <script type="text/javascript" src="js/jquery.selectbox-0.2.js"></script>
    <script type="text/javascript" src="js/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="js/placeholder.js"></script>
    <script type="text/javascript" src="js/coustem.js"></script>

</body>

</html>