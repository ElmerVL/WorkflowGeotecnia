<?php
$filtro_trabajo = $_POST['diferenciador'];
echo $filtro_trabajo;
$id_proyecto = $_GET['i_p'];
header("Location: ../Vista/iuRegistroEnsayos.php?i_p=$id_proyecto&f_t=$filtro_trabajo");
