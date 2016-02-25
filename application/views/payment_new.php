<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pagos con conekta</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Ejemplo de pago con conekta
                </div>
                <div class="panel-body ">
                    <form class="form-horizontal" action="<?php echo base_url('payment/create'); ?>" method="POST" id="card-form">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nombre del tarjetahabiente</label>
                            <div class="col-sm-8">
                                <input type="text" size="20" data-conekta="card[name]" class="form-control card"value="John Doe" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Número de tarjeta de crédito</label>
                            <div class="col-sm-8">
                                <input type="text" size="20" data-conekta="card[number]" class="form-control card" value="4242424242424242"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">CVC</label>
                            <div class="col-sm-8">
                                <input type="text" size="4" data-conekta="card[cvc]" class="form-control card" value="456"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Fecha de expiración (MM/AAAA)</label>
                            <div class="col-sm-3">
                                <input id="card_exp_mes" type="text" size="2" data-conekta="card[exp_month]" class="form-control card" value="12"/>
                            </div>
                            <div class="col-sm-1 text-center">
                                /
                            </div>
                            <div class="col-sm-4">
                                <input id="card_exp_anio" type="text" size="4" data-conekta="card[exp_year]" class="form-control card" value="2017"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-8 text-right">
                            <button id="btn-pay" type="submit" class="btn btn-primary right">¡Pagar ahora!</button>
                        </div>

                        <input id="card_token" type="hidden" class="form-control"/>
                    </form>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#card-form").submit(function(event) {
                    var form = $(this);
                    var errorResponseHandler, successResponseHandler;

                    var api = "<?php echo $this->config->item('conekta_api_key_public'); ?>";

                    // Previene hacer submit más de una vez
                    $("#btn-pay").prop("disabled", true);
                    $("#btn-pay").html('<em>Procesando...</em>');
                    /* Después de tener una respuesta exitosa, envía la información al servidor */

                    Conekta.setPublishableKey(api);

                    //COMENTADO A PROPOSITO PARA QUE NO VALIDE FECHA DE EXPIRACION
                    //if (Conekta.card.validateExpirationDate($("#card_exp_mes").val(), $("#card_exp_anio").val())) {
                    //    alert("Tarjeta expirada");
                    //    return false;
                    //}else{
                            Conekta.token.create(form, successResponseHandler, errorResponseHandler);
                    //}

                    successResponseHandler = function(token) {
                        var card="";
                        var str="";
                        $.each($("input:text.card"), function(){
                            card= card + "&"+$(this).data('conekta')+"="+ $(this).val();
                        });
                        str= str + "&token_id="+ token.id + card;

                        //
                        var card_brand= Conekta.card.getBrand($("#card_number").val());
                        str= str + "&card_brand="+ card_brand;

                        return $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('payment/create'); ?>',
                            data: str,
                            dataType: 'jsonp',
                            success: function(response){

                                if(response.charge != undefined){
                                    location.href= "<?php echo base_url('payment/find/'+response.charge.id); ?>"
                                }else{
                                    alert("Error al crear cargo");
                                }

                            }
                        });
                    };

                    /* Después de recibir un error */
                     errorResponseHandler = function(error) {
                            alert(error.message_to_purchaser);
                            return false;
                        };

                     return false;
                  });


            });
        </script>
    </body>
</html>