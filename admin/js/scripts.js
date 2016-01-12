var linklocation;

$(document).ready(function() {
	$('#summernote').summernote({lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true});
	$('#summernote1').summernote({lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true});
	$('#summernote2').summernote({lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true});
	$('#summernote3').summernote({lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true});
	$('.app-content').css('display','none');
	$('.app-content').fadeIn(1000);
	$('#summernote').code($('textarea[name="text"]').val());
	$('#summernote1').code($('textarea[name="text1"]').val());
	$('#summernote2').code($('textarea[name="text2"]').val());
	$('#summernote3').code($('textarea[name="text3"]').val());

	$('.input-group.date').datepicker({
		format: "yyyy-mm-dd",
		language: "ru",
		todayHighlight: true
	});

	$('.nav a.transition').click(function(){
		event.preventDefault();
		linklocation = this.href;
		$('.app-content').fadeOut(500, redirectPage);
	});

	$("#navigation").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

    //$('select[name="related"]').change(function(){
    //    console.log($(this).val());
    //});

	$('button.button').click(function() {
		if($(this).hasClass('listsave')) {
			var sHTML = $('#summernote').code();
			$('textarea[name="text"]').val(sHTML);
		}

		$(this).closest('form').submit();
	});

	// Редактирование
	$('.edit').click(function(){
		if ($(this).attr('data-title') == "news") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "section") {
			if ($(this).attr('data-parent')==0) { $('.hidden_section').hide(); }
			else {
				$('.hidden_section').show();
				var parent = $(this).attr('data-parent');
				$('select[name="parent"] option').removeAttr('selected');
				$('select[name="parent"] option').each(function(){
					if ($(this).val() == parent) {
						$(this).attr('selected', 'selected');
					}
				});
			}
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "pages") {
			if ($(this).attr('data-parent')==0) { $('.hidden_section').hide(); }
			else { $('.hidden_section').show(); selectPagesParent($(this).attr('data-parent')); }
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "provider") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "kurs") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "provider_status") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "zakaz") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		else if ($(this).attr('data-title') == "clients") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

        else if ($(this).attr('data-title') == "pages_client") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

        else if ($(this).attr('data-title') == "pages_press") {
			var value = "form="+$(this).attr('data-title')+"&id="+$(this).attr('data-id');
		}

		editDraw(value,$(this).attr('data-title'));
	});

	// Удаление
	$('.delete').click(function(){
		$('.modal.delete').find('input[name="delete"]').val($(this).attr('data-id'));
		$('.modal.delete').find('input[name="table"]').val($(this).attr('data-title'));
	});

    // Добавление удаление атрибутов
	$('.addattr').click(function(){
		var now = parseInt($(this).attr('data-idd'));
		var next = now+1;
		$(this).attr('data-idd', next);
		var tr = '<tr class="line">';
		tr += '<td><input class="form-control" name="attr[]" placeholder="Название"></td>';
		tr += '<td><input class="form-control" name="val[]" placeholder="Значение"></td>';
		tr += '<td class="catButt__i"><button type="button" class="btn btn-danger delattr"><i class="fa fa-minus-circle"></i></button></td>';
		tr += '</tr>';
		$(this).closest('table').find('tr:last').after(tr);

		$('.delattr').click(function() {
			var now = parseInt($(this).closest('.addAttr__i').find('.addattr').attr('data-idd'));
			var prew = now-1;
			$(this).closest('.addAttr__i').find('.addattr').attr('data-idd',prew)
			$(this).closest('tr.line').remove();
		});

	});

	$('.delattr').click(function() {
		var now = parseInt($(this).closest('.addAttr__i').find('.addattr').attr('data-idd'));
		var prew = now-1;
		$(this).closest('.addAttr__i').find('.addattr').attr('data-idd',prew)
		$(this).closest('tr.line').remove();
	});

	// Обновление прайс листов

	$('.updatePrice').click(function(){
		$('input[name="update"]').val($(this).data('id'));
	});

	// сортировка таблицы
	$('#zakazTable').tablesorter();


	//$('.js-linknew').click(function() {
	//	event.preventDefault();
	//	linklocation = $(this).data('link')+".php?check=nofeed";
	//	$('.app-content').fadeOut(500,redirectPage);
	//});



	//$('.form-js').click(function(){
	//	$(this).closest('form').submit();
	//});

	$('.section-js').click(function(){ $('.hidden_section').hide(); });
	$('.subsection-js').click(function(){ $('.hidden_section').show(); });

	$('div.button').click(function() {
		$('body').find('form:not(this)').removeClass('error');
		var answer = validator($(this).closest('form').get(0));
		if(answer != false) {
			if ($(this).hasClass('listsave')) {
				var sHTML = $('#summernote').code();
				$('textarea[name="text"]').val(sHTML);
			}
			if($(this).hasClass('listsettings')) {
				var sHTML1 = $('#summernote1').code();
				var sHTML2 = $('#summernote2').code();
				var sHTML3 = $('#summernote3').code();
				$('textarea[name="text1"]').val(sHTML1);
				$('textarea[name="text2"]').val(sHTML2);
				$('textarea[name="text3"]').val(sHTML3);
			}
			$(this).closest('form').submit();
		}
	});
	// сортировка меню
    $('.nestable_save').click(function(){
        saveSort($(this).data('table'),$('.dd').nestable('serialize'));
    });
	// сортировка прайса
	$('.sortable').sortable().bind('sortupdate', function(e, ui) {
		var arr_sort_price = [];
		$('.sortable li').each(function(){
			var id = parseInt($(this).attr('data-id'));
			var nn = parseInt($(this).index())+1;
			var tmp_arr = {
				id: id,
				nn: nn
			};
			arr_sort_price.push(tmp_arr)
		});
		saveSort('price',arr_sort_price);
	});
	// сортировка страниц
	$('.nestable_save_pages').click(function(){
		updateMenuPagesOrder($('.dd').nestable('serialize'));
	});


	//Скрыть из каталога
    $('.edit_kolViewNon').click(function(){
        if ($(this).hasClass('btn-success')) {
            var value = "form=edit_status&attr=0&id="+$(this).attr('data-id')+"&col=nal";
            $(this).removeClass('btn-success').addClass('btn-default');
        } else {
            var value = "form=edit_status&attr=1&id="+$(this).attr('data-id')+"&col=nal";
            $(this).addClass('btn-success');
            $(this).closest('span').find('.edit_kolView').removeClass('btn-success');
        }
		editStatus(value);
    });
	//Нет в наличии
    $('.edit_kolView').click(function(){
        if ($(this).hasClass('btn-success')) {
            var value = "form=edit_status&attr=0&id="+$(this).attr('data-id')+"&col=nal";
            $(this).removeClass('btn-success').addClass('btn-default');
        } else {
            var value = "form=edit_status&attr=2&id="+$(this).attr('data-id')+"&col=nal";
            $(this).addClass('btn-success');
            $(this).closest('span').find('.edit_kolViewNon').removeClass('btn-success');
        }
		editStatus(value);
    });
	//Новинка
    $('.edit_new').click(function(){
        if ($(this).hasClass('btn-success')) {
            var value = "form=edit_status&attr=0&id=" + $(this).attr('data-id')+"&col=new";
            $(this).removeClass('btn-success').addClass('btn-default');
        } else {
            var value = "form=edit_status&attr=1&id=" + $(this).attr('data-id')+"&col=new";
            $(this).removeClass('btn-default').addClass('btn-success');
        }
		editStatus(value);
    });
	//Распродажа
    $('.edit_sezons').click(function(){
        if ($(this).hasClass('btn-success')) {
            var value = "form=edit_status&attr=0&id=" + $(this).attr('data-id') + "&col=best";
            $(this).removeClass('btn-success').addClass('btn-default');
        } else {
            var value = "form=edit_status&attr=1&id=" + $(this).attr('data-id') + "&col=best";
            $(this).removeClass('btn-default').addClass('btn-success');
        }
		editStatus(value);
    });

    $('#files').change(function(){
        var input = $(this)[0];
        if ( input.files && input.files[0] ) {
            if ( input.files[0].type.match('image.*') ) {
                var reader = new FileReader();
                reader.onload = function( e ) {
                    $('.upload_photo').append('<div class="item__photo col-xs-4 pos-rlt m-t"><i class="glyphicon text-danger glyphicon-remove-circle removeIcon"></i><input type="hidden" name="tmpPhoto[]" value="'+e.target.result+'"><img src="'+e.target.result+'"><br>'+$('.colors').html()+'<br><br></div>');
                    $('.removeIcon').click(function(){ $(this).closest('.item__photo').remove(); });
                }
                reader.readAsDataURL(input.files[0]);
            } else console.log('is not image mime type');
        } else console.log('not isset files data or files API not supordet');

    });


});

$('.removeIcon').click(function(){ $(this).closest('.item__photo').remove(); });

function saveSort(table,jsondata) {
	var myJsonString = JSON.stringify(jsondata);
	console.log(table,myJsonString);
	$.ajax({ type: "POST", url: "models/data.php", dataType: "json", data: "form=savesort&table="+table+"&data="+myJsonString,
		success: function (data) { console.log(data); }
	});
}

function updateMenuPagesOrder(jsondata) {
	var myJsonString = JSON.stringify(jsondata);
	console.log(myJsonString);
	$.ajax({ type: "POST", url: "models/savesort.php", dataType: "json", data: "pages="+myJsonString,
		success: function (data) { location.reload(); }
	});
}

function redirectPage() {
	window.location = linklocation;
}

function editDraw(value,title) {
	$.ajax({ type: "POST", url: "models/data.php", dataType: "json", data: value,
		success: function (data) {
            console.log(data);
			if (title == "news") {
				$('input[name="date"]').val(data[0]["date"]);
				$('input[name="title"]').val(data[0]["title"]);
				$('input[name="text"]').val(data[0]["text"]);
				$('input[name="go"]').val(data[0]["id"]);
				$('.input-group.date').datepicker({
					format: "yyyy-mm-dd",
					language: "ru",
					todayHighlight: true
				});
			} else if (title == "section") {
				$('input[name="name_ru"]').val(data[0]["name_ru"]);
				$('input[name="title"]').val(data[0]["title"]);
				$('input[name="desc"]').val(data[0]["desc"]);
				$('input[name="keywords"]').val(data[0]["keywords"]);
				$('input[name="name_en"]').val(data[0]["name_en"]);
				$('input[name="nn"]').val(data[0]["nn"]);
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "pages") {
				$('input[name="name"]').val(data[0]["name_ru"]);
				$('input[name="url"]').val(data[0]["name_en"]);
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "provider") {
				$('input[name="name"]').val(data[0]["name"]);
				$('input[name="name_klient"]').val(data[0]["name_klient"]);
				$('input[name="margin"]').val(data[0]["margin"]);
				$('input[name="delivery"]').val(data[0]["delivery"]);
				$('select[name="kurs"] option').removeAttr('selected');
				$('select[name="kurs"] option').each(function(){
					if ($(this).val() == data[0]["kurs"]) {
						$(this).attr('selected', 'selected');
					}
				});
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "kurs") {
				$('input[name="name"]').val(data[0]["name"]);
				$('input[name="sun"]').val(data[0]["sun"]);
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "provider_status") {
				$('input[name="name"]').val(data[0]["name"]);
				$('select[name="color"] option').removeAttr('selected');
				$('select[name="color"] option').each(function(){
					if ($(this).val() == data[0]["color"]) {
						$(this).attr('selected', 'selected');
					}
				});
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "zakaz") {
				$('input[name="kol"]').val(data[0]["kol"]);
				$('input[name="kol"]').data('kolnow', data[0]["kol"]);
				$('input[name="name"]').val(data[0]["name"]);
				$('select[name="status"] option').removeAttr('selected');
				$('select[name="status"] option').each(function(){
					if ($(this).val() == data[0]["status"]) {
						$(this).attr('selected', 'selected');
					}
				});
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "clients") {
				$('select[name="opt"] option').removeAttr('selected');
				$('select[name="opt"] option').each(function(){
					if ($(this).val() == data[0]["opt"]) {
						$(this).attr('selected', 'selected');
					}
				});
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "pages_client") {
                $('input[name="name"]').val(data[0]["name"]);
                $('input[name="text"]').val(data[0]["text"]);
                $('input[name="year"]').val(data[0]["year"]);
                $('input[name="go"]').val(data[0]["id"]);
            } else if (title == "pages_press") {
                $('input[name="text"]').val(data[0]["text"]);
                $('input[name="go"]').val(data[0]["id"]);
            }
		}
	});
}

function selectPagesParent(id) {
	$.ajax({ type: "POST", url: "models/data.php", dataType: "json", data: "form=selectPagesParent&id="+id,
		success: function (data) {
			$('select[name="section"] option').removeAttr('selected');
			$('select[name="section"]').prepend('<option value="'+data[0]["id"]+'" selected="selected">'+data[0]["name_ru"]+'</option>');
		}
	});
}

function editStatus(value) {
    $.ajax({ type: "POST", url: "models/data.php", dataType: "json", data: value }).always(function() {});
}

function validator(form) {
	var $form = form;
	var checker = true;

	$("input", $form).each(function(){
		if ($(this).hasClass('required-js')) {
			if (!$(this).val()) {
				checker = false;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		}

		if ($(this).hasClass('number-js')) {
			if ($(this).val().match(/[^0-9]/g)) {
				checker = false;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		}
	});
	return checker;
}