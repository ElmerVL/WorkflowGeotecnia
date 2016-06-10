<?php
$d = $_GET['d'];
$a = $_GET['n'];
$ip = $_GET['ip'];
$tp = $_GET['tp'];
echo $a;
chown($a,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
$do = unlink("$d$a");

if($_GET['i_f'] == 1){
    header("Location: ../Vista/iuRegistroInformeFinal.php?i_p=$ip&t_p=$tp");
} else {
    header("Location: ../Vista/iuRegistroResultados.php?i_p=$ip&t_p=$tp");
}