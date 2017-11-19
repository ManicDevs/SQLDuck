<?php

namespace Engines;

class DuckDuckGo
{
	public $engineuri = 'https://duckduckgo.com/html?q=%s';
	
	public $supported = array(
		'site'			=> 'site:[url]',
		'intitle'		=> 'intitle:[text]',
		'allintitle'	=> 'allintitle:[text]',
		'inurl'			=> 'inurl:[text]',
		'allinurl'		=> 'allinurl:[text]',
		'filetype'		=> 'filetype:[file extension]',
		'intext'		=> 'intext:[text]',
		'allintext'		=> 'allintext:[text]',
		'inbody'		=> 'inbody:[text]',
		'loc'			=> 'loc:[iso code]',
		'location'		=> 'location:[iso code]',
		'region'		=> 'region:[region code]',
		'feed'			=> 'feed:[feed type]',
		'hasfeed'		=> 'hasfeed:[url]',
		'ip'			=> 'ip:[ip address]'
	);
	
	public function __construct()
	{
		echo '[*] DuckDuckGo engine loaded successfully!' . PHP_EOL;
	}
	
	public function search($query = '')
	{
		if(empty($query))
		{
			echo '[!] You must specify a non-empty query, i.e. ->search(\'site:google.com\')' . PHP_EOL;
		}
		
		echo '[-] Query: ' . $query . PHP_EOL;
		
		$this->request($query);
	}
	
	private function request($query)
	{
		$data = new \Core\Helpers\Fetch(sprintf($this->engineuri, $query));
		echo $data->get();
	}
}