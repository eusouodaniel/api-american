$(document).ready(function(){
  availableVideosList();
});

function availableVideosList() {
    var routeUrl = Routing.generate('available_videos_preview');
    var id_media = $("#course_idMediaDegustacao").val();
    $.get(routeUrl, {"id_media": id_media},
        function(data) {
            if (data.responseCode == 200) {
              console.log("Vídeos obtidos com sucesso.");
              $("#box-videos").html(data.results);
            }else{
              console.log("Erro ao obter vídeos.");
            }
        });
}

function checkClick() {
  var idMedia = $('input[name=id_media_degustacao]:checked', '#formCourse').val();
  $('#course_idMediaDegustacao').val(idMedia);
}
