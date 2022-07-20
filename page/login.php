


		<!-- 콘텐츠 -->
		<section class="con-sub w-100" id="joinBox">
			<div class="wrap col-480-12">
				
				<div class="conBox w-100 d-flex justify-content-center">
			

					<div class="menu-con w-100 d-flex fl-cc" id="joinBox">
						<div class="w-100 h-100 d-flex fl-cc">
							<label for="pop_close" class="poa closeBtn t0 l0 w-100 h-100"></label>
							<div class="itemBox por w-50">
								<div class="item p-4 w-100">
									<div class="picBox w-100 h-100 d-flex fl-cc">
										<div class=" pic w-100 d-flex fl-cc font-weight-bold fz30 bg7 fc1 text-center">
											로그인
										</div>
									</div>
									<div class="cont p-4 d-flex fl-cc w-100">
										
										<form enctype="multipart/form-data" method="post" action="<?php echo ACTION ?>" class="w-100" novalidate>
											<input type="hidden" name="mode" value="login">
											<input type="hidden" name="no" value="" class="no">
											<div class="form-row col-12 por mt-4">
												<div class="form-group col-12 por d-flex fl-cc ">
													<input type="text" name="id" id="id" class="form-control formChk id" required>
													<label for="id" class="poa t0 l0"  style="margin-top: -10px;">아이디</label>
													<div class="meter"></div>
												</div>
											</div>	
											<div class="form-row col-12 por mt-4">
												<div class="form-group col-12 por d-flex fl-cc ">
													<input type="password" name="ps1" id="ps1" class="form-control formChk ps1" required>
													<label for="ps1" class="poa t0 l0" style="margin-top: -10px;" >비밀번호</label>
													<div class="meter"></div>
												</div>
											</div>	
											<div class="form-row col-12 por mt-4">
												<div class="form-group w-100 por d-flex fl-cc ">
													<button class="bg7 col-4 p-2 ml-1 fc1 at_sc12 okBtn" type="submit">로그인</button>
													<button class="bg7 col-4 p-2 ml-1 fc1 at_sc12 okBtn" type="button" onclick="location.href='/page/join/'">회원가입</button>
												</div>
											</div>
											
										</form>

									</div>
								</div>
							</div>
							
						</div>
					</div>







				</div>
			</div>
		</section>

	