<?php 
$DB = new PDO("mysql:host=localhost; dbname=book", "root", "", [
\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
\PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8"
]);

header("Content-type:text/html; charset=utf-8");
session_start();

date_default_timezone_set("Asia/Seoul");

$url = "http://".$_SERVER['HTTP_HOST'];
$vars = explode("/", isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL);
$pagemode = isset($vars[0]) ? $vars[1] : NULL;
$midx = isset($vars[2]) ? $vars[2] : NULL;
$action = isset($vars[3]) ? $vars[3] : NULL;
$page = isset($vars[4]) ? $vars[4] : NULL;
$no = isset($vars[5]) ? $vars[5] : NULL;
$search = isset($vars[6]) ? $vars[6] : NULL;

$addr = [
	"login"=>["root"=>"login", "root_lv"=>0],
	"join"=>["root"=>"join", "root_lv"=>0],
	"foodtrip_inside"=>["root"=>"foodtrip_inside", "root_lv"=>0],
	"daegu"=>["root"=>"daegu", "root_lv"=>0],
	"ga"=>["root"=>"ga", "root_lv"=>0],
	"bus"=>["root"=>"bus", "root_lv"=>0],
	"cheng"=>["root"=>"cheng", "root_lv"=>0],
	"daejeon"=>["root"=>"daejeon", "root_lv"=>0],
	"hoeng"=>["root"=>"hoeng", "root_lv"=>0],
	"jeju"=>["root"=>"jeju", "root_lv"=>0],
	"jeon"=>["root"=>"jeon", "root_lv"=>0],
	"suwon"=>["root"=>"suwon", "root_lv"=>0],
	"ulsan"=>["root"=>"ulsan", "root_lv"=>0],
	"seoul"=>["root"=>"seoul", "root_lv"=>0],

	"reserve"=>["root"=>"reserve", "root_lv"=>0],
	"foodtrip_out"=>["root"=>"foodtrip_out", "root_lv"=>0],
	"admin"=>["root"=>"admin", "root_lv"=>0],
];

if(@is_array($addr[$midx])) {
	$root = $addr[$midx]['root'];
	$root_lv = $addr[$midx]['root_lv'];
} else {
	$root = "";
	$root_lv = "";
}

extract($_GET);
extract($_POST);

define("PAGE", "/page/{$midx}/");
define("ACTION", "/action/{$midx}/");

$current = $pagemode ? "sub" : "main";


function sql($sql, $array=null) {
	global $DB;
	$data = $DB->prepare($sql);
	$data->execute($array);
	return $data;
}
function farray($sql, $array=null) {
	$data = sql($sql);
	return $data->fetch();
}
function nrows($sql, $array=null) {
	$data = sql($sql);
	return $data->rowCount();
}
function alert($msg, $url=false) {
	echo "<script>";
	echo $msg ? "alert('$msg');" : "";
	echo $url ? "location.replace('$url');" : "history.back();";
	echo "</script>";
}
function lv_chk($root_lv, $use_lv) {
	global $url;
	switch ($root_lv) {
		case '1':
			if($use_lv < 1) alert('로그인 후 사용가능합니다.', $url);
		break;
		case '2':
			if($use_lv != 1) alert('관리자만 사용가능합니다.', $url);
		break;
	}
}


if(@$pagemode == "action") {
	if(file_exists("./page/{$root}_{$action}.php")) {
		@include "./page/{$root}_{$action}.php";
	} else {
		@include "./lib/action.php";
	}
	exit;
}

if(@isset($_SESSION['id'])) {
	$use_id = $_SESSION['id'];
	$use_name = $_SESSION['name'];
	$use_lv = $_SESSION['lv'];
} else {
	$use_id = "";
	$use_name = "";
	$use_lv = "";
}

lv_chk($root_lv, $use_lv);






?>