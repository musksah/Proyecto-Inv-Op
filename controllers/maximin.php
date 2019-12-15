<?php
header('Content-Type: application/json');
$data = $_POST;


// echo $num_mayor = mayor($array_datas);
// header("Location: ../payoff.php?maximo=$num_mayor");

// PayOffMatrix
$function = $_POST['funcion'];


unset($data['funcion']);

// llama la función PayOffMatrix
$function($data);
// sumarize($data);

function sumarize($data)
{
    // if($probability !== false){
    //     print_r($probability);
    //     calcEMV($data, $probability);
    // }
    encontrarMayores($data);
    // matrixRegreat($mayor_a, $mayor_b, $data['A'], $data['B']);
}

function calcEMV($data){
    print_r($data);
    $emv = [];
    foreach ($data as $key => $value) {
        $sum = 0;
        echo  '  ||  ';
        foreach ($value as $key_col => $value_col) {
            // echo ' '.$value_col.' <br>';
            $sum = $sum + $value_col;
            // echo ' ';
            // print_r($value_col);
            //    $sum =  $sum+($probability[$key_col]*$value_col);
        }
        echo  '  ||  '. var_dump($sum);
        
        // echo ' suma '.$sum;
        // $emv[$key]=$sum;
    }
    print_r($emv);
    
}

function encontrarMayores($data)
{
    $mayores = [];
    $index = [];
    foreach ($data as $key => $value_index) {
        foreach ($value_index as $key => $value) {
            $index[$key] = $key;
        }
    }
    foreach ($index as $key => $value) {
        $mayores_arr[$key] = array_column($data, $value);
    }
    foreach ($mayores_arr as $key => $value) {
        $mayores[$key] = mayor($value);
    }

    foreach ($data as $key => $value) {
        foreach ($value as $key_col => $value_col) {
            $result[$key][] = $mayores[$key_col] - $value_col;
        }
    }
    $table = "<div class='table-responsive'><table class='table'>";
    foreach ($result as $key => $value) {
        $table .= "<tr>";
        foreach ($value as $key_col => $value_col) {
            $table .= "<td>" . $value_col . "</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table></div>";
    echo json_encode($table);
}

function matrixRegreat($mayor_a, $mayor_b, $a, $b)
{
    $matrix_regreat = [];
    $cont = 0;
    foreach ($a as $key => $value) {
        $valueA = $mayor_a - $value;
        $valueB = $mayor_b - $b[$key];
        $matrix_regreat[$key][] = $valueA;
        $matrix_regreat[$key][] = $valueB;
        $cont++;
    }
    echo json_encode($matrix_regreat);
}



function PayOffMatrix($data)
{
    $rows = $data['num_alterns'];
    $colums = $data['num_uncerts'];
    $table_form = '
    <script>
    $("#form_payoff_data").submit(function (event) {
        event.preventDefault();
        debugger
        $.ajax({
            method: "POST",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            $("#matrix_regreat").html(data);
        });
    });
    </script>
    
    <form action="" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="sumarize">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center">Alternatives Desicion</th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <h3 class="text-center">U' . $j . '</h3>
            </th>';
    }
    $table_form .= "</thead><tbody>";


    for ($i = 1; $i < $rows + 1; $i++) {
        $table_form .= "
        <tr> 
            <td class='text-center'>
                <h3>alternative" . $i . "</h3>
                </td>";
        for ($j = 1; $j < $colums + 1; $j++) {
            $table_form .= "
            <td>
                <div class='form-group'>
                    <input type='text' class='form-control' id='A" . $i . "[U" . $j . "]' placeholder='Enter Number' name='A" . $i . "[U" . $j . "]'>
                </div>
            </td>";
        }
        $table_form .= "
        </tr>";
    }
    $table_form .= "<tr><td><h3 class='text-center'>Probability</h3></td>";
    for ($i = 1; $i < $colums + 1; $i++) {
        $table_form .= "<td>
        <div class='form-group'>
            <input type='text' class='form-control' id='P" . "[U" . $i . "]' placeholder='Enter Number' name='P" . "[U" . $i . "]'>
        </div>
        </td>";
    }
    $table_form .= "</tr>";
    $table_form .= "
            </tbody>
        </table>
        </div>
        <div class='form-group'>
            <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Calcular</button>
        </div>
    </form>";
    echo json_encode($table_form);
}

function mayor($data)
{
    $mayor = 0;
    foreach ($data as $key => $value) {
        if ($mayor < $value) {
            $mayor = $value;
        }
    }
    return $mayor;
}


