
<?php
if (isset($_FILES['BookImage']['name'])) {
		$valid_formats = array("png", "jpeg", "jpg");
		$image = $_FILES['BookImage']['name'];
		list($txt, $ext) = explode(".", $image);
		if (in_array($ext, $valid_formats)) {
			$imageName = time() . "." . $ext;
			$tmp = $_FILES['BookImage']['tmp_name'];
			move_uploaded_file($tmp, "../upload_img/create_book_img/" . $imageName);
		} else {
			$imageName = '';
		}
	} else {
		$imageName = '';
	}
    ?>
