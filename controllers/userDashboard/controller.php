<?php

namespace userDashboard;

class UserDashboard extends \Controller
{
	public $access = [
		'*' => ['Admin', 'User']
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
}
