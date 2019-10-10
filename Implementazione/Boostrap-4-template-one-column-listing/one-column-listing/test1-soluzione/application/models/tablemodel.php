<?php

require_once 'database.php';

class TableModel
{
	public function getAllTypes()
	{
		$dbh = Database::getConnection();

		$sth = $dbh->prepare("SELECT distinct DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS");
		$sth->execute();
		$types = $sth->fetchAll(PDO::FETCH_NUM);
		return $types;
	}

	public function addTable($completeFields): bool
	{
		$tableName = $_SESSION['tableName'];
		$createString = "CREATE TABLE $tableName (";

		foreach ($completeFields as $singleField) {

			$createString .= implode(" ", $singleField);
			$createString .= ",";
		}
		$createString = substr_replace($createString, ")", -1);

		$dbh = Database::getConnection();

		try {

			$dbh->query($createString);
		} catch (Exception $e) {
			echo("Query: " . $createString);
			echo("<br>");
			echo("Messaggio: " . $e->getMessage());
			echo("<br>");
			echo("Codice: " . $e->getCode());
			return false;
		}
		return true;
	}
}
