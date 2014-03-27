<?php

class MysqlConnection{
	
	private $pdo;
	
	/**
	 * Lista das maquinas em que o projeto roda, com a associação com 
	 * seu banco de dados.
	 * 
	 * Adicionar as máquinas nesta lista para definir o seu banco de 
	 * dados.
	 * 
	 * Quando a aplicação estiver em uma máquina não listada aqui, a 
	 * entrada "default" será usada (usualmente o servidor de produção). 
	 * 
	 */
	public static function corectDatabase(){
		$maquinaBanco = array(
			"default" => array(
				"name" => "test",
				"server" => "localhost",
				"user" => "test",
				"pwd" => "test",
				"database" => "test",
			),
		);
		
		// método para diferenciar máquinas linux
		$idMaquina = trim(shell_exec ("hostid"));
		//~ $thisMachineId .= trim(shell_exec ('pwd'));
		
		// carrega a configuração, se existir
		foreach ($maquinaBanco as $idMaquinaLista => $configuracao){
			if ( $idMaquina === $idMaquinaLista){
				return $configuracao;
			}
		}
		
		// default
		return $maquinaBanco["default"];
		
	}
	
	public static $configConstructor = array(
		"server_name" => "",
		"user" => "",
		"pwd" => "",
		"database" => "",
	);
	public function __construct ( $configConstructor = array() ){
		
		// se PHP Data Objects não estiver instalado
		if (!class_exists("PDO")){
			throw new ErrorException("Não é possível conectar: " . 
					"Não existe classe 'PDO' disponível.", 99, 99);
		}
		
		$server = self::corectDatabase();
		
		if ( $configConstructor == array() ){
			$configConstructor["server_name"] = $server['server'];
			$configConstructor["user"] = $server['user'];
			$configConstructor["pwd"] = $server['pwd'];
			$configConstructor["database"] = $server['database'];
		} else {
			
			switch ("") {
				case $configConstructor["server_name"]:{
					$configConstructor["server_name"] = $server['server'];
					break;
				}
				case $configConstructor["user"]:{
					$configConstructor["user"] = $server['user'];
					break;
				}
				case $configConstructor["pwd"]:{
					$configConstructor["pwd"] = $server['pwd'];
					break;
				}
				case $configConstructor["database"]:{
					$configConstructor["database"] = $server['database'];
					break;
				}
			}
			
		}
		
		try {
			$opt = array(
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => FALSE,
				);
			$this->pdo = new PDO(
					"mysql:host=".$configConstructor["server_name"]
						.";dbname=".$configConstructor["database"],
					$configConstructor["user"],
					$configConstructor["pwd"],
					$opt
			);
		} catch (Exception $e){
			echo "<p style='color: red;'>" . $e->getMessage() . "</p><br />";
			throw new PDOException( $e->getMessage(), $e->getCode() );
		}
		
	}
	
	public function pdoPrepareExecute( $sql, $param, $debug = false ){
		$query = $this->pdo->prepare($sql);
		
		if ($query == false) {
			throw new Exception(
				"Não foi possivel preparar a consulta ao banco de dados. "
				."(" . $pdo->errorCode() . ") " . $pdo->errorInfo());
		}
		
		$sucess = $query->execute( $param );
		
		if ($debug){
			$debug->log( $query );
		}
		
		if ($sucess != true) {
			throw new PDOException(
				"Não foi possivel consultar o banco de dados. "
				."(" . $this->pdo->errorCode() . ") " . $this->pdo->errorInfo());
		}
		
		return $query;
	}
	
	public function pdoPrepareExecuteGet( $sql, $param, $debug = false ){
		
		$query = $this->pdoPrepareExecute( $sql, $param, $debug );
		
		$query->setFetchMode( PDO::FETCH_ASSOC );
		$registros = $query->fetchAll();
		
		if ($debug){
			$debug->log( "\$registros" );
			$debug->log( $registros );
		}
		
		if ($registros != true){
			throw new Exception("Não foi possivel recuperar as informações "
					. "do banco de dados.");
		}
		
		return $registros;
	}
	
}

/*
 * MysqlConnection.php
 * 
 * Copyright 2014 Luís Puhl <luis@bolsista> at UNESP
 * 
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 * 
 * * Redistributions of source code must retain the above copyright
 *   notice, this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above
 *   copyright notice, this list of conditions and the following disclaimer
 *   in the documentation and/or other materials provided with the
 *   distribution.
 * * Neither the name of the unesp nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */
