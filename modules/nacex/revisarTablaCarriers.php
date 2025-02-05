<?php
include_once dirname(__FILE__) . "/nacexDAO.php";
include_once dirname(__FILE__) . "/nacex.php";

include_once dirname(__FILE__) . '/../../config/config.inc.php';

session_start();

if (isset($_POST['editarCarrier']) && $_POST['editarCarrier'] == 1) {

    $idCarrier = $_POST['idCarrier'];
    $is_module = $_POST['is_module'];
    $shipping_external = $_POST['shipping_external'];
    $external_module_name = $_POST['external_module_name'];
    $ncx = $_POST['ncx'];
    $tip_serv = $_POST['tip_serv'];

    $query = 'UPDATE ' . _DB_PREFIX_ . 'carrier ';
    $query .= 'SET is_module = ' . $is_module . ', shipping_external = ' . $shipping_external . ', external_module_name = "' . $external_module_name . '", ncx = "' . $ncx . '", tip_serv = "'. $tip_serv . '"';
    $query .= 'WHERE id_carrier =' . $idCarrier;
    $queryExec = Db::getInstance()->execute($query);

    if ($queryExec) echo "<div class=\"bootstrap\" style=\"margin-top:10px\"><div class=\"alert alert-success conf\" style=\"width:auto\">¡Fila editada!</div></div>";
    else echo "<div class=\"bootstrap\" style=\"margin-top:10px\"><div class=\"alert alert-danger conf\" style=\"width:auto\">Error al actualizar</div></div>";
} else {
    $campos = ["id_carrier", "name", "active", "is_module", "shipping_external", "external_module_name", "ncx", "tip_serv"];
    $nacex = new nacex();

    $query = 'SELECT ' . implode(',', $campos) . ' FROM ' . _DB_PREFIX_ . 'carrier WHERE ncx IS NOT NULL';
    $queryS = Db::getInstance()->ExecuteS('SELECT ' . implode(',', $campos) . ' FROM ' . _DB_PREFIX_ . 'carrier WHERE ncx IS NOT NULL');

    $html = getTableFromQuery($query, $queryS, $campos);


    echo $html;
}

function getTableFromQuery($query, $queryS, $campos)
{
    if (0 < sizeof($queryS)) {

        $html = '<table id="tableCarriers" class="grid-table js-grid-table table" style="padding: 2px; text-align: center;" data-query="' . $query . '"><thead class="thead-default"><tr class="column-headers ">';

        foreach ($campos as $campo) {
            $html .= "<th scope='col'><div class='ps-sortable-column' data-sort-col-name='" . $campo . "' data-sort-prefix='carrier'>
              <span role='columnheader'>$campo</span>
              <span role='button' class='ps-sort' aria-label='Ordenar por'></span>
            </div></th>";
        }
        $html .= '</tr></thead><tbody>';

        foreach ($queryS as $q) {
            $html .= '<tr>';
            for ($i = 0; $i < sizeof($q); $i++) {
                $campo = $campos[$i];
                $html .= "<td>$q[$campo]</td>";
            }
            $html .= '</tr>';
        }

        $html .= "</tbody></table>";

        $html .= "<div id='tableEditCarrier'>
            <span>
                <label>Carrier ID</label>
                <input type='number' id='edit_carrierId' name='edit_carrierId' />
            
                <label>is_module</label>
                <input type='number' id='edit_isModule' name='edit_isModule' />
            </span>";
        $html .= "<span>
                <label>shipping_external</label>
                <input type='number' id='edit_shihppingExternal' name='edit_shihppingExternal' />
                
                <label>external_module_name</label>
                <input type='text' id='edit_externalModuleName' name='edit_externalModuleName' />
            </span>";
        $html .= "<span>
                <label>ncx</label>
                <input type='text' id='edit_ncx' name='edit_ncx' />
                
                <label>tip_serv</label>
                <input type='text' id='edit_tip_serv' name='edit_tip_serv' />
            </span>";
        $html .= "<br>
                <input type='button' class='ncx_button green' value='Editar fila' onclick='javascript: editarFila();' />
            </div>";


    } else $html = "<div class=\"bootstrap\" style=\"margin-top:10px\"><div class=\"alert alert-danger conf\" style=\"width:auto\">No hay consultas satisfactorias</div></div>";

    return $html;
}

?>
