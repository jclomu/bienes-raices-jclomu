<?php 

require 'includes/app.php';


incluirTemplate('header');
?>  
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" loading="lazy" alt="Entrada">
        </picture>

        <p class="metadata">Escrito el: <span>20/10/2021</span>por: <span>Admin</span></p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed nisi neque est, unde aspernatur deserunt harum eaque nam dicta quisquam dolore. Harum laboriosam repellendus fugiat ratione quod doloribus. Dolore, a!</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed nisi neque est, unde aspernatur deserunt harum eaque nam dicta quisquam dolore. Harum laboriosam repellendus fugiat ratione quod doloribus. Dolore, a!</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed nisi neque est, unde aspernatur deserunt harum eaque nam dicta quisquam dolore. Harum laboriosam repellendus fugiat ratione quod doloribus. Dolore, a!</p>

    </main>

<?php 
  incluirTemplate('footer');
?>
