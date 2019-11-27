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
    header('Location: ./search-result.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Event Planning</title>

    <link rel="shortcut icon" href="images/Favicon.ico">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/datepicker.css" rel="stylesheet" />
    <link href="css/loader.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="css/jquery.selectbox.css" rel="stylesheet" /><!-- select Box css -->
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
        <div class="modal modal-vcenter fade" id="loginModal" tabindex="-1" role="dialog">
            <div class="modal-dialog login-popup" role="document">
                <div class="modal-content">
                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                    <div class="left-img"><img src="images/login-leftImg.png" alt=""></div>
                    <div class="right-info">
                        <h1>Login</h1>
                        <div class="sosal-midiyaLogin">
                            <div class="facebook-link">
                                <a href="search-result.php#"><span class="icon icon-facebook"></span>Sign in with Facebook</a>
                            </div>
                            <div class="google-link">
                                <a href="search-result.php#"><span class="icon icon-google-plus"></span>Sign in with Google+</a>
                            </div>
                        </div>
                        <div class="or-text"><span>OR</span></div>
                        <div class="input-form">
                            <div class="input-box">
                                <div class="icon icon-user"></div>
                                <input type="text" placeholder="Username">
                            </div>
                            <div class="input-box">
                                <div class="icon icon-lock"></div>
                                <input type="text" placeholder="Password">
                            </div>
                            <div class="check-slide">
                                <div class="check">
                                    <label class="label_check" for="checkbox-02"><input type="checkbox" name="sample-checkbox-01" id="checkbox-02" value="1" checked="">Remember me</label>

                                </div>
                                <a href="search-result.php#">Forgot password ?</a>
                            </div>
                            <div class="submit-slide">
                                <input type="submit" value="Login" class="btn">
                            </div>
                        </div>
                        <div class="signUp-link">Haven’t signed up yet? <a href="javascript:void(0);">Sign Up</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-vcenter fade" id="registrationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog registration-popup" role="document">
                <div class="modal-content">
                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                    <h1>New Member Registration</h1>
                    <div class="registration-form">
                        <div class="info">
                            <h2>Why to sign up</h2>
                            <ul>
                                <li>Exclusive discounts for all bookings</li>
                                <li>Full access all discounted prices</li>
                                <li>Dedicated wed-ordinator for your event</li>
                                <li>Custom event planner for your event</li>
                            </ul>
                        </div>
                        <div class="form-filde">
                            <div class="input-box">
                                <input type="text" placeholder="Email ID">
                            </div>
                            <div class="input-box">
                                <input type="text" placeholder="Username">
                            </div>
                            <div class="input-box">
                                <input type="text" placeholder="Password">
                            </div>
                            <div class="input-box">
                                <input type="text" placeholder="Phone">
                            </div>
                            <div class="captcha-box">
                                <input type="text" placeholder="Enter Captcha">
                                <div class="captcha-img"><img src="images/capcha-img.png" alt=""></div>
                            </div>
                            <div class="note">Can’t Read ?<a href="search-result.php#">Refresh</a></div>
                            <div class="check-slide">
                                <label class="label_check" for="checkbox-03"><input type="checkbox" name="sample-checkbox-01" id="checkbox-03" value="1" checked="">By signing up, I agree to EventPlanning terms of services</label>
                            </div>
                            <div class="submit-slide">
                                <input type="submit" value="Register" class="btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="searchFilter-main">
            <section class="searchFormTop">
                <div class="container">
                    <div class="searchCenter">
                        <div class="refineCenter">
                            <span class="icon icon-filter"></span>
                            <span>Refine Results</span>
                        </div>
                        <div class="searchFilter">
                            <div class="input-box">
                                <div class="icon icon-grid-view"></div>
                                <input type="text" placeholder="Wedding Planning">
                            </div>
                            <div class="input-box searchlocation">
                                <div class="icon icon-location-1"></div>
                                <input type="text" placeholder="Germany - Berlin / East">
                            </div>
                            <div class="input-box date">
                                <div class="icon icon-calander-month"></div>
                                <input type="text" placeholder="29/08/2015" id="datepicker2">
                            </div>
                            <input type="submit" value="Search" class="btn">
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container">
                    <div class="venues-view">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="left-side">
                                    <div class="search">
                                        <div class="search-icon">
                                            <div class="icon icon-search"></div>
                                        </div>
                                        <input type="text" placeholder="Search by name">
                                    </div>
                                    <div class="filter-view">
                                        <div class="filter-block">
                                            <div class="title">
                                                <h2>Food And Drinks</h2>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-20"><input type="checkbox" name="sample-checkbox-01" id="checkbox-20" value="1">Non Vegetarian</label>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-21"><input type="checkbox" name="sample-checkbox-01" id="checkbox-21" value="1">Vegetarian</label>
                                            </div>
                                        </div>
                                        <div class="filter-block">
                                            <div class="title">
                                                <h2>Number of Guests</h2>
                                                <div class="reste-filter">
                                                    <a href="search-result.php#"><span class="icon icon-reset"></span>Reset</a>
                                                </div>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-22"><input type="checkbox" name="sample-checkbox-01" id="checkbox-22" value="1">&lt; 10</label>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-23"><input type="checkbox" name="sample-checkbox-01" id="checkbox-23" value="1">10 - 100</label>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-24"><input type="checkbox" name="sample-checkbox-01" id="checkbox-24" value="1">100 - 200</label>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-25"><input type="checkbox" name="sample-checkbox-01" id="checkbox-25" value="1" checked="">200 - 500</label>
                                            </div>
                                            <div class="check-slide">
                                                <label class="label_check" for="checkbox-26"><input type="checkbox" name="sample-checkbox-01" id="checkbox-26" value="1">&gt; 500</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="left-link">
                                        <h2>People also viewed...</h2>
                                        <ul>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>Denmark</a></li>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>Germany - Frankfurt / West</a></li>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>Greater Mexico City</a></li>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>HI - Big Island</a></li>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>Hungary</a></li>
                                            <li><a href="search-result.php#"><span class="icon icon-arrow-right"></span>Poland</a></li>
                                        </ul>
                                    </div>
                                    <div class="left-productBox hidden-sm">
                                        <h2>Featured Venues</h2>
                                        <div class="product-img"><img src="images/property-img/venues-img8.jpg" alt=""></div>
                                        <h3>Hilton Berlin </h3>
                                        <p>Mohrenstrasse 30 Berlin, 10117 - Germany</p>
                                        <div class="reviews">3.5 <div class="star">
                                                <div style="width:70%;" class="fill"></div>
                                            </div>reviews</div>
                                        <a href="search-result.php#">Vewi all Details <span class="icon icon-arrow-right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-9 col-sm-12">
                                <div class="right-side">
                                    <div class="toolbar">
                                        <div class="finde-count">97 Venues found. </div>
                                        <div class="right-tool">
                                            <div class="select-box">
                                                <select name="country_id" id="setUp_select" tabindex="1">
                                                    <option>Near by</option>
                                                    <option>Near by</option>
                                                    <option>Near by</option>
                                                    <option>Near by</option>
                                                    <option>Near by</option>
                                                </select>
                                            </div>
                                            <a href="search-result.php#" class="shortlist-btn"><span class="icon icon-heart-filled"></span>7 Shortlist</a>
                                            <div class="link">
                                                <ul>
                                                    <li><a href="search-result.php#">Map</a></li>
                                                    <li class="active"><a href="search-result.php#">List</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="venues-slide first">
                                        <div class="img"><img src="images/property-img/venues-img.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>Leipzig Marriott Hotel </h3>
                                            <div class="address">Am Hallischen Tor 1 Saxony Leipzig, 04109 - Germany</div>
                                            <div class="reviews">3.5 <div class="star">
                                                    <div class="fill" style="width:70%;"></div>
                                                </div>reviews</div>
                                            <div class="outher-info">
                                                <div class="info-slide first">
                                                    <label>Seating Capacity</label>
                                                    <span>20 - 160</span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Price Range</label>
                                                    <span>$ 1000 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Hotel Star Rating</label>
                                                    <div class="star">
                                                        <div class="fill" style="width:61%;"></div>
                                                    </div>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Min. Booking Amount</label>
                                                    <span>$ 5000 <small>(onwards)</small></span>
                                                </div>
                                                <div class="venues-link">
                                                    <a href="search-result.php#">4 Venues</a>
                                                </div>
                                            </div>
                                            <div class="outher-link">
                                                <ul>
                                                    <li><a href="search-result.php#"><span class="icon icon-calander-check"></span>Check Availability</a></li>
                                                    <li><a href="javascript:;" data-toggle="modal" data-target="#contactModal1"><span class="icon icon-phone"></span>Contact Vendor</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-heart"></span>Add to Wishlist</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-location-1"></span>See on Map</a></li>
                                                </ul>
                                            </div>
                                            <div class="button">
                                                <a href="search-result.php#" class="btn">Book Now</a>
                                                <a href="javascript:;" class="btn gray">View Details <span class="icon icon-arrow-down"></span></a>
                                            </div>
                                        </div>
                                        <div class="amenities-view">
                                            <h2>All Amenities :</h2>
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
                                                <div class="icon icon-currency-xchg"></div>
                                                <span>Currency Exchange</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-bag"></div>
                                                <span>Business Centre</span>
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
                                                <div class="icon icon-handicape"></div>
                                                <span>Handicap Facilities</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-doctor"></div>
                                                <span>Doctor on Call</span>
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
                                            <div class="amenities-box">
                                                <div class="icon icon-spoon"></div>
                                                <span>Restaurant</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-massage-center"></div>
                                                <span>Massage Centre</span>
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
                                                <div class="icon icon-room-service"></div>
                                                <span>Room Service</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-taxi"></div>
                                                <span>Taxi Service</span>
                                            </div>
                                        </div>
                                        <div class="modal fade modal-vcenter" id="contactModal1" tabindex="-1" role="dialog">
                                            <div class="modal-dialog contactvendor-popup" role="document">
                                                <div class="modal-content">
                                                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                                                    <h1>Mariom Banquet</h1>
                                                    <div class="note">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Last Name ">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Email ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-slide">
                                                                <textarea placeholder="Message"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="submit-slide">
                                                                <input type="submit" value="Send" class="btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="venues-slide">
                                        <div class="img"><img src="images/property-img/venues-img2.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>Hotel AMANO Grand Central </h3>
                                            <div class="address">Heidestrasse 62 Berlin, 10557 - Germany</div>
                                            <div class="reviews">3.5 <div class="star">
                                                    <div class="fill" style="width:70%;"></div>
                                                </div>reviews</div>
                                            <div class="outher-info">
                                                <div class="info-slide first">
                                                    <label>Seating Capacity</label>
                                                    <span>20 - 160</span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Price Range</label>
                                                    <span>$ 5100 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Hotel Star Rating</label>
                                                    <div class="star">
                                                        <div class="fill" style="width:61%;"></div>
                                                    </div>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Min. Booking Amount</label>
                                                    <span>$ 1000 <small>(onwards)</small></span>
                                                </div>
                                                <div class="venues-link">
                                                    <a href="search-result.php#">4 Venues</a>
                                                </div>
                                            </div>
                                            <div class="outher-link">
                                                <ul>
                                                    <li><a href="search-result.php#"><span class="icon icon-calander-check"></span>Check Availability</a></li>
                                                    <li><a href="javascript:;" data-toggle="modal" data-target="#contactModal2"><span class="icon icon-phone"></span>Contact Vendor</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-heart-filled"></span>Add to Wishlist</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-location-1"></span>See on Map</a></li>
                                                </ul>
                                            </div>
                                            <div class="button">
                                                <a href="search-result.php#" class="btn">Request Booking</a>
                                                <a href="javascript:;" class="btn gray">View Details <span class="icon icon-arrow-down"></span></a>
                                            </div>
                                        </div>
                                        <div class="amenities-view">
                                            <h2>All Amenities :</h2>
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
                                                <div class="icon icon-currency-xchg"></div>
                                                <span>Currency Exchange</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-bag"></div>
                                                <span>Business Centre</span>
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
                                                <div class="icon icon-handicape"></div>
                                                <span>Handicap Facilities</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-doctor"></div>
                                                <span>Doctor on Call</span>
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
                                            <div class="amenities-box">
                                                <div class="icon icon-spoon"></div>
                                                <span>Restaurant</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-massage-center"></div>
                                                <span>Massage Centre</span>
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
                                                <div class="icon icon-room-service"></div>
                                                <span>Room Service</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-taxi"></div>
                                                <span>Taxi Service</span>
                                            </div>
                                        </div>
                                        <div class="modal fade modal-vcenter" id="contactModal2" tabindex="-1" role="dialog">
                                            <div class="modal-dialog contactvendor-popup" role="document">
                                                <div class="modal-content">
                                                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                                                    <h1>Mariom Banquet</h1>
                                                    <div class="note">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Last Name ">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Email ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-slide">
                                                                <textarea placeholder="Message"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="submit-slide">
                                                                <input type="submit" value="Send" class="btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="venues-slide">
                                        <div class="img"><img src="images/property-img/venues-img3.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>Ameron Hotel Abion Spreebogen Berlin </h3>
                                            <div class="address">Am Hallischen Tor 1 Saxony Leipzig, 04109 - Germany</div>
                                            <div class="reviews">3.5 <div class="star">
                                                    <div class="fill" style="width:70%;"></div>
                                                </div>reviews</div>
                                            <div class="outher-info">
                                                <div class="info-slide first">
                                                    <label>Seating Capacity</label>
                                                    <span>20 - 160</span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Price Range</label>
                                                    <span>$ 5100 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Hotel Star Rating</label>
                                                    <div class="star">
                                                        <div class="fill" style="width:61%;"></div>
                                                    </div>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Min. Booking Amount</label>
                                                    <span>$ 1000 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="venues-link">
                                                    <a href="search-result.php#">4 Venues</a>
                                                </div>
                                            </div>
                                            <div class="outher-link">
                                                <ul>
                                                    <li><a href="search-result.php#"><span class="icon icon-calander-check"></span>Check Availability</a></li>
                                                    <li><a href="javascript:;" data-toggle="modal" data-target="#contactModal3"><span class="icon icon-phone"></span>Contact Vendor</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-heart"></span>Add to Wishlist</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-location-1"></span>See on Map</a></li>
                                                </ul>
                                            </div>
                                            <div class="button">
                                                <a href="search-result.php#" class="btn">Book Now</a>
                                                <a href="javascript:;" class="btn gray">View Details <span class="icon icon-arrow-down"></span></a>
                                            </div>
                                        </div>
                                        <div class="amenities-view">
                                            <h2>All Amenities :</h2>
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
                                                <div class="icon icon-currency-xchg"></div>
                                                <span>Currency Exchange</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-bag"></div>
                                                <span>Business Centre</span>
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
                                                <div class="icon icon-handicape"></div>
                                                <span>Handicap Facilities</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-doctor"></div>
                                                <span>Doctor on Call</span>
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
                                            <div class="amenities-box">
                                                <div class="icon icon-spoon"></div>
                                                <span>Restaurant</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-massage-center"></div>
                                                <span>Massage Centre</span>
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
                                                <div class="icon icon-room-service"></div>
                                                <span>Room Service</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-taxi"></div>
                                                <span>Taxi Service</span>
                                            </div>
                                        </div>
                                        <div class="modal fade modal-vcenter" id="contactModal3" tabindex="-1" role="dialog">
                                            <div class="modal-dialog contactvendor-popup" role="document">
                                                <div class="modal-content">
                                                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                                                    <h1>Mariom Banquet</h1>
                                                    <div class="note">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Last Name ">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Email ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-slide">
                                                                <textarea placeholder="Message"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="submit-slide">
                                                                <input type="submit" value="Send" class="btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="venues-slide last">
                                        <div class="img"><img src="images/property-img/venues-img4.jpg" alt=""></div>
                                        <div class="text">
                                            <h3>Hilton Berlin</h3>
                                            <div class="address">Mohrenstrasse 30 Berlin, 10117 - Germany</div>
                                            <div class="reviews">3.5 <div class="star">
                                                    <div class="fill" style="width:70%;"></div>
                                                </div>reviews</div>
                                            <div class="outher-info">
                                                <div class="info-slide first">
                                                    <label>Seating Capacity</label>
                                                    <span>20 - 160</span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Price Range</label>
                                                    <span>$ 5100 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Hotel Star Rating</label>
                                                    <div class="star">
                                                        <div class="fill" style="width:61%;"></div>
                                                    </div>
                                                </div>
                                                <div class="info-slide">
                                                    <label>Min. Booking Amount</label>
                                                    <span>$ 1000 <small>(Onwards)</small></span>
                                                </div>
                                                <div class="venues-link">
                                                    <a href="search-result.php#">4 Venues</a>
                                                </div>
                                            </div>
                                            <div class="outher-link">
                                                <ul>
                                                    <li><a href="search-result.php#"><span class="icon icon-calander-check"></span>Check Availability</a></li>
                                                    <li><a href="javascript:;" data-toggle="modal" data-target="#contactModal4"><span class="icon icon-phone"></span>Contact Vendor</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-heart"></span>Add to Wishlist</a></li>
                                                    <li><a href="search-result.php#"><span class="icon icon-location-1"></span>See on Map</a></li>
                                                </ul>
                                            </div>
                                            <div class="button">
                                                <a href="search-result.php#" class="btn">Book Now</a>
                                                <a href="javascript:;" class="btn gray">View Details <span class="icon icon-arrow-down"></span></a>
                                            </div>
                                        </div>
                                        <div class="amenities-view">
                                            <h2>All Amenities :</h2>
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
                                                <div class="icon icon-currency-xchg"></div>
                                                <span>Currency Exchange</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-bag"></div>
                                                <span>Business Centre</span>
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
                                                <div class="icon icon-handicape"></div>
                                                <span>Handicap Facilities</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-doctor"></div>
                                                <span>Doctor on Call</span>
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
                                            <div class="amenities-box">
                                                <div class="icon icon-spoon"></div>
                                                <span>Restaurant</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-massage-center"></div>
                                                <span>Massage Centre</span>
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
                                                <div class="icon icon-room-service"></div>
                                                <span>Room Service</span>
                                            </div>
                                            <div class="amenities-box">
                                                <div class="icon icon-taxi"></div>
                                                <span>Taxi Service</span>
                                            </div>
                                        </div>
                                        <div class="modal fade modal-vcenter" id="contactModal4" tabindex="-1" role="dialog">
                                            <div class="modal-dialog contactvendor-popup" role="document">
                                                <div class="modal-content">
                                                    <div class="close-icon" aria-label="Close" data-dismiss="modal"><img src="images/close-icon.png" alt=""></div>
                                                    <h1>Mariom Banquet</h1>
                                                    <div class="note">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Last Name ">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Email ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-slide">
                                                                <input type="text" placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="input-slide">
                                                                <textarea placeholder="Message"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="submit-slide">
                                                                <input type="submit" value="Send" class="btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pagination">
                                        <ul>
                                            <li class="prev disabled"><a href="search-result.php#">Prev</a></li>
                                            <li class="active"><a href="search-result.php#">1</a></li>
                                            <li><a href="search-result.php#">2</a></li>
                                            <li><a href="search-result.php#">3</a></li>
                                            <li><a href="search-result.php#">4</a></li>
                                            <li><a href="search-result.php#">5</a></li>
                                            <li class="next"><a href="search-result.php#">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/jquery.selectbox-0.2.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="js/placeholder.js"></script>
    <script type="text/javascript" src="js/coustem.js"></script>

</body>

</html>