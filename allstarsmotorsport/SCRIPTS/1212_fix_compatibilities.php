<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getUkoocompat_compat_ids()
{
    $conn = getConn();

    /** SELECT FROM ps_ukoocompat_compat_criterion **/
    $sql = 'SELECT id_ukoocompat_compat 
            FROM `ps_ukoocompat_compat_criterion` 
            WHERE id_ukoocompat_filter = 4 
            AND id_ukoocompat_criterion IN (5, 9, 67, 106, 114, 234, 238, 240, 248, 259, 269, 277, 281, 282, 288, 301, 305, 317, 327, 462, 470, 472, 473, 479, 490, 663, 837, 839, 842)
            AND id_ukoocompat_compat IN (
                SELECT id_ukoocompat_compat 
                FROM `ps_ukoocompat_compat_criterion` 
                WHERE id_ukoocompat_filter = 3 
                AND id_ukoocompat_criterion IN (8, 20, 23, 30, 50, 59, 99, 105, 125, 128, 131, 133, 144, 146, 175, 201, 202, 258, 264, 265, 280, 284, 287, 289, 324, 822, 841)
                AND id_ukoocompat_compat IN (
                    SELECT id_ukoocompat_compat 
                    FROM `ps_ukoocompat_compat_criterion` 
                    WHERE id_ukoocompat_filter = 2
                    AND id_ukoocompat_criterion IN (7, 10, 26, 45, 51, 56, 93, 104, 115, 124, 132, 141, 147, 149, 158, 165, 182, 188, 192, 200, 267, 272, 838)
                    AND id_ukoocompat_compat IN (
                        SELECT id_ukoocompat_compat 
                        FROM `ps_ukoocompat_compat_criterion` 
                        WHERE id_ukoocompat_filter = 1
                        AND id_ukoocompat_criterion IN (25, 41, 55, 92, 103, 123, 177, 187, 196, 213)
                    )
                )
            )';

    $result = $conn->query($sql);

    $ids = '';
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $ids.= $row['id_ukoocompat_compat'] . ', ';

            $sql_delete = 'DELETE FROM ps_ukoocompat_compat_criterion WHERE id_ukoocompat_compat = ' . $row['id_ukoocompat_compat'];
            $conn->query($sql_delete);
        }
    }

}

ini_set('max_execution_time', 600);

$sql_delete = 'DELETE FROM `ps_ukoocompat_compat` 
                WHERE id_ukoocompat_compat IN (
                    SELECT id_ukoocompat_compat 
                    FROM `ps_ukoocompat_compat_criterion` 
                    WHERE id_ukoocompat_filter = 4 
                    AND id_ukoocompat_criterion IN (5, 9, 67, 106, 114, 234, 238, 240, 248, 259, 269, 277, 281, 282, 288, 301, 305, 317, 327, 462, 470, 472, 473, 479, 490, 663, 837, 839, 842)
                    AND id_ukoocompat_compat IN (
                        SELECT id_ukoocompat_compat 
                        FROM `ps_ukoocompat_compat_criterion` 
                        WHERE id_ukoocompat_filter = 3 
                        AND id_ukoocompat_criterion IN (8, 20, 23, 30, 50, 59, 99, 105, 125, 128, 131, 133, 144, 146, 175, 201, 202, 258, 264, 265, 280, 284, 287, 289, 324, 822, 841)
                        AND id_ukoocompat_compat IN (
                            SELECT id_ukoocompat_compat 
                            FROM `ps_ukoocompat_compat_criterion` 
                            WHERE id_ukoocompat_filter = 2
                            AND id_ukoocompat_criterion IN (7, 10, 26, 45, 51, 56, 93, 104, 115, 124, 132, 141, 147, 149, 158, 165, 182, 188, 192, 200, 267, 272, 838)
                            AND id_ukoocompat_compat IN (
                                SELECT id_ukoocompat_compat 
                                FROM `ps_ukoocompat_compat_criterion` 
                                WHERE id_ukoocompat_filter = 1
                                AND id_ukoocompat_criterion IN (25, 41, 55, 92, 103, 123, 177, 187, 196, 213)
                            )
                        )
                    )
                )';

$conn = getConn();
$conn->query($sql_delete);


getUkoocompat_compat_ids();