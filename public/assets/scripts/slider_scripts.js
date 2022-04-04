function AddNewPhoto() {
	$("#SliderPhotoUpload").modal('show');
}

function SliderSubmit() {
	var form = $('#slider_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/content/ajax/slider/upload",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
        	if(data['status'] == true) {
                if(data['errors'] == true) {
                	$(".check-input").removeClass('border-danger'); 
                    $.each(data['message'], function(key, value) {
                    	$("#"+key).addClass('border-danger');
                        NioApp.Toast(value, 'error');
                    });
                } else {
                    Swal.fire({
                      icon: 'success',
                      text: data['message'],
                    })
                    location.reload();
                }   
            }
        }
    });
}

function ViewSliderPhoto(slider_id) {
	$('#slider_form')[0].reset();

	$.ajax({
        dataType: 'json',
        url: "/content/ajax/slider/view",
        type: "GET",
        data: {
            slider_id: slider_id,
        },
        success: function(data) {
            if(data['status'] == true) {
            	$("#slider_photo").val(data['SliderPhoto']['path']);
            	$("#slider_small_text_ge").val(JSON.parse(data['SliderPhoto']['text'])['small_text_ge']);
            	$("#slider_small_text_en").val(JSON.parse(data['SliderPhoto']['text'])['small_text_en']);
            	$("#slider_big_text_ge").val(JSON.parse(data['SliderPhoto']['text'])['big_text_ge']);
            	$("#slider_big_text_en").val(JSON.parse(data['SliderPhoto']['text'])['big_text_en']);
            	$("#slider_url").val(data['SliderPhoto']['url']);
            	$("#slider_id").val(data['SliderPhoto']['id']);
                $("#SliderPhotoUpload").modal('show');
            }
        }
    });
}

function DeleteSliderPhoto(slider_id) {
	Swal.fire({
        title: "ნამდვილად გსურთ სურათის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/content/ajax/slider/delete",
                type: "POST",
                data: {
                    slider_id: slider_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                      icon: 'success',
                      text: data['message'],
                    })
                    location.reload();
                }
            });
        }
    });
}