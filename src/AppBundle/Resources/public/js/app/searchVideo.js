$(document).ready(function(){

  initializeVideo();

  var videos = videosDataSet();

  videos.initialize();

  applyTypeahead(videos);

  removeVideo();
});

function initializeVideo(){
  var idVideo = $("#box-sambavideos").data("id-video");
  if($('.'+idVideo).val() != ""){
    var routeUrl = '/sistema/web/avaliable-videos-load-media';
    $.get(routeUrl, {"sv_video": $('.'+idVideo).val()},
        function(data) {
            console.log(data);
            if (data.responseCode == 200) {
              selectVideo(data.result);
            }else{
              console.log("Erro ao obter vídeo.");
            }
        });
  }
}

function videosDataSet(){
  var routeTypeaheadUrl = '/sistema/web/avaliable-videos-preview-typeahead'
  var videos = new Bloodhound({
   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
   queryTokenizer: Bloodhound.tokenizers.whitespace,
   limit: 1000,
   remote: {
       url: routeTypeaheadUrl,
       replace: function(url, query) {
           return url + "?q=" + query;
       }
   }
  });
  return videos;
}

function sugestionTemplate(data){
  var html = '<div class="ProfileCard u-cf Typeahead-suggestion Typeahead-selectable">';
  if(data.thumbs.length > 0){
    html += '<img class="ProfileCard-avatar" src="'+data.thumbs[0].url+'">';
  }
  html += '<div class="ProfileCard-details">'+
      '<div class="ProfileCard-realName">'+data.title+'</div>'+
      '<div class="ProfileCard-screenName"></div>'+
      '<div class="ProfileCard-description">'+(data.shortDescription==null?"":data.shortDescription)+'</div>'+
    '</div>'+
  '</div>';
  return html;
}

function emptyTemplate(){
  return '<div class="ProfileCard u-cf Typeahead-suggestion Typeahead-selectable">'+
    '<div>'+
      'Nenhum vídeo encontrado com os termos'+
    '</div>'+
  '</div>';
}

function selectVideo(video){
  var idVideo = $("#box-sambavideos").data("id-video");
  $('.'+idVideo).val(video.id);
  if(video.thumbs.length > 0){
    $(".sambavideo-image").attr("src", video.thumbs[0].url);  
  }
  $(".sambavideo-title").html(video.title);
  $("#box-sambavideos").show();

}

function applyTypeahead(videos){
  $('#video-query').typeahead(null, {
       name: 'videos',
       displayKey: 'title',
       limit: 1000,
       source: videos.ttAdapter(),
       templates: {
         suggestion: function(data){
             return sugestionTemplate(data);
         },
         empty: function(data){
             return emptyTemplate();
         },
       }
  }).on('typeahead:selected', function(event, selection) {
      selectVideo(selection);
      $(this).typeahead('val', '');
  });
}

function removeVideo(){
  var idVideo = $("#box-sambavideos").data("id-video");
  $("#remove-sambavideo").click(function(e){
    $("#box-sambavideos").hide();
    $('.'+idVideo).val("");
  });
}
