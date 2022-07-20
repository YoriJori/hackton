<?php 
  @include "../lib/lib.php";
  if(!isset($s_type)) {
     $s_type = "작가";
     $s_val = "";
  }
  if($s_type == "작가"){ 
     $te = " and writer like('%{$s_val}%') ";
  }else if($s_type == "예약자") {
     $te = " and name like('%{$s_val}%') ";
  // } else {
  //    $te = " and name like('%{$s_val}%') or writer like('%{$s_val}%')  ";
  }


    // [img2]
    // 학년별 예약현황, 해당 작가에 예약된 학년별 갯수를 구한다.
    $sql = sql("select * from reserve where no>0 {$te} order by no desc");
    $arr1 = [];
    $arr2 = [];
    foreach ($sql as $key => $value) {
       @$arr1[$value->school] += 1;
    }
    $arr2 = ['초등학생', '중학생', '고등학생'];
    $gragh = join("@@", $arr1)."||".join("@@", $arr2);

    

    $arr = explode("||", $gragh);

    $num = explode("@@", $arr[0]);
    $str = explode("@@", $arr[1]);
    $sum = array_sum($num);
    $max = max($num);

    $image      = imagecreatetruecolor(400, 400);
    $white      = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, 400, 400, $white);

    $font = "C:/Windows/Fonts/malgun.ttf"; 

    $start = 0;
    $count = 0;

    foreach ($num as $key => $da) {
       $x1   = 20;
       $x2   = 40;
       $y1   = ($count*30) + 40;
       $y2   = ($count*30) + 60;

       $end = $start + ($da * 360 / $sum);

       if ($da!=0) {
          $color[]  = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
          // imagefilledarc($image, 250, 200, 200, 200, $start, $end, $color[$count], IMG_ARC_PIE);

          imagefilledrectangle($image, $x1, $y1, $x2, $y2, $color[$count]);
          imagettftext($image, 10, 0, 50, ($count*30) + 55, $color[$count], $font, $str[$key]);
          imagettftext($image, 10, 0, 100, ($count*30) + 55, $color[$count], $font, $da);
          $count++; 
       }
       
       $start = $end;
    }

    $start   = 700;
    $count   = 0;
    foreach ($num as $key => $da) {

       $x1   = ($count*50) + $start;
       $x2   = $x1 + 20;
       $y1   = 300;
       $y2   = $y1 - ($da * 240 / $max);

       if ($da!=0) { 
         
          imagefilledrectangle($image, $x1, $y1, $x2, $y2, $color[$count]);
          imagettftext($image, 10, 0, $x1-20, 320, $color[$count], $font, $str[$key]);
          imagettftext($image, 10, 0, $x1+20, 320, $color[$count], $font, $da);
          $start += 10;
          $count++;      
       }


    }

    header('Content-type: image/png');
    $degrees = 90;
    $rotate = imagerotate($image, $degrees, 0);
    imagepng($rotate);


    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);






?>