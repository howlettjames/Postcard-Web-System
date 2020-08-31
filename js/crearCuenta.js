$(document).ready(function(){
    $("#crearCuentaForm").validetta(
    {
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid: function(evnt)
        {
            evnt.preventDefault();
            var tipo = new Array("red", "blue");
            $.ajax({
                method: "POST",
                url: "./crearCuenta_ajax.php",
                // data: new FormData(this),
                data: new FormData($("#crearCuentaForm")[0]),
                contentType: false,
                processData: false,
                cache: false,
                success: function(respAX)
                {
                    let AX = JSON.parse(respAX);                    
                    $.alert({
                        title: "<h4>Worm</h4>",
                        icon: "fas fa-info fa-2x",
                        content: AX.msj,
                        type: tipo[AX.val],
                        onDestroy: function(){
                            if(AX.val == 1){
                                window.location.replace("./../index.html");
                            }
                        }
                    });
                }
            });
        }
    });
});