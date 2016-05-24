<?php
$d = $_GET['d'];
$a = $_GET['n'];
$ip = $_GET['ip'];
$tp = $_GET['tp'];
chown($a,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
$do = unlink("$d$a");

header("Location: ../Vista/iuRegistroResultados.php?i_p=$ip&t_p=$tp");