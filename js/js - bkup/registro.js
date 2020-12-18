function validate_email(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function check_data()
{
    var usr = $("#usr_reg").val();
    var pw = $("#pw_reg").val();
    var email = $("#email_reg").val();
    var resp = $("#resp_reg").val();
    var dir = $("#dir_reg").val();

    // Campos vacios
    if( pw=="" || usr=="" || email=="" || resp=="" || dir=="" )
    {
        alert("Debes completar todos los campos!");
        return false;
    }

    // Email correcto?
    if( !validate_email(email) )
    {
        $("#email").focus;
        alert("Email incorrecto!");
        return false;
    }

    // Las contrasenias no coinciden
    if( pw != $("#pw2_reg").val() )
    {
        $("#pw_reg").focus();
        alert("Las contraseñas no coinciden!");
        return false;
    }

    return true;
}

$(document).ready( function() {    
    $("#botonenviar").click( function() {
        if( check_data() ){
            var data_reg = $("#formdata").serialize();
            
            $("#formulario").fadeOut(500);

            $.ajax({
                data: data_reg,
                type: "POST",
                url: "checkin.php",
                success: function(data){
                    if( data == false )
                        $("#fracaso").delay(500).fadeIn("slow");
                    else
                        $("#exito").delay(500).fadeIn("slow");
                }
                error: function(jqXHR, textStatus, errorThrown) {
                    $("#fracaso").delay(500).fadeIn("slow");
                }
            });
        }
    });    
});