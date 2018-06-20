<?php 

namespace Details;

use Rain\Tpl;

class Page {

	private $_tpl;
	private $_options = [];
	private $_defaults = [
		"header"	=> true,
		"footer"	=> true,
		"data"		=> []
	];

	public function __construct($opts = [], $tpl_dir = "/site/")
	{

		$this->_options = array_merge($this->_defaults, $opts);

		$config = [
		    "base_url"      => null,
		    "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
		    "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
		    "debug"         => false
		];

		Tpl::configure( $config );

		$this->_tpl = new Tpl();

		if ($this->_options['data']) $this->setData($this->_options['data']);

		if ($this->_options['header'] === true) $this->_tpl->draw("header", false);

	}

	public function __destruct()
	{

		if ($this->_options['footer'] === true) $this->_tpl->draw("footer", false);

	}

	private function setData($data = [])
	{

		foreach($data as $key => $value)
		{

			$this->_tpl->assign($key, $value);

		}

	}

	public function setTpl($tplName, $data = [], $returnHTML = false)
	{

		$this->setData($data);

		return $this->_tpl->draw($tplName, $returnHTML);

	}

}
