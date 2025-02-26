<?php

   //Crear objeto SimpleXMLElement
   $Votaciones = simplexml_load_file('VotacionGobernador.xml');

   function  mostrar()
   {

    foreach ($GLOBALS['Votaciones']->departamento as $info) 
    {
     echo "<tr>";  
     echo "<td>$info->nombre</td>";
     echo "<td>$info->inscritos</td>";
     echo "<td>$info->partido1</td>";
     echo "<td>$info->partido2</td>";
     echo "<td>$info->partido3</td>";
     echo "<td>$info->blanco</td>";
     echo "</tr>";
    } 
    
   }

   function punto_uno()
   {
    $Partido1=0;
    $Partido2=0;
    $Partido3=0;
    foreach ($GLOBALS['Votaciones']->departamento as $partido) 
    {
        $Partido1=$Partido1 + $partido->partido1;
        $Partido2=$Partido2 + $partido->partido2;
        $Partido3=$Partido3 + $partido->partido3;
    }
 
    echo"Partido1= ".$Partido1;
    echo"<br>";
    echo"Partido2= ".$Partido2;
    echo"<br>";
    echo"Partido3= ".$Partido3;
   }

   function punto_dos(){

    $no_votantes=0;
    $abstencion=0;

    foreach ($GLOBALS['Votaciones']->departamento as $votos) 
    {
        $no_votantes=$votos->inscritos-($votos->partido1+$votos->partido2+$votos->partido3+$votos->blanco);
        $abstencion= $no_votantes / $votos->inscritos;
       
        echo"<p>$votos->nombre =".bcdiv($abstencion, '1', 2)." %</p>";

    }

   }
   function punto_tres($Region){
 

    foreach ($GLOBALS['Votaciones']->departamento as $info) 
    {
        
      if($info['region'] == $Region){

       
        echo "<tr>";  
        echo "<td>$info->nombre</td>";
        echo "<td>$info->inscritos</td>";
        echo "<td>$info->partido1</td>";
        echo "<td>$info->partido2</td>";
        echo "<td>$info->partido3</td>";
        echo "<td>$info->blanco</td>";
        echo "</tr>";
      }  
    
    }
    


   }

   function punto_cuatro($Region){
 

    foreach ($GLOBALS['Votaciones']->departamento as $info) 
    {
        
      if($info['region'] == $Region){

        
        echo "<p>".$info->nombre .'-'.strlen($info->nombre)."</p>";
       
      }  
    
    }


   }

   error_reporting(0);



?>
<!doctype html>

<html lang="en">

<head>
<link rel="shortcut icon" href="./img/colombia.png" />
  <title>Votaciones de Gobernadores en Colombia </title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
  <h1>Votaciones de Gobernadores Colombia</h1>
  </header>
  <main>
  <table class="table table-dark table-hover">
            <tr>
                <th scope="col">Departamentos</th>
                <th scope="col">Inscritos</th>
                <th scope="col">Partido1</th>
                <th scope="col">Partido2</th>
                <th scope="col">Partido3</th>
                <th scope="col">Blanco</th>
            </tr>
            <tr>
             
            <?php
            echo mostrar();
            ?>

              
            </tr> 
          </table>

  </main>
  <footer>
  <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Total de Votos Partido1,Partido2 y Partido3 en Colombia
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">

              <?php
            echo punto_uno();
            ?>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Porcentaje de Abstencion(no votantes)
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
               
               <?php
               punto_dos();
               ?>

              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Filtrar Informe Por Atributo "Caribe"
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
               
              <form method="POST" action="">
              <select class="form-select" aria-label="Default select example"  name="LISTA" >
              <option selected >Region</option>
                <option>Caribe</option>
               <option>Andina</option>
               <option>Pacifica</option>
               <option>Orinoquia</option>
              </select>

              <input type="submit" name="submit" value="Buscar">

              </form>

              <table class="table table-dark table-hover">
            <tr>
                <th scope="col">Departamentos</th>
                <th scope="col">Inscritos</th>
                <th scope="col">Partido1</th>
                <th scope="col">Partido2</th>
                <th scope="col">Partido3</th>
                <th scope="col">Blanco</th>
            </tr>
            <tr>
            <?php
                

              $xselect=$_POST['LISTA'];

              if($xselect == ""){
                echo punto_tres('Caribe');
              }
              if($xselect == "Caribe"){
                echo punto_tres('Caribe');
              }
              if($xselect == "Andina"){
                echo punto_tres('Andina');
              }
              if($xselect == "Pacifica"){
                echo punto_tres('Pacifica');
              }
              if($xselect == "Orinoquia"){
                echo punto_tres('Orinoquia');
              }

              ?>

              
            </tr> 
          </table>
             

              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Informe de Cantidad de letras por atributo "Andina"
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                
              <form method="POST" action="" >
              <select class="form-select" aria-label="Default select example"  name="LISTA1" >
              <option selected >Region</option>
                <option>Caribe</option>
               <option>Andina</option>
               <option>Pacifica</option>
               <option>Orinoquia</option>
              </select>

              <input type="submit" name="submit1" value="Buscar">

              </form>
            
              <p>
              <?php
               

              $xselect1=$_POST['LISTA1'];

              if($xselect1 == ""){
                echo punto_cuatro('Andina');
              }
              if($xselect1 == "Caribe"){
                echo punto_cuatro('Caribe');
              }
              if($xselect1 == "Andina"){
                echo punto_cuatro('Andina');
              }
              if($xselect1 == "Pacifica"){
                echo punto_cuatro('Pacifica');
              }
              if($xselect1 == "Orinoquia"){
                echo punto_cuatro('Orinoquia');
              }
            

              ?>
              </p>
              
                

              </div>
            </div>
          </div>
        </div>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
