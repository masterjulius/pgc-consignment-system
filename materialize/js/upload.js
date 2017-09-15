var httpLocation = window.location;
var base_url = httpLocation.protocol + "//" + httpLocation.host + "/" + httpLocation.pathname.split('/')[1] + '/';
var progressUrl = base_url + 'materialize/img/components/gif/progress.gif';
(function($){
	$(document).ready(function(e){
		upload.initialize();
	});
})(jQuery);

var	upload = {
	initialize:	function() {
		this.interact();
	},
	interact:	function() {
		this.onChange('#fileUpload');
	},
	onChange:	function(selector) {
		$(selector).on('change', function(e){
			var $this = $(this);
			var file = upload.getFileDetails($this);
			// ajax
			var url = $('#upload_ajax_url').attr('action');
			upload.asyncUploadFile('fileUpload',url);
		});
	},
	getFileDetails: function(self) {
		if ( self.val() != '' || self.val() != null ) {
			return self[0].files[0];
		}
	},
	asyncUploadFile:function(inputFileSelector,url) {
		var postData = new FormData();
		$.each($('#fileUpload')[0].files, function(i, file){
			postData.append('fileUpload',file);
		});
		$.ajax({
			url:url,
			type:'POST',
			data:postData,
			processData:false,
			contentType:false,
			beforeSend:function(xhr){
				$('#btn-fileUpload-trigger').attr('disabled',true);
				var str = '<img src="'+progressUrl+'" height="100" width="100" alt="" />';
				$('#cnsgnr-upload-file-details .col').html(str);
			},
			success:function(result,status,xhr){
				result = JSON.parse(result);
				upload.asyncReadDatas(result.upload_data,base_url);
			},
			complete:function(xhr,status){
				$('#btn-fileUpload-trigger').removeAttr('disabled');
			},
			error: function(xhr) {
				$('#btn-fileUpload-trigger').removeAttr('disabled');
				if (xhr.statusText != 'OK') {
					console.log("Error:"+xhr.responseText);
				}
			}
		});
	},
	asyncReadDatas:	function(arrayResults,url) {
		var orig_file_name = arrayResults.client_name,
			full_path = arrayResults.full_path;
		var postData = {'postFile':full_path};
		$.ajax({
			url:url + 'upload_controller/scan_excel_datas/',
			type:'POST',
			dataType:'json',
			data:postData,
			beforeSend:function(xhr){
				$('#btn-fileUpload-trigger').attr('disabled',true);
				var str = '<img src="'+progressUrl+'" height="100" width="100" alt="" />';
				$('#cnsgnr-upload-file-details .col').html(str);
			},
			success:function(result,status,xhr){
				$('#btn-fileUpload-trigger').removeAttr('disabled');
				console.log(result);
				var str = '<div class="row"><h6>File Name: <b>'+orig_file_name+'</b></h6></div>';
				str += '<div class="row"><button class="btn btn-large teal" id="btn-save-datas">SAVE</button> <button class="btn btn-large red" id="btn-cancel-datas">CANCEL</button></div>';
				str += '<div class="row"></div>';
				$('#cnsgnr-upload-file-details .col').html(str);
				upload.onSaveDatas('#btn-save-datas',result,url);
			},
			complete:function(xhr,status){
				$('#btn-fileUpload-trigger').removeAttr('disabled');
			},
			error: function(xhr) {
				$('#btn-fileUpload-trigger').removeAttr('disabled');
				if (xhr.statusText != 'OK') {
					console.log("Error:"+xhr.responseText);
				}
			}
		});
	},
	onSaveDatas:	function(selector,jsonDatas,url) {
		$(document).on('click', selector, function(e){
			upload.asyncSaveDatas(jsonDatas,url);
		});
	},
	asyncSaveDatas:	function(jsonDatas,url){
		var datas = {'jsonDatas':jsonDatas};
		$.ajax({
			xhr: function() {
			    var xhr = new window.XMLHttpRequest();

			    xhr.upload.addEventListener("progress", function(evt) {
			      	if (evt.lengthComputable) {
			        	var percentComplete = evt.loaded / evt.total;
			        	percentComplete = parseInt(percentComplete * 100);
			        	console.log(percentComplete);

			        	if (percentComplete === 100) {
			        		
			        	}

			      	}
			    }, false);

			    return xhr;
			},
			url:url + 'upload_controller/save_scanned_datas/',
			type:'POST',
			// dataType:'json',
			data:datas,
			beforeSend:function(xhr){
				// console.log(xhr);
			},
			success:function(result,status,xhr){
				console.log(result);
			},
			complete:function(xhr,status){

			},
			error: function(xhr) {
				console.log("Error:"+xhr.responseText);
			}
		});
	},
	// on cancel datas
	onCancelDatas: function(selector) {

	},
	asyncCancelDatas: function(file,url) {

	}
}