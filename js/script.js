
$(function() {
	$('#date').datepicker({
		minDate : 1,
		defaultDate : 'yy-mm-dd',
	})

	// 
	$(document).on('click', '#reserve_pop .okBtn', function() {
		$('#reserve_pop .okBtn').hide();
		$('#reserve_pop .resetBtn').show();
		$('#reserve_pop .mainBtn').show();
	})
	// 
	$(document).on('click', '#reserve_pop .resetBtn, #reserve_pop .mainBtn', function() {
		$('#reserve_pop .okBtn').show();
		$('#reserve_pop .resetBtn').hide();
		$('#reserve_pop .mainBtn').hide();
	})

	// 폼 정보변경시, 요소위치값
	$(document).on('change', '#reserveBox .formChk', function() {
		var idx = $('#reserveBox .formChk').index(this);
		formChk(idx);
	});

});

	

	// 폼 순차적 실행
	function formChk() {
		var idx = $('#reserveBox .formChk').index(this);
		$('#reserveBox .formChk').eq(1).prop('disabled', true);
		$('#reserveBox .formChk').eq(2).prop('disabled', true);

		switch(idx) {
			case 0 : 
				$('#reserveBox .formChk').eq(1).prop('disabled', false);
				name_ajax();
			break;
			case 1 : 
				$('#reserveBox .formChk').eq(1).prop('disabled', false);
				$('#reserveBox .formChk').eq(2).prop('disabled', false);
				time_ajax();
			break;
			case 2 : 
				$('#reserveBox .formChk').eq(1).prop('disabled', false);
				$('#reserveBox .formChk').eq(2).prop('disabled', false);
			break;
		}
	}




