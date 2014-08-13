<?php
$filtro = $_POST['filtro'];
echo $filtro;

header("Location: ../Vista/iuTablaProyectos.php?f=$filtro");