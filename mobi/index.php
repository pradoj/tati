<?php
  // Copyright 2009 Google Inc. All Rights Reserved.
  $GA_ACCOUNT = "MO-23860787-1";
  //$GA_PIXEL = "/ga.php";
  $GA_PIXEL = "ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);
    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];
    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);
    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }
    $url .= "&guid=ON";
    return str_replace("&", "&amp;", $url);
  }
?>
<!DOCTYPE html>
<!--<html>-->
<html manifest="cache.appcache.php">
  <head>
    <script>
    if (window.applicationCache) {
    	applicationCache.addEventListener('updateready', function() {
	        if (confirm('Uma nova versão está disponível. Mostrar agora?')) {
            	window.location.reload();
        	}
    	});
	}
    </script>
    <meta charset="utf-8">
    <title>IMC para a Tati</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="shortcut icon" href="../Calculator.ico">
    <link rel="apple-touch-icon" href="../Calculator-64.png">
    <link rel="stylesheet" href="jquery.mobile/jquery.mobile.min.css" />
    <style type="text/css">
    </style>
    <script type="text/javascript" src="../js/libs/jquery-1.5.1.min.js"></script>
    <script src="jquery.mobile/jquery.mobile.min.js"></script>
    <script src="../js/libs/jquery.global.js"></script>
    <script src="../js/libs/jquery.glob.pt-BR.js"></script>
    <script type="text/javascript">
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
            //console.log('teste');
            $("#calcular").click(function(event){
                var altura = $.global.parseFloat($("#altura").val());
                var peso   = $.global.parseFloat($("#peso").val());
                var resultado = peso / (altura * altura);
                console.log(resultado);
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
    </script>
  </head>
  <body>
     <div data-role="page" data-theme="b" id="input">
        <div data-role="header">
          <h1>IMC para a Tati</h1>
          <p>Com proteção sobre o peso :0)</p>
        </div>
        <form data-role="content">
            <fieldset>
                <label for="altura">Altura em metros?</label><br />
                    <input id="altura" type="text" autofocus="autofocus" placeholder="Ex.: 1,50"><br />
                <label for="peso">Peso em quilos(protegido)</label><br />
                    <input id="peso" type="password" autofocus="autofocus" placeholder="Ex.: 200"><br />
                <p>
                    <a href="#output" id="calcular" data-role="button">Calcular IMC</a><br />
                </p>
            </fieldset>
        </form>
        <div data-role="footer">
            <p>(c) <?php echo date('Y');?> - <a href="http://rogeriopradoj.com">rogeriopradoj.com</a> - <a href="http://<?php echo $_SERVER['HTTP_HOST'];  ?>/contato/">Contato</a></p>
        </div>
    </div>


    <div data-role="page" data-theme="b" id="output">
        <div data-role="header">
          <a href="#input" data-rel="back">Voltar</a>
          <h1>IMC para a Tati</h1>
        </div>
        <div data-role="content">
            <p id="result"></p>
            <a href="#tabelaImc" data-rel="dialog" data-role="button" data-theme="a">Ver tabela IMC</a>
            <a href="#input" data-rel="back" data-role="button">Voltar</a>
        </div>
        <div data-role="footer">
            <p>(c) <?php echo date('Y');?> - <a href="http://rogeriopradoj.com">rogeriopradoj.com</a> - <a href="http://<?php echo $_SERVER['HTTP_HOST'];  ?>/contato/">Contato</a></p>
        </div>
    </div>

    <div data-role="page" data-theme="b" id="tabelaImc">
        <div data-role="header">
          <h1>IMC para a Tati</h1>
        </div>
        <div data-role="content">
            <table>
                <caption>Tabela IMC</caption>
                <tr>
                    <th>IMC</th>
                    <th>Classificação</th>
                </tr>
                <tr>
                    <th>Abaixo de 18,5</th>
                    <td>Subnutrição</td>
                </tr>
                <tr>
                    <th>Entre 18,6 e 24,9</th>
                    <td>Peso saudável</td>
                </tr>
                <tr>
                    <th>Entre 25 e 29,9</th>
                    <td>Sobrepeso</td>
                </tr>
                <tr>
                    <th>Entre 30 e 34,9</th>
                    <td>Obesidade grau 1</td>
                </tr>
                <tr>
                    <th>Entre 35 e 39,9</th>
                    <td>Obesidade grau 2</td>
                </tr>
                <tr>
                    <th>Acima de 40</th>
                    <td>Obesidade grau 3</td>
                </tr>
            </table>
        </div>
    </div>
    <?php
    $googleAnalyticsImageUrl = googleAnalyticsGetImageUrl();
    echo '<img alt ="" src="' . $googleAnalyticsImageUrl . '" />';?>
  </body>
</html>
