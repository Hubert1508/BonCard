<?php

$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];
$type = $_GET['type'];

$request = new RequestProcessing();
$controller = $request->processController($controller);
$response = $request->runAction($controller, $action, $id);

$responseObject = new ResponseProcessing();
if($type == 'string'){
	$responseObject->string($response);
}
else{
	$responseObject->json($response);
}

	/*****************************section one - request procesing/*******/

	class RequestProcessing{
		public function processController($controller){

			if ($controller == 'cards'){
				$objectCard = new CardsController();
			}

			if ($controller == 'users'){
				$objectCard = new UsersController();
			}
			return $objectCard;
		}

		public function runAction($controller, $action, $id){

			if ($action == 'create'){
				return $controller->create();
			}

			if ($action == 'read'){
				return $controller->read([
					'newid'=> $id
				]);
			}

			if ($action == 'update'){
				return $controller->update();
			}

			if ($action == 'delete'){
				return $controller->delete();
			}
		}
	}

	/*****************************section two - controllers/*******/

	class UsersController{
		public function create(){
			return ['status'=> true];
		}

		public function read($params){
			return $params['newid'];
			/*
				1) Odczytujemy użytkownika z bazy danych
			*/
		}

		public function update(){
			return 'update Users';
		}

		public function delete(){
			return 'delete Users';
			/*
				1) Usuwamy użytkownika z bazy danych
			*/
		}
	}

	class CardsController{
		public function create(){
			return 'add Cards';
		}

		public function read(){
			return 'show Cards';
		}

		public function update(){
			return 'update Cards';
		}

		public function delete(){
			return 'delete Cards';
		}
	}

/*****************************section three - response procesing/*******/


class ResponseProcessing{
	public function string($response){
		var_dump($response);
		exit();
	}
	public function json($response){
		echo json_encode($response);
		exit();
	}
}

 ?>
