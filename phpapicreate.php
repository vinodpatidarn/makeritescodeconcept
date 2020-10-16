<?php
header('Content-Type: application/json');
require '../includes/functions.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$yourrate = array();
$getimage = site_url . '/apkabhaav/admin/uploads/desavar_bhavv/image/';
$getvideo = site_url . '/apkabhaav/admin/uploads/desavar_bhavv/video/';
if (isset($_POST["action"])) {
	if ($_POST["action"] == 'deshvar_bhav') {

		$select_deshvar = select("deshvar_bhav");
		if (howMany($select_deshvar) > 0) {
			while ($fetch_yourrate = fetch($select_deshvar)) {
			
				
				$nutsCategory = $fetch_yourrate['nuts_category'];
                    $categoryName = mysqli_query($conn ,"SELECT * FROM nuts_category WHERE token ='$nutsCategory'");
                    $getCategory = mysqli_fetch_array($categoryName);
                    
				$array_yourrate = array_push($yourrate, array(
					'id' => $fetch_yourrate['id'],
					'token' => $fetch_yourrate['token'],
					'image' => $getimage . '' . $fetch_yourrate['image'],
					'rate' => $fetch_market_report['rate'],
					'name' => $fetch_market_report['name'],
					'contact_number' => $fetch_market_report['contact_number'],
					'video' => $getvideo . '' . $fetch_yourrate['vedio'],
					'nuts' => $getCategory['category'],
					'description' => $fetch_yourrate['description'],
					'create_at' => $fetch_yourrate["created_date"],
					'update_date' => $fetch_yourrate["update_date"],
				));
			}
			if (!empty($array_yourrate)) {
				$arr[] = array(
					"success" => "Y",
					"code" => "1",
					"msg" => $yourrate,
				);
			} else {
				$arr[] = array(
					"success" => "N",
					"code" => "0",
					"msg" => "SomeThing Wents Wrong!",
				);
			}
		} else {
			$arr[] = array(
				"success" => "N",
				"code" => "1",
				"msg" => "There Are No About Found In our DataBase!",
			);
		}
	} else {
		$arr[] = array(
			"success" => "N",
			"code" => "1",
			"msg" => "Value do not match!",
		);
	}
} else {
	$arr[] = array(
		"success" => "N",
		"code" => "1",
		"msg" => "Please Filled the value and try again!",
	);
}

echo json_encode($arr, JSON_PRETTY_PRINT);
?>