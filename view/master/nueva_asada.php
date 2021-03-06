<div class="page-404 padding ptb-xs-40">
    <div class="container">

        <?php 
        
        function generarCodigo($longitud) {
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }

        
        if(isset($_GET['nuevo'])){
            foreach($_FILES as $file){
                $name = $file['name'];
                $name = str_replace(' ', '', $name);
                $name = explode('.', $name);
                $destino =  "uploads/logos_asadas/".generarCodigo(6).'.'.$name[1];
                copy($file['tmp_name'],$destino);
            }
             $querry = "     
             INSERT INTO `asada`(
                `nombre`, 
                `cedulaJuridica`, 
                `fechaFundacion`,
                `mision`, 
                `vision`, 
                `historia`, 
                `direccion`,
                `logo`,
                `horario`,
                `id_distrito`,
                redes,
                email,
                telefono
            ) VALUES (
                '".$_POST['nombre']."',
                '".$_POST['cedulaJuridica']."',
                '".$_POST['fechaFundacion']."',
                '".$_POST['mision']."',
                '".$_POST['vision']."',
                '".$_POST['historia']."',
                '".$_POST['direccion']."',
                '".$destino."',
                '".$_POST['horario']."',
                '".$_POST['id_distrito']."',
                '".$_POST['facebook']."',
                '".$_POST['email']."',
                '".$_POST['telefono']."'
            )
            ";
            mysqli_query($link,$querry);
            echo "<script>alert('Insertado con éxito');location.href='?pag=master/nueva_asada';</script>";
        }
        ?>
        <center><h1>Crear Asada</h1></center>
        <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal" enctype="multipart/form-data">       
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el nombre:</label>  
              <div class="col-md-4">
                  <input name="nombre" type="text" placeholder="Título" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Logo:</label>  
              <div class="col-md-4">
                  <input name="nombre" type="file" placeholder="Título" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione el distrito:</label>  
              <div class="col-md-4">
                  <select name="id_distrito"   id="select-beast"  required>
                    <option value="" selected>Seleccionar</option>
                    <?php 
                      $sth = mysqli_query($link,"SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                        }
                      ?>
                  </select>
                  <script>
                    $('#select-beast').selectize({
                        create: false,
                        sortField: 'text'
                    });
                  </script>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la dirección exacta:</label>  
              <div class="col-md-4">
                  <textarea name="direccion" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la cédula jurídica:</label>  
              <div class="col-md-4">
                  <input name="cedulaJuridica" id="cedula" type="text" placeholder="Cédula jurídica" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el correo:</label>  
              <div class="col-md-4">
                  <input name="email" type="email" placeholder="Correo electrónico" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione la fecha de fundación:</label>  
              <div class="col-md-4">
                  <input name="fechaFundacion" id="fecha" type="text" placeholder="DD/MM/AA" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">*Digité el número de teléfono:</label>  
              <div class="col-md-4">
                  <input name="telefono" id="numero" type="text" placeholder="Número de teléfono" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el horario:</label>  
              <div class="col-md-4">
                  <textarea name="horario" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digite el link de la página de Facebook:</label>  
              <div class="col-md-4">
                  <input name="facebook" type="text" placeholder="Link" class="form-control input-md">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digite la historia:</label>  
              <div class="col-md-4">
                  <textarea name="historia" class="form-control"></textarea>
              </div>
            </div>    
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digite la misión:</label>  
              <div class="col-md-4">
                  <textarea name="mision" class="form-control"></textarea>
              </div>
            </div>               
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digite la visión:</label>  
              <div class="col-md-4">
                  <textarea name="vision" class="form-control"></textarea>
                  
              </div>
            </div>

    
          <center><button class="btn btn-success" type="submit">Crear</button></center>
        </form>
        
        
<script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
         <script>
   
        var cleave = new Cleave('#cedula', {
            prefix: '',
            delimiter: '-',
            blocks: [1, 3, 6],
            uppercase: true
        });
        var cleave2 = new Cleave('#numero', {
            prefix: '',
            delimiter: '-',
            blocks: [4, 4],
            uppercase: true
        });
        var cleave3 = new Cleave('#fecha', {
            date: true,
            datePattern: ['d','m','Y']
        });
        
    </script>

    </div>
</div>
