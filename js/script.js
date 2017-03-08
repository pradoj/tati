
$(document).ready(function() {
    var classificaImc = function(imc) {
        if ( imc < 18.5) {
            return 'Subnutrição';
        } else if ( 18.5 <= imc && imc < 25 ) {
            return 'Peso saudável';
        } else if ( 25 <= imc && imc < 30 ) {
            return 'Sobrepeso';
        } else if ( 30 <= imc && imc < 35 ) {
            return 'Obesidade grau 1';
        } else if ( 35 <= imc && imc < 40 ) {
            return 'Obesidade grau 2';
        } else if ( 40 <= imc ) {
            return 'Obesidade grau 3';
        }


    }
    $('#acao').focus();
    $("form").bind("submit", function(event) {
        event.preventDefault();
    });
    $.global.preferCulture("pt-BR");
    
    $("#calcular").click(function(event){
        var altura = $.global.parseFloat($("#altura").val());
        var peso   = $.global.parseFloat($("#peso").val());
        var resultado = peso / (altura * altura);
        
        $("#result").html(
            '<table>'
            + '<tr>'
                + '<th>' + 'Altura' + '</th>'
                + '<td>' + jQuery.global.format(altura, 'n2') + '</td>'
            + '</tr>'
            + '<tr>'
                + '<th>' + 'Peso' + '</th>'
                + '<td>' + '***' + '</td>'
            + '</tr>'
            + '<tr>'
                + '<th>' + 'IMC' + '</th>'
                + '<td>' + jQuery.global.format(resultado, "n2") + '</td>'
            + '</tr>'
            + '<tr>'
                + '<th>' + 'Classificação' + '</th>'
                + '<td>' + classificaImc(resultado) + '</td>'
            + '</tr>'
            + '</table>'
        );
    });
});