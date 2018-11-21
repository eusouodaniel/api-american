
function uploadFile(){
	var file = $(":file")[0].files[0];
	$('#fileNameModal').text(file.name);
 	$('#confirm').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#enviar', function() {
            sendFile();
        });
}

function sendFile(){
	var file = $("#file")[0].files[0];

	var token = $('#sambaToken').val();
	var project = $('#projectId').val();
	var mediaId = null;

	var url = 'http://api.sambavideos.sambatech.com/v1/sambafiles/uploadMedia?access_token='+token;
	var formdata = new FormData();
	formdata.append("file", file);
	formdata.append("projectId", project);

	$(":file").filestyle('buttonText', 'Aguardando upload...');
	$(':file').prop("disabled", true);

	jQuery.ajax({
	    url: url,
	    data: formdata,
	    cache: false,
	    contentType: false,
	    processData: false,
	    type: 'POST',
	    success: function(data){
			$(data).find("media").each(function(){
				mediaId = $(this).attr("id");
				$('#video_sambaid').val(mediaId);
				$('#video_fileName').val(file.name);
				$('#fileNameSelected').text(file.name);
			});

			$(":file").filestyle('buttonText', 'Escolha o vídeo');
			$('#file').prop("disabled", false);
			$('#btnSalvar').prop("disabled",false);
	    }
	});
}