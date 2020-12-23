
<?php
include "function.php";

   //facebook login Api 
	
	define('APP_ID', '423280098802251');
	define('APP_SECRET', '86b75fc4ffd55c3e349eda0a6b72caa7');
	define('REDIRECT_URL','http://localhost/ecommerce-website-11-12-20/index.php');
    require_once('lib_1/Facebook/FacebookSession.php');
	require_once('lib_1/Facebook/FacebookRequest.php');
	require_once('lib_1/Facebook/FacebookResponse.php');
	require_once('lib_1/Facebook/FacebookSDKException.php');
	require_once('lib_1/Facebook/FacebookRequestException.php');
	require_once('lib_1/Facebook/FacebookRedirectLoginHelper.php');
	require_once('lib_1/Facebook/FacebookAuthorizationException.php');
	require_once('lib_1/Facebook/FacebookAuthorizationException.php');
	require_once('lib_1/Facebook/GraphObject.php');
	require_once('lib_1/Facebook/GraphUser.php');
	require_once('lib_1/Facebook/GraphSessionInfo.php');
	require_once('lib_1/Facebook/Entities/AccessToken.php');
	require_once('lib_1/Facebook/HttpClients/FacebookCurl.php');
	require_once('lib_1/Facebook/HttpClients/FacebookHttpable.php');
	require_once('lib_1/Facebook/HttpClients/FacebookCurlHttpClient.php');

	//USING NAMESPACES
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\GraphUser;
	use Facebook\GraphSessionInfo;
	use Facebook\HttpClients\FacebookHttpable;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\HttpClients\FacebookCurl;

	//STARTING SESSION



	FacebookSession::setDefaultApplication(APP_ID,APP_SECRET);

	$helper = new FacebookRedirectLoginHelper(REDIRECT_URL);

	$sess = $helper->getSessionFromRedirect();

	if(isset($sess)){
		$request  = new FacebookRequest($sess, 'GET', '/me');
		$response = $request->execute();
		$graph = $response->getGraphObject(GraphUser::className());
        $name = $graph->getName();
        echo $name;
        $id = $graph->getId();
        $email = $graph->getEmail();
        $id = $_SESSION['login_user']['user_id'] = $id;
        //echo $email;
        $_SESSION['login_user']['name'] = $name;
    }
// google Api intrigration 

     require 'google_autoload/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('398361684942-v6bb7irftv8jdt0e5v9l92vmmhelgt3b.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('py0s5cFxKeHTDN0SN5NcgmmM');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/ecommerce-website-11-12-20/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['login_user']['name'] = $data['given_name'];
  }
if(!empty($data['id']))
  {
   $_SESSION['login_user']['user_id'] = $data['id'];
  // echo $_SESSION['login_user']['user_id'];
  }
  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['login_user']['email'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['login_user']['gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['login_user']['image'] = $data['picture'];
  }
 }
}

   //end google Api intrigration 


 $session_value=(isset($_SESSION['login_user']))?$_SESSION['login_user']['name']:''; 

if (isset($_POST['change_name'])) {
    $nm = $_POST['p_name'];
    $serch_res = mysqli_query($conn, "SELECT * FROM sub_category WHERE sub_cat_name = '$nm'");
    if (mysqli_num_rows($serch_res) > '0') {
        $url_value = mysqli_fetch_array($serch_res);
        $id = $url_value['id'];

        $username = base64_encode($id);
        header("location:product_category.php?p_name=$username");
    }
}
if (isset($_POST['hidden_key']) and !empty('hidden_key')) {
    $email = $_POST['email'];
    $password =$_POST['password'];
    //echo $password;
    $result = mysqli_query($conn, "SELECT * FROM user_login WHERE email = '$email'");
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1) {
        $res = mysqli_fetch_array($result);
        //echo $res['password'];
        //echo $password;
        $verify = password_verify($password, $res['password']);
        // var_dump($verify);
        if($verify == true){
           // echo 'vinod';
        $_SESSION["login_user"] = $res;
        return exit(json_encode(["response" => ["code" => '1', "success" => 'sucess', "msg" => 'login sucessfully']]));}
else {
    return exit(json_encode(["response" => ["code" => '0', "success" => 'sucess', "msg" => 'E-mail Went Wrong']]));}}
}
if (isset($_POST['check_out_key']) and !empty('check_out_key')) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM user_login WHERE email = '$email'");
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1) {
        $res = mysqli_fetch_array($result);
        //echo $res['password'];
        //echo $password;
        $verify = password_verify($password, $res['password']);
        // var_dump($verify);
        if($verify == true){
           // echo 'vinod';
        $_SESSION["login_user"] = $res;
        return exit(json_encode(["response" => ["code" => '1', "success" => 'sucess', "msg" => 'login sucessfully']]));}
else {
    return exit(json_encode(["response" => ["code" => '0', "success" => 'sucess', "msg" => 'E-mail Went Wrong']]));}}
}
if (isset($_POST['hidden_key_reg']) and !empty('hidden_key_reg')) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['Username'];
    $newpass = password_hash($password, PASSWORD_DEFAULT);
    $res = mysqli_query($conn, "SELECT * FROM user_login WHERE email = '$email'");
    if (mysqli_num_rows($res) === 0) {
        $result = mysqli_query($conn, "INSERT INTO user_login(email,password,name) VALUES('$email','$newpass','$username')");
        $result_login = mysqli_query($conn, "SELECT * FROM user_login WHERE email = '$email'");
    $num_rows = mysqli_num_rows($result_login);
    if ($num_rows === 1) {
        $res = mysqli_fetch_array($result_login);
        $_SESSION["login_user"] = $res;
        return exit(json_encode(["response" => ["code" => '1', "success" => 'sucess', "msg" => 'login sucessfully']]));
    } else {
        return exit(json_encode(["response" => ["code" => '0', "success" => 'sucess', "msg" => 'Something Went Wrong']]));
    }
    } else {
        return exit(json_encode(["response" => ["code" => '0', "success" => 'warning', "msg" => 'E-mail Alredy Used']]));
    }
}

?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>I AM WHOLE SALER</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="i-SOFTZONE">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/favicon-32x32.png">
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-32x32.png">
    <!-- <link rel="manifest" href="assets/images/icons/site.html"> -->
    <link rel="mask-icon" href="assets/images/icons/favicon-32x32.png">
    <!-- <link rel="shortcut icon" href="assets/images/icons/favicon.ico"> -->
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-14.css">
    <link rel="stylesheet" href="assets/css/demos/demo-13.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/paginate.css">
    <link rel="stylesheet" href="assets/css/ligne.css">
    <script type="text/javascript" src="assets/js/paginate.js"></script> -->

</head>

<body>
    <div class="page-wrapper">
        <header class="header header-10 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:#"><i class="icon-phone"></i>Call:+91 7415664456</a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#">User/login</a>
                                <ul>

                                    <!-- <li>   
                                        <div class="header-dropdown">
                                            <a href="#">Engligh</a>
                                            <div class="header-menu">
                                                <ul>
                                                    <li><a href="#"></a></li>
                                                    <li><a href="#">French</a></li>
                                                    <li><a href="#">Spanish</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li> -->
                                    <?php
                                    if (!isset($_SESSION['login_user'])) {

                                    ?>

                                        <li class="login">
                                            <a href=".signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li>
                                            <div class="header-dropdown">
                                                <a href="#"><?php echo $_SESSION['login_user']['name']; ?></a>
                                                <div class="header-menu">
                                                    <ul>
                                                        <li><a href="#">Account</a></li>
                                                    </ul>
                                                    <ul>
                                                        <li><a href="order-details.php">Your Orders</a></li>
                                                    </ul>
                                                    <ul>
                                                        <li><a href="logout.php">Logout</a></li>
                                                    </ul>
                                                </div><!-- End .header-menu -->
                                            </div><!-- End .header-dropdown -->
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.php" class="logo">
                            <img src="assets/images/new-2-logo.png" alt="Logo">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="index.php" method="POST">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <!-- End .select-custom -->

                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="p_name" id="q" placeholder="Search product ..." required>
                                    <button class="btn btn-primary" type="submit" name="change_name"><i class="icon-search"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>

                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                        <div class="header-dropdown-link">
                            <!-- <div class="dropdown compare-dropdown">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                                    <i class="icon-random"></i>
                                    <span class="compare-txt">Compare</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="compare-products">
                                        <li class="compare-product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                            <h4 class="compare-product-title"><a href="product.php">Blue Night Dress</a></h4>
                                        </li>
                                        <li class="compare-product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                            <h4 class="compare-product-title"><a href="product.php">White Long Skirt</a></h4>
                                        </li>
                                    </ul>

                                    <div class="compare-actions">
                                        <a href="#" class="action-link">Clear All</a>
                                        <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div> -->
                             
                            <a href="wishlist.php" class="wishlist-link">
                                <i class="icon-heart-o"></i>
                                <?php 
                                    if(isset($_SESSION['login_user'])){
                                       $user_id = $_SESSION['login_user']['user_id'];
                                       $wishlist_user_rows = mysqli_query($conn,"SELECT * FROM wishlist WHERE user_login_id = '$user_id'");  
                                       if(mysqli_num_rows($wishlist_user_rows) > '0'){
                                           $count = 0;
                                           while($row_count = mysqli_fetch_array($wishlist_user_rows)){
                                              $count++;  
                                           } 
                                           ?>
                                          
                                <span class="wishlist-count"><?php echo $count?$count:'0'; ?></span>
                                <?php
                                       }
                                       
                                    }
                                ?>
                                <span class="wishlist-txt">Wishlist</span>
                            </a>

                            <!-- add cart -->
                            <div class="dropdown cart-dropdown">

                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count cart_count" id="cart_count">

                                    </span>
                                    <span class="cart-txt">Cart</span>
                                </a>
                                <?php

                                ?>
                                <div class="dropdown-menu dropdown-menu-right cart_scroll">
                                    <div class="dropdown-cart-products fetch_data" id="fetch_data">

                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price total_price"><span class="text-capitalize"> Rs.</span></span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="cart.php" class="btn btn-primary">View Cart</a>
                                        <a href="#" class="btn btn-outline-primary-2" id="checkout"><span onclick="checkout()">Checkout</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .cart-dropdown -->
                        </div>
                        <!-- end cart -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown show" data-visible="true">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM category");
                                        if (mysqli_num_rows($result) > '0') {
                                            while ($rows = mysqli_fetch_array($result)) {

                                        ?>
                                                <li class="megamenu-container">
                                                    <?php
                                                    $su_result = mysqli_query($conn, "SELECT * FROM sub_category WHERE category_id ='$rows[id]'");
                                                    if (mysqli_num_rows($su_result) == '0') {

                                                    ?>
                                                        <a class="" href="#"><?php echo $rows['category_name'] ?></a>
                                                    <?php
                                                    } elseif (mysqli_num_rows($su_result) > '0') {
                                                    ?>
                                                        <a class="sf-with-ul" href="#"><?php echo $rows['category_name'] ?></a>
                                                        <?php

                                                        ?>
                                                        <div class="megamenu pl-5">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-12">
                                                                    <div class="menu-col">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <!-- <div class="menu-title"><?php echo $rows['category_name'] ?></div> -->
                                                                                <ul>
                                                                                    <?php
                                                                                    $sub_result = mysqli_query($conn, "SELECT * FROM sub_category WHERE category_id ='$rows[id]'");
                                                                                    if (mysqli_num_rows($sub_result)) {
                                                                                        while ($sub_rows = mysqli_fetch_array($sub_result)) {


                                                                                    ?>
                                                                                            <li><a href="product_category.php?c_id=<?php echo base64_encode($sub_rows['category_id']);?>&s_id=<?php echo base64_encode($sub_rows['id']);?>"><?php echo $sub_rows['sub_cat_name']; ?></a></li>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </ul>


                                                                            </div><!-- End .col-md-6 -->


                                                                            <!-- End .col-md-6 -->
                                                                        </div><!-- End .row -->
                                                                    </div><!-- End .menu-col -->
                                                                </div><!-- End .col-md-8 -->

                                                                <!-- End .col-md-4 -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .megamenu -->
                                                    <?php
                                                    }
                                                    ?>
                                                </li>
                                        <?php
                                            }
                                        }
                                        
                                        ?>



                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .col-lg-3 -->
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container active">
                                    <a href="index.php">Home</a>


                                </li>


                                <li>
                                    <a href="#">Company</a>
                                    <ul>
                                        <li><a href="about.php">About Us</a></li>
                                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                                        <li><a href="terms_conditions.php">Terms and Conditions</a></li>
                                        <li><a href="refund_policy.php">Refund Policy</a></li>
                                        <li><a href="payment.php">Payment Options</a></li>


                                    </ul>
                                </li>
                                </li>
                                 <li>
                                    <a href="about.php"> About Us</a> 

                                    <!--  <ul>
                                        <li><a href="blog.html">Classic</a></li>
                                        <li><a href="blog-listing.html">Listing</a></li>
                                        <li>
                                            <a href="#">Grid</a>
                                            <ul>
                                                <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                                <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                                <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                                <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Masonry</a>
                                            <ul>
                                                <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                                <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                                <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                                <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Mask</a>
                                            <ul>
                                                <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                                <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Single Post</a>
                                            <ul>
                                                <li><a href="single.html">Default with sidebar</a></li>
                                                <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                                <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                 </li> 
                                <li>
                                    <a href="contact.php">Contact Us</a>
                                </li>

                                <!-- <ul> -->


                                <!--  <ul>
                                                <li><a href="about.html">About 01</a></li>
                                                <li><a href="about-2.html">About 02</a></li>
                                            </ul> -->

                                <!-- <li>
                                                    <a href="contact.php">Contact</a></li> -->

                                <!--   <ul>
                                                <li><a href="contact.html">Contact 01</a></li>
                                                <li><a href="contact-2.html">Contact 02</a></li>
                                            </ul> -->

                                <!-- <li><a href="login.php">Login</a></li>
                                                <li><a href="faq.php">FAQs</a></li>
                                                <li><a href="404.php">Error 404</a></li>
                                                <li><a href="coming-soon.php">Coming Soon</a></li> -->
                                <!-- </ul> -->
                               
                                 <li>
                                 <a href="terms_conditions.php">Terms and Conditions</a>
                                 </li> 

                                <!-- <li> -->
                                <!-- <a href="blog.php">Blog</a> -->

                                <!--  <ul>
                                        <li><a href="blog.html">Classic</a></li>
                                        <li><a href="blog-listing.html">Listing</a></li>
                                        <li>
                                            <a href="#">Grid</a>
                                            <ul>
                                                <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                                <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                                <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                                <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Masonry</a>
                                            <ul>
                                                <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                                <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                                <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                                <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Mask</a>
                                            <ul>
                                                <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                                <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Single Post</a>
                                            <ul>
                                                <li><a href="single.html">Default with sidebar</a></li>
                                                <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                                <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                <!-- </li> -->
                                <!-- <li>
                                    <a href="elements-list.html" class="sf-with-ul">Elements</a>

                                    <ul>
                                        <li><a href="elements-products.html">Products</a></li>
                                        <li><a href="elements-typography.html">Typography</a></li>
                                        <li><a href="elements-titles.html">Titles</a></li>
                                        <li><a href="elements-banners.html">Banners</a></li>
                                        <li><a href="elements-product-category.html">Product Category</a></li>
                                        <li><a href="elements-video-banners.html">Video Banners</a></li>
                                        <li><a href="elements-buttons.html">Buttons</a></li>
                                        <li><a href="elements-accordions.html">Accordions</a></li>
                                        <li><a href="elements-tabs.html">Tabs</a></li>
                                        <li><a href="elements-testimonials.html">Testimonials</a></li>
                                        <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                                        <li><a href="elements-portfolio.html">Portfolio</a></li>
                                        <li><a href="elements-cta.html">Call to Action</a></li>
                                        <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                                    </ul>
                                </li> -->
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .col-lg-9 -->
                    <!-- <div class="header-right">
                        <i class="la la-lightbulb-o"></i><p>Clearance Up to 30% Off</span></p>
                    </div> -->
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->





   <?php 
      if(!isset($_SESSION['login_user'])){
          ?>
        
        <!-- Sign in / Register Modal -->
        <div class="modal fade signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="form-box">
                            <div class="form-tab">
                                <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-content-5">
                                    <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                        <form method="POST" id="formData">
                                            <div class="form-group">
                                                <label for="singin-email">Username or email address *</label>
                                                <input type="text" class="form-control" id="singin-email" name="email" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-group">
                                                <label for="singin-password">Password *</label>
                                                <input type="password" class="form-control" id="singin-password" name="password" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-footer">
                                                <input type="hidden" name="hidden_key" value="true">
                                                <input type="submit" name="submit" value="LOG IN" class="btn btn-outline-primary-2">
                                                <i class="icon-long-arrow-right"></i>
                                                </button>

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                    <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                                </div><!-- End .custom-checkbox -->

                                                <a href="forgot-password.php" class="forgot-link">Forgot Your Password?</a>
                                            </div><!-- End .form-footer -->
                                        </form>
                                        <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href='<?php echo $google_client->createAuthUrl(); ?>' class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div><!-- End .col-6 -->
                                                <div class="col-sm-6">
                                                    <a href='<?php echo $helper->getLoginUrl();?>' class="btn btn-login btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .form-choice -->
                                    </div><!-- .End .tab-pane -->
                                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                        <form method="POST" id="RegisterFrom">
                                            <div class="form-group">
                                                <label for="register-username">UserName *</label>
                                                <input type="text" class="form-control" name="Username" required autocomplete="off">
                                            </div><!-- End .form-group -->
                                            <div class="form-group">

                                                <label for="register-email">Your email address *</label>
                                                <input type="email" class="form-control" id="register-email" name="email" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-group">
                                                <label for="register-password">Password *</label>
                                                <input type="password" class="form-control" name="password" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-footer">
                                                <input type="hidden" name="hidden_key_reg" value="true">
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>SIGN UP</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                    <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .form-footer -->
                                        </form>
                                        <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a  class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div><!-- End .col-6 -->
                                                <div class="col-sm-6">
                                                    <a href="<?php echo $helper->getLoginUrl();?>" class="btn btn-login  btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .form-choice -->
                                    </div><!-- .End .tab-pane -->
                                </div><!-- End .tab-content -->
                            </div><!-- End .form-tab -->
                        </div><!-- End .form-box -->
                    </div><!-- End .modal-body -->
                </div><!-- End .modal-content -->
            </div><!-- End .modal-dialog -->
        </div><!-- End .modal -->



        <div class="modal fade checkout_model" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="form-box">
                            <div class="form-tab">
                                <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-content-5">
                                    <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                        <form method="POST" id="check_out_fromData">
                                            <div class="form-group">
                                                <label for="singin-email">Username or email address *</label>
                                                <input type="text" class="form-control" id="singin-email" name="email" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-group">
                                                <label for="singin-password">Password *</label>
                                                <input type="password" class="form-control" id="singin-password" name="password" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-footer">
                                                <input type="hidden" name="check_out_key" value="true">
                                                <input type="submit" name="submit" value="LOG IN" class="btn btn-outline-primary-2">
                                                <i class="icon-long-arrow-right"></i>
                                                </button>

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                    <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                                </div><!-- End .custom-checkbox -->

                                                <a href="forgot-password.php" class="forgot-link">Forgot Your Password?</a>
                                            </div><!-- End .form-footer -->
                                        </form>
                                        <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div><!-- End .col-6 -->
                                                <div class="col-sm-6">
                                                    <a href="<?php echo $helper->getLoginUrl();?>" class="btn btn-login btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .form-choice -->
                                    </div><!-- .End .tab-pane -->
                                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                        <form method="POST" id="RegisterFrom">
                                            <div class="form-group">
                                                <label for="register-username">UserName *</label>
                                                <input type="text" class="form-control" name="Username" required autocomplete="off">
                                            </div><!-- End .form-group -->
                                            <div class="form-group">

                                                <label for="register-email">Your email address *</label>
                                                <input type="email" class="form-control" id="register-email" name="email" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-group">
                                                <label for="register-password">Password *</label>
                                                <input type="password" class="form-control" name="password" required autocomplete="off">
                                            </div><!-- End .form-group -->

                                            <div class="form-footer">
                                                <input type="hidden" name="hidden_key_reg" value="true">
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>SIGN UP</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                    <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .form-footer -->
                                        </form>
                                        <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div><!-- End .col-6 -->
                                                <div class="col-sm-6">
                                                    <a href="<?php echo $helper->getLoginUrl();?>" class="btn btn-login  btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .form-choice -->
                                    </div><!-- .End .tab-pane -->
                                </div><!-- End .tab-content -->
                            </div><!-- End .form-tab -->
                        </div><!-- End .form-box -->
                    </div><!-- End .modal-body -->
                </div><!-- End .modal-content -->
            </div><!-- End .modal-dialog -->
        </div>
        <?php
      }
   ?> 
        <!--   <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
         
            $(document).ready(function() {
               
               // alert(forget_pass);
                $("#formData").submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: 'header.php',
                        type: 'POST',
                        data: formData,
                        cache: false,
                        dataType: 'json',
                        contentType: false,
                        processData: false,


                        success: function(data) {

                            if (data.response.code == '1') {
                                swal("Good job!", "Login Successfully!", "success");
                                setTimeout(function() {
                                    window.location.href = 'index.php';
                                }, 300);
                            }
                             //var times = '0'
                            if (data.response.code == '0') {
                                swal("ohh! snap", "please Register And Then Login!", "warning");
                            }
                           

                        },

                        error: function(data) {
                            console.log("error");
                            console.log(data);
                        }
                    });
                });
                $("#check_out_fromData").submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    $.ajax({
                        url: 'header.php',
                        type: 'POST',
                        data: formData,
                        cache: false,
                        dataType: 'json',
                        contentType: false,
                        processData: false,


                        success: function(data) {

                            if (data.response.code == '1') {
                                swal("Good job!", "Login Successfully!", "success");
                                setTimeout(function() {
                                    window.location.href = 'checkout.php';
                                }, 300);
                            }
                            if (data.response.code == '0') {
                                swal("ohh! snap", "please Register And Then Login!", "warning");
                            }

                        },

                        error: function(data) {
                            console.log("error");
                            console.log(data);
                        }
                    });
                });
                
                $("#RegisterFrom").submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    $.ajax({
                        url: 'header.php',
                        type: 'POST',
                        data: formData,
                        cache: false,
                        dataType: 'json',
                        contentType: false,
                        processData: false,


                        success: function(data) {

                            if (data.response.code == '1') {
                                swal("Good job!", "Register Successfully!", "success");
                                setTimeout(function() {
                                    window.location.href = 'index.php';
                                }, 300);
                            }
                            if (data.response.code == '0') {
                                swal("ohh! snap", "E-mail Already Used!", "warning");
                            }

                        },

                        error: function(data) {
                            console.log("error");
                            console.log(data);
                        }
                    });
                });
            });

            //for add to cart product add ajax
            var fetch_data = [];
            $(function() {
                if (localStorage.fetch_data) {
                    fetch_data = JSON.parse(localStorage.fetch_data);
                    showCart();
                }
            });

            function pluse(P_id,title1,symboles){
              //alert(symboles);    
             
                for (var i in fetch_data) {

                    if (fetch_data[i].id == P_id) {
                        fetch_data[i].Qty= parseInt(fetch_data[i].Qty) + 1 ;
                         fetch_data[i].Product_total = fetch_data[i].Price * Math.abs(fetch_data[i].Qty);
                        
                         fetch_data[i].Qtyprice = title1 * fetch_data[i].Qty;
                         location.reload();
                       showCart();
                        saveCart();
                        
                        return;
                         //console.log(fetch_data);
                        
                    }
                }  

            }
            function minus(P_id,title1,symboles){
              //alert(symboles);    
             
                var qty = (symboles == 1 ) ? 0 : 1; 
               // alert(qty);
                //alert(qty);
                for (var i in fetch_data) {

                    if (fetch_data[i].id == P_id) {
                        fetch_data[i].Qty = parseInt(fetch_data[i].Qty) - qty;
                         fetch_data[i].Product_total = fetch_data[i].Price * Math.abs(fetch_data[i].Qty);
                        
                         fetch_data[i].Qtyprice = title1 * fetch_data[i].Qty;
                         location.reload();
                       showCart();
                        saveCart();
                        
                        return;
                         //console.log(fetch_data);
                        
                    }
                }  

            }
           

            function anchore_tag(id, name, title) {
                // var price = $("#product_price").text();
                // var name = $("#product_title").text();
                //   var  img = $(".fullcontect").attr('role');
                var qty =$("#qty").val();
                //alert(qty);
                
                alert('add to cart sucessfully');
                var title1 = title.substring(0, title.indexOf("="));

                var imgpath = title.substring(title.indexOf("=") + 1);

                var p_id = id;
                var qtyreal = qty ? qty : 1;

                for (var i in fetch_data) {

                    if (fetch_data[i].id == p_id) {

                        fetch_data[i].Qty = parseInt(fetch_data[i].Qty) + parseInt(qtyreal);
                       // alert(fetch_data[i].Qty);
                         fetch_data[i].Product_total = fetch_data[i].Price * fetch_data[i].Qty;
                        
                        fetch_data[i].Qtyprice = title1 * fetch_data[i].Qty;

                        showCart();
                        saveCart();
                        location.reload();
                        return;
                    }
                }
                
                var item = {
                    id: p_id,
                    Product: name.replace("%", " "),
                    Price: title1,
                    Qtyprice: title1 * qtyreal,
                    Img: imgpath,
                    Qty: qty ? qty : 1,
                    Product_total :title1
                };

                
                fetch_data.push(item);
                saveCart();
                showCart(this.item);
                location.reload();
            }

            function deleteItem(index) {
                alert('Are You Sure to Delete This Item')
                // delete item at index
                fetch_data.splice(index, 1);
                // fetch_data.remove(index);
                location.reload();
                showCart();
                saveCart();

            }

            function saveCart() {
                if (window.localStorage) {
                    localStorage.fetch_data = JSON.stringify(fetch_data);
                }
            }
          
            function showCart() {
                var total = 0;
                for (var i in fetch_data) {

                    var item = fetch_data[i];
                     
                  //console.log(item);
                    var row = `<div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="#">` + item.Product.replace("%", '  ') + `</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">
                                                    ` + item.Qty + `
                                                </span>
                                                X Rs ` + item.Price + `
                                                </span>
                                            </div>

                                            <figure class="product-image-container">
                                                <a href="#" class="product-image">
                                                    <img src="assets/uploads/` + item.Img + `" alt="product">
                                                </a>
                                            </figure>
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close" onclick="deleteItem(` + i + `)"></i></a>
                                        </div>
                                       
                                    </div>`;
                     var viewcart = `<tr><td class="product-col" >
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="assets/uploads/` + item.Img + `" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
                                                    <a href="#">` + item.Product.replace("%", '  ') + `</a>
													</h3>
												</div>
											</td>
											<td class="price-col"> Rs ` + item.Price + `</td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                <input type="button" min="1" onclick="minus(`+item.id+`,`+item.Price+`,`+item.Qty+`)" value="-" />
                                                        <input type="text" name="quantity"  value=`+Math.abs(item.Qty)+` maxlength="2" min="0" max="10" size="1" id="number" style="width:24px" pattern="\d+"/>
                                                        <input type="button"  min="1" onclick="pluse(`+item.id+`,`+item.Price+`,`+item.Qty+`)" value="+" />
                                                </div>
                                            </td>
											<td class="total-col"> Rs `+item.Product_total+`</td>
											<td class="remove-col"><button class="btn-remove"><i class="icon-close" onclick="deleteItem(` + i + `)"></i></button></td>
										</tr>`;
                                  var checkout = `<tr>
		                							<td><a href="#">` + item.Product.replace("%", '  ') + `</a></td>
		                							<td>Rs `+item.Product_total+`</td>
		                						  </tr>`;
                                 
                    var cart_count = 1;
                    var cart_count = +cart_count + i++;
                    $(".viewcart").append(viewcart);
                    $(".checkout_cart").append(checkout);
                   
                    $('#cart_count').html(cart_count);
                    var total = parseInt(total) + parseInt(item.Qtyprice);
                    $(".fetch_data").append(row);
                  

                }
                $('.total_price').append(total);
                //$('.total_price').append(total);
               //$(".checkoutsubtotal").append(checkoutsubtotal);
               


            }

            function wishlist(id){
               
                $.ajax({
                    url:'wishlist_data.php',
                    method:'POST',
                    data: {product_id : id},
                    success:function(data){
                      console.log(data.code);
                      if(data == 1){
                       
                        setTimeout(function(){
                           
                        }, 10000);
                        swal("Success!","Add SuccessFully!","success");
                     
                      }if(data == 0){
                        swal("info!","Already Exit!","info");
                      }if(data == 2){
                        $('.signin-modal').modal('toggle');
                      }
                     
                    },
                    error:function(data){
                      console.log(data);

                    }


                })
                
                
            }

            function checkout(){
           
             //console.log('viod');
             var str ="<?php echo $session_value?>";
          
             console.log(str);
            if(str.length == 0){
                $('.checkout_model').modal('toggle');
            }else{
               window.location = "checkout.php";
            }
            }
             
          
function decrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
        value--;
            document.getElementById('number').value = value;
    }

}


              
        </script>