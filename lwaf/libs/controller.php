<?php

class controller{
	
	
	protected $url;
	protected $file;
	protected $_get = array();
	protected $_post = array();
	protected $_data = array();
	protected $_params = array();
	protected $_cookie = array();
	protected static $content;
	public $addins = array();
	
	#############################
	#
	#		  APP LOGIC
	#
	#############################
	
	final function __construct(){
		$this->url = $_SERVER['REQUEST_URI'];
		if(!empty($_GET)){ $this->_get = array_merge($this->_get,$_GET); }
		if(!empty($_POST)){ $this->_post = array_merge($this->_post,$_POST); }
		if(!empty($_COOKIE)){ $this->_cookie = array_merge($this->_cookie,$_COOKIE); }
		$this->_setParams();
		$this->_buildView();
		$this->_output();
	}
	
	
	
	#############################
	#
	#	   PUBLIC FUNCTIONS
	#
	#############################
	
	final function getHost(){
		return LWAF_PROTOCOL.LWAF_HOST;
	}
	
	final function getSecureHost(){
		return LWAF_SECUREPROTOCOL.LWAF_HOST;
	}
	
	final function staticInclude($file,$params=array()){
		if(file_exists(LWAF_STATICROOT.$file)){
			if(!empty($params)){ extract($params); }
			include_once LWAF_STATICROOT.$file;
		}
	}
	
	final function getParam($name = '*'){
		if($name=='*'){
			return $this->_params;
		}elseif(!empty($this->_params[$name])){
			return $this->_params[$name];
		}else{
			return false;
		}
	}
	
	final function getPost($name = '*'){
		if($name=='*'){
			return $this->_post;
		}elseif(!empty($this->_post[$name])){
			return $this->_post[$name];
		}else{
			return false;
		}
	}
	
	final function getGet($name = '*'){
		if($name=='*'){
			return $this->_get;
		}elseif(!empty($this->_get[$name])){
			return $this->_get[$name];
		}else{
			return false;
		}
	}
	
	final function getCookie($name = '*'){
		if($name=='*'){
			return $this->_cookie;
		}elseif(!empty($this->_cookie[$name])){
			return $this->_cookie[$name];
		}else{
			return false;
		}
	}
	
	final function setSession($name = '', $value = '', $force = false){
		if(!empty($name)){
			if(!isset($_SESSION[$name]) || $force==true){
				$_SESSION[$name] = $value;
			}
		}
	}
	
	final function getSession($name = ''){
		return (!empty($_SESSION[$name]) ? $_SESSION[$name] : NULL);
	}
	
	final function unsetSession($name = ''){
		if(!empty($name) && isset($_SESSION[$name])){
			unset($_SESSION[$name]);
		}
	}
	
	final function redirect($location = ''){
		if(empty($location)){
			die(header('Location: '.$this->getHost()));
		}else{
			die(header('Location: '.$this->getHost().str_replace('%2F','/',urlencode($location))));
		}
	}
	
	final function makeError($errorType){
        switch ($errorType) {
            case $errorType == 400:
                $doType = '400 Bad Request';
                break;
            case $errorType == 401:
                $doType = '401 Authorization Required';
                break;
            case $errorType == 403:
                $doType = '403 Forbidden';
                break;
            case $errorType == 404:
                $doType = '404 Not Found';
                break;
            case $errorType == 405:
                $doType = '405 Method Not Allowed';
                break;
            case $errorType == 500:
                $doType = '500 Internal Server Error';
                break;
            default:
                $doType = '404 Not Found';
                break;
        }
		@ob_end_clean();
        @ob_end_flush();
        if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
            @ob_start("ob_gzhandler");
            $expires = 3600 * 24 * 10;
            header('Content-Type: text/html; charset=utf-8');
            header("Vary: Accept-Encoding");
            header("Expires: ".gmdate("D, d M Y H:i:s", time() + $expires)." GMT");
        }else{
            @ob_start();
        }
        $expires = 3600 * 24 * 10;
        header('HTTP '.$errorType);
        header("Expires: -1");
        header("Status: ".$errorType);
        header("Connection: close");
        $_SERVER['REDIRECT_STATUS'] = $errorType;
        include LWAF_DOCROOT."/error.php";
        @ob_end_flush();
        exit();
	}
	
	
	#################################
	#
	#		PRIVATE FUNCTIONS
	#
	#################################
	
	final private function _output(){
		echo controller::$content;
	}
	
	final private function setHeaderType($type){
		switch($type){
			case 'json':
				header('Content-Type: application/json');
			break;
			default:
				header('Content-Type: text/html; charset=utf-8');
			break;
		}
	}
	
	
	final private function _buildView(){
		if(file_exists(LWAF_PAGEROOT.$this->file.'index.php')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'index.php');
		}elseif(file_exists(LWAF_PAGEROOT.$this->file.'.php')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'.php');
		}elseif(file_exists(LWAF_PAGEROOT.$this->file.'.txt')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'.txt');
		}elseif(file_exists(LWAF_PAGEROOT.$this->file.'.json')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'.json');
		}elseif(file_exists(LWAF_PAGEROOT.$this->file.'.html')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'.html');
		}elseif(file_exists(LWAF_PAGEROOT.$this->file.'/index.php')){
			$this->_getContents(LWAF_PAGEROOT.$this->file.'/index.php');
		}else{
			$this->makeError(404);
			exit();
		}
	}
	
	final private function _setParams(){
		$pieces = explode('/',$this->url);
		foreach($pieces as $num => $val){
			$param_match = preg_match('/[a-zA-Z0-9-\%]+\_[a-zA-Z0-9-\%]+/',$val);
			switch($val){
				case '': break;
				case $param_match==1:
					$pvar = strtok($val,'_');
					$pval = substr(strstr($val,'_'),1);
					$this->_params[$pvar] = urldecode($pval);
				break;
				default:
					$this->file .= $val.'/';
				break;
			}
		}
		$this->file = str_replace('//','/',substr($this->file,0,-1));
	}
	
	
	/*
	* most of the magic happens here, where we include and grab content for output.
	*/
	final private function _getContents($file){
		$this->setHeaderType(substr(strstr($file,'.'),1));
		//find any addins for this view and include them so they are executable
		$addins = str_replace(LWAF_PAGEROOT,LWAF_ADDINROOT,$file); //quick and dirty
		if(file_exists($addins)){
			@include_once($addins);
			if(!empty($this->addins)){
				foreach($this->addins as $anum => $afile){
					@include_once($afile);	
				}
			}
		}
		//get data for view and attach to static container
		ob_end_flush();
		ob_start("ob_gzhandler");
		include($file);
		controller::$content = ob_get_contents();
		ob_end_clean();
	}
	
	
	
} //end class

?>