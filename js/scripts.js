var phone_format;
var phone_format;
var prefix = $('.prefix').val();
$(document).ready(function() {
	update_card();
	$("a.fancybox").fancybox();
	var url = prefix+"send.php";
	phone_format = $('.phone_format').val();
	$('#show .slider').slick();
	$('#product .slider').slick({
		'arrows': false,
		'infinite': false,
		'fade': true
	});
	var mobile = navigator.userAgent.toLowerCase().match(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i);
	if(mobile != null) {
		$('html').css('width', window.innerWidth + 'px');

	} else {
		$(".scroll").each(function() {
			var block = $(this);
			$(window).scroll(function() {
				var top = block.offset().top;
				var bottom = block.height()+top;
				top = top - $(window).height();
				var scroll_top = $(this).scrollTop();
				var block_center = block.offset().top + (block.height() / 2);
				var screen_center = scroll_top + ($(window).height() / 2);
				if(block.height() < $(window).height()) {
					if ((scroll_top > (top-(block.height()/2))) && ((scroll_top < bottom+(block.height()/2))) && (scroll_top + $(window).height() > (bottom-(block.height()/2))) && (scroll_top < (block.offset().top+(block.height()/2)))) {
						if (!block.hasClass("animated")) {
							block.addClass("animated");
						}
					} else {
						if((block.offset().top + block.height() < scroll_top) || (block.offset().top > (scroll_top + $(window).height()))) {
							block.removeClass("animated");
						}
					}
				} else {
					if ((scroll_top > top) && (scroll_top < bottom) && (Math.abs(screen_center - block_center) < (block.height() / 4))) {
						if (!block.hasClass("animated")) {
							block.addClass("animated");
						}
					} else {
						if((block.offset().top + block.height() < scroll_top) || (block.offset().top > (scroll_top + $(window).height()))) {
							block.removeClass("animated");
						}
					}
				}
			});
		});
		$('head').append('<link rel="stylesheet" href="'+prefix+'css/animation.css" />');
	}

	$('.button').click(function() {
		$('body').find('form:not(this)').children('label').removeClass('red');
		var request_url = '<br>'+$('input[name="ref_url"]').val().toString().replace(/&/g, '<br>');
		var answer = checkForm($(this).parent().get(0));
		if(answer != false)
		{
			var $form = $(this).parent();
			var name = $('input[name="name"]', $form).val();
			if(phone_format == 'one') {
				var phone = $('input[name="phone"]', $form).val();
			} else if(phone_format == 'three') {
				var phone = $('input[name="phone1"]', $form).val()+' '+$('input[name="phone2"]', $form).val()+' '+$('input[name="phone3"]', $form).val();
			}
			var email = $('input[name="email"]', $form).val();
			var ques = $('textarea[name="ques"]', $form).val();
			var sbt = $('.button', $form).attr("data-name");
			var submit = $('.button', $form).text();
			var ref = $('input[name="referer"]').val();
			var formname = $('input[name="formname"]').val();
			var sitename = $('.sitename').val();
			var emailsarr = $('.emailsarr').val();
			$.ajax({
				type: "POST",
				url: url,
				dataType: "json",
				data: "name="+name+"&phone="+phone+"&"+sbt+"="+submit+"&email="+email+"&ques="+ques+"&formname="+formname+"&ref="+ref+"&utm="+request_url+"&sitename="+sitename+"&emailsarr="+emailsarr
			}).always(function() {
				thx();
				//метрики
				setTimeout(function(){ga('send', 'event', ''+sbt, ''+sbt);}, 30);
				setTimeout(function(){yaCounterXXXXXXXXX.reachGoal(''+sbt);}, 30); // меняем XXXXXXXXX на номер счетчика
			});
		}
	});

    $('.oformZakaz').click(function(){
        var cheker = true;
        $('.required_of').each(function(){
            if (!$(this).val()) {
                cheker = false;
                $(this).css('border','1px solid #FF0000');
            } else {
                $(this).css('border','1px solid #9d9da2');
            }
        });
        if (cheker==true) {
            var name = $('input[name="name"]').val();
            var phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var address_state = $('#shipping_address_state option:selected').val();
            var city = $('input[name="city"]').val();
            var street = $('input[name="street"]').val();
            var house = $('input[name="house"]').val();
            var cityindex = $('input[name="city-index"]').val();
            var comment = $('textarea[name="comment"]').val();
            var delivery = $('input[name="delivery"]:checked').val();
            var payment = $('input[name="payment"]:checked').val();
            var sumzakaz = $('.checout-price-value').text();
            var sumdost = $('.checkout-delivery-cost').text();
            var value = "form=oformzakaz&name="+name+"&phone="+phone+"&email="+email+"&address_state="+address_state+"&city="+city+"&street="+street+"&house="+house+"&comment="+comment+"&delivery="+delivery+"&payment="+payment+"&sumzakaz="+sumzakaz+"&sumdost="+sumdost+"&cityindex="+cityindex;
            $.ajax({ type: "POST", url: prefix+"view/update.php", dataType: "json", data: value,
                success: function (data) {
                    if (data['type']=="thanks") {
                        popup('thanks');
                    } else {
                        var targets = "GLZN Заказ №"+data['zakaz'];
                        $('#pay').html('<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account=410012153352644&quickpay=shop&payment-type-choice=on&writer=seller&targets='+targets+'&targets-hint=&default-sum='+data['summ']+'&button-text=01&successURL=glzn.ru%2Fnew%2Finvoice%2Fym%2Fpayment.php&label='+data['zakaz']+'" width="450" height="200"></iframe>');
                        popup('payment');
                    }
                }
            });
        }
    });

    $('input[name="delivery"]').click(function(){
        $('.checkout-delivery').show();
        if ($(this).val()=="Курьерская доставка") {
            var dostSum = $(this).attr('data-delsum');
        } else if ($(this).val()=="EMS") {
            var dostSum = $(this).closest('.form-container').find('#shipping_address_state option:selected').attr('data-ems');
        } else if ($(this).val()=="Почта России") {
            var dostSum = $(this).closest('.form-container').find('#shipping_address_state option:selected').attr('data-pr');
        } else if ($(this).val()=="Самовывоз") {
            var dostSum = 0;
            $('.checkout-delivery').hide();
        }
        $('.checkout-delivery-cost').text(dostSum);
    });

	if(phone_format == 'three') {
		$('input[name="phone2"]').focus(function() {
			$(this).keydown(function(event){
				if(event.keyCode != 8) {
					if($(this).val().length >= 3 && event.keyCode != 8)
						$(this).parent().siblings().find('input[name="phone3"]').focus();
				}
			});
		});
		$('input[name="phone3"]').focus(function() {
			$(this).keydown(function(event){
				if(event.keyCode == 8 && $(this).val().length == 0) {
					$(this).parent().siblings().find('input[name="phone2"]').focus();
				}
			});
		});
	}

    $('.catalog-js li').each(function(){
        if ($(this).find('ul').hasClass('sub-sub-menu')) {
            $(this).addClass('sub');
            $(this).find('a:first').attr('href','javascript:void(0);');
        }
    });

});

function popup(id, form, h1, h2, btn) { //onClick="popup('callback', '');"
	if (id != 'size-table') {
		$('.popup_overlay').show();	
	};
	$('#'+id).addClass('activePopup');
	if(id == 'request') {
		var def_h1 = 'Оставить заявку';
		var def_h2 = 'Заполните форму,<br>и&nbsp;мы&nbsp;обязательно свяжемся с&nbsp;вами!';
		var def_btn = 'Оставить заявку';
	}
	if(h1 != '') {$('#'+id).find('.popup_h1').html(h1);} else {$('#'+id).find('.popup_h1').html(def_h1);}
	if(h2 != '') {$('#'+id).find('.popup_h2').html(h2);} else {$('#'+id).find('.popup_h2').html(def_h2);}
	if(btn != '') {$('#'+id).find('.button').html(btn);} else {$('#'+id).find('.button').html(def_btn);}
	$('.activePopup').fadeIn(300);
	$('.formname').attr("value", form);
	yaCounter22247570.reachGoal('knopka');
}

function popup_out() {
	$('.popup_overlay').hide();
	$('.popup.activePopup').hide();
	$('.popup').removeClass('activePopup');
	$('body').find('label').removeClass('red');
    update_card();
}

function formname(name) { //onClick="formname('text');"
	$('.formname').attr("value", name);
}

function thx() {
	$('.popup').hide();
	$('.popup').removeClass('activePopup');
	popup('thx', '');
	if(phone_format == 'one') {
		$('input[type="text"]').each(function(){
			$(this).val('');
		});
	} else if(phone_format == 'three') {
		$('input[type="text"]:not(input[name="phone1"])').each(function(){
			$(this).val('');
		});
	}
	$('textarea').val('');
}

function checkForm(form1) {

	var $form = $(form1);
	var checker = true;
	var name = $("input[name='name']", $form).val();
	if(phone_format == 'one') {
		var phone = $("input[name='phone']", $form).val();
	} else if(phone_format == 'three') {
		var phone1 = $("input[name='phone1']", $form).val();
		var phone2 = $("input[name='phone2']", $form).val();
		var phone3 = $("input[name='phone3']", $form).val();
	}
	var email = $("input[name='email']", $form).val();

	if($form.find(".name").hasClass("required")) {
		if(!name) {
			$form.find(".name").addClass("red");
			checker = false;
		} else {
			$form.find(".name").removeClass('red');
		}
	}

	if(phone_format == 'one') {
		if($form.find(".phone").hasClass("required")) {
			if(!phone) {
				$form.find(".phone").addClass("red");
				checker = false;
			} else if(/[^0-9\+ ()\-]/.test(phone)) {
				$form.find(".phone").addClass("red");
				checker = false;
			} else {
				$form.find(".phone").removeClass("red");
			}
		}
	} else if(phone_format == 'three') {
		if($form.find(".phone").hasClass("required")) {
			if(!phone1) {
				$form.find(".phone").children('input[name="phone1"]').parent().addClass("red");
				checker = false;
			} else if(/[^0-9+]/.test(phone1)) {
				$form.find(".phone").children('input[name="phone1"]').parent().addClass("red");
				checker = false;
			} else {
				$form.find(".phone").children('input[name="phone1"]').parent().removeClass("red");
			}

			if(!phone2) {
				$form.find(".phone").children('input[name="phone2"]').parent().addClass("red");
				checker = false;
			} else if(/[^0-9]/.test(phone2)) {
				$form.find(".phone").children('input[name="phone2"]').parent().addClass("red");
				checker = false;
			} else {
				$form.find(".phone").children('input[name="phone2"]').parent().removeClass("red");
			}

			if(!phone3) {
				$form.find(".phone").children('input[name="phone3"]').parent().addClass("red");
				checker = false;
			} else if(/[^0-9 -]/.test(phone3) || phone3.length < 4) {
				$form.find(".phone").children('input[name="phone3"]').parent().addClass("red");
				checker = false;
			} else {
				$form.find(".phone").children('input[name="phone3"]').parent().removeClass("red");
			}
		}
	}

	if($form.find(".email").hasClass("required")) {
		if(!email) {
			$form.find(".email").addClass("red");
			checker = false;
		} else if(!/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/.test(email)) {
			$form.find(".email").addClass("red");
			checker = false;
		} else {
			$form.find(".email").removeClass("red");
		}
	}

	if(checker != true) { return false; }
}

$('.nav li.sub a').click(function(event){
	event.stopPropagation();
	var block = $(this);
	var arr = [];
	while (!getParent(block).hasClass('menu-container')) {
		var tmp = new Array;
		tmp.push(getParent(block).get(0));
		tmp.push(getParent(block).index());
		arr.push(tmp);
		block = getParent(block);
	}
	var selector = '.menu ';
	for (var i = arr.length-1; i >= 0; i-- ) {
		selector += arr[i][0].localName+'.'+arr[i][0].className.replace(/ /g,'.')+':nth-child('+(parseInt(arr[i][1])+1)+') ';
	}
	selector += '>a';
	if (!$(this).parent().hasClass('opened')) {
		$(selector).parent().siblings('.opened').children('ul').slideUp(300).parent().removeClass('opened').find('.opened').children('ul').slideUp(300).parent().removeClass('opened');
		$(selector).siblings('ul').slideDown(300).parent().addClass('opened');
	} else {
		$(selector).siblings('ul').slideUp(300).parent().removeClass('opened').find('.opened').children('ul').slideUp(300).parent().removeClass('opened');
	}
});

function getParent(block) {
	return block.parent();
}

$(document).on('mouseenter', '.catalog-item', function(){
	$(this).siblings('.catalog-item').addClass('faded');
});
$(document).on('mouseleave', '.catalog-item', function(){
	$('.catalog-item').removeClass('faded');
});

function showCard() {
	$('.card-popup').fadeIn(300);
    if ($('.card-count').text()==0) {
        $('.card-true').hide();
        $('.card-false').show();
    } else {
        $('.card-true').show();
        $('.card-false').hide();
    }
}

var fl = true;
$('.sub-menu').hide();
$('.sub-sub-menu').hide();
$(document).on('click', '.burger', function(){
    if ($(this).closest('body').hasClass('overflow')) {
        $('body').removeAttr('class');
        $('.menu').addClass('hidden');
        $('.burger').removeClass('active');
        //$('.consolelog').text("он нет");
    } else {
        //$('.consolelog').text("он есть");
        $('.burger').addClass('active');
        $('.menu').removeClass('hidden');
        $('body').addClass('overflow');
        if (fl) {
            $('.sub-menu').hide();
            $('.sub-sub-menu').hide();
            fl = !fl;
        }
    }
});


$(document).on('click', '.card-icon img', function(){
	if ($( document ).width() > 1023) {
		showCard();
	} else {
		window.location.href = prefix+'card';
	}
});
$(document).on('click', '.colors label', function(){
	$(this).siblings('label').removeClass('active');
	$(this).addClass('active');
});
$(document).on('click', '.sizes label', function(){
	$(this).siblings('label').removeClass('active');
	$(this).addClass('active');
});
$(document).on('click', '#product .col-nav .slider-arrows .arrow', function(){
	if (!$(this).hasClass('disabled')) {
		if ($(this).hasClass('left')) {
			$('#product .slider').slick('slickPrev');
		} else {
			$('#product .slider').slick('slickNext');
		}
	};
});
$(document).on('click', '#product .slider-nav img', function(){
	$('#product .slider').slick('slickGoTo', parseInt($(this).attr('data-num'))-1, false);
});

$('#product .slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	if (nextSlide > $('#product .slider').children().length) {
		$('#product .col-nav .slider-arrows .arrow').removeClass('disabled');
		$('#product .col-nav .slider-arrows .arrow.right').addClass('disabled');
	} else if (currentSlide == 1) {
		$('#product .col-nav .slider-arrows .arrow').removeClass('disabled');
		$('#product .col-nav .slider-arrows .arrow.left').addClass('disabled');
	} else {
		$('#product .col-nav .slider-arrows .arrow').removeClass('disabled');
	}
});

$(document).on('click', '#size-table .mini-table-header td', function(){
	var selector = '#'+$(this).attr('data-table-id');
	$('#size-table .mini-table-body').css({
		'display': 'none'
	});
	$(selector).css({
		'display': 'block'
	});
	$('.mini-table-header td').removeClass('active');
});

$(document).on('click', '#size-table .btn', function(){
	$('#size-table').removeClass('activePopup');
	popup('request', '| Запись на примерку в шоурум', 'ЗАПИСАТЬСЯ В ШОУРУМ', 'Оставьте свои данные, и наш менеджер свяжется с вами, чтобы записать вас на посещение шоурума', 'Записаться');
});
$(document).on('click', '#size-table .popup_close', function(){
	$('#size-table').hide();
});


$(document).on('click', '.addToCart', function(){
	//$('.card-total').html('<span class="card-total-text">Итого: </span><span class="card-total-value">0</span> руб');
	//$('.btn-wrapp_zakaz').show();
	var value = "form=add_card&id="+$(this).attr('data-id')+"&size="+$('input[name="size"]:checked').val()+"&color="+$('input[name="color"]:checked').val()+"&kol="+$('.item-count-value').text();
	update_bd(value, "card");
});

$(document).on('click', '.card-close', function(){
	$('.card-popup').css({
		'display':'none'
	});
});

$(document).on('change', 'input[name="color"]', function(){
    var id = $(this).data('num');
    $('.slider-nav img').each(function(){
        if ($(this).data('num')==id) {
            $(this).click();
        }
    });
});

$(document).on('click', '.item-remove', function(){
	var click_kol = parseInt($('.card-item.item_product-id'+$(this).attr('data-id')).find('.item-count-value').text());
	var click_price = parseInt($('.card-item.item_product-id'+$(this).attr('data-id')).find('.item-price-value').text());
	var click_summ = click_kol*click_price;
	$('.card-item.item_product-id'+$(this).attr('data-id')).slideUp(300);
	var value = "form=delete_card&id="+$(this).attr('data-id');
	update_bd(value,"count_card");
	var summ = parseInt($('.checout-price-value').text());
	var new_summ = summ-click_summ;
	$('.checout-price-value').text(new_summ);
});

$(document).on('click', '.item-count-controls .inc', function(){
	var now_kol = parseInt($(this).parent().siblings('.item-count-value').text());
	now_kol++;
	$(this).parent().siblings('.item-count-value').text(now_kol);
	var summ_now_product = parseInt($(this).closest('.item_product-id'+$(this).attr('data-id')).find('.item-price-value').text());
	var value = "form=card_count_plus&id="+$(this).attr('data-id');
	update_bd(value,"count_card");
	var summ = parseInt($('.checout-price-value').text());
	summ = summ + summ_now_product;
	$('.checout-price-value').text(summ);
});

$(document).on('click', '.item-count-controls .dec', function(){
	if (parseInt($(this).parent().siblings('.item-count-value').text())>1) {
		var now_kol = parseInt($(this).parent().siblings('.item-count-value').text());
		now_kol--;
		$(this).parent().siblings('.item-count-value').text(now_kol);
		var value = "form=card_count_minus&id="+$(this).attr('data-id');
		update_bd(value,"count_card");
		var summ_now_product = parseInt($(this).closest('.item_product-id'+$(this).attr('data-id')).find('.item-price-value').text());
		var summ = parseInt($('.checout-price-value').text());
		summ = summ - summ_now_product;
		$('.checout-price-value').text(summ);
	}
});

$(document).on('change', '#card #shipping_address_state', function(){
	if ($(this).find('option:checked').val() != 'г Москва') {
		$('#card input[value="Курьерская доставка"]').closest('label').slideUp(300);
		$('#card input[value="Самовывоз"]').closest('label').slideUp(300);
		$('#card input[value="Наличными курьеру"]').closest('label').slideUp(300);
		$('#card input[value="Картой курьеру"]').closest('label').slideUp(300);
		$('#card input[value="EMS"]').attr('checked', 'checked');
		$('#card input[value="Картой on-line"]').attr('checked', 'checked');
        if ($('input[name="delivery"]:checked').val() == "EMS") {
          $('.checkout-delivery-cost').text($(this).find('option:checked').attr('data-ems'));
        } else if ($('input[name="delivery"]:checked').val() == "Почта России") {
            $('.checkout-delivery-cost').text($(this).find('option:checked').attr('data-pr'));
        }

	} else {
		$('#card input[value="Наличными курьеру"]').closest('label').slideDown(300);
		$('#card input[value="Картой курьеру"]').closest('label').slideDown(300);
		$('#card input[value="Курьерская доставка"]').closest('label').slideDown(300);
		$('#card input[value="Самовывоз"]').closest('label').slideDown(300);
        if ($('input[name="delivery"]:checked').val() == "EMS") {
          $('.checkout-delivery-cost').text($(this).find('option:checked').attr('data-ems'));
        } else if ($('input[name="delivery"]:checked').val() == "Почта России") {
            $('.checkout-delivery-cost').text($(this).find('option:checked').attr('data-pr'));
        }
	}
});


function update_bd(value,formnameR) {
	$.ajax({ type: "POST", url: prefix+"view/update.php", dataType: "json", data: value }).always(function() {
		if (formnameR == 'card') {
			$('#addCart').addClass('activePopup').fadeIn(300);
			update_card();
		}
		else if (formnameR == 'count_card') {
			update_card();
		}
	});
}

function update_card() {
	$.ajax({ type: "POST", url: prefix+"view/update.php", dataType: "json", data: "form=card",
		success: function (data) {
			if (data==false) {
                $('.card-count').text('0');
                $('.card-true').hide();
                $('.card-false').show();
                if ($('body').attr('id')=="card") {
                    $('.container').html('<div class="card-head">КОРЗИНА</div><div class="checkout-title">Ваша корзина пуста</div>');
                }
            }
            else {
                $('.card-true').show();
                $('.card-false').hide();
				$('.card-count').text(data.length);
				var ul = $('.card-goods');
				var li = '';
				var summ = 0;
				for (var i=0; i < data.length; i++) {
					summ = summ + (parseInt(data[i]['price'])*data[i]['kol']);
					li += '<li class="card-goods-item group">';
					li += '<div class="card-goods-item-left">';
					li += '<a href="'+prefix+'catalog/product/'+data[i]['price_id']+'"><img src="'+prefix+''+data[i]['src']+'" alt=""></a>';
					li += '</div>';
					li += '<div class="card-goods-item-right">';
					li += '<a href="'+prefix+'catalog/product/'+data[i]['price_id']+'" class="item-title">'+data[i]['name']+'</a>';
					li += '<div class="item-price"><span class="item-price-value">'+data[i]['price']+'</span> руб</div>';
					li += '<div class="item-count">';
					li += 'Кол-во:';
					li += '<div class="input-container">';
					li += '<div class="item-count-dec input-control" data-id="'+data[i]['id']+'"></div>';
					li += '<input type="text" class="item-count-value" name="item-count-value" value="'+data[i]['kol']+'">';
					li += '<div class="item-count-inc input-control" data-id="'+data[i]['id']+'"></div>';
					li += '</div>';
					li += '</div>';
					li += '<div class="item-size">Размер: <span class="item-size-value">'+data[i]['size']+'</span></div>';
					li += '<div class="item-delete" data-id="'+data[i]['id']+'"><img src="'+prefix+'img/delete.png" alt="" class="item-delete-icon"><span class="item-delete-text">Удалить </span></div>';
					li += '</div>';
					li += '</li>';
				}
				ul.html(li);
				$('.card-total-value').text(summ);

				$('.item-count-dec').click(function(){
					if ($(this).siblings('input.item-count-value').val()>1) {
						var value = "form=card_count_minus&id="+$(this).attr('data-id');
						update_bd(value,"count_card");
					}
				});

				$('.item-count-inc').click(function(){
					var value = "form=card_count_plus&id="+$(this).attr('data-id');
					update_bd(value,"count_card");
				});

				$('.item-delete').click(function(){
					var value = "form=delete_card&id="+$(this).attr('data-id');
					update_bd(value,"count_card");
				});
			}
		}
	});
}

$(document).on('scroll', function(){
	if ($(window).scrollTop() > $('.inputs-group.group').last().offset().top + $('.inputs-group.group').last().height() - $(window).height() && $(window).width() < 760) {
		$('.cart-checkout').css({
			'margin-top': 0,
			'position': 'relative'
		}).find('.checkout-delivery').css({'display':'block'});

	} else {
		$('.cart-checkout').removeAttr('style').find('.checkout-delivery').removeAttr('style');
	}
});