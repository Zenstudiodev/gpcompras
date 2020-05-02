<?php
defined('BASEPATH') OR exit('No direct script acces allowed');
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:08 PM
 */

class Base_Controller extends CI_Controller
{
	public $templates;

	public function __construct()
	{
		parent::__construct();
		$this->templates = new League\Plates\Engine(APPPATH . "/views");
	}

}