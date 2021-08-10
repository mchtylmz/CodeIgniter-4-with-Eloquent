<?php

namespace App\Controllers;

use \App\Models\Users;
use \Fluent\Models\DB;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function deneme()
	{
		d($_SERVER);

		d(
			Users::find(1)->phone()->where('id', 2)->get()
		);

		$users = Users::paginate(3)->withQueryString();

		$users->appends($_GET)->links();

		$queries = \Fluent\Models\DB::getQueryLog();
		d(
			$queries
		);
	}
}
