$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    'use strict';
    let forms = $('.formsValidate');
    [].filter.call(forms, function(form) {
        $(form).submit(function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }

            $(form).addClass('was-validated');
        });
    });
});



// var Popup = (function() {
//
// 	return {
// 		show: function(text) {
// 			$(".popup_text").text(text);
// 			$(".popup_wrapper").fadeIn();
//
// 			setTimeout(function() {
// 				$(".popup_wrapper").fadeOut(500);
// 			}, 2000);
// 		}
// 	};
// })();
//
//
// var Cart = (function() {
//
// 	return {
// 		add: function(productElment, productId) {
// 			productId = productId || 0;
//
// 			$.ajax({
// 				url: '/cart/store',
// 				type: "POST",
// 		      	dataType: 'json',
// 		      	data: {productId},
// 				success: function(d) {
// 			        if (d.result && d.result === 'success') {
// 			        	Popup.show('add');
// 			        } else {
// 			        	Popup.show('error');
// 			        }
// 		      	},
// 		      	error: function(e) {
// 		      		if (e.status === 0) {
// 			        	console.log('Нет подключения к Интернету.');
// 		      		}
// 		      	}
// 			});
// 		},
// 		remove: function(productElment, productId) {
// 			productId = productId || 0;
//
// 			$.ajax({
// 				url: '/cart/delete',
// 				type: "POST",
// 		      	dataType: 'json',
// 		      	data: {productId},
// 				success: function(d) {
// 			        if (d.result && d.result === 'success') {
// 			        	console.log('add');
// 			        	Popup.show('remove');
// 			        } else {
// 			        	Popup.show('error');
// 			        }
// 		      	},
// 		      	error: function(e) {
// 		      		if (e.status === 0) {
// 			        	console.log('Нет подключения к Интернету.');
// 		      		}
// 		      	}
// 			});
// 		}
// 	};
// })();
//
// var Compare = (function() {
//
//
//
// 	return {
//
// 	}
// })();
//
// var Wishlist = (function() {
//
// 	return {
// 		add: function() {
//
// 		},
// 		remove: function() {
//
// 		}
// 	}
// })();
