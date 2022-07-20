<?php 

$mode = $mode ? $mode : $action;

switch ($mode) {
	//로그인
	case 'login':
		$da = farray("select * from member where id='$id' and password=password('$ps1')");
		$msg = "";

		if(empty($id)) {
			$msg .= "[입력누락] 아이디를 입력해주세요.\\n";
		}
		if(empty($ps1)) {
			$msg .= "[입력누락] 비밀번호를 입력해주세요.\\n";
		} else {
			if(!is_object($da)) {
				$msg .= "[불일치] 아이디와 비밀번호가 일치하지 않습니다.\\n";
			}
		}

		if(empty($msg)) {
			$_SESSION['id'] = $da->id;
			$_SESSION['name'] = $da->name;
			$_SESSION['lv'] = $da->lv;

			alert("{$da->name}님 환영합니다.", $url);
		} else {
			alert($msg);
		}

	break;
	//로그아웃
	case 'logout':
		session_destroy();
		alert('로그아웃 되었습니다.', $url);
	break;
	//회원가입
	case 'join':
		$da = farray("select * from member where id='$id' and password=password('$ps1')");
		$da2 = farray("select * from member where id='$id'");
		$msg = "";

		if(empty($id)) {
			$msg .= "[입력누락] 아이디를 입력해주세요.\\n";
		} else {
			if(!filter_var($id, FILTER_VALIDATE_EMAIL)) {
				$msg .= "[형식오류] 아이디는 이메일형식으로 입력해주세요.\\n";
			} else if(is_object($da2)) {
				$msg .= "[중복] 이미 존재하는 아이디입니다.\\n";
			}
		}


		if(empty($name)) {
			$msg .= "[입력누락] 이름을 입력해주세요.\\n";
		} else {
			if(!mb_ereg("^([가-힣]{1,})$", $name)) {
				$msg .= "[형식오류] 이름은 한글로 입력해주세요.\\n";
			}
		}

		if(empty($ps1)) {
			$msg .= "[입력누락] 비밀번호를 입력해주세요.\\n";
		} else {
			$len = mb_strlen($ps1);
			if($len < 4) {
				$msg .= "[형식오류] 비밀번호는 4자이상 입력해주세요.\\n";
			}
		}
		if(empty($ps2)) {
			$msg .= "[입력누락] 비밀번호확인을 입력해주세요.\\n";
		} else {
			if($ps1 != $ps2) {
				$msg .= "[불일치] 비밀번호와 비밀번호확인이 일치하지 않습니다.\\n";
			} 
		}
		if(empty($cap)) {
			$msg .= "[입력누락] 캡챠코드를 입력해주세요.\\n";
		} else {
			if($cap != $_SESSION['cap']) {
				$msg .= "[불일치] 캡챠코드가 일치하지 않습니다.\\n";
			}
		}

		if(empty($msg)) {
			sql("INSERT INTO `member` (`no`, `id`, `password`, `name`, `lv`, `date`) 
								VALUES (NULL, '$id', password('$ps1'), '$name', 3, now());");
			alert("회원가입 되었습니다.", $url);
		} else {
			alert($msg);
		}

	break;


// user
	// 맛집삭제
	case 'admin_del' :
		sql("DELETE FROM `admin` WHERE `admin`.`no` = $no");
		alert('삭제되었습니다.', PAGE."manage/");
	break;
	// 맛집 추가
	case 'admin_write' :
		$da = farray("select * from admin where no='$no' order by no desc");
		$msg .= "";

		if(empty($book)) {
			$msg = "누락 항목이 있습니다.";
		}
		if(empty($writer)) {
			$msg = "누락 항목이 있습니다.";
		}
		
		if(empty($_FILES['mfile']['name'])) {
			$msg = "누락 항목이 있습니다.";
		}
			// $m_da = farray("select * from member where name='$name'");

			$dayNo 	= explode("@@", $day)[0];
			$day 	= explode("@@", $day)[1];

		if(empty($msg)) {

			$img = $da->img;
			if($_FILES['mfile']['name']) {
				$img = $_FILES['mfile']['name'];
				move_uploaded_file($_FILES['mfile']['tmp_name'], "./upload/".$img);
			}

			$sql = sql("INSERT INTO `admin` (`no`, `book`, `img`, `addContent`) 
								VALUES (NULL, '$book',  '$img', '');");

			alert("맛집추가가 완료되었습니다.", PAGE."manage");
		} else {
			alert($msg);
		}

	break;

	// 맛집 수정
	case 'admin_modify' :
		$da = farray("select * from admin where no='$no' order by no desc");
		$msg .= "";

		if(empty($book)) {
			$msg = "누락 항목이 있습니다.";
		}
		if(empty($writer)) {
			$msg = "누락 항목이 있습니다.";
		}

			$dayNo 	= explode("@@", $day)[0];
			$day 	= explode("@@", $day)[1];

		if(empty($msg)) {

			$img = $da->img;
			if($_FILES['mfile']['name']) {
				$img = $_FILES['mfile']['name'];
				move_uploaded_file($_FILES['mfile']['tmp_name'], "./upload/".$img);
			}

			$sql = sql("INSERT INTO `admin` (`no`, `book`,`img`, `addContent`) 
								VALUES (NULL, '$book', '$writer', '$img', '');");

			alert("맛집수정이 완료되었습니다.", PAGE."manage");
		} else {
			alert($msg);
		}

	break;






}








?>