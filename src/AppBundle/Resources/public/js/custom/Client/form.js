$(document).ready(function() {
  //Aplica o date picker
  $('.date-picker').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: 'pt_BR',
    maxDate: new Date(),
  });

  $(".date-picker").mask("99/99/9999");
});
