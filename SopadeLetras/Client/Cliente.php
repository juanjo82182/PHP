<?php

// Configuración del cliente
$host = 'localhost';
$port = 5000;

// Crear un socket TCP/IP
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "Error al crear el socket: " . socket_strerror(socket_last_error()) . PHP_EOL;
    exit(1);
}

// Conectar al servidor
$result = socket_connect($socket, $host, $port);

if ($result === false) {
    echo "Error al conectar al servidor: " . socket_strerror(socket_last_error($socket)) . PHP_EOL;
    exit(1);
}

// Recibir la sopa de letras del servidor
$grid_data = socket_read($socket, 4096);

if ($grid_data === false) {
    echo "Error al recibir la sopa de letras: " . socket_strerror(socket_last_error($socket)) . PHP_EOL;
    exit(1);
}

// Recibir las palabras del servidor
$words_data = socket_read($socket, 4096);

if ($words_data === false) {
    echo "Error al recibir las palabras: " . socket_strerror(socket_last_error($socket)) . PHP_EOL;
    exit(1);
}

// Cerrar el socket
socket_close($socket);

// Decodificar los datos recibidos
$grid = json_decode($grid_data);
$words = json_decode($words_data);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sopa de Letras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../assets/img/palabra.png" />
    <link rel="stylesheet" href="../assets/css/sp.css"> 
   
</head>

<body>
    <div class="container mt-5">
    <div id="timer">Tiempo transcurrido: 0 minutos 0 segundos</div>
        <h1>Sopa de Letras</h1>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <?php foreach ($grid as $row) : ?>
                        <tr>
                            <?php foreach ($row as $cell) : ?>
                                <td><?php echo $cell; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="col-md-4">
                <h3>Palabras</h3>
                <ul class="list-group">
                    <?php foreach ($words as $index => $word) : ?>
                        <li id="word-<?php echo $index; ?>" class="list-group-item"><?php echo $word; ?></li>
                    <?php endforeach; ?>
                    <br>
                    <input id="show-words-btn" name="submit" value="Mostrar Palabras" src="../assets/img/revisar.png" type="image" style="width: 3rem;"> <input id="reload-words-btn" name="submit" value="Actualizar Sopa"  src="../assets/img/actualizar.png" type="image" style="width: 3rem;">
                    
                </ul>
            </div>
        </div>
        

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script>
           $(document).ready(function() {
    var selectedLetters = [];
    var currentIndex = 0;
    var wordCount = <?php echo count($words); ?>;
    var wordsToFind = <?php echo json_encode($words); ?>;
    var startTime;
    var timerInterval;

  

     // Iniciar el contador de tiempo
    function startTimer() {
        startTime = Date.now();
        timerInterval = setInterval(updateTimer, 1000);
    }

    // Detener el contador de tiempo
    function stopTimer() {
        clearInterval(timerInterval);
    }

    // Reiniciar el contador de tiempo
    function resetTimer() {
        stopTimer();
        startTimer();
    }

    // Actualizar el contador de tiempo
    function updateTimer() {
        var currentTime = Math.floor((Date.now() - startTime) / 1000);
        var minutes = Math.floor(currentTime / 60);
        var seconds = currentTime % 60;
        $("#timer").text("Tiempo transcurrido: " + minutes + " minutos " + seconds + " segundos");
    }

    // Marcar letra seleccionada
    $("table td").click(function() {
        var letter = $(this).text();

        // Reiniciar selección si la letra ya estaba seleccionada
        if ($(this).hasClass("selected")) {
            selectedLetters = [];
            $("table td.selected").removeClass("selected");
            $("table td").removeClass("highlight");
        }

        $(this).addClass("selected");
        selectedLetters.push(letter);

        // Verificar si las letras seleccionadas coinciden con alguna palabra
        var matchingWordIndex = findMatchingWordIndex(selectedLetters.join(""));

        if (matchingWordIndex !== -1) {
            var currentWord = $("#word-" + matchingWordIndex);
            currentWord.addClass("text-success");
            $("table td.selected").addClass("highlight");
            $("table td.selected").addClass("found"); // Agregar la clase "found" a las celdas seleccionadas
         
            
           // Comprobar si se han encontrado todas las palabras
           var foundWordsCount = $(".text-success").length;
            if (foundWordsCount === wordCount) {

                     
                setTimeout(function() {

                   // Detener el contador de tiempo
                     stopTimer();

                  // Mostrar mensaje de felicitaciones con el tiempo transcurrido
                   var currentTime = Math.floor((Date.now() - startTime) / 1000);
                   var minutes = Math.floor(currentTime / 60);
                   var seconds = currentTime % 60;

                    alert("¡Felicidades! Has encontrado todas las palabras. Tiempo: " + minutes + " minutos " + seconds + " segundos");
                   
                     // Reiniciar el contador de tiempo
                     resetTimer();

                     window.location.href = "../Controllers/redireccion.php";
                   

                }, 100);
              
            }

            // Reiniciar selección
            selectedLetters = [];
            $("table td.selected").removeClass("selected");
            $("table td").removeClass("highlight");
        }
    });

    // Verificar si la palabra completa se encuentra en la sopa de letras
    function checkWord(startCell, letters, startRow, startCol) {
        var wordLength = letters.length;
        var currentRow = startRow;
        var currentCol = startCol;

        for (var i = 0; i < wordLength; i++) {
            if (currentRow >= $("table tr").length || currentCol >= $("table tr:eq(" + currentRow + ") td").length) {
                return false;
            }

            var cell = $("table tr:eq(" + currentRow + ") td:eq(" + currentCol + ")");
            var cellText = cell.text();
            if (cellText !== letters[i]) {
                return false;
            }

            currentCol++;
        }

        return true;
    }

    // Buscar el índice de la palabra que coincide con las letras seleccionadas
    function findMatchingWordIndex(letters) {
        for (var i = 0; i < wordsToFind.length; i++) {
            if (wordsToFind[i] === letters) {
                return i;
            }
        }
        return -1;
    }

     // Mostrar todas las palabras de la sopa de letras
     $("#show-words-btn").on("mousedown", function() {
      
      

for (var i = 0; i < wordsToFind.length; i++) {
  var word = wordsToFind[i];
  var wordLength = word.length;

  for (var row = 0; row < $("table tr").length; row++) {
    for (var col = 0; col < $("table tr:eq(" + row + ") td").length; col++) {
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, 1, 0)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, 1, 0);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, 0, 1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, 0, 1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, 1, 1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, 1, 1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, -1, 1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, -1, 1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, 1, -1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, 1, -1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, -1, -1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, -1, -1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, 0, -1)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, 0, -1);
      }
      if (checkWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), word, -1, 0)) {
        markWord($("table tr:eq(" + row + ") td:eq(" + col + ")"), wordLength, -1, 0);
      }
    }
  }
}
     });  

     // Función auxiliar para verificar si la palabra completa se encuentra en la sopa de letras
function checkWord(startCell, word, rowStep, colStep) {
  var row = startCell.parent().index();
  var col = startCell.index();
  var wordLength = word.length;

  for (var i = 0; i < wordLength; i++) {

    // Verificar si el índice está fuera del rango de la tabla
    if (row < 0 || row >= $("table tr").length || col < 0 || col >= $("table tr:eq(" + row + ") td").length) {
      return false;
    }

    var cell = $("table tr:eq(" + row + ") td:eq(" + col + ")");
    var cellText = cell.text();

    // Verificar si la letra en la celda coincide con la letra de la palabra
    if (cellText !== word[i]) {
      return false;
    }

    row += rowStep;
    col += colStep;
  }

  return true;
}

// Función auxiliar para marcar la palabra encontrada en la sopa de letras
function markWord(startCell, wordLength, rowStep, colStep) {
  var row = startCell.parent().index();
  var col = startCell.index();

  for (var i = 0; i < wordLength; i++) {
    var cell = $("table tr:eq(" + row + ") td:eq(" + col + ")");
    cell.addClass("highlight");

    row += rowStep;
    col += colStep;
  }
}

    // Evento mouseup del botón
     $("#show-words-btn").on("mouseup", function() {
     
      $(".word").removeClass("text-success");
      $("table td").removeClass("highlight");
      
     });

     // Actualizar la sopa de letras
     $("#reload-words-btn").click(function() {
    window.location.href = "../Controllers/redireccion.php";
  });

  startTimer();
});
        </script>
    </div>
</body>

</html>