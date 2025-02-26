<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>    
<xsl:template match="/">

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/> 
        <link rel="shortcut icon" href="./img/colombia.png" />
        <title>
            Votaciones de Gobernadores en Colombia 
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"/>
      </head>
      
      <body>
        <xsl:apply-templates select="votaciones"/> 
      </body>
</html>

</xsl:template>

   <xsl:template match="votaciones">

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
              <xsl:for-each select="//departamento">
            
                <tr>
                  <td><xsl:value-of select="nombre"/></td>
                  <td><xsl:value-of select="inscritos"/></td>
                  <td><xsl:value-of select="partido1"/></td>
                  <td><xsl:value-of select="partido2"/></td>
                  <td><xsl:value-of select="partido3"/></td>
                  <td><xsl:value-of select="blanco"/></td>
                </tr>

              </xsl:for-each>
              
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

              <p>Partido1= <xsl:value-of select="sum(departamento/partido1)"/></p>
              <p>Partido2= <xsl:value-of select="sum(departamento/partido2)"/></p>
              <p>Partido3= <xsl:value-of select="sum(departamento/partido3)"/></p>

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
               
                <xsl:for-each select="//departamento">
            
                  <xsl:variable name="abstencion" select="partido1+partido2+partido3+blanco"/>
                  <p><xsl:value-of select="nombre"/> = <xsl:value-of select="(inscritos - $abstencion) div inscritos"/> %</p>
                  
              </xsl:for-each>

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
                    <xsl:for-each select="//departamento[@region='Caribe']">
                  
                      <tr>
                        <td><xsl:value-of select="nombre"/></td>
                        <td><xsl:value-of select="inscritos"/></td>
                        <td><xsl:value-of select="partido1"/></td>
                        <td><xsl:value-of select="partido2"/></td>
                        <td><xsl:value-of select="partido3"/></td>
                        <td><xsl:value-of select="blanco"/></td>
                      </tr>
      
                    </xsl:for-each>
                    
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
               
                <xsl:for-each select="//departamento[@region='Andina']">
                  
                     
                        <p><xsl:value-of select="nombre"/></p>
                        
                        <p><xsl:value-of select="string-length(./nombre)"/></p>
                     
                    </xsl:for-each>

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
      
    
 </xsl:template>

</xsl:stylesheet>