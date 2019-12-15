<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];

unset($data['funcion']);
$function($data);

function getHeaders($data)
{
    foreach ($data['Alternative1'] as $keycol => $valuecol) {
        $headers[] = $keycol;
    }
    return $headers;
}

function encontrarMayores($data)
{
    $datost = " ";
    $datostr = " ";
   

    $headers = getHeaders($data);

    $datostr .= "<br>";
    $datost = '
    <div class="table-responsive">
    <table class="table">';

    $datost .= '<thead><tr>';
    foreach ($headers as $key => $value) {
        $datost .= ' <th scope="col" class="text-center">' . $value . ' </th>';
    }
    $datost .= ' <th scope="col" class="text-center">Minimo</th>';
    $datost .= '</tr></thead><tbody>';


    foreach ($data as $key => $value) {
        $datost .= "<tr>";
        foreach ($value as $keycol => $valuecol) {
            //echo" ";
            $datost .= "<td><center>$valuecol</center></td>";
        }
        $minimo= min($value);
        $minimos[]=$minimo;
        $datost .= "<td><center>$minimo</center></td>";
        $datost .= '</tr>';
    }

    $datost .= '
        </tbody>
       
    </table>                                                                                                                                                                                                                    
    </div>';
    echo json_encode(['datost'=>$datost,'minimo'=>max($minimos)]);
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
            url: "controllers/maximinController.php",
            data: $(this).serialize()
        }).done(function (data) {
            $("#matrix_max").html(data.datost);
            $("#minimo").html(data.minimo);
            console.log(data);
           
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="encontrarMayores">
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
           $table_form .="</div></td>";
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
    
