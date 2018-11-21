$(document).ready(function(){
  loadVideo();
  var route = Routing.generate('lesson_load_action', { courseId: $("#lessonPlayer").data('course-id'), id: $("#lessonPlayer").data('lesson-id')});
  $.ajax({ method: "PATCH", url: route });
});

function eventListener(player) {
    if (player.event == "onStart") {
        var route = Routing.generate('lesson_start_action', { courseId: $("#lessonPlayer").data('course-id'), id: $("#lessonPlayer").data('lesson-id')});
        $.ajax({ method: "PATCH", url: route });
    }
    if (player.event == "onFinish") {
        var route = Routing.generate('lesson_finish_action', { courseId: $("#lessonPlayer").data('course-id'), id: $("#lessonPlayer").data('lesson-id')});
        $.ajax({ method: "PATCH",
            url: route,
            success:function(data) {
                console.log(data);
                if (data.question > 0) {
                    $('#confirm-avaliacao-lesson').modal('show');
                    var question = Routing.generate('question_show');
                    $(".btn-avaliacao").attr("href", question +'/'+ data.course);
                }else{
                  $('#confirm-next-lesson').modal('show');
                }
            }
        });
    }
}

function loadVideo() {
    var player = new SambaPlayer("lessonPlayer", {
        height: 360,
        width: 600,
        ph: $("#lessonPlayer").data('player-hash'),
        m: $("#lessonPlayer").data('video-hash'),
        playerParams: {
            enableShare: true,
            wideScreen: true
        },
        events: {
            "*": "eventListener",
        }
    });
}
