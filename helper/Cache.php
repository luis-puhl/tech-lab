<?php

if ( file_exists( "../boot.php" ) ){
	include_once( "../boot.php" );
}

class Cache {
	
	const SQL_CHECK = "
	SELECT
		NOW() - UPDATE_TIME AS updatetime
	FROM
		information_schema.tables
	WHERE
		TABLE_SCHEMA = :Pschema
		AND TABLE_NAME = :Ptable
	;";
	
	static public function getUpdateTime( $schema, $table ){
		$pdo = new MysqlConnection(  );
		
		$param = array( 
			"Pschema" => $schema,
			"Ptable" => $table,
		);
		
		$stm = $pdo->pdoPrepareExecute( self::SQL_CHECK, $param );
		
		$stm->setFetchMode(PDO::FETCH_ASSOC);
		$reg = $stm->fetchAll(PDO::FETCH_ASSOC);
		
		return (int) $reg[0]["updatetime"];
	}
	
}
