$(document).ready(function() {

    // Inicialização das tabelas
    initiateQuestionItens();

    // Adiciona novo item à tabela de serviços
    $("#item-add").click(function(e){
        e.preventDefault();
        addQuestionItem();
    });

    // Seta a função de exclusão nos itens da tabela de disponibilidade
    $("#questionitens-table tbody").children().each(function() {
        var questionitensItem = $(this).closest('tr.questionitens-item');
        removeQuestionItens(questionitensItem);
        validaQuestionItem(questionitensItem);

    });

});


/**
 * Função para inicializar o indice da tabela de serviços
 */
function initiateQuestionItens(){
    // Atualiza o indice do prototype com a quantidade de itens disponíveis
    $('#questionitens-table').attr('data-index-count', $(".questionitens-item").length);
}

/**
 * Método que adiciona um novo lote pago.
 */
function addQuestionItem() {
    var collectionHolder = $('#questionitens-table');
    var prototype = collectionHolder.attr('data-prototype');
    var count = collectionHolder.attr('data-index-count');
    var newForm = $(prototype.replace(/\_\_name\_\_/g, count));

    collectionHolder.find('tbody').append(newForm);
    collectionHolder.attr('data-index-count', ++count);

    // Adiciona a ação de remover o item
    removeQuestionItens(newForm);

    return newForm;
}

/**
 * Remove item da tabela de disponibilidade.
 */
function removeQuestionItens(questionitensItem){
    questionitensItem.find("a.questionitens-remove-item").click(function(e){
        e.preventDefault();
        var item = this;
        var title = $(this).data('confirm-title');
        var text = $(this).data('confirm-text');
        var line = $(item).closest('tr.questionitens-item');
        $(line).remove();

    });
}

/**
 * Valida se existem dias repetidos na tabela de disponibilidade
 */
function validaQuestionItem(questionitensItem){
    questionitensItem.find(".correct-answer").click(function(e){
        var idEscolhido = $(this).attr('id');
        if($(this).prop('checked')){
          $(".correct-answer").each(function( i ){
              if($(this).attr('id') != idEscolhido){
                  $(this).prop( "checked", false );
              }
          });
        }
    });
}
