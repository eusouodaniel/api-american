$(document).ready(function(){
  availableVideosList();
});

function availableVideosList() {
    var routeUrl = Routing.generate('available_videos_lesson');
    var sv_video = $("#lesson_sv_video").val();
    $.post(routeUrl, {"sv_video": sv_video},
        function(data) {
            if (data.responseCode == 200) {
              console.log("Vídeos obtidos com sucesso.");
              $("#box-videos").html(data.results);
            }else{
              console.log("Erro ao obter vídeos.");
            }
        });
}
