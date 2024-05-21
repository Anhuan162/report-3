<?php

function show($stuff){
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}


function page($file){
	return "../app/pages/".$file.".php";
}

function db_connect()
{
	$string = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
	$con = new PDO($string, DBUSER, DBPASS);
	return $con;
}


function db_query_one($query, $data = array())
{

	$con = db_connect();

	$stm = $con->prepare($query);
	if($stm){
		$check = $stm->execute($data);
		if($check){
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);

			if(is_array($result) && count($result) > 0){
				return $result[0];
			}
		}
	}
	return false;
}

function db_query($query, $data = array())
{

	$con = db_connect();

	$stm = $con->prepare($query);
	if($stm){
		$check = $stm->execute($data);
		if($check){
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);

			if(is_array($result) && count($result) > 0){
				return $result;
			}
		}
	}
	return false;
}




function message($message = '', $clear = false){

	if(!empty($message)){
		$_SESSION['message'] = $message;
	}	
	else {
		if(!empty($_SESSION['message'])){
			$msg = $_SESSION['message'];
			if($clear){
				unset($_SESSION['message']);
			}
			return $msg;
		}

	}

	return false;
}


function redirect($page){
	header("Location: ".ROOT."/".$page);
	die;
}


function set_value($key , $default=''){
	if(!empty($_POST[$key])){
		return $_POST[$key];
	}
	else{
		return $default;
	}
	return '';
}

function set_select($key, $value, $default=''){
	if(!empty($_POST[$key])){
		if($_POST[$key] == $value){
			return "selected";
		}
		
	}
	else {
		if($default == $value){
			return "selected";
		}
	}
	return '';
}

function get_date($date){
	return date("jS M, Y", strtotime($date));
}


function logged_in(){

	if(!empty($_SESSION['USER']) && is_array($_SESSION['USER'])){
		return true;
	}
	return false;
}

function is_admin(){

	if(!empty($_SESSION['USER']['role']) && $_SESSION['USER']['role'] == 'admin'){
		return true;
	}
	return false;
}

function user($column){
	if(!empty($_SESSION['USER'][$column])){
		return $_SESSION['USER'][$column];
	}
	return "unknown";
}

function authenticate($row){
	$_SESSION['USER'] = $row;
}



function str_to_url($url) {
    // Bảng chuyển đổi các ký tự có dấu thành không dấu
    $transliteration = [
        'à' => 'a', 'á' => 'a', 'ạ' => 'a', 'ả' => 'a', 'ã' => 'a',
        'â' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ậ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a',
        'ă' => 'a', 'ằ' => 'a', 'ắ' => 'a', 'ặ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a',
        'è' => 'e', 'é' => 'e', 'ẹ' => 'e', 'ẻ' => 'e', 'ẽ' => 'e',
        'ê' => 'e', 'ề' => 'e', 'ế' => 'e', 'ệ' => 'e', 'ể' => 'e', 'ễ' => 'e',
        'ì' => 'i', 'í' => 'i', 'ị' => 'i', 'ỉ' => 'i', 'ĩ' => 'i',
        'ò' => 'o', 'ó' => 'o', 'ọ' => 'o', 'ỏ' => 'o', 'õ' => 'o',
        'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ộ' => 'o', 'ổ' => 'o', 'ỗ' => 'o',
        'ơ' => 'o', 'ờ' => 'o', 'ớ' => 'o', 'ợ' => 'o', 'ở' => 'o', 'ỡ' => 'o',
        'ù' => 'u', 'ú' => 'u', 'ụ' => 'u', 'ủ' => 'u', 'ũ' => 'u',
        'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ự' => 'u', 'ử' => 'u', 'ữ' => 'u',
        'ỳ' => 'y', 'ý' => 'y', 'ỵ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y',
        'đ' => 'd',
        'À' => 'A', 'Á' => 'A', 'Ạ' => 'A', 'Ả' => 'A', 'Ã' => 'A',
        'Â' => 'A', 'Ầ' => 'A', 'Ấ' => 'A', 'Ậ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A',
        'Ă' => 'A', 'Ằ' => 'A', 'Ắ' => 'A', 'Ặ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A',
        'È' => 'E', 'É' => 'E', 'Ẹ' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E',
        'Ê' => 'E', 'Ề' => 'E', 'Ế' => 'E', 'Ệ' => 'E', 'Ể' => 'E', 'Ễ' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Ị' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I',
        'Ò' => 'O', 'Ó' => 'O', 'Ọ' => 'O', 'Ỏ' => 'O', 'Õ' => 'O',
        'Ô' => 'O', 'Ồ' => 'O', 'Ố' => 'O', 'Ộ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O',
        'Ơ' => 'O', 'Ờ' => 'O', 'Ớ' => 'O', 'Ợ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Ụ' => 'U', 'Ủ' => 'U', 'Ũ' => 'U',
        'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ự' => 'U', 'Ử' => 'U', 'Ữ' => 'U',
        'Ỳ' => 'Y', 'Ý' => 'Y', 'Ỵ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y',
        'Đ' => 'D'
    ];

    // Thay thế các ký tự tiếng Việt có dấu bằng không dấu
    $url = strtr($url, $transliteration);

    // Loại bỏ dấu nháy đơn
    $url = str_replace("'", "", $url);

    // Thay thế các ký tự không phải chữ cái hoặc số bằng dấu gạch ngang
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);

    // Loại bỏ các dấu gạch ngang thừa ở đầu và cuối chuỗi
    $url = trim($url, "-");

    // Chuyển đổi chuỗi thành chữ thường
    $url = strtolower($url);

    // Loại bỏ các ký tự không phải chữ cái, số, gạch ngang, hoặc gạch dưới
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}




function get_category($id){

	$query = "select category from categories where id = :id limit 1";
	$row = db_query_one($query, ['id'=>$id]);

	if(!empty($row['category'])){
		return$row['category'];
	}
	return "Unknown";

}


function esc($str){
	return nl2br(htmlspecialchars($str));
}


function get_artist($id){

	$query = "select name from artists where id = :id limit 1";
	$row = db_query_one($query, ['id'=>$id]);

	if(!empty($row['name'])){
		return$row['name'];
	}
	return "Unknown";

}

function get_area($id){

	$query = "select area from areas where id = :id limit 1";
	$row = db_query_one($query, ['id'=>$id]);

	if(!empty($row['area'])){
		return$row['area'];
	}
	return "Unknown";

}
