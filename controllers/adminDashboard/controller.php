<?php

namespace adminDashboard;

class AdminDashboard extends \Controller
{

	private $components = [];
	private $tree_components = [];

	public $access = [
		'*' => ['Admin']
	];

	public function __construct()
	{
		parent::__construct();
	}


	public function Index()
	{
		$rows = \Connect::get_content('postdata', ['*'], 'name');
		return $this->Views->render('index', [
			'data' => $this->renderLevelComponents($rows),
		]);
	}

	private function renderLevelComponents($rows)
	{
		$components = [];
		foreach ($rows as $row) {
			$parent_ids = explode(".", $row->tree_key);
			if (is_array($parent_ids)) {
				$parent_id = end($parent_ids);
			} else {
				$parent_id = $parent_ids;
			}
			$components[$parent_id][] = $row;
		}
		return $components;
	}


	public function formvalidation($data)
	{
		foreach ($data as $value) {
			if (!filter_input(INPUT_POST, $value)) {
				return true;
			}
		}
		return false;
	}

	private function renderView($row, $res)
	{
		
		$rows = \Connect::get_content('postdata', ['*'], 'name');
		if (\Sfn::status($res)) {
			return $this->Views->render('index', [
				'status' => 'success',
				'anchorid' => array_key_first(explode(".", $row['tree_key'])),
				'message' => $res['message'] . ' <stong>' . $row['name'] . '<br>' . $row['description'] . '</stong>',
				'data' => $this->renderLevelComponents($rows),
			]);
		} else {
			return $this->Views->render('index', [
				'status' => 'error',
				'anchorid' => array_key_first(explode(".", $row['tree_key'])),
				'message' => $res['message'] . ' <br><strong> name: ' . $row['name'] . '<br>' . $row['description'] . '</strong>',
				'data' => $this->renderLevelComponents($rows),
			]);
		}
	}

	public function removeItem()
	{
		$rows = \Connect::get_content('postdata', ['*'], 'name');
		$must_be = ['id'];
		if ($this->formvalidation($must_be)) {
			return $this->Views->render('index', [
				'status' => 'error',
				'anchorid' => array_key_first(explode(".", filter_input(INPUT_POST, 'tree_key'))),
				'message' => 'Непраильно заполненая форма',
				'data' => $this->renderLevelComponents($rows),
			]);
		}

		$db = \Connect::_self()->mysql();
		$row = [
			'tree_key'=> filter_input(INPUT_POST, 'tree_key'),
			'name'=>filter_input(INPUT_POST, 'name'),
			'description'=>filter_input(INPUT_POST, 'description')
		];
		try {
			$sth = $db->prepare("DELETE FROM postdata WHERE id=:id OR tree_key LIKE(:tree_key) ");
			$sth->bindParam(":id", ...[filter_input(INPUT_POST, 'id'), \PDO::PARAM_INT]);
			$sth->bindParam(":tree_key", ...[filter_input(INPUT_POST, 'id'), \PDO::PARAM_STR]);
			$sth->execute();

			if ($sth->RowCount() >= 1) {
				return $this->renderView($row, \Sfn::message(true, 'запись удалена'));
				
			} else {
				return $this->renderView($row, \Sfn::message(false, 'отсутствует запись ?!!' . filter_input(INPUT_POST, 'id')));
			}
		} catch (\PDOException $e) {
			return \Sfn::message(false, $e->getLine() . ' -:- ' . $e->getMessage());
		}
	}

	public function updateItem()
	{
		$rows = \Connect::get_content('postdata', ['*'], 'name');

		$must_be = ['name', 'id'];
		if ($this->formvalidation($must_be)) {
			return $this->Views->render('index', [
				'status' => 'error',
				'anchorid' => array_key_first(explode(".", filter_input(INPUT_POST, 'tree_key'))),
				'message' => 'Непраильно заполненая форма',
				'data' => $this->renderLevelComponents($rows),
			]);
		}

		$row = [
			'id' => filter_input(INPUT_POST, 'id'),
			'tree_key' => filter_input(INPUT_POST, 'tree_key'),
			'name' => htmlentities(filter_input(INPUT_POST, 'name')),
			'description' => htmlentities(filter_input(INPUT_POST, 'description')),
			'update_at' => time(),
			'delete_at' => NULL
		];

		$result = \Connect::update_row('postdata', $row);
		return $this->renderView($row, $result);
	}

	public function addItem()
	{
		if (!$name = filter_input(INPUT_POST, 'name')) {
			$rows = \Connect::get_content('postdata', ['*'], 'name');
			return $this->Views->render('index', [
				'status' => 'error',
				'anchorid' => array_key_first(explode(".", filter_input(INPUT_POST, 'tree_key'))),
				'message' => 'Непраильно заполненая форма',
				'data' => $this->renderLevelComponents($rows),
			]);
		}
		$tree_key    = filter_input(INPUT_POST, 'tree_key');
		$description = filter_input(INPUT_POST, 'description');
		$id = filter_input(INPUT_POST, 'id');
		if ($id) {
			$res = \Connect::get_row_byId('postdata', $id);
			if (\Sfn::status($res)) {
				$tree_key = $res['data']->tree_key . '.' . $id;
				\Connect::update_row(
					'postdata',
					[
						'update_at' => time(),
						'id' => $id,
					],
					'id=:id'
				);
			} else {
				echo 'Элемент родителя не найден';
				exit;
			}
		}

		$row = [
			'tree_key' => $tree_key,
			'name' => htmlentities($name),
			'description' => htmlentities($description),
			'create_at' => time(),
			'update_at' => time(),
			'delete_at' => NULL
		];
		$result =  \Connect::add_row('postdata', $row);
		return $this->renderView($row, $result);
	}
}
