<?php 
	@include "./lib/lib.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <title>요리조리</title>
   <link rel="stylesheet" href="/js/jquery-ui-1.12.1/jquery-ui.min.css">
   <link rel="stylesheet" href="/css/bootstrap.css">
   <link rel="stylesheet" href="/css/style.css">
   <script src="/js/jquery-3.5.1.js"></script>
   <script src="/js/jquery-ui-1.12.1/jquery-ui.js"></script>
   <script src="/js/bootstrap.bundle.js"></script>
   <script src="/js/App.js"></script>
</head>
<body>
   
   <input type="radio" name="pop" id="pop_close">


   <!-- 스크린 -->
   <div class="screen">
      <!-- 헤더 -->
      <header class="w-100 d-flex justify-content-center text-center">
         <div class="logo poa">
            <a href="/" title="logo" class="at_sc12"><img class="main_logo_img" src="/images/madeimg/logo.svg" alt="logo" title="logo"></a>
         </div>
         <input type="radio" name="nav" id="nav_open">
         <input type="radio" name="nav" id="nav_close" checked="">
         <nav class="nav_1 col-12 d-flex justify-content-between align-items-center">
            <ul class=" col-4 col-480-12 d-flex justify-content-end align-items-center">
               <li class="col-2 d-flex justify-content-center align-items-center por">
                  <a href="#" title="link" class="por d-flex fl-cc">
                     <span>　</span>
                  </a>
                  <ul class="w-100 poa">
                     <li class="w-100"><a href="#" title="link">　</a></li>
                  </ul>
               </li>
               <li class="col-2 d-flex justify-content-center align-items-center por">
                  <a href="#" title="link" class="por d-flex fl-cc">
                     <span>　</span>
                  </a>
                  <ul class="w-100 poa">
                     <li class="w-100"><a href="#" title="link">　</a></li>
                  </ul>
               </li>
            </ul>
            
         </nav>

         <nav class="nav_2 col-12 d-flex justify-content-between align-items-center">
            <ul class="headerclass col-12 gnb d-flex align-items-center ul-center">
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="/page/foodtrip_out" title="해외음식" class="por d-flex fl-cc font-weight-bolder ">
                     <span>해외음식</span>
                     <svg class="poa"><rect class="w-100 h-100" width="0" height="0"></rect></svg>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="/page/foodtrip_inside" title="국내음식" class="por d-flex fl-cc font-weight-bolder ">
                     <span>국내음식</span>
                     <svg class="poa"><rect class="w-100 h-100" width="0" height="0"></rect></svg>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="/page/admin" title="음식 추천" class="por d-flex fl-cc font-weight-bolder ">
                     <span>음식 추천</span>
                     <svg class="poa"><rect class="w-100 h-100" width="0" height="0"></rect></svg>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="관리자페이지" class="por d-flex fl-cc font-weight-bolder ">
                     <span>관리자페이지</span>
                     <svg class="poa"><rect class="w-100 h-100" width="0" height="0"></rect></svg>
                  </a>
               </li>
			   <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="사용자" class="por d-flex fl-cc font-weight-bolder ">
                     <span>
					 <?php if(!$use_id) { ?>
						사용자
						<?php } else{?>
							<?php echo($use_name) ?>
							<?php }?>
					</span>
                     <svg class="poa"><rect class="w-100 h-100" width="0" height="0"></rect></svg>
                  </a>
                  <ul class="w-100 poa fz14">
                     <li class="w-100 d-flex justify-content-center">
                        <?php if(!$use_id) { ?>
                        <a href="/page/login/" title="로그인_회원가입">로그인</a>
                        <?php } else { ?>
                        <a href="/action/logout/logout/" title="로그인">로그아웃</a>
                        <?php } ?>
                     </li>

                  </ul>
               </li>
            </ul>
         </nav>
      </header>



      <?php
         if($current == "main") {
            @include "./page/main.php";
         } else {
            if($action) {
               if(file_exists("./page/{$root}_{$action}.php")) {
                  @include "./page/{$root}_{$action}.php";
               } else {
                  if(file_exists("./page/{$root}.php")) {
                     @include "./page/{$root}.php";
                  } else {
                     echo "공사중입니다.";
                  }
               }
            } else {
               if(file_exists("./page/{$root}.php")) {
                  @include "./page/{$root}.php";
               } else {
                  echo "공사중입니다.";
               }
            }
         }
      ?>


      <!-- 푸터 -->
      <footer class="w-100 por text-center fc1 d-flex justify-content-center">
         <div class="logo poa hv_sc12 ">
            <div>
               <a href="#" title="logo" class="at_sc12"><img src="/images/madeimg/logo.svg" alt="logo" title="logo"></a>
            </div>
         </div>
         
         <nav class="nav_2 col-12 d-flex justify-content-between align-items-center" style="margin-top: 200px;">
            <ul class="col-12 gnb d-flex justify-content-center align-items-center por">
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="해외음식" class="por d-flex fl-cc font-weight-bolder ">
                     <span>해외음식</span>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="국내음식" class="por d-flex fl-cc font-weight-bolder ">
                     <span>국내음식</span>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="음식 추천" class="por d-flex fl-cc font-weight-bolder ">
                     <span>음식 추천</span>
                  </a>
               </li>
               <li class=" d-flex justify-content-center align-items-center por">
                  <a href="#" title="관리자페이지" class="por d-flex fl-cc font-weight-bolder ">
                     <span>관리자페이지</span>
                  </a>
               </li>
            </ul>
         </nav>

         <ul class="iconBox por  d-flex" style="margin-top: 120px;">
            <li class="por d-flex fl-cc">
               <a href="#" title="icon" class="por d-flex fl-cc w-100 h-100 ">
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
               </a>
            </li>
            <li class="por d-flex fl-cc">
               <a href="#" title="icon" class="por d-flex fl-cc w-100 h-100 ">
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
               </a>
            </li>
            <li class="por d-flex fl-cc">
               <a href="#" title="icon" class="por d-flex fl-cc w-100 h-100 ">
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
                  <div class="poa w-100 h-100 t0 l0 fz30 font-weight-bold"></div>
               </a>
            </li>
         </ul>


         <div class="txt w-100 d-flex fl-cc" style="margin-top: 50px;">
            (대구소프트웨어고등학교)<br>
            Copyright 2022 해외음식. All rights reserved.
         </div>
         

      </footer>


	</div>



</body>
</html>