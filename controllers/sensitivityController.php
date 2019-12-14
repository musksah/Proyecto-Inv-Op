<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];
$probability = false;


unset($data['funcion']);
$function($data);

function sensitivityAnalisis($data)
{
    $data_graphic = dataGraphic($data);
    echo json_encode($data_graphic);
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

function dataGraphic($data)
{
    $headers_col = getHeaders($data['Alternative1']);
    unset($headers_col['EMV']);
    $prob = [];
    $probalities = [];
    for ($i = 0; $i < 11; $i++) {
        $pro = array();
        $prob1 = $i / 10;
        $probalities[] = $i / 10;
        $pro[] = $prob1;
        $pro[] = 1 - $prob1;
        foreach ($headers_col as $key_col => $value_col) {
            $prob[$value_col] = $pro[$key_col];
        }
        $emv_arr[] = calcEMV($data, $prob);
    }
    $arr_balanced = getAlternativeOver0($emv_arr);
    // Se arregla el array para la gráfica
    // print_r($emv_arr);
    // die;
    $cont = 0;
    foreach ($data as $key => $value) {
        $plot[$cont]['y'] = array_column($emv_arr, $key);
        $plot[$cont]['x'] = $probalities;
        $plot[$cont]['mode'] = "lines+markers";
        $plot[$cont]['name'] = $key;
        $cont++;
    }
    
    return ['plot' => $plot, 'balanced' => $arr_balanced['balanced_alternatives']];
}

function init0Array($data)
{
    $ceros = [];
    foreach ($data as $key => $value) {
        $ceros[$key] = 0;
    }
    return $ceros;
}
function getAlternativeOver0($data)
{
    $positive_arr = init0Array($data[0]);
    $negative_arr = init0Array($data[0]);
    foreach ($data as $key => $value) {
        foreach ($value as $key_col => $value_col) {
            if ($value_col > 0) {
                $positive_arr[$key_col] = $positive_arr[$key_col] + 1;
            }
            if ($value_col < 0) {
                $negative_arr[$key_col] = $negative_arr[$key_col] + 1;
            }
        }
    }
    $mayor_positive = max($positive_arr);
    // print_r($positive_arr);
    // print_r($mayor_positive);
    // die;
    foreach ($positive_arr as $key => $value) {
        if($value == $mayor_positive){
            $balanced_alternatives[] = $key;
        }
    }
    return ['positive' => $mayor_positive, 'negative' => $negative_arr,'balanced_alternatives'=>$balanced_alternatives];
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
        $.ajax({
            method: "POST",
            url: "controllers/sensitivityController.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            var layout = {};
            Plotly.newPlot("myDiv", data.plot, layout, { showSendToCloud: true });
            let texthtml = "";
            $.each( data.balanced, function( key, value ) {
                texthtml = texthtml + "<p>"+ value +"</p></br>";
            });
            $("#balanced_analisys").html(texthtml)
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="sensitivityAnalisis">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center">Alternatives Desicion</th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <h3 class="text-center">Evento' . $j . '</h3>
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
                    <input type='text' class='form-control' id='Alternative" . $i . "[U" . $j . "]' placeholder='Enter Number' name='Alternative" . $i . "[U" . $j . "]'>
                </div>
            </td>";
        }
        $table_form .= "
        </tr>";
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

function minor($data)
{
    $menor = 0;
    foreach ($data as $key => $value) {
        if ($menor < $value) {
            $menor = $value;
        }
    }
    return $menor;
}
