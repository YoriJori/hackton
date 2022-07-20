<?php 
	lv_chk(0, $use_lv);
	$r_da = farray("select * from reserve where no='$no'");
	$m_da = farray("select * from member where id='$r_da->id'");


	$a_da = farray("select * from admin where no='$no'");

	$day[$a_da->day] = "selected";
?>

<script>

</script>
		<!-- 콘텐츠 -->
		<section class="con-sub w-100" id="reserveBox">
			<div class="wrap col-480-12">
				<div class="titleBox w-100">
					<div class="itemBox w-100 d-flex fz24 font-weight-bold mb-0">
						사용자 페이지
					</div>
					<div class="itemBox w-100 d-flex justify-content-end fz16 ">
						<a href="#" title="link">홈</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">사용자 페이지</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">맛집수정</a>
					</div>
				</div>
				<div class="conBox w-100 d-flex justify-content-center">
			

					<div class="menu-con w-100 d-flex fl-cc" id="p">
						<div class="w-100 h-100 d-flex fl-cc">
							<label for="pop_close" class="poa closeBtn t0 l0 w-100 h-100"></label>
							<div class="itemBox por w-50">
								<div class="item p-4 w-100">
									<div class="picBox w-100 h-100 d-flex fl-cc">
										<div class="pic w-100 d-flex fl-cc font-weight-bold fz30 bg0 fc1 text-center">
											맛집수정
										</div>
									</div>
									<div class="cont p-4 d-flex fl-cc w-100">
										
										<form enctype="multipart/form-data" method="post" action="<?php echo ACTION ?>" class="w-100" novalidate>
											<input type="hidden" name="mode" value="admin_modify">
											<input type="hidden" name="no" value="<?php echo $no ?>" class="no">
											<div class="form-row col-12 por mt-4">
												<div class="form-group col-12 por d-flex fl-cc  was-validated">
													<input type="text" name="book" id="book" class="form-control formChk bookbook" required value="<?php echo $a_da->book ?>">
													<label for="book" class="poa t0 l0" >title</label>
													<div class="meter"></div>
													<div class="invalid-feedback">title을 입력해주세요</div>
												</div>
											</div>	
											<div class="form-row col-12 por mt-5">
												<div class="form-group col-12 por d-flex fl-cc  was-validated">
													<input type="file" name="mfile" id="mfile" class="form-control formChk mfile" required >
													<label for="mfile" class="poa t0 l0 font-weight-bold"  style="top: -30px;">사진</label>
													<div class="meter"></div>
													<div class="invalid-feedback">기존 파일 : <?php echo $a_da->img ?></div>
												</div>
											</div>

											<div class="form-row col-12 por mt-4">
												<div class="form-group w-100 por d-flex fl-cc ">
													<button class="bg0 col-4 p-2 ml-1 fc1 at_sc12 okBtn" type="submit">맛집수정</button>
													<button class="bg4 col-4 p-2 ml-1 fc1 at_sc12 okBtn" type="button" onclick="location.href='<?php echo PAGE."manage/" ?>'">목록보기</button>
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