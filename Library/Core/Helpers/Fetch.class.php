<?php

namespace Core\Helpers;

class Fetch
{
	private $engineuri = '';
	
	public function __construct($engineuri = '')
	{
		if(empty($engineuri))
		{
			echo '[!] You must specify a non-empty Engine URI!' . PHP_EOL;
		}
		
		$this->engineuri = $engineuri;
	}
	
	public function get()
	{
		echo '[*] Fetching: ' . $this->engineuri . PHP_EOL;
		
		$uri_segs = str_replace('https://', '', $this->engineuri);
		$uri_segs = explode('/', $uri_segs);
		
		$ctxOpts = array(
    		'ssl' => array(
        		'verify_peer' => false,
        		'verify_peer_name' => false,
        		'allow_self_signed'=> true
    		)
		);
		$ctx = stream_context_create($ctxOpts);
		
		$socket = stream_socket_client('ssl://' . $uri_segs[0] . ':443', 
			$errno, $errstr, 15, STREAM_CLIENT_ASYNC_CONNECT, $ctx
		);
		
		if($socket === FALSE)
		{
			echo "[!] Error: [$errno] $errstr" . PHP_EOL;
			exit;
		}
		
		if(fwrite($socket, "GET /{$uri_segs[1]} HTTP/1.0\r\nHost: {$uri_segs[0]}\r\nAccept: */*\r\n\r\n") === FALSE)
		{
			echo '[!] Error: Unable to write to socket!' . PHP_EOL;
			exit;
		}
		
		$data = '';
		while(!feof($socket))
		{
			$data .= fgets($socket, 1024);
		}
		
		fclose($socket);
		
		return $data;
	}
}