$(document).ready(function() {
						   
    /* Check whether browser is IE or not */
	var isIE = function(){
	      var rv = -1; // Return value assumes failure.
	      if (navigator.appName == 'Microsoft Internet Explorer')
	      {
	        var ua = navigator.userAgent;
	        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	        if (re.exec(ua) != null) rv = parseFloat( RegExp.$1 );
	      }
	      
	      return rv == -1 ? false : true;
	};
	
	var crop_divider = 0.5;
	$('.formRight_update_crop').hide();
	$('.formRight_cancel_crop').hide();
	
	/*  Image Uploader  using JCrop*/
	if($('#uploadBtn').length > 0) {
	    var uploaderFile = new plupload.Uploader({
	        runtimes : isIE() ? 'flash,html4,html5' : 'html5,html4',
	        browse_button : 'uploadBtn',
	        container : 'uploaderContainer',
	        max_file_size : max_file_size+'kb',
	        flash_swf_url : base_url + '/js-libs/uploader/plupload.flash.swf',
	        url : base_url+'frontend/all_ajax/temporary_upload/',
	        filters : [
	            {title : "Image files", extensions : allowed_file_type}
	        ]
	    });
	
	    uploaderFile.init();
	
	    uploaderFile.bind('FilesAdded', function(up, files) {
	        $.each(files, function(i, file) {
	            $('#uploaderContainer span#filemsg').html('<span id="' + file.id + '"><img src="'+ base_url +'assets/frontend/images/skin/uploader.gif" alt="Uploading File..." /></span>');
	        });
	        
	        $('#uploaderContainer span#errormsg').remove();
	        $('#uploadBtn span').text('Uploading...');
	        
	        uploaderFile.start();
	    });
		
	    uploaderFile.bind('Error', function(up, err) {
			$('#uploaderContainer span#errormsg').remove();
	        $('#uploaderContainer').append("<span id=\"errormsg\" style=\"color:#FF0000;\">" +
	            "Message: " + err.message + 
	            (err.file.name > max_file_size ? " ,Max file size is 1 MB." : "") + 
	            (err.file ? ", File: " + err.file.name : "") + 
	            "</span>"
	        );
	
	        up.refresh(); // Reposition Flash/Silverlight
	    });
		
	    uploaderFile.bind('FileUploaded', function(up, file, resp) {
	        var resp = $.parseJSON(resp.response);
			var previewArea = '<img alt="Preview Foto" id="preview" src="'+ base_url+ 'assets/frontend/images/temp/' + resp.result.filename+'" />';
			var update_crop_button = '<input type="button" name="update_crop" value="update" class="form_input" />';
			var cancel_crop_button = '<input type="button" name="cancel_crop" value="cancel" class="form_input" />';
			
			/* perhitungan ratio gambar */
			var real_height, real_width, y1, y2, x1, x2;
			var x,y,w,h;
			real_width = resp.result.width;
			real_height = resp.result.height;
			image_dpi = resp.result.dpi;
			ratio_image = real_width / real_height;
			x1 = (real_width * crop_divider) - ((real_width * crop_divider) * crop_divider);
			x2 = (real_width * crop_divider) + ((real_width * crop_divider) * crop_divider); 			
			y1 = (real_height * crop_divider) - ((real_height * crop_divider) * crop_divider);
			y2 = (real_height * crop_divider) + ((real_height * crop_divider) * crop_divider);
			
			$('#uploaderContainer #filemsg').html('');
			$('#preview_jcrop').html(previewArea).show();
			
			$('.formRight_update_crop').show().html(update_crop_button);
			$('.formRight_cancel_crop').show().html(cancel_crop_button);

			$('#show_preview').hide();

			/*
			var aspr = pageType == 'featuredcard' ? (real_width/real_height) : 1;
			
			$('#preview').Jcrop({
				//aspectRatio: 1,
				aspectRatio: aspr,
				setSelect: [ x1, y1, x2, y2],
				onSelect: updateCoords,
				trueSize: [real_width,real_height],
				boxWidth : 720,
				bgColor: 'transparent'
			});
			*/

			if(pageType == 'featuredcard') {
				$('#preview').Jcrop({
					aspectRatio: 500/300,
					setSelect: [ x1, y1, 500, 300],
					minSize: [ 500,300 ],
					maxSize: [ 500,300 ],
	                onChange: updateCoords,
	                boxWidth : 720,
					bgColor: 'transparent',
					trueSize: [real_width,real_height]
				});	
			} else {
				var aspr = pageType == 'featuredcard' ? (real_width/real_height) : 1;
			
				$('#preview').Jcrop({
					aspectRatio: aspr,
					setSelect: [ x1, y1, x2, y2],
					onSelect: updateCoords,
					trueSize: [real_width,real_height],
					boxWidth : 720,
					bgColor: 'transparent',
					allowSelect : false,
					minSize: [ 300,300 ],
				});	
			}
			
			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};
			
									
	        $('#uploadBtn span').text('Update File');

	        $('#divImageFromWeb').hide();
			
			$('input[name=cancel_crop]').click(function(e){
				e.preventDefault();
				$('#preview_jcrop').fadeOut();
				$('.formRight_update_crop').hide();
				$('.formRight_cancel_crop').hide();
				$('body,html').animate({scrollTop: 0}, 800);
				$('#uploadBtn span').text('Select File');
				$('#show_preview').show();

				$('#divImageFromWeb').show();
			});
			
			$('input[name=update_crop]').click(function(e){
				x = $('#x').val();
				y = $('#y').val();
				w = $('#w').val();
				h = $('#h').val();
				
				$('#preview_jcrop').fadeOut();
				$('.formRight_update_crop').hide();
				$('.formRight_cancel_crop').hide();
				
				$('#uploaderContainer span#filemsg').html('<span ><img src="'+ base_url + 'assets/frontend/images/skin/uploader.gif" alt="Uploading File..." /></span>');
				$('body,html').animate({scrollTop: 0}, 800);

				$('#show_preview').show();

				$('#divImageFromWeb').show();
				
				$.ajax({
					type:"POST",
					url:base_url+'frontend/all_ajax/permanent_upload/',
					data:"x="+ x +"&y="+ y +"&w="+ w +
						 "&h="+ h +"&filename="+ resp.result.filename +
						 "&real_width=" + real_width +
						 "&real_height="+real_height+"&pagetype="+pageType+"&image_dpi="+image_dpi,
					success: function(resp){
						var resp = $.parseJSON(resp);
						/*var previewImage = '<a style="display:none;" href="' + resp.result.file_url_large + '" class="lightbox_preview" title="Preview Foto">' +
							'<img alt="Preview Foto" height="30" src="'+ base_url +'/assets/backstage/images/icons/middlenav/image2.png" /></a>';*/
						var previewImage = '<a style="display:none;" href="' + resp.result.file_url_large + '" class="lightbox_preview" title="Preview Foto">' +
							'<img alt="Preview Foto" width="350" class="img-responsive" src="'+ resp.result.file_url_large +'" /></a>';
						$('#putit').html(previewImage).fadeIn();
						
						$('#fname_vlarge').val(resp.result.file_name_vlarge);					
						$('#fname_large').val(resp.result.file_name_large);
						$('#fname_medium').val(resp.result.file_name_medium);
						$('#fname_small').val(resp.result.file_name_small);
						$('#fname_vsmall').val(resp.result.file_name_vsmall);
						$('#uploadBtn span').text('Update File');
						 	
						$('a.lightbox_preview').fadeIn('slow').fancybox();	
					}
					
				})
			});
			
	    });  
    }

    if($('#ckimagefromweb').length > 0) {
    	$('#ckimagefromweb').click(function(){ 
    		var me = $(this);
    		if(me.is(':checked')) {
    			$('#showuploadfrompc').hide();
    			$('#showuploadfromweb').show();
    		} else {
    			$('#showuploadfrompc').show();
    			$('#showuploadfromweb').hide();
    		}
    	});

    	$('#uploadfromweb').click(function(e){
    		e.preventDefault(); 
    		$('#divImageFromWeb').hide();
    		$.post( 
    			base_url+'frontend/all_ajax/temporary_upload_from_web/', 
    			{ urlwebimage : $('#urlwebimage').val() }, 
    			function(resp) {
					//console.log(data);
					var previewArea = '<img alt="Preview Foto" id="preview" src="'+ base_url+ 'assets/frontend/images/temp/' + resp.result.filename+'" />';
					var update_crop_button = '<input type="button" name="update_crop" value="update" class="form_input" />';
					var cancel_crop_button = '<input type="button" name="cancel_crop" value="cancel" class="form_input" />';
					
					/* perhitungan ratio gambar */
					var real_height, real_width, y1, y2, x1, x2;
					var x,y,w,h;
					real_width = resp.result.width;
					real_height = resp.result.height;
					image_dpi = resp.result.dpi;
					ratio_image = real_width / real_height;
					x1 = (real_width * crop_divider) - ((real_width * crop_divider) * crop_divider);
					x2 = (real_width * crop_divider) + ((real_width * crop_divider) * crop_divider); 			
					y1 = (real_height * crop_divider) - ((real_height * crop_divider) * crop_divider);
					y2 = (real_height * crop_divider) + ((real_height * crop_divider) * crop_divider);
					
					$('#uploaderContainer #filemsg').html('');
					$('#preview_jcrop').html(previewArea).show();
					
					$('.formRight_update_crop').show().html(update_crop_button);
					$('.formRight_cancel_crop').show().html(cancel_crop_button);

					$('#show_preview').hide();

					$('#preview').Jcrop({
						aspectRatio: 1,
						setSelect: [ x1, y1, x2, y2],
						onSelect: updateCoords,
						trueSize: [real_width,real_height],
						boxWidth : 720,
						bgColor: 'transparent'
					});

					function updateCoords(c)
					{
						$('#x').val(c.x);
						$('#y').val(c.y);
						$('#w').val(c.w);
						$('#h').val(c.h);
					};

					$('input[name=cancel_crop]').click(function(e){
						e.preventDefault();
						$('#preview_jcrop').fadeOut();
						$('.formRight_update_crop').hide();
						$('.formRight_cancel_crop').hide();
						$('body,html').animate({scrollTop: 0}, 800);
						$('#uploadBtn span').text('Select File');
						$('#show_preview').show();

						$('#divImageFromWeb').show();
					});
					
					$('input[name=update_crop]').click(function(e){
						x = $('#x').val();
						y = $('#y').val();
						w = $('#w').val();
						h = $('#h').val();
						
						$('#preview_jcrop').fadeOut();
						$('.formRight_update_crop').hide();
						$('.formRight_cancel_crop').hide();
						
						$('#uploaderContainer span#filemsg').html('<span ><img src="'+ base_url + 'assets/frontend/images/skin/uploader.gif" alt="Uploading File..." /></span>');
						$('body,html').animate({scrollTop: 0}, 800);

						$('#show_preview').show();

						$('#divImageFromWeb').show();
						
						$.ajax({
							type:"POST",
							url:base_url+'frontend/all_ajax/permanent_upload/',
							data:"x="+ x +"&y="+ y +"&w="+ w +
								 "&h="+ h +"&filename="+ resp.result.filename +
								 "&real_width=" + real_width +
								 "&real_height="+real_height+"&pagetype="+pageType+"&image_dpi="+image_dpi,
							success: function(resp){
								var resp = $.parseJSON(resp);
								/*var previewImage = '<a style="display:none;" href="' + resp.result.file_url_large + '" class="lightbox_preview" title="Preview Foto">' +
									'<img alt="Preview Foto" height="30" src="'+ base_url +'/assets/backstage/images/icons/middlenav/image2.png" /></a>';*/
								var previewImage = '<a style="display:none;" href="' + resp.result.file_url_large + '" class="lightbox_preview" title="Preview Foto">' +
									'<img alt="Preview Foto" width="350" class="img-responsive" src="'+ resp.result.file_url_large +'" /></a>';
								$('#putit').html(previewImage).fadeIn();
								
								$('#fname_vlarge').val(resp.result.file_name_vlarge);					
								$('#fname_large').val(resp.result.file_name_large);
								$('#fname_medium').val(resp.result.file_name_medium);
								$('#fname_small').val(resp.result.file_name_small);
								$('#fname_vsmall').val(resp.result.file_name_vsmall);
								$('#uploadBtn span').text('Update File');
								 	
								$('a.lightbox_preview').fadeIn('slow').fancybox();				
							}
							
						})
					});

				}, 
				"json"
			);
    	});
    }

    /* Show message on success add items */
	if(typeof success_message != 'undefined'){if(success_message != ''){
		jAlert(success_message, "Pesan Notifikasi",function(){
			window.location = target_url;
		});
	}}

	/* Form validation */
	if($("#theform").length > 0) {
		$("#theform").validationEngine('attach',{validationEventTrigger:'submit',focusFirstField:true,autoHidePrompt:true,autoHideDelay:5000,promptPosition:'centerRight'});	
		if(typeof error_message != 'undefined') {if(error_message != ""){jAlert(error_message, "Pesan Kesalahan")}}
	}

	/*
	if($('.owncomment').length > 0) {
    	var tmpMaxHeight = 0;
    	$('.owncomment').each(function() { 
    		var height = $(this).outerHeight();
    		if(height > tmpMaxHeight) tmpMaxHeight = height;
    	});
    	$('.owncomment').outerHeight(tmpMaxHeight);
    }
    */
});