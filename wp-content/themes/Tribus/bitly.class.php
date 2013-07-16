<?php 



class Bitly {
	
	public $url;
	public $login;
	public $appkey;
	public $format = 'xml';
	public $short ='';
	public $version = '2.0.1';
	function __construct($login,$appkey)
	{
		//echo "login $login and app key $appkey";
		$this->login = $login;
		$this->url = $url;
		$this->appkey = $appkey;
		
		$this->url = $this->actualURL();
		//echo "[{$this->url}]";
		$this->make_bitly();		
	}
	
	
	function make_bitly()
	{
	  $url = $this->url;
	  $login = $this->login;
	  $version = $this->version;
	  $appkey = $this->appkey;
	  $format = $this->format;		
		
	  //create the URL
	  $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
	  
	  
	  //echo "bitly [$bitly]";
	  //get the url
	  //could also use cURL here
	  $response = file_get_contents($bitly);
  
	  //parse depending on desired format
	  if(strtolower($format) == 'json')
	  {
		$json = @json_decode($response,true);
		$this->short =  $json['results'][$url]['shortUrl'];
	  }
	  else //xml
	  {
		$xml = simplexml_load_string($response);
		$this->short =  'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	  }
	  
	  
	  //echo "short is [$this->short]";
    }
	
	
	function actualURL() 
	{
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL.'?utm_source=TribusPostings&utm_medium=CL&utm_campaign=TribusPostings';
	}
	
	function __toString()
	{
		return $this->short;	
	}
	
}