<?php 
	lv_chk(2, $use_lv);
	$r_da = farray("select * from reserve where no='$no'");
	$m_da = farray("select * from member where id='$r_da->id'");

	$m_da = farray("select * from member where id='$use_id'");

?>

<script>
	
$(function() {
	$('#date').datepicker({
		// minDate : 1,
		dateFormat : 'yy-mm-dd',
	})

	// 폼 정보변경시, 요소위치값
	$(document).on('click', '.searchBtn', function() {
		search();
	});

})


	

	
</script>

		<!-- 콘텐츠 -->
		<section class="con-sub w-100" id="reserveBox">
			<div class="wrap col-480-12">
				<div class="titleBox w-100">
					<div class="itemBox w-100 d-flex fz24 font-weight-bold mb-0">
						사용자페이지
					</div>
					<div class="itemBox w-100 d-flex justify-content-end fz16 ">
						<a href="#" title="link">홈</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">사용자페이지</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">맛집등록</a>
					</div>
				</div>
				<div class="conBox w-100 d-flex justify-content-center">
			
					<div class="w-100 d-flex justify-content-end" style="height: 50px;">
						<button class="bg3 fc1 p-2 fz14 m-1 at_sc12" type="button" onclick="location.href='<?php echo PAGE."write" ?>'">행사 추가</button>
					</div>

					<div class="menu-con w-100 d-flex fl-cc" id="p" style="margin-top: 100px;">
						<div class="w-100 h-100 d-flex fl-cc">
							<div class="itemBox por w-100">ㄴ
								<div class="item p-4 w-100">
									<div class="picBox w-100 h-100 d-flex fl-cc">
										<div class="pic w-100 d-flex fl-cc font-weight-bold fz30 bg0 fc1 text-center">
											맛집등록
										</div>
									</div>
									<div class="cont p-4 d-flex fl-cc w-100">



										
										<table class="table board">
											<thead class="border-top-0">
												<tr class="col-12 d-flex justify-content-center bg-light">
													<th class="col-1 d-flex fl-cc border-bottom-0 fz14">순번</th>
													<th class="col-1 d-flex fl-cc border-bottom-0 fz14">음식, 관광지 사진</th>
													<th class="col-3 d-flex fl-cc border-bottom-0 fz14">title</th>
													<th class="col-1 d-flex fl-cc border-bottom-0 fz14">수정/삭제</th>
												</tr>
											</thead>
											<?php 
											$sql = sql("select * from admin where no>0 order by no desc");
											$num = 1;
											foreach ($sql as $key => $da) {
											?>
											<tbody class="border-top-0">
												<tr class="col-12 d-flex justify-content-center">
													<td class="col-1 d-flex fl-cc border-bottom-0 fz14"><?php echo $num ?></td>
													<td class="col-1 d-flex fl-cc border-bottom-0 fz14">
														<img src="/upload/<?php echo $da->img ?>" alt="img" style="width: 50px; height: 50px;" class="hv_sc15">
													</td>
													<td class="col-3 d-flex fl-cc border-bottom-0 fz14"><?php echo $da->book ?></td>
													<td class="col-1 d-flex fl-cc border-bottom-0 fz14">
														<button class="bg0 fc1 p-1 fz14 m-1" type="button" onclick="location.href='<?php echo PAGE."modify/0/$da->no" ?>'">수정</button>
														<button class="bg1 fc1 p-1 fz14 m-1" type="button" onclick="if(confirm('삭제하시겠습니까?')) location.href='<?php echo ACTION."admin_del/0/$da->no" ?>'">삭제</button>
													</td>
												</tr>
											</tbody>
											<?php 
												$num++;
											}
											 ?>
										</table>


									</div>
								</div>
							</div>
							
						</div>
					</div>




				</div>
			</div>
		</section>

	