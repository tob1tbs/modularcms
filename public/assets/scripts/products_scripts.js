function CategoryModal() {
	$('#category_form')[0].reset();
	$(".category-modal-head").html('პროდუქტის კატეგორიის დამატება');
	$("#CategoryModal").modal('show');
}

function CategoryFormSubmit() {
	var form = $('#category_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/categories/submit",
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
		            $(".text-error").html('');
		         	$.each(data['message'], function(key, value) {
			            $("#"+key).addClass('border-danger');
			            $("."+key+"-error").html(value);
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

$("#parent_sortable").sortable({
    items: "> div:not(:first)",
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/products/ajax/categories/sortable",
        });
    }
});

function CategoryActiveChange(category_id, elem) {
    if($(elem).is(":checked")) {
        category_active = 1;
    } else {
        category_active = 2
    }

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/categories/active",
        type: "POST",
        data: {
            category_id: category_id,
            category_active: category_active,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            return;
        }
    });
}

function CategoryDelete(category_id) {
    Swal.fire({
        title: "ნამდვილად გსურთ მომხმარებლის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/categories/delete",
                type: "POST",
                data: {
                    category_id: category_id,
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

function CategoryEdit(category_id) {
	$(".category-modal-head").html('პროდუქტის კატეგორიის რედაქტირება');
	$.ajax({
        dataType: 'json',
        url: "/products/ajax/categories/edit",
        type: "GET",
        data: {
            category_id: category_id,
        },
        success: function(data) {
            if(data['status'] == true) {
        		$('#category_form')[0].reset();
	            $("#category_name_ge").val(JSON.parse(data['ProductCategoryData']['name'])['ge']);
	            $("#category_name_en").val(JSON.parse(data['ProductCategoryData']['name'])['en']);
	            $("#category_id").val(data['ProductCategoryData']['id']);
		        $("#CategoryModal").modal('show');
            }
        }
    });
}

function ChildCategoriesList(category_id) {
    var form = $('#child_category_add')[0].reset();
    var data = new FormData(form);

	$.ajax({
        dataType: 'json',
        url: "/products/ajax/categories/child",
        type: "GET",
        data: {
            category_id: category_id,
        },
        success: function(data) {
            if(data['status'] == true) {
            	$(".child-category-list").html('');
            	$.each(data['ProductChildCategoryList'], function(key, value) {
                    if(value['active'] == 1) {
                        var checked = 'checked';                            
                    } else {
                        var checked = '';
                    }

	            	$(".child-category-list").append(`
	            		<tr id="child_category_item-`+value['id']+`">
					      	<th>`+value['id']+`</th>
                            <th class="text-center">`+value['sortable']+`</th>
					      	<td>`+JSON.parse(value['name'])['ge']+`</td>
                            <td>`+JSON.parse(value['name'])['en']+`</td>
					      	<td>
						      	<div class="custom-control custom-switch">
	                                <input type="checkbox" class="custom-control-input" id="child_category_`+value['id']+`" onclick="CategoryActiveChange(`+value['id']+`, this)" `+checked+`>
	                                <label class="custom-control-label" for="child_category_`+value['id']+`"></label>
	                            </div>
					      	</td>
					      	<td>
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                <em class="icon ni ni-more-h"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                <ul class="link-list-opt no-bdr">
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="javascript:;" onclick="CategoryEdit({{ $category_item->id }})">
                                                            <em class="icon ni ni-dot"></em>
                                                            <span>რედაქტირება</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" onclick="ChildCategoryDelete(`+value['id']+`)" class="text-danger">
                                                            <em class="icon ni ni-trash"></em>
                                                            <span>ქვეკატეგორიის წაშლა</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
					    </tr>
	        		`);
        		});
                $("#child_category_parent_id").val(category_id);
        		$("#ChildCategoryModal").modal('show');
            }
        }
    });
}

function ChildCategoryAdd() {
    var form = $('#child_category_add')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/categories/child/submit",
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
                $(".check-input").removeClass('border-danger'); 
                $(".text-error").html('');
                if(data['errors'] == true) {
                    $.each(data['message'], function(key, value) {
                        $("#"+key).addClass('border-danger');
                        $("."+key+"-error").html(value);
                    });
                } else {
                    $(".child-category-list").html('');
                    var form = $('#child_category_add')[0].reset();
                    $.each(data['ProductChildCategoryList'], function(key, value) {

                        if(value['active'] == 1) {
                            var checked = 'checked';                            
                        } else {
                            var checked = '';
                        }

                        $(".child-category-list").append(`
                            <tr id="child_category_item-`+value['id']+`">
                                <th>`+value['id']+`</th>
                                <th class="text-center">`+value['sortable']+`</th>
                                <td>`+JSON.parse(value['name'])['ge']+`</td>
                                <td>`+JSON.parse(value['name'])['en']+`</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="child_category_`+value['id']+`" onclick="CategoryActiveChange(`+value['id']+`, this)" `+checked+`>
                                        <label class="custom-control-label" for="child_category_`+value['id']+`"></label>
                                    </div>
                                </td>
                                <td>
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="javascript:;" onclick="CategoryEdit({{ $category_item->id }})">
                                                                <em class="icon ni ni-dot"></em>
                                                                <span>რედაქტირება</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" onclick="ChildCategoryDelete(`+value['id']+`)" class="text-danger">
                                                                <em class="icon ni ni-trash"></em>
                                                                <span>ქვეკატეგორიის წაშლა</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `);
                    });
                }
            }
        }
    });
}

function ChildCategoryDelete(child_category_id) {
	Swal.fire({
        title: "ნამდვილად გსურთ მომხმარებლის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/categories/child/delete",
                type: "POST",
                data: {
                    child_category_id: child_category_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $(".child-category-list").html('');
                    var form = $('#child_category_add')[0].reset();
                    $.each(data['ProductChildCategoryList'], function(key, value) {

                        if(value['active'] == 1) {
                            var checked = 'checked';                            
                        } else {
                            var checked = '';
                        }

                        $(".child-category-list").append(`
                            <tr id="child_category_item-`+value['id']+`">
                                <th>`+value['id']+`</th>
                                <th class="text-center">`+value['sortable']+`</th>
                                <td>`+JSON.parse(value['name'])['ge']+`</td>
                            	<td>`+JSON.parse(value['name'])['en']+`</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="child_category_`+value['id']+`" onclick="CategoryActiveChange(`+value['id']+`, this)" `+checked+`>
                                        <label class="custom-control-label" for="child_category_`+value['id']+`"></label>
                                    </div>
                                </td>
                                <td>
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="javascript:;" onclick="CategoryEdit({{ $category_item->id }})">
                                                                <em class="icon ni ni-dot"></em>
                                                                <span>რედაქტირება</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" onclick="ChildCategoryDelete(`+value['id']+`)" class="text-danger">
                                                                <em class="icon ni ni-trash"></em>
                                                                <span>კატეგორიის წაშლა</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }
    });
}

$("#child_sortable").sortable({
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/products/ajax/categories/child/sortable",
        });
    }
});

// BRANDS
function BrandModal() {
    $(".brand-modal-head").html('პროდუქტის ბრენდის დამატება');
    $('#brand_form')[0].reset();
    $("#BrandModal").modal('show');
}

function BrandFormSubmit() {
    var form = $('#brand_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/brands/submit",
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
                    $(".text-error").html('');
                    $.each(data['message'], function(key, value) {
                        $("#"+key).addClass('border-danger');
                        $("."+key+"-error").html(value);
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

function GetSubCategoryList(field_name, append_field_name) {
    $.ajax({
        dataType: 'json',
       	url: "/products/ajax/get/subcategories",
        type: "GET",
        data: {
            category_id: $("#"+field_name).val(),
        },
        success: function(data) {
            if(data['status'] == true) {
                $("#"+append_field_name).html('');
                if(data['ProductChildCategoryList'].length > 0) {
                	html = '<option value="0"></option>';
                    $.each(data['ProductChildCategoryList'], function(key, value) {
                        html += `<option value="`+value['id']+`">`+JSON.parse(value['name'])['ge']+`</option>`;
                    });
                    $("#"+append_field_name).append(html);
                    $("#"+append_field_name).removeAttr('disabled');
                } else {
                    $("#"+append_field_name).attr('disabled', 'true');
                }
            }
        }
    });
}

function GetSubCategoryAndBrandList() {
    $.ajax({
        dataType: 'json',
        url: "/products/ajax/get/subcategoriesbrands",
        type: "GET",
        data: {
            category_id: $("#product_category").val(),
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['ProductBrandList'].length > 0) {
                    $("#product_brand").html('');
                    brand_html = '<option value="0"></option>';
                    $.each(data['ProductBrandList'], function(key, value) {
                        brand_html += `<option value="`+value['id']+`">`+JSON.parse(value['name'])['ge']+`</option>`;
                    });
                    $("#product_brand").append(brand_html);
                    $("#product_brand").removeAttr('disabled');
                } else {
                    $("#product_brand").attr('disabled', 'true');
                }

                if(data['ProductChildCategoryList'].length > 0) {
                    $("#product_child_category").html('');
                    category_html = '<option value="0"></option>';
                    $.each(data['ProductChildCategoryList'], function(key, value) {
                        category_html += `<option value="`+value['id']+`">`+JSON.parse(value['name'])['ge']+`</option>`;
                    });
                    $("#product_child_category").append(category_html);
                    $("#product_child_category").removeAttr('disabled');
                } else {
                    $("#product_child_category").attr('disabled', 'true');
                }
            }
        }
    });
}

function GetBrandByChildCategory() {
    $.ajax({
        dataType: 'json',
        url: "/products/ajax/get/brandsbysubcategory",
        type: "GET",
        data: {
            child_category_id: $("#product_child_category").val(),
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['ProductBrandList'].length > 0) {
                    $("#product_brand").html('');
                    brand_html = '<option value="0"></option>';
                    $.each(data['ProductBrandList'], function(key, value) {
                        brand_html += `<option value="`+value['id']+`">`+JSON.parse(value['name'])['ge']+`</option>`;
                    });
                    $("#product_brand").append(brand_html);
                    $("#product_brand").removeAttr('disabled');
                } else {
                    $("#product_brand").attr('disabled', 'true');
                }
            }
        }
    });
}

function BrandActiveChange(brand_id, elem) {
    if($(elem).is(":checked")) {
        brand_active = 1;
    } else {
        brand_active = 2
    }

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/brands/active",
        type: "POST",
        data: {
            brand_id: brand_id,
            brand_active: brand_active,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            return;
        }
    });
}

function BrandDelete(brand_id) {
    Swal.fire({
        title: "ნამდვილად გსურთ ბრენდის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/brands/delete",
                type: "POST",
                data: {
                    brand_id: brand_id,
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

$("#brand_sortable").sortable({
    items: "> div:not(:first)",
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/products/ajax/brands/sortable",
        });
    }
});

function BrandEdit(brand_id) {
    $(".brand-modal-head").html('პროდუქტის ბრენდის რედაქტირება');
    $('#brand_form')[0].reset();

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/brands/edit",
        type: "GET",
        data: {
            brand_id: brand_id,
        },
        success: function(data) {
            if(data['status'] == true) {
                $("#brand_child_category_id").html('');
                $("#brand_id").val(data['ProductBrandData']['id']);
                $("#brand_name_ge").val(JSON.parse(data['ProductBrandData']['name'])['ge']);
                $("#brand_name_en").val(JSON.parse(data['ProductBrandData']['name'])['en']);
                if(data['ChildCategoryList'].length > 0) {
                    $.each(data['ChildCategoryList'], function(key, value) {
                        if(data['ProductBrandData']['child_category_id'] == value['id']) {
                            var Selected = 'selected';
                        } else {
                            var Selected = ' ';
                        }
                        $("#brand_child_category_id").append(`<option value="`+value['id']+`" `+Selected+`>`+JSON.parse(value['name'])['ge']+`</option>`);
                    });
                    $("#brand_child_category_id").removeAttr('disabled');
                } else {
                    $("#brand_child_category_id").attr('disabled', 'true');
                }
                $("#brand_category_id option[value='"+data['ProductBrandData']['category_id']+"']").attr("selected","selected");
                $("#BrandModal").modal('show');
            }
        }
    });
}

function OptionsModal() {
    $(".option-modal-head").html('პროდუქტის პარამეტრის დამატება');
    $("#OptionModal").modal('show');
}

function OptionSubmit() {
	var form = $('#option_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/submit",
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
                    $(".text-error").html('');
                    $.each(data['message'], function(key, value) {
                        $("#"+key).addClass('border-danger');
                        $("."+key+"-error").html(value);
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

function OptionActiveChange(option_id, elem) {
    if($(elem).is(":checked")) {
        option_active = 1;
    } else {
        option_active = 2
    }

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/active",
        type: "POST",
        data: {
            option_id: option_id,
            option_active: option_active,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            return;
        }
    });
}


function OptionDelete(option_id) {
    Swal.fire({
        title: "ნამდვილად გსურთ მომხმარებლის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/options/delete",
                type: "POST",
                data: {
                    option_id: option_id,
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

function OptionEdit(option_id) {
    $(".option-modal-head").html('პროდუქტის პარამეტრის რედაქტირება');
    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/edit",
        type: "GET",
        data: {
            option_id: option_id,
        },
        success: function(data) {
            if(data['status'] == true) {
                $('#option_form')[0].reset();
                $("#option_name_ge").val(JSON.parse(data['ProductOptionData']['name'])['ge']);
                $("#option_name_en").val(JSON.parse(data['ProductOptionData']['name'])['en']);
                if(data['ProductChildCategoryList'].length > 0) {
                    $.each(data['ProductChildCategoryList'], function(key, value) {
                        if(data['ProductOptionData']['child_category_id'] == value['id']) {
                            var Selected = 'selected';
                        } else {
                            var Selected = ' ';
                        }
                        $("#option_child_category").append(`<option value="`+value['id']+`" `+Selected+`>`+JSON.parse(value['name'])['ge']+`</option>`);
                    });
                    $("#option_child_category").removeAttr('disabled');
                } else {
                    $("#option_child_category").attr('disabled', 'true');
                }
                $("#option_category option[value='"+data['ProductOptionData']['category_id']+"']").attr("selected","selected");
                $("#option_type option[value='"+data['ProductOptionData']['type']+"']").attr("selected","selected");
                $("#option_key").val(data['ProductOptionData']['key']);
                $("#option_id").val(data['ProductOptionData']['id']);
                $("#OptionModal").modal('show');
            }
        }
    });
}

$("#option_sortable").sortable({
    items: "> div:not(:first)",
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/products/ajax/options/sortable",
        });
    }
});

function OptionValue(option_id) {
    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/value",
        type: "GET",
        data: {
            option_id: option_id,
        },
        success: function(data) {
            if(data['status'] == true) {
                $("#value_option_id").val(option_id);
                $("#option_value").html('');
                $.each(data['ProductOptionValueList'], function(key, value) {
                    if(value['active'] == 1) {
                        var checked = 'checked';                            
                    } else {
                        var checked = '';
                    }
                    $("#option_value").append(`
                        <tr id="option_value_item-`+value['id']+`">
                            <th>`+value['id']+`</th>
                            <th class="text-center">`+value['sortable']+`</th>
                            <th class="text-center">`+value['key']+`</th>
                            <td>
                                <div class="form-group">
                                    <label class="form-label d-none"></label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                        </div>
                                        <input type="text" class="form-control check-input" id="option_name_ge_`+value['id']+`" value="`+JSON.parse(value['name'])['ge']+`">
                                    </div>
                                    <small class="option_name_ge_`+value['id']+`-error text-error text-danger mt-1"></small>
                                </div>
                            </td>
                           <td>
                                <div class="form-group">
                                    <label class="form-label d-none"></label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                        </div>
                                        <input type="text" class="form-control check-input" id="option_name_en_`+value['id']+`" value="`+JSON.parse(value['name'])['en']+`">
                                    </div>
                                    <small class="option_name_en_`+value['id']+`-error text-error text-danger mt-1"></small>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="option_value_`+value['id']+`" onclick="OptionValueActiveChange(`+value['id']+`, this)" `+checked+`>
                                    <label class="custom-control-label" for="option_value_`+value['id']+`"></label>
                                </div>
                            </td>
                            <td>
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                <em class="icon ni ni-more-h"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="javascript:;" onclick="OptionValueEdit(`+value['id']+`)">
                                                            <em class="icon ni ni-dot"></em>
                                                            <span>რედაქტირება to do</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" onclick="OptionValueDelete(`+value['id']+`)" class="text-danger">
                                                            <em class="icon ni ni-trash"></em>
                                                            <span>მნიშვნელობის წაშლა</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    `);
                });
                $('#option_value_form')[0].reset();
                $("#OptionValueModal").modal('show');
            }
        }
    });
}

function OptionValueSubmit() {
    var form = $('#option_value_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/value/submit",
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
                    $(".text-error").html('');
                    $.each(data['message'], function(key, value) {
                        $("#"+key).addClass('border-danger');
                        $("."+key+"-error").html(value);
                    });
                } else {
                    $("#option_value").html('');
                    $.each(data['ProductOptionValueList'], function(key, value) {
                        if(value['active'] == 1) {
                            var checked = 'checked';                            
                        } else {
                            var checked = '';
                        }
                        $("#option_value").append(`
                           <tr id="option_value_item-`+value['id']+`">
                                <th>`+value['id']+`</th>
                                <th class="text-center">`+value['sortable']+`</th>
                                <th class="text-center">`+value['key']+`</th>
                                <td>
                                    <div class="form-group">
                                        <label class="form-label d-none"></label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                            </div>
                                            <input type="text" class="form-control check-input" id="option_name_ge_`+value['id']+`" value="`+JSON.parse(value['name'])['ge']+`">
                                        </div>
                                        <small class="option_name_ge_`+value['id']+`-error text-error text-danger mt-1"></small>
                                    </div>
                                </td>
                               <td>
                                    <div class="form-group">
                                        <label class="form-label d-none"></label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                            </div>
                                            <input type="text" class="form-control check-input" id="option_name_en_`+value['id']+`" value="`+JSON.parse(value['name'])['en']+`">
                                        </div>
                                        <small class="option_name_en_`+value['id']+`-error text-error text-danger mt-1"></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="option_value_`+value['id']+`" onclick="OptionValueActiveChange(`+value['id']+`, this)" `+checked+`>
                                        <label class="custom-control-label" for="option_value_`+value['id']+`"></label>
                                    </div>
                                </td>
                                <td>
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="javascript:;" onclick="OptionValueEdit(`+value['id']+`)">
                                                                <em class="icon ni ni-dot"></em>
                                                                <span>რედაქტირება to do</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" onclick="OptionValueDelete(`+value['id']+`)" class="text-danger">
                                                                <em class="icon ni ni-trash"></em>
                                                                <span>მნიშვნელობის წაშლა</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `);
                    });
                    $('#option_value_form')[0].reset();
                }
            }
        }
    });
}

function OptionValueActiveChange(option_value_id, elem) {
    if($(elem).is(":checked")) {
        option_value_active = 1;
    } else {
        option_value_active = 2
    }

    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/value/active",
        type: "POST",
        data: {
            option_value_id: option_value_id,
            option_value_active: option_value_active,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            return;
        }
    });
}

function  OptionValueDelete(option_value_id) {
    Swal.fire({
        title: "ნამდვილად გსურთ მომხმარებლის წაშლა?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'წაშლა',
        cancelButtonText: "გათიშვა",
        preConfirm: () => {
            $.ajax({
                dataType: 'json',
                url: "/products/ajax/options/value/delete",
                type: "POST",
                data: {
                    option_value_id: option_value_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data['status'] == true) {
                        $("#option_id").val(option_id);
                        $("#option_value").html('');
                        $.each(data['ProductOptionValueList'], function(key, value) {
                            if(value['active'] == 1) {
                                var checked = 'checked';                            
                            } else {
                                var checked = '';
                            }
                            $("#option_value").append(`
                                <tr id="option_value_item-`+value['id']+`">
                                    <th>`+value['id']+`</th>
                                    <th class="text-center">`+value['sortable']+`</th>
                                    <th class="text-center">`+value['key']+`</th>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label d-none"></label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                                </div>
                                                <input type="text" class="form-control check-input" id="option_name_ge_`+value['id']+`" value="`+JSON.parse(value['name'])['ge']+`">
                                            </div>
                                            <small class="option_name_ge_`+value['id']+`-error text-error text-danger mt-1"></small>
                                        </div>
                                    </td>
                                   <td>
                                        <div class="form-group">
                                            <label class="form-label d-none"></label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-save" style="cursor: pointer" onclick="OptionValueNameSave(`+value['id']+`)"></em>
                                                </div>
                                                <input type="text" class="form-control check-input" id="option_name_en_`+value['id']+`" value="`+JSON.parse(value['name'])['en']+`">
                                            </div>
                                            <small class="option_name_en_`+value['id']+`-error text-error text-danger mt-1"></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="option_value_`+value['id']+`" onclick="OptionValueActiveChange(`+value['id']+`, this)" `+checked+`>
                                            <label class="custom-control-label" for="option_value_`+value['id']+`"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="width: 240px;">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="javascript:;" onclick="OptionValueEdit(`+value['id']+`)">
                                                                    <em class="icon ni ni-dot"></em>
                                                                    <span>რედაქტირება to do</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" onclick="OptionValueDelete(`+value['id']+`)" class="text-danger">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>მნიშვნელობის წაშლა</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                        });
                        $('#option_value_form')[0].reset();
                        $("#OptionValueModal").modal('show');
                    }
                }
            });
        }
    });
}

$("#option_value").sortable({
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/products/ajax/options/value/sortable",
        });
    }
});

function OptionValueNameSave(option_value_id) {
    $.ajax({
        dataType: 'json',
        url: "/products/ajax/options/value/update",
        type: "POST",
        data: {
            name_ge: $("#option_name_ge_"+option_value_id).val(),
            name_en: $("#option_name_en_"+option_value_id).val(),
            option_value_id: option_value_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                $(".check-input").removeClass('border-danger'); 
                $(".text-error").html('');
                if(data['errors'] == true) {
                    $.each(data['message'], function(key, value) {
                        $("#option_"+key+"_"+option_value_id+"").addClass('border-danger');
                        $(".option_"+key+"_"+option_value_id+"-error").html(value);
                    });
                } else {
                    toastr.clear();
                    NioApp.Toast(data['message'], 'success');
                }
            } else {
                toastr.clear();
                NioApp.Toast(data['message'], 'error');
            }
        }
    });
}