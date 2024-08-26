<?php

error_reporting(E_ALL);

include_once "/home/allstar1/public_html/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

function insert_data_into_ps_ukoocompat_compat($id_product){
    insert_data("INSERT INTO eu_ukoocompat_compat (id_product) VALUES ('" . $id_product . "')");
    return get_inserted_id('SELECT id_ukoocompat_compat FROM ps_ukoocompat_compat ORDER BY id_ukoocompat_compat DESC LIMIT 1', 'id_ukoocompat_compat')['id_ukoocompat_compat'];
}

function insert_data_into_ps_ukoocompat_compat_criterion($id_ukoocompat_compat, $id_ukoocompat_filter, $id_ikoocompat_criterion){   
    insert_data("INSERT INTO eu_ukoocompat_compat_criterion (id_ukoocompat_compat, id_ukoocompat_filter, id_ukoocompat_criterion) VALUES ('" . $id_ukoocompat_compat . "', '" . $id_ukoocompat_filter . "', '" . $id_ikoocompat_criterion . "')");
}

function get_id_ukoocompat_compat($id_product, $id_ukoocompat_criterion_1, $id_ukoocompat_criterion_2, $id_ukoocompat_criterion_3, $id_ukoocompat_criterion_4){
    
    $data['is_new'] = false;
    $sql = "SELECT * 
            FROM eu_ukoocompat_compat_criterion
            INNER JOIN eu_ukoocompat_compat
            ON eu_ukoocompat_compat_criterion.id_ukoocompat_compat = eu_ukoocompat_compat.id_ukoocompat_compat
            WHERE eu_ukoocompat_compat.id_ukoocompat_compat IN ( 
                                        SELECT id_ukoocompat_compat 
                                        FROM eu_ukoocompat_compat_criterion 
                                        WHERE id_ukoocompat_filter = 1 AND id_ukoocompat_criterion = " . $id_ukoocompat_criterion_1 . "
                                        )
            AND eu_ukoocompat_compat.id_ukoocompat_compat IN ( 
                                        SELECT id_ukoocompat_compat 
                                        FROM eu_ukoocompat_compat_criterion 
                                        WHERE id_ukoocompat_filter = 2 AND id_ukoocompat_criterion = " . $id_ukoocompat_criterion_2 . "
                                        )
            AND eu_ukoocompat_compat.id_ukoocompat_compat IN (
                                        SELECT id_ukoocompat_compat 
                                        FROM eu_ukoocompat_compat_criterion 
                                        WHERE id_ukoocompat_filter = 3 AND id_ukoocompat_criterion = " . $id_ukoocompat_criterion_3 . "
                                        )
            AND eu_ukoocompat_compat.id_ukoocompat_compat IN (
                                        SELECT id_ukoocompat_compat 
                                        FROM eu_ukoocompat_compat_criterion 
                                        WHERE id_ukoocompat_filter = 4 AND id_ukoocompat_criterion = " . $id_ukoocompat_criterion_4 . "
                                        )
            AND id_product=" . $id_product;
            
    $conn = getConn();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data['is_new'] = 0;
    } else {
        $data['is_new'] = 1;
        $data['id_ukoocompat_compat'] = insert_data_into_ps_ukoocompat_compat($id_product);
    }

    return (object)$data;
}

/** Monta o array de compatibilidades simplificado **/
function simple_compatibility($id_product, $select_1, $select_2, $select_3, $select_4){
    $compatibilities_filter['id_product']        = $id_product;
    $compatibilities_filter['id_filter_value_1'] = $select_1;
    $compatibilities_filter['id_filter_value_2'] = $select_2;
    $compatibilities_filter['id_filter_value_3'] = $select_3;
    $compatibilities_filter['id_filter_value_4'] = $select_4;
    return (object)$compatibilities_filter;
}
/** Monta o array de compatibilidades ultidimensional **/
function nested_compatibility($id_product, $select_1, $select_2, $select_3, $select_4){

    $conn = getConn();
    
    $nested = array();
    
    if ( ($select_4 == 0) && ($select_3 == 0) && ($select_2 == 0) && ($select_1 == 0) ){
        
        /** Create universal **/
        $result_1 = $conn->query( "SELECT id_ukoocompat_criterion, value FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=0 AND id_filter=1 GROUP BY id_ukoocompat_criterion" );
        if ($result_1->num_rows > 0){
            while ($row_1 = $result_1->fetch_assoc()) {
                $result_2 = $conn->query( "SELECT id_ukoocompat_criterion, value FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_1['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                if ($result_2->num_rows > 0){
                    while ($row_2 = $result_2->fetch_assoc()) {
                        $result_3 = $conn->query( "SELECT id_ukoocompat_criterion, value FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_2['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                        if ($result_3->num_rows > 0){
                            while ($row_3 = $result_3->fetch_assoc()) {
                                $result_4 = $conn->query( "SELECT id_ukoocompat_criterion, value FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_3['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                                if ($result_4->num_rows > 0){
                                    while ($row_4 = $result_4->fetch_assoc()){
        
                                        $nested[] = (object)[
                                            'id_product'        => $id_product,
                                            'id_filter_value_1' => $row_1['id_ukoocompat_criterion'],
                                            'id_filter_value_2' => $row_2['id_ukoocompat_criterion'],
                                            'id_filter_value_3' => $row_3['id_ukoocompat_criterion'],
                                            'id_filter_value_4' => $row_4['id_ukoocompat_criterion']
                                        ];
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }elseif ( ($select_4 == 0) && ($select_3 == 0) && ($select_2 == 0) ){
        
        /** Create for a specific brand **/
        $result_2 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $select_1 . " GROUP BY id_ukoocompat_criterion" );
        if ($result_2->num_rows > 0){
            while ($row_2 = $result_2->fetch_assoc()) {
                $result_3 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_2['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                if ($result_3->num_rows > 0){
                    while ($row_3 = $result_3->fetch_assoc()) {
                        $result_4 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_3['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                        if ($result_4->num_rows > 0){
                            while ($row_4 = $result_4->fetch_assoc()){

                                $nested[] = (object)[
                                    'id_product'        => $id_product,
                                    'id_filter_value_1' => $select_1,
                                    'id_filter_value_2' => $row_2['id_ukoocompat_criterion'],
                                    'id_filter_value_3' => $row_3['id_ukoocompat_criterion'],
                                    'id_filter_value_4' => $row_4['id_ukoocompat_criterion'],
                                ];
                                
                            }
                        }
                    }
                }
            }
        }

    }elseif ( ($select_4 == 0) && ($select_3 == 0) ) {

        /** Create for a specific model **/
        $result_3 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $select_2 . " GROUP BY id_ukoocompat_criterion" );
        if ($result_3->num_rows > 0){
            while ($row_3 = $result_3->fetch_assoc()) {
                $result_4 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $row_3['id_ukoocompat_criterion'] . " GROUP BY id_ukoocompat_criterion" );
                if ($result_4->num_rows > 0){
                    while ($row_4 = $result_4->fetch_assoc()){

                        $nested[] = (object)[
                            'id_product'        => $id_product,
                            'id_filter_value_1' => $select_1,
                            'id_filter_value_2' => $select_2,
                            'id_filter_value_3' => $row_3['id_ukoocompat_criterion'],
                            'id_filter_value_4' => $row_4['id_ukoocompat_criterion'],
                        ];
                        
                    }
                }
            }
        }

    }elseif ( ($select_4 == 0)) {

        /** Create for a specific type **/
        $result_4 = $conn->query( "SELECT id_ukoocompat_criterion FROM eu_ukoocompat_criterion_lang WHERE id_parent_item=" . $select_3 . " GROUP BY id_ukoocompat_criterion" );
        if ($result_4->num_rows > 0){
            while ($row_4 = $result_4->fetch_assoc()){

                $nested[] = (object)[
                    'id_product'        => $id_product,
                    'id_filter_value_1' => $select_1,
                    'id_filter_value_2' => $select_2,
                    'id_filter_value_3' => $select_3,
                    'id_filter_value_4' => $row_4['id_ukoocompat_criterion'],
                ];
                
            }
        }
                
    }
        
    return (object)$nested;
}

/** Devolve o array das compatibilidades **/
function get_compats($id_product, $select_1, $select_2, $select_3, $select_4){	
    if (($select_1 != 0) && ($select_2 != 0) && ($select_3 != 0) && ($select_4 != 0)) {
        return simple_compatibility($id_product, $select_1, $select_2, $select_3, $select_4);
    } else {
        return nested_compatibility($id_product, $select_1, $select_2, $select_3, $select_4);
    }
}

$conn = getConn();
$result_products = $conn->query( "SELECT id_product FROM ps_product WHERE universal=1" );

if ($result_products->num_rows > 0){
    while ($row = $result_products->fetch_assoc()) {

        $compats = (object)get_compats((int)$row['id_product'], 0, 0, 0, 0);
        $resposta = array();
        $some_compats_existe = 0;
        
        foreach ($compats As $k =>$compat) {						
            
            if ( !is_numeric($compat) ){			
                $new_compat = get_id_ukoocompat_compat( $compat->id_product, $compat->id_filter_value_1, $compat->id_filter_value_2, $compat->id_filter_value_3, $compat->id_filter_value_4 );			
                if ($new_compat->is_new) {				
                    insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 1, $compat->id_filter_value_1);				
                    insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 2, $compat->id_filter_value_2);				
                    insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 3, $compat->id_filter_value_3);				
                    insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 4, $compat->id_filter_value_4);			
                } else {				
                    $some_compats_existe++;	
                }		
                
            }else{		
        
                $new_compat = get_id_ukoocompat_compat( $compats->id_product, $compats->id_filter_value_1, $compats->id_filter_value_2, $compats->id_filter_value_3, $compats->id_filter_value_4 );
                
        		if ($new_compat->is_new) {
        			insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 1, $compats->id_filter_value_1);	
        			insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 2, $compats->id_filter_value_2);		
        			insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 3, $compats->id_filter_value_3);		
        			insert_data_into_ps_ukoocompat_compat_criterion($new_compat->id_ukoocompat_compat, 4, $compats->id_filter_value_4);		
        		} else {
        			$some_compats_existe++;
        		}		
            }
        }
    }
}

echo 'FIM!';
exit;
