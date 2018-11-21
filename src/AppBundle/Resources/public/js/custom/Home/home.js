//Realiza o envio do formulário de lead através do botão
$( "#btn-email" ).click(function() {
  var $this = $(this);
  $this.button('loading');
  submitLeadForm();
  $this.button('reset');
});

//Realiza o envio do formulário de lead através da tecla enter no input
$('#email-lead').keydown(function( event ) {
  if ( event.which == 13 ) {
   submitLeadForm();
  }
});

//Realiza o envio do formulário
function submitLeadForm(){
  if($('#email-lead').val()!=""){

    var routeUrl = Routing.generate('home_create_lead');
  	$.post(routeUrl, {"email": $('#email-lead').val()}, function( data ) {
  		if (data.responseCode == 200) {
   			$('#email-lead').val('');
  			$('#span-retorno-texto').html(data.results);
  		}
  	});
  }
}

function modalPayment(){
	$('#myModal').show();
}

$(document).ready(function() {

	$(".open-item-modal").click(function(){
		//ajax
		$("div#divLoading").addClass("show");
		$("#matricula").addClass("btn btn-wait-course");
		$("#matricula2").addClass("fa fa-spinner fa-pulse");
		$("#message").html("Aguardando pagamento");
		$("#buttonmatricular").addClass("openitem");
		var routeUrl = '/sistema/web/matricula/curso';
		$.post(routeUrl,
	      { "courseId": $(this).data("id") },
	      function(data){
	        if(data.responseCode == 200) {
                $("div#divLoading").removeClass('show');
                $('#myModal').modal('show');
                $("#cartaoButton").attr("href", data.link);
                $("#boletoButton").attr("href", data.boleto);
	        }else if(data.responseCode == 400){
	            $("div#divLoading").removeClass('show');
	            alert('Seu pagamento está sendo processado...')
	        }

	      }
	    );
		
	})
	
	$(".openitem").click(function(){
		alert("Seu pagamento está sendo processado.");
		
	})
	
	$("#cartaoButton").click(function(){
		window.location.href = "/sistema/web/painel";
	})
	
	$("#boletoButton").click(function(){
	    window.location.href = "/sistema/web/painel";
	})
	
});
