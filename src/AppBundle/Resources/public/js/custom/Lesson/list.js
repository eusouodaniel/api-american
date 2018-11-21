$(document).ready(function(){

      $(".sortable").sortable({ opacity: 0.3, cursor: 'move', update: function() {
              var order = $(this).sortable("serialize");
              sortAjaxList(order);
          }
      });

});

function sortAjaxList(order) {
    var routeUrl = Routing.generate('lesson_sort_ajax_list');
    $.post(routeUrl, { "lesson_order": order },
        function(data) {
            if (data.responseCode == 200) {
              console.log("Ordenação realizada com sucesso.");
            }else{
              console.log("Erro ao realizar ordenação.");
            }
        });
}
