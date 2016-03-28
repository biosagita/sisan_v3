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

MYAPP.doAjaxUpload = (function() {
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
			processData	: false, // Don't process the files
        	contentType	: false, // Set content type to false as jQuery will tell the server its a query string request
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

MYAPP.doFormSubmit = (function() {
    var process = function(){};
	process = function(listparam) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);

		btn_submit.attr('disabled', true);
		div_errmsg.hide();

  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			param       = $(listparam.formid).serialize(),
			callback    = listparam.callback;
		
		if(enbl_btn_process == true) {
			MYAPP.doAjax.process(url, param, callback, dataType);
			enbl_btn_process = false;
		}
    }
	return {
		process: process
	};
}());

MYAPP.doFormSubmitUploadTmp = (function() {
    var process = function(){};
	process = function(listparam, files) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);

		btn_submit.attr('disabled', true);
		div_errmsg.hide();

		var data = new FormData();
		if(typeof files != 'undefined') {
			$.each(files, function(key, value)
			{
				data.append(key, value);
			});	
		}

		//console.log(data); return false;

  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			param       = data,
			callback    = listparam.callback;
		
		if(enbl_btn_process == true) {
			MYAPP.doAjaxUpload.process(url, param, callback, dataType);
		}
    }
	return {
		process: process
	};
}());

MYAPP.doFormSubmitUpload = (function() {
    var process = function(){};
	process = function(listparam, data) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);

		btn_submit.attr('disabled', true);
		div_errmsg.hide();

  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			param       = $(listparam.formid).serialize(),
			callback    = listparam.callback;

		// You should sterilise the file names
		$.each(data.files, function(key, value)
		{
			param = param + '&filenames[]=' + value;
		});
		
		if(enbl_btn_process == true) {
			MYAPP.doAjax.process(url, param, callback, dataType);
			enbl_btn_process = false;
		}
    }
	return {
		process: process
	};
}());

//------do logout----------
$(function() { "use strict";
	$('#logout_link').click(function() {
		var cfm = confirm('Logout?');
		if(!cfm) return false;
	});
});