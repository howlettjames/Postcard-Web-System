$(document).ready(function()
{
    $("#subirPostalForm").validetta(
    {
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid: function(evnt)
        {
            evnt.preventDefault();
            $.ajax({
            method: "POST",
            url: "./../pages/subir_postales_ajax.php",
            data: new FormData($("#subirPostalForm")[0]),
            contentType: false,
            processData: false,
            cache: false,
            success: function(respAX)
            {
                let AX = JSON.parse(respAX);
                
                let tipoAlerts = new Array("red", "blue");
                $.alert({
                    title: "<h4>WORM</h4>",
                    content: AX.msj,
                    icon: "fas fa-info fa-2x",
                    type: tipoAlerts[AX.val],
                    onDestroy: function()
                    {
                        if(AX.val == 1)
                            window.location.reload(true);
                    }
                });
            }    
            });
        }
    });
});