<?php

function calcularFactorial($num) {
    if ($num == 0 || $num == 1) {
        return 1;
    } else {
        return $num * calcularFactorial($num - 1);
    }
}

function esPrimo($num) {
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

function calcularSerie($numTerminos) {
    $resultado = 0;
    for ($i = 1; $i <= $numTerminos; $i++) {
        $termino = pow($i, 2) / calcularFactorial($i);
        if ($i % 2 == 0) {
            $resultado -= $termino;
        } else {
            $resultado += $termino;
        }
    }
    return $resultado;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Programa de Menú</title>
  <style>
    body {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    #contenedor {
      text-align: center;
      border: 2px solid #333;
      border-radius: 15px;
      padding: 20px;
      width: 300px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div id="contenedor">
  <h2>Menú ejercicio 01</h2>
  <button onclick="manejarOpcion('1')">1. FACTORIAL</button>
  <br><br>
  <button onclick="manejarOpcion('2')">2. PRIMO</button>
  <br><br>
  <button onclick="manejarOpcion('3')">3. SERIE MATEMÁTICA</button>
  <br><br>
  <button onclick="manejarOpcion('S')">S. SALIR</button>
  <br>

  <div id="resultado">
    <!-- Aquí se mostrarán los resultados -->
  </div>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['opcion'])) {
            $opcion = $_POST['opcion'];

            switch ($opcion) {
                case '1':
                    if (isset($_POST['numFactorial'])) {
                        $numFactorial = $_POST['numFactorial'];
                        echo "<p id='resultadoFinal'>El factorial de $numFactorial es: " . calcularFactorial($numFactorial) . "</p>";
                    }
                    break;

                case '2':
                    if (isset($_POST['numPrimo'])) {
                        $numPrimo = $_POST['numPrimo'];
                        $resultadoPrimo = esPrimo($numPrimo) ? " es primo." : " no es primo.";
                        echo "<p id='resultadoFinal'>$numPrimo $resultadoPrimo</p>";
                    }
                    break;

                case '3':
                    if (isset($_POST['numTerminos'])) {
                        $numTerminos = $_POST['numTerminos'];
                        echo "<p id='resultadoFinal'>El resultado de la serie es: " . calcularSerie($numTerminos) . "</p>";
                    }
                    break;
				case 'S':
                    // Redirigir a index.html
                    header("Location: index.html");
                    exit();
                    break;
            }
        }
    }
  ?>

  <script>
    function manejarOpcion(opcion) {
      switch (opcion) {
        case '1':
          let numFactorial = parseInt(prompt("Ingrese un número para calcular su factorial (Entre el 0 y el 10): "));
          if (numFactorial >= 0 && numFactorial <= 10) {
            document.getElementById('resultado').innerHTML = "<form id='formFactorial' method='post'><input type='hidden' name='opcion' value='1'><input type='hidden' name='numFactorial' value='" + numFactorial + "'></form>";
            document.getElementById('formFactorial').submit();
          } else {
            document.getElementById('resultado').innerHTML = "Número fuera del rango permitido.";
          }
          break;

        case '2':
          let numPrimo = parseInt(prompt("Ingrese un número para verificar si es primo: "));
          document.getElementById('resultado').innerHTML = "<form id='formPrimo' method='post'><input type='hidden' name='opcion' value='2'><input type='hidden' name='numPrimo' value='" + numPrimo + "'></form>";
          document.getElementById('formPrimo').submit();
          break;

        case '3':
          let numTerminos = parseInt(prompt("Ingrese la cantidad de términos para la serie matemática: "));
          document.getElementById('resultado').innerHTML = "<form id='formSerie' method='post'><input type='hidden' name='opcion' value='3'><input type='hidden' name='numTerminos' value='" + numTerminos + "'></form>";
          document.getElementById('formSerie').submit();
          break;

        case 'S':
          document.getElementById('resultado').innerHTML = "Saliendo del programa. Hasta luego!";
          // Esperar un segundo antes de redirigir
          setTimeout(function() {
            window.location.href = "../index.html";
          }, 1000);
          break;
      }
    }
  </script>
</div>

</body>
</html>
