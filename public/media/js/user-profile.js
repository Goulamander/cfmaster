 $('#user-profileForm').on('submit', function(e){
    e.preventDefault();
    $.ajax({
       url:'/user/updateProfile',
       method:'post',
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
       data:new FormData(this),
       processData:false,
       dataType:'json',
       contentType:false,
       beforeSend:function(){
        $(document).find('span.error-text').text('');
       },
       success:function(data){
            if (data.status == 200) {
				toastr.success(data.message);
			} else {
                $.each(data.error, function(prefix ,val){
                    $('span.' +prefix+ '_error').text(val[0]);
                });
			}
        },error: function () {
			toastr.error("Request Failed, Please Try Again.");
		}


    });

 });
 $(document).on('click','#change_imageBttn',function(){

    $('#user_img').click();
});
$('#user_img').ijaboCropTool({
    preview : '.user_img',
    setRatio:1,
    allowedExtensions: ['jpg', 'jpeg','png'],
    buttonsText:['CROP','QUIT'],
    buttonsColor:['#30bf7d','#ee5155', -15],
    processUrl:'/user/change_photo',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    // withCSRF:['_token','{{ csrf_token() }}'],
    onSuccess:function(message, element, status){
        toastr.success(message);
    },
    onError:function(message, element, status){
        toastr.error(message);
    }
 });


$('#change_password').on('submit',function(e){
    e.preventDefault();
    url='/user/change_password';
    $.ajax({
        url:url,
        type:'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:new FormData(this),
        dataType:'json',
        processData:false,
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success:function(data){
            if (data.status == 200) {
                toastr.success(data.message);
                 $('#current_pass').val("");
                 $('#new_pass').val("");
                 $('#confirm_pass').val("")

			} else {
                $.each(data.error, function(prefix ,val){
                    $('span.' +prefix+ '_error').text(val[0]);
                });
			}
        },error: function () {
			toastr.error("Request Failed, Please Try Again.");
		}
    });
});
function deleteProfile(id){
    swal({
		title: "Are you sure?",
		text: "Once deleted, you will not be able to recover your Account!",
		icon: "warning",
		buttons: {
			defeat: "Delete",
			cancel: "Not Now"
		},
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				recordAccountDelete(id)
			} else {
				swal("Your imaginary file is safe!", {
					icon: "warning",
				});
			}
		});
}
function recordAccountDelete(id) {
	console.log(id);
	$.ajax({
		url: '/user/deleteAccount/' + id,
		type: 'get',
		dataType: 'json',
		success: function (data) {
            toastr.success(data.message);
            window.location.href = "/";

		},
		error: function () {
			alert("Failed! Please try again.");
		}
	});
}
