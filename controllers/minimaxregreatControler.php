<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];
$probability = false;


unset($data['funcion']);
$function($data);

function MiniMaxRegreat($data)
{
    if (!empty($data['name_alternative'])) {
        $names = $data['name_alternative'];
        $table = generateMatrixRegreat($data['data'], $names);
        foreach ($table['solutions'] as $key => $value) {
            $table['solutions'][] = $names[$value];
            unset($table['solutions'][$key]);
        }
    } else {
        $table = generateMatrixRegreat($data['data']);
    }
    echo json_encode($table);
}

function calcEMV($data, $probability)
{
    foreach ($data as $key => $value) {
        $sum = 0;
        foreach ($value as $key_col => $value_col) {
            $result = (float) $value_col * $probability[$key_col];
            $sum = $sum + $result;
        }
        $emv[$key] = $sum;
        $data[$key]['EMV'] = $sum;
    }
    return $emv;
}

function getNamesAlternatives($name_alternatives, $data_graphic)
{
    $balanced = $data_graphic['balanced'];
    for ($i = 0; $i < count($balanced); $i++) {
        foreach ($name_alternatives as $key => $value) {
            $new_balanced[$i] = $name_alternatives[$balanced[$i]];
        }
    }
    $data_graphic['balanced'] = $new_balanced;
    return $data_graphic;
}

function tableEmv($data)
{
    $headers_col = getHeaders($data['A1']);
    $table = "<table class='table'>";

    $table .= "<tr>";
    $table .= "<td> Alternatives Desicion </td>";
    foreach ($headers_col as $key => $value) {
        $table .= "<td> <h3> $value </h3> </td>";
    }
    $table .= "</tr>";
    foreach ($data as $key => $value) {
        $table .= "<tr>";
        $table .= "<td> $key </td>";
        foreach ($value as $key_col => $value_col) {
            $table .= "<td> $value_col </td>";
        }
        $table .= "</tr>";
    }
    $table .= "<table>";
    return $table;
}



function init0Array($data)
{
    $ceros = [];
    foreach ($data as $key => $value) {
        $ceros[$key] = 0;
    }
    return $ceros;
}


function getHeaders($data)
{
    foreach ($data as $key => $value) {
        $headers[] = $key;
    }
    return $headers;
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

function generateMatrixRegreat($data, $names = false)
{
    $columns = getColumns($data['Alternative1']);

    foreach ($columns as $key => $value) {
        $array_col[$value] = array_column($data, $value);
    }

    foreach ($array_col as $key => $value) {
        $maximos[$key] = max($value);
    }

    foreach ($data as $key => $value) {
        foreach ($value as $keycol => $valuecol) {
            $data[$key][$keycol] = $maximos[$keycol] - $valuecol;
        }
    }

    foreach ($data as $key => $value) {
        $maximo_regreat[$key] = max($value);
        foreach ($value as $keycol => $valuecol) {
            $data[$key]['maximo'] = $maximo_regreat[$key];
        }
    }
    $min = min($maximo_regreat);
    foreach ($maximo_regreat as $key => $value) {
        if ($min == $value) {
            $solutions[$key] = $key;
        }
    }
    if ($names !== false) {
        return generateTableMatrixRegreat($data, $solutions, $names);
    } else {
        return generateTableMatrixRegreat($data, $solutions);
    }
}

function generateTableMatrixRegreat($data, $solutions, $names = false)
{
    $headers = getHeaders($data['Alternative1']);
    $table = "<table class='table table-striped'>";
    $table .= "<thead><tr><th class='text-center bg-secondary text-white'><h3>Alternatives Desicion</h3></th>";
    foreach ($headers as $key => $value) {
        $table .= "<th scope='col' class='text-center bg-secondary text-white'><h3 class=text-center'>$value</h3></th>";
    }
    $table .= "</tr></head><tbody>";
    foreach ($data as $key => $value) {
        $table .= "<tr>";
        if ($names !== false) { 
            
            $table .= "<td><center><h4>".$names[$key]."</h4></center></td>";
            
        }else{
            $table .= "<td><h3><center>$key</center></h3></td>";
        }
        foreach ($value as $keycol => $valuecol) {
            $table .= "<td><center><h4>$valuecol</h4></center></td>";
        }
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    $table .= "</table>";
    return ['table' => $table, 'solutions' => $solutions];
}

function getColumns($data)
{
    foreach ($data as $key => $value) {
        $columns[] = $key;
    }
    return $columns;
}

function PayOffMatrix($data)
{
    if (!empty($data['alternative'])) {
        $alternatives_name = $data['alternative'];
    }
    $rows = $data['num_alterns'];
    $colums = $data['num_uncerts'];
    $table_form = '
    <script>
    $("#form_payoff_data").submit(function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "controllers/minimaxregreatControler.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            $("#matrix_minmaxregreat").html(data.table);
            let cadena = "";
            $.each(data.solutions, function (keyarr, value) {
                cadena += "<p>" + value + "</p><br>";
            });
            $("#alternatives_regreat").html(cadena);
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="MiniMaxRegreat">
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center bg-secondary text-white"><h3>Alternatives Desicion</h3></th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col" class="bg-secondary text-white">
                <h3 class="text-center">Evento' . $j . '</h3>
            </th>';
    }
    $table_form .= "</tr></thead><tbody>";


    for ($i = 1; $i < $rows + 1; $i++) {
        $table_form .= "
        <tr> 
            <td class='text-center'>";
        if (!empty($data['alternative'])) {
            $alternatives_name = $data['alternative'];
            $table_form .= "<h3>" . $alternatives_name[$i - 1] . "</h3></td>";
        } else {
            $table_form .= "<h3>Alternative" . $i . "</h3></td>";
        }
        for ($j = 1; $j < $colums + 1; $j++) {
            $table_form .= "
            <td>
                <div class='form-group'>
                    <input type='text' class='form-control' id='Alternative" . $i . "[U" . $j . "]' placeholder='Enter Number' name='data[Alternative" . $i . "][U" . $j . "]'>";
            if (!empty($data['alternative'])) {
                $table_form .= "<input type='hidden' class='form-control' id='name_alternative[Alternative" . $i . "]' name='name_alternative[Alternative" . $i . "]' value='" . $alternatives_name[$i - 1] . "'>";
            }
            $table_form .= "</div></td>";
        }
        $table_form .= "</tr>";
    }

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
