function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

var utils = {
	isEmpty: function(value){
		return !value || value.toString().trim().length == 0;
	},
	isEmail: function(value) {
		var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	return re.test(value);
	}
};

function contactForm($formEle) {
	var self = this;

	self.containerEle = $formEle.length > 0 ? $formEle : $("#contact-form");
	self.form = {
		name : self.containerEle.find("input[name='name']"),
		email : self.containerEle.find("input[name='email']"),
		topic : self.containerEle.find("input[name='topic']"),
		enquiry : self.containerEle.find("textarea[name='enquiry']")
	};
	self.sendButton = self.containerEle.find('.btn-send');

	function validate(){
		var formData = getFormData();
		var errors = [];
		if(utils.isEmpty(formData.name)){
			errors.push('name');
			self.form.name.parent().addClass('error');
		} else {
			self.form.name.parent().removeClass('error');
		}

		if(utils.isEmpty(formData.email) || !utils.isEmail(formData.email)){
			errors.push('email');
			self.form.email.parent().addClass('error');
		} else {
			self.form.email.parent().removeClass('error');
		}

		if(utils.isEmpty(formData.topic)) {
			errors.push('topic');
			self.form.topic.parent().addClass('error');
		} else {
			self.form.topic.parent().removeClass('error');
		}

		if(utils.isEmpty(formData.enquiry)) {
			errors.push('enquiry');
			self.form.enquiry.parent().addClass('error');
		} else {
			self.form.enquiry.parent().removeClass('error');
		}

		if(errors.length > 0) {
			self.form[errors[0]].focus();
			return false;
		}

		return true;
	}

	function getFormData(){
		return {
			name : self.form.name.val().trim(),
			email : self.form.email.val().trim(),
			topic : self.form.topic.val().trim(),
			enquiry : self.form.enquiry.val().trim()
		};
	}

	function sendRequest (data, customCallback) {
		$.ajax({
			url: 'index.php?route=information/contact/submitAjax',
			type: 'post',			
			data: data,
			dataType: 'json',
			success: function(json) {
				//$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				if(customCallback){
					customCallback(json);
				}
			}
		});
	}

	function lockForm(isSending){
		if(isSending) {
			self.containerEle.find(':input').attr('disabled', 'disabled');
			self.sendButton.text(self.sendButton.data('sending')).attr('disabled', 'disabled');
		} else {
			self.containerEle.find(':input').removeAttr('disabled');
			self.sendButton.text(self.sendButton.data('text')).removeAttr('disabled');
		}
	}

	function resetForm(){
		self.containerEle.find(":input").val('');
	}

	function sendButtonOnClick(){
		if(!validate()) return;

		lockForm(true);		
		sendRequest(getFormData(), function(json){
			lockForm(false);
			if(json.success) {
				resetForm();
			}
			if(json.message) {
				alert(json.message);
			}
		});
	}

	function init(){
		self.sendButton.on('click', function(e){
			e.preventDefault();
			sendButtonOnClick();
		});
	}
	init();
};

$(document).ready(function() {
	// Adding the clear Fix
	cols1 = $('#column-right, #column-left').length;
	
	if (cols1 == 2) {
		$('#content .product-layout:nth-child(2n+2)').after('<div class="clearfix visible-md visible-sm"></div>');
	} else if (cols1 == 1) {
		$('#content .product-layout:nth-child(3n+3)').after('<div class="clearfix visible-lg"></div>');
	} else {
		$('#content .product-layout:nth-child(4n+4)').after('<div class="clearfix"></div>');
	}
	
	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
		
	// Currency
	$('#currency .currency-select').on('click', function(e) {
		e.preventDefault();

		$('#currency input[name=\'code\']').attr('value', $(this).attr('name'));

		$('#currency').submit();
	});

	// Language
	$('#language a').on('click', function(e) {
		e.preventDefault();

		$('#language input[name=\'code\']').attr('value', $(this).attr('href'));

		$('#language').submit();
	});

	/* Search */
	var searchInput = $('#search input[name=\'search\']');
	var searchButton = $('#search button');
	searchButton.on('click', function() {
		url = $('body').data("searchurl");
		if(!url) return;

		var value = searchInput.val();
		if (value && value.trim().length > 0) {
			url += '&search=' + encodeURIComponent(value);
			location.href = url;
		}	
	});
	searchInput.on('keydown', function(e) {
		if (e.keyCode == 13) {
			searchButton.trigger('click');
		}
	});

	// Menu
	$('#menu .dropdown-menu').each(function() {
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();

		var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// Product List
	$('#list-view').click(function() {
		$('#content .product-layout > .clearfix').remove();

		$('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

		localStorage.setItem('display', 'list');
	});

	// Product Grid
	$('#grid-view').click(function() {
		$('#content .product-layout > .clearfix').remove();

		// What a shame bootstrap does not take into account dynamically loaded columns
		cols = $('#column-right, #column-left').length;

		if (cols == 2) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		} else if (cols == 1) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
		} else {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
		}

		 localStorage.setItem('display', 'grid');
	});

	/*if (localStorage.getItem('display') == 'list') {
		$('#list-view').trigger('click');
	} else {
		$('#grid-view').trigger('click');
	}*/
	$('#list-view').trigger('click');

	// tooltips on hover
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});

	$(".showmore-job-list").on("click", function(){
		$(".job-list .hidden").removeClass("hidden");
		$(this).hide(0);
	});

	$(".js-manufacturers").on("change", function(e){
		var option = $(this).find("option:selected");
		if(option.length > 0){
			location.href = option.data("url");
		}
	});

	$("#gotocontact").on("click", function(e){
		e.preventDefault();
		$("html, body").animate({ scrollTop: $(document).height() }, 1200);
	});

	var contactFormEle = $("#contact-form");
	contactFormEle.data('contactForm', new contactForm(contactFormEle));
});

/* Agree to Terms */
$(document).delegate('.agree', 'click', function(e) {
	e.preventDefault();

	$('#modal-agree').remove();

	var element = this;

	$.ajax({
		url: $(element).attr('href'),
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-agree" class="modal">';
			html += '  <div class="modal-dialog">';
			html += '    <div class="modal-content">';
			html += '      <div class="modal-header">';
			html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			html += '        <h4 class="modal-title">' + $(element).text() + '</h4>';
			html += '      </div>';
			html += '      <div class="modal-body">' + data + '</div>';
			html += '    </div';
			html += '  </div>';
			html += '</div>';

			$('body').append(html);

			$('#modal-agree').modal('show');
		}
	});
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();
	
			$.extend(this, option);
	
			$(this).attr('autocomplete', 'off');
			
			// Focus
			$(this).on('focus', function() {
				this.request();
			});
			
			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);				
			});
			
			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}				
			});
			
			// Click
			this.click = function(event) {
				event.preventDefault();
	
				value = $(event.target).parent().attr('data-value');
	
				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}
			
			// Show
			this.show = function() {
				var pos = $(this).position();
	
				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					left: pos.left
				});
	
				$(this).siblings('ul.dropdown-menu').show();
			}
			
			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}		
			
			// Request
			this.request = function() {
				clearTimeout(this.timer);
		
				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}
			
			// Response
			this.response = function(json) {
				html = '';
	
				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}
	
					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						}
					}
	
					// Get all the ones with a categories
					var category = new Array();
	
					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}
	
							category[json[i]['category']]['item'].push(json[i]);
						}
					}
	
					for (i in category) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';
	
						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
					}
				}
	
				if (html) {
					this.show();
				} else {
					this.hide();
				}
	
				$(this).siblings('ul.dropdown-menu').html(html);
			}
			
			$(this).after('<ul class="dropdown-menu"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));	
			
		});
	}
})(window.jQuery);