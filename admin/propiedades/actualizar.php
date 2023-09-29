<?php 
  use App\Propiedad;
  use Intervention\Image\ImageManagerStatic as Image;

  
   // Autentica usuario
  require '../../includes/app.php';
  

  estaAutenticado();

 
  // Validar la URL por ID válido
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if(!$id) {
    header('Location: /admin');
  }

  $propiedad = Propiedad::find($id);

  // Consulta vendedores en DB

  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  // Arreglo con mensaje de error
  $errores = Propiedad::getErrores();

   

  //Ejecuta el codigo despues deque el usuario envia el formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Asignar los atributos 
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    // Validacion
    $errores = $propiedad->validar();    

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];
        
    // Validación 
    $errores = $propiedad->validar();

    // Subida de archivos
    // Generar un nombre único
    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

    if($_FILES['propiedad']['tmp_name']['imagen']) {
      $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
      $propiedad->setImage($nombreImagen);
  }


    if(empty($errores)) {
      $propiedad->guardar()

      // Insertar en la base de datos
      $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '{$nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedores_id = ${vendedores_id} WHERE id = ${id} "; 

      // echo $query;

      $resultado = mysqli_query($db, $query);

      if($resultado) {

        // Redireccionar al usuario al  insertar correctamente 
        header('Location: /admin?resultado=2'); // Solo funciona si no hay codigo html anterior a esta linea

      }
    }
  }

  
  incluirTemplate('header');

?>  
    
    <main class="contenedor seccion">
      <h1>Actualizar propiedad</h1>

      <a href="/admin" class="boton boton-verde">Volver</a>

      <?php foreach($errores as $error): ?>
        <div class="alerta error">
          <?php echo $error; ?>
        </div>
      
      <?php endforeach; ?>

      <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

          <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php 
  incluirTemplate('footer');
?>