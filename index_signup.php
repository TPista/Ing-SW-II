<?php
	session_start();

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] == "Administrador" )
			header('Location: admin/');
		else if( $_SESSION['users']['usr_tipo_cuenta'] == "Cliente" )
			header('Location: cliente/');
	}

	function comboPais($index=-1)
    {
        $valores = array("Afghanistan", "Albania", "Argelia", "Alemania", "American Samoa", "Andorra", "Angola", "Anguilla", "Antartida", "Antigua y Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia-Herzegovina", "Botswana", "Bouvet Island", "Brasil", "Brit Ind Ocean Territory", "Brunei Darussalm", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Canary Islands", "Cape Verde", "Caymen Islands", "Central African Rep", "Chad", "Chile", "China", "Christmas Islands", "Cocos Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Croatia", "Cuba", "Chipre", "Dem Rep. of Korea", "Dinamarca", "Djibouti", "Dominica", "East Timor", "Ecuador", "Egipto", "El Salvador", "Eritrea", "España", "Estados Unidos de America", "Estonia", "Etiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "Francia", "Guiana Francesa", "Polynesia Francesa", "French So. Territories", "Gabon", "Gambia", "Georgia", "Ghana", "Gibraltar", "Guinea Equatorial", "Grecia", "Greenland", "Grenada", "Guadalupe", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Inglaterra", "Iran", "Iraq", "Ireland", "Islas Filipinas", "Israel", "Italia", "Ivory Coast", "Jamaica", "Japon", "Jordan", "Kazakhistan", "Kenia", "Kiribati", "Korea del Norte", "Kuwait", "Kyrqyzstan", "Laos", "Lativa", "Libano", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldivas", "Mali", "Malta", "Mariana Islands", "Marruecos", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montserrat", "Mozambique", "Myanmar", "Nambia", "Nauru", "Nepal", "Netherland Antilles", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue Island", "Norfolk Island", "Northern Mariana Island", "Norway", "OCE", "Oman", "Pacific Islands", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reino Unido", "Republica de Corea", "Republica Dominicana", "Reunion", "Romania", "Russian Federation", "Rwanda", "South Georgia Sandwich", "Saint Pierre Miguelon", "Samoa", "San Marino", "Sao Tomee and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierre Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somali Republic", "South Africa", "South Korea", "Sri Lanka", "St. Helena", "St. Kits-Nevis", "St. Lucia", "Sudan", "Suriname", "Svalbard Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tokeelau", "Tonga", "Trinidad Tobago", "Tunisia", "Turquia", "Turkmenistan", "Tuvalu", "Uganda", "Ukrania", "United Arab Emirates", "Uruguay", "US Minor Outlying Is.", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands: British", "Virgin Islands: US", "Western Sahara", "Western Samoa", "Yemen", "Yugoslavia", "Zaire", "Zambia", "Zimbabwe");
        $selected = "";
        for( $i = 0; $i < count($valores); $i++)
        {
            if( $index == $i )
                $selected = 'selected = "selected"';
            else
                $selected = "";
            echo '<option value="'.$valores[$i].'" '.$selected.'>'.$valores[$i].'</option>';
        }
    }

    function comboPreg($index=-1)
    {
        $valores = array("Cual es el nombre de mi madre?", "Cual es el nombre de mi mascota?", "Nombre de tu club favorito de futbol");
        $selected = "";
        for( $i = 0; $i < count($valores); $i++)
        {
            if( $index == $i )
                $selected = 'selected = "selected"';
            else
                $selected = "";
            echo '<option value="'.$valores[$i].'" '.$selected.'>'.$valores[$i].'</option>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<Title>Registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_signup.css">
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<ul class="navbar-nav m-auto">
			<a class="navbar-brand" href="./">CAPICA S.A</a>
		</ul>
	</nav>

	<div class="container">
		<h2>Registrarme</h2>

		<form id="formdata" class="was-validated" action="checkin.php" method="post">
		<table class="tabla" cellspacing="2" cellpadding="2">
			<tr>
				<td><hr><h3>Información</h3></td>
			</tr>
			<tr>
				<td>Usuario <span class="text-danger">*</span></td>
				<td><input type="text" name="user_reg" required placeholder="Ingresar Usuario"></td>
				<td>Email <span class="text-danger">*</span></td>
				<td><input type="email" id="email_reg" name="email_reg" required placeholder="Ingresar E-mail"></td>
			</tr>
			
			<tr>
				<td>Contraseña <span class="text-danger">*</span></td>
				<td><input type="password" id="pw_reg" name="pw_reg" required placeholder="Ingresar Contraseña"></td>
				<td>Confirmar Contraseña <span class="text-danger">*</span></td>
				<td><input type="password" id="pw2_reg" name="pw2_reg" required placeholder="Confirmar contraseña"></td>
			</tr>

			<tr>
				<td>Tipo de Cuenta</td>
				<td>
					<select name="reg_tipo_cuenta">
						<option value="Cliente">Cliente</option>
						<option value="Administrador">Administrador</option>
					</select>
				</td>

				<td>País <span class="text-danger">*</span></td>
				<td>
					<select name="pais_reg">
						<?php comboPais(10); ?>
                    </select>
				</td>
			</tr>

			<tr>
				<td>Dirección <span class="text-danger">*</span></td>
				<td>
					<input type="text" id="dir_reg" name="dir_reg" required placeholder="Ingresar Dirección">
				</td>
				<td>Código Postal <span class="text-danger">*</span></td>
				<td>
					<input type="number" id="dir_reg" name="cp_reg" required placeholder="Ingresar CP">
				</td>
			</tr>

			<tr>
				<td><br/><hr><h3>Seguridad</h3></td>
			</tr>

			<tr>
				<td>Pregunta </td>
				<td>
					<select name="preg_reg">
						<?php comboPreg(0); ?>
					</select>
				</td>
				<td>Respuesta <span class="text-danger">*</span></td>
				<td><input type="text" id="resp_reg" name="resp_reg" required placeholder="Respuesta"></td>
			</tr>
		</table>
		
		<br/>
			<input type="submit" id="botonenviar" value="Registrarme">
		</form>
		
		<p><b>Ya está registrado? <a href="./">Ingresar</a></b></p>
	</div>
</body>
</html>