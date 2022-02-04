<?php

namespace App\Controllers;

use App\Models\NovelModel;

class Home extends BaseController
{
	protected $novelModel;
	public function __construct()
	{
		$this->novelModel = new NovelModel();
	}
	public function index()
	{
		$novel = new NovelModel();
		$data =
			[
				'tittle' => 'Home',
				'novel' => $novel->getNovel(),
			];
		return view('novel/home', $data);
	}
}
