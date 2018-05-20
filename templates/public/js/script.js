$(document).ready(function() {
	new WOW().init();
	$('.bxslider').bxSlider({
		auto: true,
	  	autoControls: true,
	  	stopAutoOnClick: true,
	  	pager: true,
	  	speed: 2000,
	});
	$('.bxslider2').bxSlider({
		auto: true,
	  	autoControls: true,
	  	stopAutoOnClick: true,
	  	pager: true,
	  	speed: 3000,
        pause: 6000,
        mode: 'vertical',
	});
	$(".form-cmt").validate({
		rules:{
			"hoten": {
				required: true,
			},
			"email": {
				required: true,
				email: true,
			},
			"content": {
				required: true,
			},
		},
		messages:{
			"hoten": {
				required: "Vui lòng nhập tên !",
			},
			"email": {
				required: "Vui lòng nhập email !",
				rangelength: "Nhập đúng định dạng email",
			},
			"content": {
				required: "Vui lòng nhập noi dung !",
			},
		},
	});
	$('.sub').click(function(event) {
		var id=$(this).parent('form').attr('id');
		var content=$(this).parent('form').children('.content-cmt').val();
		var email=$(this).parent('form').children('.infor-cmt').children('div').children('#email-sub').val();
		var hoten=$(this).parent('form').children('.infor-cmt').children('div').children('#hoten-sub').val();
		if(hoten!=''&&email!=''&&content!=''){
			$.ajax({
				url: '/ajaxcmt.php',
				type: 'POST',
				data: {
					aid:id,
					acontent:content,
					ahoten:hoten,
					aemail:email,
				},
				success: function(value){
					$(".ul-list-cmt").prepend(value);
				},
				error: function (){
					alert('Có lỗi xảy ra');
				}
			});
		}else{
			alert("Điền đủ thông tin bình luận ");
		}
		
		return false;
	});
	$('.main-content .answer-question-content ul li a').click(function() {
		var show = $(this).next();
		if($(show).is(':visible')){
			$(show).slideToggle();
		}
		else {
			$('.main-content .answer-question-content ul li p:visible').slideToggle();
			$(show).slideToggle();	
		}

		return false;
	});
	jQuery.validator.setDefaults({
	  success: "valid",
	  ignore: [],
	  debug: false,
	});
	$(".form-addtin").validate({
		rules:{
			"ten": {
				required:true,
			},
			"danhmuc": {
				required:true,
			},
			"gia": {
				required:true,
				number:true,
			},
			"noiban": {
				required:true,
			},
			"mota": {
				required:true,
			},
			"sodienthoai":{
				required:true,
				number:true,
			},
		},
		messages:{
			"ten": {
				required:"Vui lòng nhập tên tin rao bán!",
			},
			"danhmuc": {
				required:"Vui lòng chọn danh mục !",
			},
			"gia": {
				required:"Vui lòng nhập giá !",
				number:"Vui lòng nhập đúng định dạng" ,
			},
			"noiban": {
				required:"Vui lòng nhập nơi bán !",
			},
			"mota": {
				required:"Vui lòng nhập mô tả !",
			},
			"sodienthoai":{
				required:"Vui lòng nhập số điện thoại !",
				number:"Vui lòng nhập đúng định dạng số !",
			}
		},
	});
	$(".form-login").validate({
		rules:{
			"username": {
				required: true,
				rangelength: [4, 32],
			},
			"password": {
				required: true,
				minlength: 6,
			},
		},
		messages:{
			"username": {
				required: "Vui lòng nhập tên đăng nhập !",
				rangelength: "Nhập trong phạm vi 4 - 32 kí tự",
			},
			"password": {
				required: "Vui lòng nhập mật khẩu đăng nhập !",
				rangelength: "Mật khẩu phải trên 6 kí tự !",
			},
		},
	});
	$(".form-create").validate({
		rules:{
			"username": {
				required: true,
				rangelength: [4, 32],
			},
			"password": {
				required: true,
				minlength: 6,
			},
			"repassword": {
				required: true,
				equalTo: "#password",
			},
			"email": {
				required: true,
				email: true,
			},
		},
		messages:{
			"username": {
				required: "Vui lòng nhập tên đăng nhập !",
				rangelength: "Nhập trong phạm vi 4 - 32 kí tự",
			},
			"password": {
				required: "Vui lòng nhập mật khẩu đăng nhập !",
				rangelength: "Mật khẩu phải trên 6 kí tự !",
			},
			"repassword": {
				required: "Vui lòng nhập lại mật khẩu đăng nhập !",
				equalTo: "Mật khẩu xác nhận ko đúng !",
			},
			"email": {
				required: "Vui lòng nhập email !",
				email: "Vui lòng nhập đúng email !",
			},
		},
	});

	$('.alert-message').delay(3000).hide('300');
	
	$('#logout-btn').click(function () {
		$('#logout-form').submit();

		return false;
	});
});	