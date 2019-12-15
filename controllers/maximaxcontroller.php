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

    //$datostr .= "<br>";
    $datost = '
    <div class="table-responsive">
    <table class="table table-striped">';

    $datost .= '<thead h4 class="bg-secondary text-white"><tr>';
    $datost .= "<td><h4><center>Alternatives Decision</center></h3></td>";
    foreach ($headers as $key => $value) {
        $datost .= ' <th scope="col" class="text-center"><h4>' . $value . ' </h3></th>';
    }
    $datost .= ' <th scope="col" class="text-center"><h3>Maximum</h3></th>';
    $datost .= '</tr></thead><tbody>';

    foreach ($data as $key => $value) {
        $datost .= "<tr>";
        $datost .= "<td><h4><center>$key</center></h4></td>";
        foreach ($value as $keycol => $valuecol) {
            //echo" ";
            $datost .= "<td><h5><center>$valuecol</center></h5></td>";
           
        }
        $maximo = max($value);
        $maximos[$key] = $maximo;
        $datost .= "<td><h6><center>$maximo</center></h6></td>";
        $datost .= '</tr>';
    }

    $datost .= '
        </tbody>
       
    </table>                                                                                                                                                                                                                    
    </div>';
    $maximo_maximos = max($maximos);
    foreach ($maximos as $key => $value) {
        if($maximo_maximos == $value){
            $result_maximos[] = $key; 
        }
    }
    echo json_encode(['datost'=>$datost,'maximos'=>$result_maximos]);
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
            url: "controllers/maximaxController.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            $("#matrix_max").html(data.datost);
            let cadena = "";
            $.each(data.maximos, function (keyarr, value) {
                cadena += "<p>" + value + "</p>";
            });
            $("#maximo").html(cadena); 
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="encontrarMayores">
    <div class="table-responsive">
    <table class="table table-striped">
      <thead class="bg-secondary text-white" >
        <tr>
          <th  scope="col" class="text-center"><h4>Alternatives Decision</h4></th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <h4 class="text-center">U' . $j . '</h4>
            </th>';
    }
    $table_form .= "</thead><tbody>";


    for ($i = 1; $i < $rows + 1; $i++) {
        $table_form .= "
        <tr> 
            <td class='text-center'>
                <h4>Alternative" . $i . "</h4>
                </td>";
        for ($j = 1; $j < $colums + 1; $j++) {
            $table_form .= "
            <td>
                <div class='form-group'>
                    <input h4 type='text' class='form-control' id='Alternative" . $i . "[U" . $j . "]' placeholder='Enter Number' name='Alternative" . $i . "[U" . $j . "]'>
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
            <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Calculate</button>
        </div>
    </form>";
    echo json_encode($table_form);

}

    
