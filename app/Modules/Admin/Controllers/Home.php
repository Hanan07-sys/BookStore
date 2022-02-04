<?php
namespace App\Modules\Admin\Controllers;
use App\Controllers\BaseController;
use App\Modules\Admin\Models\NovelModel;


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
		return view('App\Modules\Admin\Views\halaman\home', $data);
	}
}
