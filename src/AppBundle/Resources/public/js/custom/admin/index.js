$(document).ready(function () {

    //Monta o gráfico de dispositivos
    var dataDevices = $('.devices-section').data("info");
    var totalMobile = 0;
    $.each(dataDevices, function() {
      if(this.name == "ANDROIDSDK"){
        $(".device-android").html(this.value);
        totalMobile+=parseInt(this.value);
      }
      if(this.name == "IOSSDK"){
        $(".device-ios").html(this.value);
        totalMobile+=parseInt(this.value);
      }
      if(this.name == "MOBILE"){
        totalMobile+=parseInt(this.value);
      }
      if(this.name == "DESKTOP"){
        $(".device-desktop").html(this.value);
      }
    });

    $(".device-mobile").html(totalMobile);

});
