<?php
header('Content-Type: application/json');
$data = $_POST;

// echo $num_mayor = mayor($array_datas);
// header("Location: ../payoff.php?maximo=$num_mayor");
$function = $_POST['funcion'];

$function($_POST);
// sumarize($data);

function sumarize($data)
{
    $mayor_a = mayor($data['A']);
    $mayor_b = mayor($data['B']);
    matrixRegreat($mayor_a, $mayor_b, $data['A'], $data['B']);
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
    $table_form = '<form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="sumarize">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Alternatives Desicion</th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <h3 class="text-center">U' . $j . '</h3>
            </th>';
    }
    $table_form .= "</thead><tbody>";
    

    for ($i=1; $i < $rows+1 ; $i++) { 
        $table_form.= "
        <tr> 
            <td class='text-center'>
                <h3>alternative".$i."</h3>
                </td>";
        for ($j=1; $j < $colums+1 ; $j++) { 
            $table_form.="
            <td>
                <div class='form-group'>
                    <input type='text' class='form-control' id='A".$i."[U".$j."]' placeholder='Enter Number' name='A".$i."[U".$j."]'>
                </div>
            </td>";
        }
        $table_form.= "
        </tr>";
    }
    $table_form .= "
            </tbody>
        </table>
        </div>
        <div class='form-group'>
            <button type='submit' class='btn btn-primary'>Calcular</button>
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
