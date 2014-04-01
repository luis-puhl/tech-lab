<?php

abstract class Model{
	
	// @Field
	public $id;
	
	private $config = array(
		"pdo" => null,
	);
	
	/* -------------------------------------------------------------------- */
	
	/*
	 * Estes métodos definem qual sql será executada atravéz dos métodos como 
	 * load() e loadAll()
	 */
	/**
	 * Gera uma string de SQL para ser usada pelo model.
	 * <p>
	 * 
	 * Gera uma string de consulta SQL com base em SQLparams para ser utilizada 
	 * no model para recuperar um ou mais registros do banco de dados.
	 * <p>
	 * 
	 * Deve conter uma clausula SELECT, uma FROM. Não deve ter clausula WHERE.
	 * 
	 *
	 * @param  SQLparams Parametros para construir as clausulas SELECT e FROM
	 * @return String com a consulta SQL.
	 */
	abstract protected function getSelectSQL( $SQLparams = array() );
	
	/**
	 * Gera uma string de SQL para ser usada pelo model com o mínimo de campos.
	 * <p>
	 *
	 * Gera uma string de consulta SQL com base em SQLparams para ser utilizada 
	 * no model para recuperar um ou mais registros do banco de dados.
	 * <p>
	 * 
	 * Deve conter uma clausula SELECT, uma FROM. Não deve ter clausula WHERE.
	 * <p>
	 * 
	 * Deve ter o mínimo possível de campos formando uma consulta leve;
	 * 
	 * @param  SQLparams Parametros para construir as clausulas SELECT e FROM
	 * @return String com a consulta SQL.
	 */
	abstract protected function getSelectShortSQL( $SQLparams = array() );
	
	
	/**
	 * Carrega do banco o registro com id igual à propriedade id deste objeto.
	 * <p>
	 *
	 * Gera uma string de consulta SQL com getSelectSQL e carrega os dados das
	 * colunas recuperadas nos campos públicos do objeto sendo que o id do 
	 * objeto seja igual ao id do regitro.
	 * <p>
	 * 
	 * Cria uma clausula WHERE com obj.id = :Pid e parametros Pid = this->id.
	 * <p>
	 * 
	 * @param  SQLparams Parametros para construir as clausulas SELECT e FROM
	 * @throws ErrorException se não existe classe 'PDO' disponível.
	 * @throws PDOException
	 * @return true.
	 */
	public function load( $SQLparams = array() ){
		$pdo = $this->getPdo();
		
		$sql = $this->getSelectSQL( $SQLparams );
		$sql .= "
WHERE
	`person`.`id` = :Pid
;";
		
		$param = array( "Pid" => $this->id );
		echo "<br>\nsql" . $sql . "\n<br>";
		
		$stm = $pdo->pdoPrepareExecute( $sql, $param );
		
		$stm->setFetchMode(PDO::FETCH_INTO, $this);
		$stm->fetch(PDO::FETCH_INTO);
		
		return true;
	}
	
	/**
	 * Carrega do banco o todos registros.
	 * <p>
	 *
	 * Gera uma string de consulta SQL com getSelectSQL e carrega os dados das
	 * colunas recuperadas nos campos públicos dos objetos sendo que o id do 
	 * objeto seja igual ao id do regitro.
	 * <p>
	 * 
	 * 
	 * @param  SQLparams Parametros para construir as clausulas SELECT e FROM
	 * @throws ErrorException se não existe classe 'PDO' disponível.
	 * @throws PDOException
	 * @return array Of ModelType.
	 */
	public function loadAll( $SQLparams = array() ){
		$pdo = $this->getPdo()->getPdo();
		
		$sql = $this->getSelectShortSQL( $SQLparams );
		$sql .= ";";
		$param = array(  );
		echo "<br>\nsql" . $sql . "\n<br>";
		
		$query = $pdo->prepare( $sql );
		
		if ($query == false) {
			throw new Exception(
				"Não foi possivel preparar a consulta ao banco de dados. "
				."(" . $pdo->errorCode() . ") " . $pdo->errorInfo() );
		}
		
		$stm = $query->execute( $param );
		
		if ($stm != true) {
			throw new PDOException(
				"Não foi possivel consultar o banco de dados. "
				."(" . $pdo->errorCode() . ") " . $pdo->errorInfo() );
		}
		
		$query->setFetchMode( PDO::FETCH_CLASS , get_class($this) );
		return $query->fetchAll( PDO::FETCH_CLASS );
	}
	
	/* -------------------------------------------------------------------- */
	
	/**
	 * @throws ErrorException se não existe classe 'PDO' disponível.
	 * @throws PDOException se não consegue conectar ao banco de dados.
	 */
	public function getPdo(){
		if ( !$this->config["pdo"] ){
			$pdo = new MysqlConnection(  );
			$this->config["pdo"] = $pdo;
		}
		return $this->config["pdo"];
	}
	public function setPdo( MysqlConnection $pdo ){
		$this->config["pdo"] = $pdo;
		return $this;
	}
	
	/* -------------------------------------------------------------------- */
	
	public function getFields(){
		$arr =  array();
		
		$reflector = new ReflectionClass( $this );
		$props = $reflector->getProperties( ReflectionProperty::IS_PUBLIC );
		
		foreach ($props as $prop){
			$fieldReflection = new ReflectionAnnotatedProperty( 
					$this, $prop->getName() );
			
			if ( $fieldReflection->hasAnnotation("Field") ){
				$arr[ $prop->getName() ] = $prop->getValue() ;
			}
		}
		return $arr;
	}
	
	public function __toArray(){
		$reflector = new ReflectionClass( $this );
		$props = $reflector->getProperties( ReflectionProperty::IS_PUBLIC );
		
		$arr = array();
		foreach ( $props as $prop ) {
			$arr[ $prop->getName() ] = $prop->getValue( $this );
		}
		
		return $arr;
	}
	public function __toString(){
		$props = $this->__toArray();
		$text = "";
		
		foreach ( $props as $prop => $value ) {
			$text .= $prop . ": " . $value . "\n";
		}
		
		return $text;
	}
	
	
	
}

/*
 * Model.php
 * 
 * Copyright 2014 Luís Puhl <luispuhl@gmail.com> at UNESP
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
