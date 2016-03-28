// Initiating MYAPP Singleton
var MYAPP = MYAPP || {};

MYAPP.nameSpace = function (ns_string) {
	var parts = ns_string.split('.'),
		parent = MYAPP,
		i;
	if (parts[0] === "MYAPP") {
		parts = parts.slice(1);
	}
	for (i = 0; i < parts.length; i += 1) {
		if (typeof parent[parts[i]] === "undefined") {
			parent[parts[i]] = {};
		}
		parent = parent[parts[i]];
	}
	return parent;
};

MYAPP.timeOut = (function(){
	var timeOuts = new Array();
	var getTimo = function() {
		return timeOuts;
	};
	var setTimo = function(val) {
		timeOuts.push(val);
	};
	var clearTimo = function() {
		for( key in getTimo() ){  
			clearInterval(timeOuts[key]);
		}
	};
	return {
		setTimo: setTimo,
		clearTimo: clearTimo
	};
}());

MYAPP.doAjax = (function() {
    var process = function(){};
	process = function(url, param, callback, dataType, el) {
        dataType = dataType || 'json';
        callback = callback || function(){};
		var me = el || '';
		jQuery.ajax({
			url         : url,
			data        : param,
			type        : 'POST',
			dataType    : dataType,
			success     : callback,
			beforeSend  : function(xhr, status) {
				//if(el != '') el.show();
			},
			error       : function(xhr, status) {
				alert('Sorry, there was a problem!');
			},
			complete    : function(xhr, status) {
				//if(el != '') el.hide();
			}
		});
    }
	return {
		process: process
	};
}());

$(function() { "use strict";
	var enbl_login_form = true;

	$('#login_form').submit(function(){
		/*
		var data = $(this).serializeArray();
		data.push({name: 'wordlist', value: wordlist});
		*/
		 
		var btn_sigin 		= $('#login_btn_signin');
		var login_errmsg 	= $('#login_errmsg');

		btn_sigin.attr('disabled', true);
		login_errmsg.hide();

  		var url         = $('#login_ajax_action').text(),
			dataType    = 'json',
			param       = $(this).serialize(),
			callback    = function(data) {
				if(data.err_msg == '') {
					window.location.href = data.url_home;	
				} else {
					login_errmsg.html(data.err_msg);
					login_errmsg.show();
				}
				enbl_login_form = true;
				btn_sigin.attr('disabled', false);
			};
		
		if(enbl_login_form == true) {
			MYAPP.doAjax.process(url, param, callback, dataType);
			enbl_login_form = false;
		}

		return false;
	});
});

$(function() { "use strict";
	var enbl_admin_form = true;

	$('#admin_form').submit(function(){
		/*
		var data = $(this).serializeArray();
		data.push({name: 'wordlist', value: wordlist});
		*/
		 
		var btn_sigin 		= $('#admin_btn_process');
		var login_errmsg 	= $('#admin_errmsg');

		btn_sigin.attr('disabled', true);
		login_errmsg.hide();

  		var url         = $('#admin_ajax_action').text(),
			dataType    = 'json',
			param       = $(this).serialize(),
			callback    = function(data) {
				if(data.err_msg == '') {
					console.log('success form admin');	
				} else {
					login_errmsg.html(data.err_msg);
					login_errmsg.show();
				}
				enbl_admin_form = true;
				btn_sigin.attr('disabled', false);
			};
		
		if(enbl_admin_form == true) {
			MYAPP.doAjax.process(url, param, callback, dataType);
			enbl_admin_form = false;
		}

		return false;
	});
});
