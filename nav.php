<?php
// Detecta la página actual para marcar el enlace activo
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>
<nav>
    <a href="index.php" class="<?php echo ($pagina_actual == 'index.php') ? 'active' : ''; ?>">Inicio</a>
    <a href="la_seccion_para_poder_jugar.php" class="<?php echo ($pagina_actual == 'la_seccion_para_poder_jugar.php') ? 'active' : ''; ?>">Jugar</a>
    <a href="seccion_de_blog_.php" class="<?php echo ($pagina_actual == 'seccion_de_blog_.php') ? 'active' : ''; ?>">Blog</a>
    <a href="seccion_de_el_curso.php" class="<?php echo ($pagina_actual == 'seccion_de_el_curso.php') ? 'active' : ''; ?>">Curso</a>
    <a href="seccion_de_quienes_somos.php" class="<?php echo ($pagina_actual == 'seccion_de_quienes_somos.php') ? 'active' : ''; ?>">Quiénes Somos</a>
    <a href="seccion_de_cv.php" class="<?php echo ($pagina_actual == 'seccion_de_cv.php') ? 'active' : ''; ?>">CV</a>
    <a href="seccion_de_contacto.php" class="<?php echo ($pagina_actual == 'seccion_de_contacto.php') ? 'active' : ''; ?>">Formulario</a>
</nav>