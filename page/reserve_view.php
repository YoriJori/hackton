<?php 
	lv_chk(1, $use_lv);
	// $a_da = farray("select * from admin where no='$no'");

	$r_da = farray("select * from reserve where no='$no'");
	$m_da = farray("select * from member where id='$r_da->id'");


?>






		<!-- 콘텐츠 -->
		<section class="con-sub w-100" id="reserveBox">
			<div class="wrap col-480-12">
				<div class="titleBox w-100">
					<div class="itemBox w-100 d-flex fz24 font-weight-bold mb-0">
						예약 상세보기
					</div>
					<div class="itemBox w-100 d-flex justify-content-end fz16 ">
						<a href="#" title="link">홈</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">예약 상세보기</a>
					</div>
					<img src="/images/patt2.png" alt="title" title="title" class="w-100">
				</div>
				<div class="conBox w-100 d-flex justify-content-center">
			

					<div class="menu-con w-100 d-flex fl-cc" id="p">
						<div class="w-100 h-100 d-flex fl-cc">
							<label for="pop_close" class="poa closeBtn t0 l0 w-100 h-100"></label>
							<div class="itemBox por w-100">
								<div class="item p-4 w-100">
									<div class="picBox w-100 h-100 d-flex fl-cc">
										<div class="pic w-100 d-flex fl-cc font-weight-bold fz30 bg0 fc1 text-center">
											예약 상세보기
										</div>
									</div>
									<div class="cont p-4 d-flex fl-cc w-100">
										

										
										<table class="table board">
											<thead class="border-top-0">
												<tr class="col-12 d-flex justify-content-center bg-light">
													<th class="col-3 d-flex fl-cc border-bottom-0">예약날짜</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">예약시간</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">작가이름</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">예약상태</th>
												</tr>
											</thead>
											<tbody class="border-top-0">
												<tr class="col-12 d-flex justify-content-center">
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $r_da->r_date ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $r_da->r_time ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $r_da->writer ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $r_da->state ?></td>
												</tr>
											</tbody>
											<thead class="border-top-0">
												<tr class="col-12 d-flex justify-content-center bg-light">
													<th class="col-3 d-flex fl-cc border-bottom-0">회원이름</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">회원나이</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">회원성별</th>
													<th class="col-3 d-flex fl-cc border-bottom-0">학생구분</th>
												</tr>
											</thead>
											<tbody class="border-top-0">
												<tr class="col-12 d-flex justify-content-center">
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $m_da->name ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $m_da->age ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $m_da->sex ?></td>
													<td class="col-3 d-flex fl-cc border-bottom-0"><?php echo $m_da->school ?></td>
												</tr>
											</tbody>
											<thead class="border-top-0">
												<tr class="col-12 d-flex justify-content-center bg-light">
													<th class="col-3 d-flex fl-cc border-bottom-0">작가에게 바라는 점</th>
													<th class="col-3 d-flex fl-cc border-bottom-0"></th>
													<th class="col-3 d-flex fl-cc border-bottom-0"></th>
													<th class="col-3 d-flex fl-cc border-bottom-0"></th>
												</tr>
											</thead>
											<tbody class="border-top-0">
												<tr class="col-12 d-flex justify-content-center"  style="min-height: 300px;">
													<td class="col-1"></td>
													<td class="col-11 d-flex p-5 border-bottom-0"><?php echo $r_da->content ?></td>
												</tr>
											</tbody>
										</table>






										<button class="bg0 fc1 p-2 fz14 m-1" type="button" onclick="location.href='<?php echo PAGE."manage/" ?>'">목록보기</button>





								

									</div>
								</div>
							</div>
							
						</div>
					</div>







				</div>
			</div>
		</section>

	