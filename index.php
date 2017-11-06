<!DOCTYPE html>
<html>
<head>
	<title>Batalla Naval</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<table>
		<form method="POST" action="index.php">
			<?php
				session_start();
				$filas = 10;
				$columnas = 10;
				$contador = 0;
				$casilla = [];
				$barcos = array(
					array(
						0 => '15',
						1 => '16',
						2 => '17'),
					array(
						0 => '51',
						1 => '41'
					));

				if (isset($_POST["casilla"])) {
					$casilla = $_POST["casilla"];
				}
				for ($i=0; $i < $filas+1; $i++) {
					echo "<tr>\n";
					for ($y=0; $y < $columnas+1; $y++) {
						if ((in_array($i.$y, $barcos[0]) || in_array($i.$y, $barcos[1])) && in_array($i.$y, $casilla)) {
							$color = "blue";
							$checked = "checked";
							$contador++;
						}
						elseif ((!in_array($i.$y, $barcos[0]) || !in_array($i.$y, $barcos[1])) && in_array($i.$y, $casilla)) {
							$color = "red";
							$checked = "checked";
						}
						else {
							$color = "";
							$checked = "";
						}
						if ($i==0 && $y==0) {
							echo "
								<td>
								</td>";
						}
						elseif ($i==0) {
							echo "
								<td>
									<p>$y</p>
								</td>";
						}
						elseif ($y==0) {
							echo "
								<td>
									<p>$i</p>
								</td>";
						}
						else {
							echo "
								<td style='background-color:$color'>
									<input class='casilla' $checked type='checkbox' name='casilla[]' value='$i$y'/>
								</td>";
						}
					}
					echo "</tr>";
				}
				if ($contador == sizeof($barcos[0]) + sizeof($barcos[1])) {
					session_destroy();
					echo "<h1>¡HAS GANADO!</h1>";
				}
				if (isset($_SESSION["fallos"])) {
					$_SESSION["fallos"] = $_SESSION["fallos"] + sizeof($casilla) - $contador;
				}
				else {
					$_SESSION["fallos"] = 0;
				}
			?>
			<input id="boton" type="submit" name="comprueba" value="Comprueba"/>
			<?php
				echo "<p id='fallos'>Fallos: ".$_SESSION["fallos"]."</p>";
			?>
		</form>
	</table>
</body>
</html>