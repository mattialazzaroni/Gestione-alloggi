<?php
session_start();

class Home
{
	public function index()
	{

		require_once 'application/views/index.php';
	}

	public function addTable()
	{
		require_once 'application/controller/validator.php';
		$validator = new Validator();
		$_SESSION['tableName'] = $validator->validateString($_POST['tableName']);
		$_SESSION['tableNumberFields'] = $validator->validateInt($_POST['tableNumberFields']);
		header('location: ' . URL . 'home/showTableFields');
	}

	public function showTableFields()
	{
		$tableNumberFields = $_SESSION['tableNumberFields'];
		require 'application/models/tablemodel.php';
		$tableModel = new TableModel();
		$types = $tableModel->getAllTypes();
		require_once 'application/views/tableFields.php';
	}

	public function addFields()
	{
		require_once 'application/controller/validator.php';
		$validator = new Validator();
		$completeFields = array();
		$singleField = array();

		for ($i = 0; $i < $_SESSION['tableNumberFields']; $i++) {

			$field = $validator->validateString($_POST['field'][$i]);
			$dataType = $validator->validateString($_POST['dataType'][$i]);
			$size = "(11)";
			if ($_POST['size'][$i] != '') {
				$validatedSize = $validator->validateInt($_POST['size'][$i]);
				$size = "(" . $validatedSize . ")";
			}
			$singleField = [$field, $dataType, $size];
			$completeFields[] = $singleField;
		}
		require 'application/models/tablemodel.php';
		$tableModel = new TableModel();
		if ($tableModel->addTable($completeFields)) {
			$mess = "Tabella aggiunta con successo";
			require_once 'application/views/success.php';
		}
	}


}
