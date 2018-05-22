$(document).ready(function() {
	$('.active').click(function(event) {
		var active=0;
		var id=$(this).val();
		if($(this).prop("checked") == true){
                active=1;
        }
		$.ajax({
			url: '/admin/users/ajax.php',
			type: 'POST',
			data: {
				act:active,
				aid:id,
			},
			success: function(value){
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
	});
	jQuery.validator.setDefaults({
	  success: "valid",
	  ignore: [],
	  debug: false,
	});

	$(".form-adduser").validate({
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
				required: "Vui lòng xác nhân mật khẩu đăng nhập !",
				equalTo: "Mật khẩu xác nhận ko đúng !",
			},
			"email": {
				required: "Vui lòng nhập email !",
				email: "Vui lòng nhập đúng email !",
			},
		},
	}); 
	 
	$(".form-addtin").validate({
		rules:{
			"name": {
				required:true,
			},
			"category_id": {
				required:true,
			},
			"salary": {
				required:true,
				number:true,
			},
			"location": {
				required:true,
			},
			"description": {
				required:true,
			},
			"phone":{
				required:true,
				number:true,
			},
		},
		messages:{
			"name": {
				required:"Vui lòng nhập tên tin rao bán!",
			},
			"category_id": {
				required:"Vui lòng chọn danh mục !",
			},
			"salary": {
				required:"Vui lòng nhập giá !",
				number:"Vui lòng nhập đúng định dạng" ,
			},
			"location": {
				required:"Vui lòng nhập nơi bán !",
			},
			"description": {
				required:"Vui lòng nhập mô tả !",
			},
			"phone":{
				required:"Vui lòng nhập số điện thoại !",
				number:"Vui lòng nhập đúng định dạng số !",
			}
		},
	}); 

	$(".form-addQc").validate({
		rules:{
			"company": {
				required:true,
			},
			"link": {
				required:true,
			},
			"picture": {
				required:true,
			},
		},
		messages:{
			"company": {
				required:"Vui lòng nhập tên công ty!",
			},
			"link": {
				required:"Vui lòng nhập link Website của công ty !",
			},
			"picture": {
				required:"Bạn chưa chọn ảnh quảng cáo !",
			},
		},
	}); 

	$(".form-editQc").validate({
		rules:{
			"company": {
				required:true,
			},
			"link": {
				required:true,
			},
		},
		messages:{
			"company": {
				required:"Vui lòng nhập tên công ty!",
			},
			"link": {
				required:"Vui lòng nhập link Website của công ty !",
			},
		},
	});

	$(".form-editCate").validate({
		rules:{
			"tendanhmuc": {
				required:true,
			},
		},
		messages:{
			"tendanhmuc":{
				required:"Vui lòng nhập tên danh mục",
			},
		}
	});

	$('.alert-message').delay(3000).hide('300');
	
	$('#logout-btn').click(function () {
		$('#logout-form').submit();

		return false;
	});
});
