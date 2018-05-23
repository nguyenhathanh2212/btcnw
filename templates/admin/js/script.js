$(document).ready(function() {
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

	$('.checkbox-delete-all').on('click', function () {
    	var check = $(this).prop('checked');

		$('.checkbox-delete').each(function () {
			$(this).prop('checked', check ? 'checked' : '');
		});
    });

    $('.checkbox-delete').on('click', function () {
		var checks = [];

		$('.checkbox-delete').each(function () {
			if ($(this).prop('checked')) {
				checks.push(1);
			}
		});

		if (checks.length == 0 || checks.length != $('.checkbox-delete').length) {
			$('.checkbox-delete-all').prop('checked', '');
		} else if (checks.length == $('.checkbox-delete').length) {
			$('.checkbox-delete-all').prop('checked', 'checked');
		}
    });

    // news
    $('#delete-all-news').on('click', function () {
    	var newsId = [];

    	$('.checkbox-delete').each(function () {
			if ($(this).prop('checked')) {
				newsId.push(parseInt($(this).attr('val')));
			}
		});

		if (!newsId.length) {
			alert('Bạn chưa chọn dòng để xóa!')
			return false;
		}

		if (!confirm('Bạn có chắc chắn muốn xóa tin tức đã chọn và toàn bộ thông tin trong đó?')) {
    		return false;
    	}

		$.ajax({
        	url: '/admin/news/delete-all.php',
        	method: 'POST',
        	data: {
        		newsId: newsId
        	}, 
        	success: function (data) {}
        });
    });

    $('#search-news').on('keyup', function () {
        var data = $(this).val();

        $.ajax({
        	url: '/admin/news/search.php',
        	method: 'POST',
        	data: {
        		searchData: data
        	}, 
        	success: function (data) {
        		$('#show-news').html(data);
        	}
        });
    });

    // advertisement
    $('#delete-all-advertisements').on('click', function () {
    	var advertisementsId = [];

    	$('.checkbox-delete').each(function () {
			if ($(this).prop('checked')) {
				advertisementsId.push(parseInt($(this).attr('val')));
			}
		});

		if (!advertisementsId.length) {
			alert('Bạn chưa chọn dòng để xóa!')
			return false;
		}

		if (!confirm('Bạn có chắc chắn muốn xóa quảng cáo đã chọn ?')) {
    		return false;
    	}

		$.ajax({
        	url: '/admin/advertisement/delete-all.php',
        	method: 'POST',
        	data: {
        		advertisementsId: advertisementsId
        	}, 
        	success: function (data) {}
        });
    });

    $('#search-advertisements').on('keyup', function () {
        var data = $(this).val();

        $.ajax({
        	url: '/admin/advertisement/search.php',
        	method: 'POST',
        	data: {
        		searchData: data
        	}, 
        	success: function (data) {
        		$('#show-advertisements').html(data);
        	}
        });
    });

    // users
    $('#delete-all-users').on('click', function () {
    	var usersId = [];

    	$('.checkbox-delete').each(function () {
			if ($(this).prop('checked')) {
				usersId.push(parseInt($(this).attr('val')));
			}
		});

		if (!usersId.length) {
			alert('Bạn chưa chọn dòng để xóa!')
			return false;
		}

		if (!confirm('Bạn có chắc chắn muốn tất cả người dùng đã chọn ?')) {
    		return false;
    	}

		$.ajax({
        	url: '/admin/users/delete-all.php',
        	method: 'POST',
        	data: {
        		usersId: usersId
        	}, 
        	success: function (data) {}
        });
    });

    $('#search-users').on('keyup', function () {
        var data = $(this).val();

        $.ajax({
        	url: '/admin/users/search.php',
        	method: 'POST',
        	data: {
        		searchData: data
        	}, 
        	success: function (data) {
        		$('#show-users').html(data);
        	}
        });
    });
});
