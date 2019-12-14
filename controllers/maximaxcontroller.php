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
    $datost .= ' <th scope="col" class="text-center">Máximo</th>';
    $datost .= '</tr></thead><tbody>';


    foreach ($data as $key => $value) {
        $datost .= "<tr>";
        foreach ($value as $keycol => $valuecol) {
            //echo" ";
            $datost .= "<td><center>$valuecol</center></td>";
        }
        $maximo = max($value);
        $maximos[]=$maximo;
        $datost .= "<td><center>$maximo</center></td>";
        $datost .= '</tr>';
    }

    $datost .= '
        </tbody>
       
    </table>                                                                                                                                                                                                                    
    </div>';
    echo json_encode(['datost'=>$datost,'maximo'=>max($maximos)]);
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
            url: "controllers/maximaxController.php",
            data: $(this).serialize()
        }).done(function (data) {
            $("#matrix_max").html(data.datost);
            $("#maximo").html(data.maximo);
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
