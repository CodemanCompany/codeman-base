<?php

require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/../adodb5/conex.php' );

// Config

// DB table to use
$table = 'clients';
// Table's primary key
$primaryKey = 'id_client';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = [
	[
		'db'	=>	'`clients`.`id_client`',
		'dt'	=>	0,
		'field'	=>	'id_client',
		'as'	=>	'id_client',
	],
];

$sql_details = array(
	'user' => $user,
	'pass' => $pwd,
	'db'   => $db,
	'host' => $server
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* If you just want to use the basic configuration for DataTables with PHP
* server-side, there is no need to edit below this line.
*/
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/controllers/general/ssp.class.php' );

$joinQuery = "FROM `clients`";
$extraWhere = "";
$groupBy = "";
$having = "";
echo json_encode(
	SSP :: simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having ),
	JSON_PRETTY_PRINT
);