function UserRoleAdd() {
	$(".role-modal-title").html('ახალი წვდომის ჯგუფი');
	$("#role_modal").modal('show');
}

function UserRoleSubmit() {
	var form = $('#role_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/users/ajax/role/submit",
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
                    $(".role-input").removeClass('border-danger');
                    $(".error-text").html('');
                    $.each(data['message'], function(key, value) {
                        $('#'+key).addClass('border-danger');
                        $('.error-'+key).html(value);
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        text: data['message'],
                        timer: 2000,
                    });
                    location.reload()
                }
            } else {
                Swal.fire({
                  icon: 'error',
                  text: data['message'],
                })
            }
        }
    });
}

function UserRoleActiveChange(role_id, elem) {
	if($(elem).is(":checked")) {
        role_active = 1;
    } else {
        role_active = 0
    }

	$.ajax({
        dataType: 'json',
        url: "/users/ajax/role/active",
        type: "POST",
        data: {
        	role_id: role_id,
        	role_active: role_active,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            return;
        }
    });
}

function UserRoleDelete(role_id) {
	Swal.fire({
        title: "ნამდვილად გსურთ ჯგუფის წაშლა?",
        text: "მომხმარებლები რომელებთაც ააქვთ მინიჭებული აღნიშნული ჯგუფი, ავტომატურად გადავლენ ჯგუფ მოხმარებლებში !!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/users/ajax/role/delete",
                type: "POST",
                data: {
                    role_id: role_id,
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

function UserRoleEdit(role_id) {
    $.ajax({
        dataType: 'json',
        url: "/users/ajax/role/edit",
        type: "GET",
        data: {
            role_id: role_id,
        },
        success: function(data) {
            if(data['status'] == true) {
             	$('#role_form').trigger("reset");
                $.each(data['UserRoleData'], function(key, value){
                    $("#role_"+key).val(value);
                    $(".role-modal-title").html('წვდომის ჯგუფის რედაქტირება');
                    $("#role_modal").modal('show');
                });
            }
        }
    });
}

function UserRolePermissions(role_id) {
	$.ajax({
        dataType: 'json',
        url: "/users/ajax/role/permission",
        type: "GET",
        data: {
            role_id: role_id,
        },
        success: function(data) {
            if(data['status'] == true) {
                $(".permission-list").html('');
                if(Object.keys(data['PermissionGroupArray']).length > 0) {
                	view = ``;
	                $.each(data['PermissionGroupArray']['group_data'], function(key, value){
	                    view += `
	                    <div class="col-lg-3 col-sm-12 mb-3">
	                        <div class="font-neue">`+value['group_name']+`</div>
	                        <div class="row">
	                        `;
	                        $.each(value['permissions']['list'], function(permission_key, permission_value){
	                            view += `
	                            <div class="col-lg-12 permission-item-`+permission_value['id']+`">
	                                <div class="float-left">
	                                <div class="custom-control custom-control-sm custom-checkbox">
	                                    <input type="checkbox" class="custom-control-input" name="permissions[]" id="permission_`+permission_value['id']+`" value="`+permission_value['id']+`">
	                                    <label class="custom-control-label font-neue" for="permission_`+permission_value['id']+`">`+permission_value['title']+`</label>
	                                </div>
	                                </div>
	                                <div class="float-right">
	                                	<span onclick="UserRolePermissionDelete(`+permission_value['id']+`, `+role_id+`)"><em class="icon ni ni-delete-fill" style="font-size: 24px; color: #e36262; cursor: pointer"></em></span>
	                                </div>
	                            </div>
	                            `;
	                        });
	                    view += `</div></div>`;
	                });
	                $(".permission-list").append(view);
	                $.each(data['PermissionGroupArray']['group_data'], function(key, value){
	                    $.each(value['permissions']['list'], function(permission_key, permission_value){
	                        $.each(value['permissions']['selected'], function(selected_key, selected_value){
	                            if(permission_value['id'] == selected_value['permission_id']) {
	                                $("#permission_"+selected_value['permission_id']).prop('checked', true);
	                            }
	                        });
	                    });
	                });
	                $(".permission-submit-button").css('display', 'block');
                } else {
                	$(".permission-list").html(`
                		<div class="col-12 mb-3">
	                		<div class="alert alert-fill alert-warning alert-icon font-helvetica-regular">
	                            <em class="icon ni ni-alert-circle"></em> აღნიშნულ ჯგუფს არააქვს უფლებები
	                        </div>
                        </div>
            		`);
                	$(".permission-submit-button").css('display', 'none');
                }
                $("#permission_role").val(role_id);
                $("#permission_role_id").val(role_id);
                $("#permission_modal").modal('show');
            }
        }
    });
}

function AddPermissionSubmit() {
	var form = $('#permission_add_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/users/ajax/role/permission/submit",
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
            		$(".permission-input").removeClass('border-danger');
                    $(".error-text").html('');
                    $.each(data['message'], function(key, value) {
                        $('#'+key).addClass('border-danger');
                        $('.error-'+key).html(value);
                    })
            	} else {
            		$(".permission-list").html('');
        			view = ``;
	                $.each(data['PermissionGroupArray']['group_data'], function(key, value){
	                    view += `
	                    <div class="col-lg-3 col-sm-12 mb-3">
	                        <div class="font-neue">`+value['group_name']+`</div>
	                        <div class="row">
	                        `;
	                        $.each(value['permissions']['list'], function(permission_key, permission_value){
	                            view += `
	                            <div class="col-lg-12 permission-item-`+permission_value['id']+`">
	                                <div class="float-left">
	                                <div class="custom-control custom-control-sm custom-checkbox">
	                                    <input type="checkbox" class="custom-control-input" name="permissions[]" id="permission_`+permission_value['id']+`" value="`+permission_value['id']+`">
	                                    <label class="custom-control-label font-neue" for="permission_`+permission_value['id']+`">`+permission_value['title']+`</label>
	                                </div>
	                                </div>
	                                <div class="float-right">
	                                	<span onclick="UserRolePermissionDelete(`+permission_value['id']+`, `+$("#permission_role_id").val()+`)"><em class="icon ni ni-delete-fill" style="font-size: 24px; color: #e36262; cursor: pointer"></em></span>
	                                </div>
	                            </div>
	                            `;
	                        });
	                    view += `</div></div>`;
	                });
	                $(".permission-list").append(view);
	                $.each(data['PermissionGroupArray']['group_data'], function(key, value){
	                    $.each(value['permissions']['list'], function(permission_key, permission_value){
	                        $.each(value['permissions']['selected'], function(selected_key, selected_value){
	                            if(permission_value['id'] == selected_value['permission_id']) {
	                                $("#permission_"+selected_value['permission_id']).prop('checked', true);
	                            }
	                        });
	                    });
	                });
	                $(".permission-submit-button").css('display', 'block');
            	}
            }
        }
    });
}

function SyncPermissionSubmit() {
	var form = $('#permission_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/users/ajax/role/permission/sync",
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
                Swal.fire({
                    icon: 'success',
                    text: data['message'],
                    timer: 1500,
                    timerProgressBar: true,
                })
                $("#PermissionModal").modal('hide');
            } else {
                Swal.fire({
                  icon: 'error',
                  text: data['message'],
                })
            }
        }
    });
}

function UserRolePermissionDelete(permission_id, role_id) {
	Swal.fire({
        title: "ნამდვილად გსურთ უფლების წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/users/ajax/role/permission/delete",
                type: "POST",
                data: {
                    permission_id: permission_id,
                    role_id: role_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                      	icon: 'success',
                      	text: data['message'],
                      	timer: 1500,
                		timerProgressBar: true,
                    })
                    $(".permission-item-"+permission_id).remove();
                }
            });
        }
    });
}