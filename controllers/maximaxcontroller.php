<?php

$array_datas = $_POST;

echo $num_mayor = mayor($array_datas);
header("Location: ../payoff.php?maximo=$num_mayor");

function mayor($array_datos){
    foreach ($array_datos as $key => $value) {
        $mayor = 0;
        if($mayor<$value){
            $mayor = $value;
        }
    }
    return $mayor;
}

?>