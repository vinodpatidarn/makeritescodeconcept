<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Calcutta');
define('host', 'localhost');
define('dbuser', 'tdglo6bf_global');
define('dbpass', 'admin@123');
define('dbname', 'tdglo6bf_globalmart');
define('site_url', $_SERVER['SERVER_NAME']);
define('site_name', 'TDGLOBALMART');
define('site_email', 'info@tdglobalmart.com');
define('admin_email', 'moiz.makerites@gmail.com');
define('fb_link', 'https://www.facebook.com/tdglobal.mart.5?ref=bookmarks');
define('insta_link', 'https://www.instagram.com/tdglobal_mart/');
define('pint_link', 'https://in.pinterest.com/thulani9306/');
if (file_exists('SendGrid/SendGrid-API/vendor/autoload.php')) {
  require_once 'SendGrid/SendGrid-API/vendor/autoload.php';
} elseif (file_exists('../../SendGrid/SendGrid-API/vendor/autoload.php')) {
  require_once '../../SendGrid/SendGrid-API/vendor/autoload.php';
} else {
  require_once '../SendGrid/SendGrid-API/vendor/autoload.php';
}

/*
required php 7.0+

Example to use

SaveData("tblname",["name"=> "Yash","last_name" => "Gupta","full_name" => "Yash Gupta" ,"email" => "email@mail.com","password" => '5646'],'created_at');

 */
if (isset($_SESSION["user"])) {
  $userId = $_SESSION["user"]["id"];
  $userToken = $_SESSION["user"]["token"];
  $fullname = $_SESSION["user"]["fullname"];
  $userEmail = $_SESSION["user"]["email"];
  $mobile = $_SESSION["user"]["mobile"];
}

if (isset($_SESSION["vendor"])) {
  $vendorId = $_SESSION["vendor"]["id"];
  $vendorToken = $_SESSION["vendor"]["token"];
  $vendorfullname = $_SESSION["vendor"]["fullname"];
  $vendorEmail = $_SESSION["vendor"]["email"];
  $vendormobile = $_SESSION["vendor"]["mobile"];
}

if (isset($_SESSION["admin"])) {
  $firstname = $_SESSION["admin"]["firstname"];
  $lastname = $_SESSION["admin"]["lastname"];
  $fullname = $firstname . ' ' . $lastname;
  $email = $_SESSION["admin"]["email"];
  $token = $_SESSION["admin"]["token"];
}

$conn = mysqli_connect(host, dbuser, dbpass, dbname);

function saveData(string $tbl_name, array $tbl_value, string $datetime = '') {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $string = '';
  $stringValue = '';
  foreach ($tbl_value as $key => $value) {
    $string .= $key . ",";
  }
  foreach ($tbl_value as $key => $value) {
    $stringValue .= "'" . mysqli_real_escape_string($conn, $value) . "',";
  }
  $tbl_key = substr($string, 0, -1);
  $tbl_value = substr($stringValue, 0, -1);
  if (!empty($datetime)) {
    $mysqliQuery = mysqli_query($conn, "INSERT INTO $tbl_name($tbl_key,$datetime)VALUES($tbl_value,NOW())");
  } else {
    $mysqliQuery = mysqli_query($conn, "INSERT INTO $tbl_name($tbl_key)VALUES($tbl_value)");
  }
  return $mysqliQuery;
}

/*
Example to use
select("tblname",condition);

 */

function select(string $tableName, string $condition = '') {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);

  if (empty($condition)) {
    $fetchQuery = mysqli_query($conn, "SELECT * FROM $tableName");
  } else {
    $fetchQuery = mysqli_query($conn, "SELECT * FROM $tableName WHERE $condition");
  }

  return $fetchQuery;
}

/*
Example to use
howMany(query);

 */

function howMany($query) {
  $mysqli_num_rows = mysqli_num_rows($query);
  return $mysqli_num_rows;
}

/*
Example to use
fetch(query);

 */

function fetch($query) {
  $mysqli_fetch_array = mysqli_fetch_array($query);
  return $mysqli_fetch_array;
}

/*
Example to use
fetch(query);

 */

function fetchAssoc($query) {
  $mysqli_fetch_assoc = mysqli_fetch_assoc($query);
  return $mysqli_fetch_assoc;
}

/* Random string
Example to use
$a = token(32);
$b = token(8, 'abcdefghijklmnopqrstuvwxyz');
 */

function token($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
  $pieces = [];
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
    $pieces[] = $keyspace[random_int(0, $max)];
  }
  return implode('', $pieces);
}

/* Random int
Example to use
$a = tokenInt(32);
$b = tokenInt(8, 'abcdefghijklmnopqrstuvwxyz');
 */

function tokenInt($length, $keyspace = '0123456789') {
  $pieces = [];
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
    $pieces[] = $keyspace[random_int(0, $max)];
  }
  return implode('', $pieces);
}

/*
delete
Example to use
deleteRow("tblname","condition");

 */

function deleteRow(string $tblname, string $condition) {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $deleteQuery = mysqli_query($conn, "DELETE FROM $tblname WHERE $condition");
  return $deleteQuery;
}

/**
 * @param  string $tblname [name of your table]
 * @param  array  $var_value [name and value for column in table to be update]
 * @param  string $condition  [such as WHERE clause and AND,OR,NOT]
 * @param  string $updated_at [optional: if table contain updated at field]
 * @return [boolean or string]
 *
 * Example of use: update("tblname",["field1" => "value","field2" => "value"],"id='1'","updated");
 */
function update(string $tblname, array $var_value, string $condition, string $updated_at = '') {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $query = mysqli_query($conn, "SHOW columns FROM $tblname");
  $strings = '';
  $keys = '';
  $error = '';
  foreach ($var_value as $key => $value) {
    $strings .= $key . "='" . mysqli_real_escape_string($conn, $value) . "',";
    $keys .= $key . ",";
  }
  $queryBuild = substr($strings, 0, -1);
  if (empty($updated_at)) {
    $updateQuery = mysqli_query($conn, "UPDATE $tblname SET $queryBuild WHERE $condition");
  } else {
    $arr = '';
    while ($row = mysqli_fetch_array($query)) {
      $arr .= $row['Field'] . ",";

    }
    $keyArray = explode(',', $keys);
    $array = explode(',', $arr);
    foreach ($keyArray as $key) {
      if (array_search($key, $array)) {
        //echo $results ='1';
      } else {
        $error .= $key . ",";
      }
    }
    $errorStrings = substr($error, 0, -1);
    $errorArray = explode(',', $error);
    $errorCount = count($errorArray);
    $totalError = $errorCount - 1;

    if ($totalError <= 0) {
      if (array_search($updated_at, $array)) {
        $updateQuery = mysqli_query($conn, "UPDATE $tblname SET $queryBuild,$updated_at=NOW() WHERE $condition");
      } else {
        echo $updateQuery = "<b>Error!</b> There is no Field in Table <b>" . $tblname . "</b> with <b>" . $updated_at . "</b> column.";
      }

    } else {
      echo $updateQuery = "<b>" . $totalError . " Error!</b> There is No Field With These column names(" . $errorStrings . ") in table <b>Users</b> <em>Please Check..</em> ";
    }

  }

  return $updateQuery;
}

function move(string $path) {
  //header("Location:$path");
  echo "<script>window.location.href='$path';</script>";
  return true;
}

function secureAdmin() {
  if (!isset($_SESSION["admin"]) AND empty($_SESSION["admin"])) {
    move("https://" . site_url);
  }
  return true;
}

/*
if You call this method this will check about `user` Session And redirection to Index.php if no pere is give
or if you want custom redirection give one single perameter as page url!

 */
function secureUser($link = '') {

  if (!isset($_SESSION["user"]) AND empty($_SESSION["user"])) {
    if ($link != "") {
      move("https://" . site_url . "/" . $link);
    } else {
      move("https://" . site_url . "/login.php");
    }

  }
  return true;
}

function secureVendor($link = '') {

  if (!isset($_SESSION["vendor"]) AND empty($_SESSION["vendor"])) {
    if ($link != "") {
      move("https://" . site_url . "/" . $link);
    } else {
      move("https://" . site_url . "/login.php");
    }

  }
  return true;
}

function getUserIP() {
  $client = @$_SERVER['HTTP_CLIENT_IP'];
  $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
  $remote = $_SERVER['REMOTE_ADDR'];

  if (filter_var($client, FILTER_VALIDATE_IP)) {
    $ip = $client;
  } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
    $ip = $forward;
  } else {
    $ip = $remote;
  }

  return $ip;
}

function timeAgo($timestamp) {
  date_default_timezone_set('Africa/Johannesburg');
  $time_ago = strtotime($timestamp);
  $current_time = time();
  $time_difference = $current_time - $time_ago;
  $seconds = $time_difference;
  $minutes = round($seconds / 60); // value 60 is seconds
  $hours = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
  $days = round($seconds / 86400); //86400 = 24  60  60;
  $weeks = round($seconds / 604800); // 7*24*60*60;
  $months = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
  $years = round($seconds / 31553280); //(365+365+365+365+366)/5  24  60 * 60
  if ($seconds <= 60) {
    return "Just Now";
  } else if ($minutes <= 60) {
    if ($minutes == 1) {
      return "one minute ago";
    } else {
      return "$minutes minutes ago";
    }
  } else if ($hours <= 24) {
    if ($hours == 1) {
      return "an hour ago";
    } else {
      return "$hours hrs ago";
    }
  } else if ($days <= 7) {
    if ($days == 1) {
      return "yesterday";
    } else {
      return "$days days ago";
    }
  } else if ($weeks <= 4.3) //4.3 == 52/12
  {
    if ($weeks == 1) {
      return "a week ago";
    } else {
      return "$weeks weeks ago";
    }
  } else if ($months <= 12) {
    if ($months == 1) {
      return "a month ago";
    } else {
      return "$months months ago";
    }
  } else {
    if ($years == 1) {
      return "one year ago";
    } else {
      return "$years years ago";
    }
  }
}

function dateFormat(string $datetime, string $format) {
  $date = date_create($datetime);
  return date_format($date, $format);
}

function clean(string $str) {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $string = mysqli_real_escape_string($conn, $str);
  $clean = trim($string);
  return $clean;
}

function post(string $str) {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $index = mysqli_real_escape_string($conn, $str);
  return $_POST[$index];
}

function lastID(string $tblName) {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  $select = mysqli_query($conn, " SELECT * FROM $tblName ORDER BY id DESC LIMIT 1 ");
  $row = mysqli_fetch_array($select);
  return $row["id"];
}

function query(string $str) {
  $conn = mysqli_connect(host, dbuser, dbpass, dbname);
  return mysqli_query($conn, $str);
}

function response(array $array) {
  return exit(json_encode(["response" => $array]));
}

function returnJson(int $int, string $str) {
  return exit(json_encode(["response" => ["code" => $int, "msg" => $str]]));
}
function getJson(int $int, string $str, array $msg) {
  return exit(json_encode(["response" => ["code" => $int, "success" => $str, "msg" => $msg]]));
}

function sentEmail($subject, $toname, $toemail, $html) {
  $from = new SendGrid\Email(site_name, site_email);
  $subject = $subject;
  $to = new SendGrid\Email($toname, $toemail);
  $content = new SendGrid\Content("text/html", $html);

  /*Send the mail*/
  $mail = new SendGrid\Mail($from, $subject, $to, $content);
  $apiKey = ('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'); //Shubham Patidar
  $sg = new \SendGrid($apiKey);
  $response = $sg->client->mail()->send()->post($mail);
  return $response;
}

function removeWhitespace($buffer) {
  return preg_replace('/\s+/', ' ', $buffer);
}

ob_start('removeWhitespace');

?>