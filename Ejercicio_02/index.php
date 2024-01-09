<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Enunciado 2</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      height: 100vh;
      margin: 0;
    }

    #contenedor-general {
      text-align: left;
      padding-top: 20px;
    }

    .formulario-container {
      border: 2px solid black;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 10px;
      width: 300px; /* ajusta el ancho según sea necesario */
      margin: auto;
    }
  </style>
</head>
<body>

<div id="contenedor-general">
  <div id="menu">
    <h2>MENU</h2>
    <button onclick="mostrarRecuadro('opcion1')">1. Fibonacci</button>
    <hr>
    <button onclick="mostrarRecuadro('opcion2')">2. Cubo</button>
    <hr>
    <button onclick="mostrarRecuadro('opcion3')">3. Fraccionarios</button>
    <hr>
    <button onclick="salir()">Salir</button>
    <hr>
  </div>

  <div class="formulario-container">
    <div id="opcion1" style="display: none;">
      <h3>Opción 1: Fibonacci</h3>
      <form action="" method="post">
        <label for="numFibonacci">Ingrese un número para calcular los primeros números de Fibonacci (Entre 1 y 50): </label>
        <input type="number" name="numFibonacci" required min="1" max="50">
        <br>
        <input type="submit" value="Calcular Fibonacci">
      </form>
    </div>

    <div id="opcion2" style="display: none;">
      <h3>Opción 2: Cubo</h3>
      <form action="" method="post">
        <label for="maxCubo">Ingrese un número máximo para buscar los números que cumplen la condición: </label>
        <input type="number" name="maxCubo" required min="1" max="1000000">
        <br>
        <input type="submit" value="Buscar Números">
      </form>
    </div>

    <div id="opcion3" style="display: none;">
      <h3>Opción 3: Fraccionarios</h3>
      <form action="" method="post">
        <label for="numeradorA">Ingrese el numerador A: </label>
        <input type="number" name="numeradorA" required>
        <br>
        <label for="numeradorB">Ingrese el denominador B: </label>
        <input type="number" name="numeradorB" required>
        <br>
        <label for="numeradorC">Ingrese el numerador C: </label>
        <input type="number" name="numeradorC" required>
        <br>
        <label for="numeradorD">Ingrese el denominador D: </label>
        <input type="number" name="numeradorD" required>
        <br>
        <input type="submit" value="Calcular Expresión Matemática">
      </form>
    </div>
  </div>

  <div id="resultado">
    <!-- Aquí se mostrarán los resultados -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['numFibonacci'])) {
        $num = (int)$_POST['numFibonacci'];
        if ($num >= 1 && $num <= 50) {
          $resultado = calcularFibonacci($num);
          echo "Los primeros $num números de Fibonacci son: " . implode(', ', $resultado);
        } else {
          echo "Número fuera del rango permitido o inválido.";
        }
      } elseif (isset($_POST['maxCubo'])) {
        $maxCubo = (int)$_POST['maxCubo'];
        $resultado = buscarNumerosCubo($maxCubo);
        echo "Los números que cumplen la condición son: " . implode(', ', $resultado);
      } elseif (isset($_POST['numeradorA']) && isset($_POST['numeradorB']) && isset($_POST['numeradorC']) && isset($_POST['numeradorD'])) {
        $A = (int)$_POST['numeradorA'];
        $B = (int)$_POST['numeradorB'];
        $C = (int)$_POST['numeradorC'];
        $D = (int)$_POST['numeradorD'];
        $resultado = calcularExpresionMatematica($A, $B, $C, $D);
        echo "El resultado de la expresión A + B * C - D es: $resultado";
      }
    }

    function calcularFibonacci($N) {
      $fib = [1, 1];
      for ($i = 2; $i < $N; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
      }
      return $fib;
    }

    function buscarNumerosCubo($max) {
      $numerosCumplenCondicion = [];
      for ($i = 1; $i <= $max; $i++) {
        if ($i === calcularCuboDigitos($i)) {
          $numerosCumplenCondicion[] = $i;
        }
      }
      return $numerosCumplenCondicion;
    }

    function calcularCuboDigitos($num) {
      $digitos = str_split($num);
      $cuboDigitos = array_map(function ($digit) {
        return pow((int)$digit, 3);
      }, $digitos);
      return array_sum($cuboDigitos);
    }

    function calcularExpresionMatematica($A, $B, $C, $D) {
      return $A + $B * $C - $D;
    }
  ?>


    <script>
      function mostrarRecuadro(opcion) {
        resetearResultado();
        document.getElementById('opcion1').style.display = 'none';
        document.getElementById('opcion2').style.display = 'none';
        document.getElementById('opcion3').style.display = 'none';
        document.getElementById(opcion).style.display = 'block';
      }

      function salir() {
        resetearResultado();
        window.location.href = "../index.html";
      }

      function resetearResultado() {
        document.getElementById('resultado').innerHTML = "";
      }
    </script>
  </div>
</div>

</body>
</html>
