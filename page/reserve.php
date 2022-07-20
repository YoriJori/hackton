<?php 
	lv_chk(1, $use_lv);
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

	// // 
	// $(document).on('click', '#reserve_pop .okBtn', function() {
	// 	$('#reserve_pop .okBtn').hide();
	// 	$('#reserve_pop .resetBtn').show();
	// 	$('#reserve_pop .mainBtn').show();
	// })
	// // 
	// $(document).on('click', '#reserve_pop .resetBtn, #reserve_pop .mainBtn', function() {
	// 	$('#reserve_pop .okBtn').show();
	// 	$('#reserve_pop .resetBtn').hide();
	// 	$('#reserve_pop .mainBtn').hide();
	// })

	// 폼 정보변경시, 요소위치값
	$(document).on('change', '#reserveBox .formChk', function() {
		var idx = $('#reserveBox .formChk').index(this);
		formChk(idx);
	});

	// 예약날짜 뿌리기
	// date_ajax();
})

	//예약날짜
	// function date_ajax() {
	// 	$.ajax({
	// 		url: '/action/admin/admin_date/',
	// 		type: 'POST',
	// 		data: {
	// 			//date: $('#date').val(),
	// 		},
	// 		success : function(e) {
	// 			var data = JSON.parse(e);

	// 			var arr = [];
	// 			data.items.filter(function(e,i) {
	// 				arr.push( e.dayNo );
	// 			})

	// 			$('#date').datepicker('option', 'beforeShowDay', function(date) {
	// 				var day = $.datepicker.formatDate('D', date);

	// 				if( $.inArray(day, arr) != -1 ) {
	// 					return [true, 'reserveDay', '예약가능 날짜'];
	// 				} else {
	// 					return [false, '', ''];
	// 				}

	// 			})

	// 		}
	// 	})
	// } 

	//작가정보
	function name_ajax() {
		$.ajax({
			url: '/action/admin/admin_name/',
			type: 'POST',
			data: {
				date: $('#date').val(),
			},
			success : function(e) {
				var data = JSON.parse(e);
				
				$('#writer').empty();
				var obj = $(`<option value="">작가를 선택해주세요.</option>`);
				$('#writer').append(obj);

				data.items.filter(function(e,i) {
					var obj = $(`<option value="${e.writer}@@${e.no}">${e.writer}</option>`);
					$('#writer').append(obj);
				})
				console.log(data);


			}
		})
	} 

	//예약 시간정보
	function time_ajax() {
		$.ajax({
			url: '/action/admin/admin_time/',
			type: 'POST',
			data: {
				no: $('#writer').val().split("@@")[1],
			},
			success : function(e) { 
				var data = JSON.parse(e); 
				
				$('#time').empty();
				var obj = $(`<option value="">시간을 선택해주세요.</option>`);
				$('#time').append(obj);

				data.items.filter(function(e,i) {
					var time = count_output(e.stime)+":"+count_output(e.sMinute);
					var obj = $(`<option value="${time}">${time}</option>`);
					$('#time').append(obj);
				})


			}
		})
	} 

	function count_output(option) {
		var option = Number(option);
		if(option < 10) {
			option = "0"+option;
		} else {
			option = option;
		}
		return option;
	}

	

	

	// 폼 순차적 실행
	function formChk(idx) {
		// $('#reserveBox .formChk').eq(1).prop('disabled', true);
		// $('#reserveBox .formChk').eq(2).prop('disabled', true);

		switch(idx) {
			case 0 : 
				// $('#reserveBox .formChk').eq(1).prop('disabled', false);
				name_ajax();
			break;
			case 1 : 
				// $('#reserveBox .formChk').eq(1).prop('disabled', false);
				// $('#reserveBox .formChk').eq(2).prop('disabled', false);
				time_ajax();
			break;
			case 2 : 
				// $('#reserveBox .formChk').eq(1).prop('disabled', false);
				// $('#reserveBox .formChk').eq(2).prop('disabled', false);
			break;
		}
	}



	// //예약뿌리기 
	// function reserve_form() { 
	// 	var len = $('#reserveBox .formChk').filter(function(e,i) {
	// 		var val = $(this).val() ? $(this).val() : $(this).text();
	// 		$('#reserve_pop .formChk').eq(i).val( val );
	// 		return val == "";
	// 	});


	// 	if(len.length > 0 ) {
	// 		alert('모든 입력요소를 입력해주세요.');
	// 		return false;
	// 	}

	// 	$('#reserve_pop .name').val( $('#reserveBox .name').val().split("@@")[1] );
	// 	$('#reserve_pop').show();
	// } 



</script>






		<!-- 콘텐츠 -->
		<section class="con-sub w-100" id="reserveBox">
			<div class="wrap col-480-12">
				<div class="titleBox w-100">
					<div class="itemBox w-100 d-flex fz24 font-weight-bold mb-0">
						예약하기
					</div>
					<div class="itemBox w-100 d-flex justify-content-end fz16 ">
						<a href="#" title="link">홈</a>
						<span>&nbsp;/&nbsp;</span>
						<a href="#" title="link">예약하기</a>
					</div>
					<img src="/images/patt2.png" alt="title" title="title" class="w-100">
				</div>
				<div class="conBox w-100 d-flex justify-content-center">
			

					<div class="menu-con w-100 d-flex fl-cc" id="p">
						<div class="w-100 h-100 d-flex fl-cc">
							<label for="pop_close" class="poa closeBtn t0 l0 w-100 h-100"></label>
							<div class="itemBox por w-50">
								<div class="item p-4 w-100">
									<div class="picBox w-100 h-100 d-flex fl-cc">
										<div class="pic w-100 d-flex fl-cc font-weight-bold fz30 bg0 fc1 text-center">
											예약하기
										</div>
									</div>
									<div class="cont p-4 d-flex fl-cc w-100">
										
										<form enctype="multipart/form-data" method="post" action="<?php echo ACTION ?>" class="w-100" novalidate>
											<input type="hidden" name="mode" value="reserve_write">
											<input type="hidden" name="no" value="<?php echo $no ?>" class="no">
											<div class="form-row col-12 por mt-4">
												<div class="form-group col-12 por d-flex fl-cc ">
													<input type="text" name="date" id="date" class="form-control formChk date" required>
													<label for="date" class="poa t0 l0" >날짜</label>
													<div class="meter"></div>
												</div>
											</div>	
											<div class="form-row col-12 por mt-5">
												<div class="form-group col-12 por d-flex fl-cc was-validated">
													<label for="writer" class="poa t0 l0 font-weight-bold" style="top: -30px;">작가</label>
													<select name="writer" class="custom-select formChk writer" id="writer" required >
												      <option value="">작가를 선택해주세요.</option>
												      <option value="작가@@12">작가</option>
												    </select>
												    <div class="invalid-feedback">작가를 선택해주세요</div>
												</div>
											</div>	
											<div class="form-row col-12 por mt-5">
												<div class="form-group col-12 por d-flex fl-cc was-validated">
													<label for="time" class="poa t0 l0 font-weight-bold" style="top: -30px;">만남가능시간</label>
													<select name="time" class="custom-select formChk time" id="time" required >
												      <option value="">만남가능시간을 선택해주세요.</option>
												      <option value="00:00">00:00</option>
												    </select>
												    <div class="invalid-feedback">만남가능시간을 선택해주세요</div>
												</div>
											</div>	
											<div class="hide_form mt-5">
												<div class="form-row col-12 por mt-4 d-flex">
													<div class="form-group col-3 por d-flex fl-cc ">
														<input type="text" name="name" id="name" class="form-control formChk name" required readonly value="<?php echo $m_da->name ?>">
														<label for="name" class="poa t0 l0 font-weight-bold"  style="top: -30px;">회원 이름</label>
														<div class="meter"></div>
													</div>
													<div class="form-group col-3 por d-flex fl-cc ">
														<input type="text" name="sex" id="sex" class="form-control formChk sex" required readonly value="<?php echo $m_da->sex ?>">
														<label for="sex" class="poa t0 l0 font-weight-bold"  style="top: -30px;">회원 성별</label>
														<div class="meter"></div>
													</div>
													<div class="form-group col-3 por d-flex fl-cc ">
														<input type="number" name="age" id="age" class="form-control formChk age" required readonly value="<?php echo $m_da->age ?>">
														<label for="age" class="poa t0 l0 font-weight-bold"  style="top: -30px;">회원 나이</label>
														<div class="meter"></div>
													</div>
													<div class="form-group col-3 por d-flex fl-cc ">
														<input type="text" name="school" id="school" class="form-control formChk school" required readonly value="<?php echo $m_da->school ?>">
														<label for="school" class="poa t0 l0 font-weight-bold"  style="top: -30px;">학생구분</label>
														<div class="meter"></div>
													</div>
												</div>	

												<div class="form-group col-12 por d-flex fl-cc mt-4">
													<div class="form-row col-12 por mt-4 d-flex was-validated">
														<textarea  name="content" id="content" class="form-control formChk content" required></textarea>
														<label for="content" class="poa t0 l0 font-weight-bold"  style="top: -30px;">작가에게 바라는 점</label>
														<div class="meter"></div>
													</div>
												</div>
											</div>	

											<div class="form-row col-12 por mt-4">
												<div class="form-group w-100 por d-flex fl-cc ">
													<button class="bg0 col-4 p-2 ml-1 fc1 at_sc12 okBtn" type="submit">예약신청</button>
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

	