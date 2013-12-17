<?
class shoutOut{
	
	private $type;//holds the type of shotout
	private $text;//holds the text in the shout out
	private $title;//holds the title of the shot out 
	private $uesrName;//holds a user objecet which also holds the zipcode
	private $replyArray = array(); //holds all of the replys for this shoutOut

	/**
	* this function is the consturter of this class it assigins the data for the shoutOut
	* args [String, String, Obj]
	*/
	function __construct($PosterUser, $body, $head){	

		$this->text = $body;
		$this->title = $head;
		$this->uesrName = $PosterUser;
	}
	/**
	* all of the getters so that we can see all of the data outside looking in
	*/
	function getReplys(){return $this->replyArray;}
	function getUser(){return $this->uesrName;}
	function getTitle(){return $this->title;}
	function getBodyText(){return $this->text;}
	/**
	* this function returns a string that that holds the html for the card 
	*/
	function getHtml(){
		return 
		'	<div class="noItem">
				<h1>'.$this->title.'</h1>
				<p>'.$this->text.'<br> - '.$this->uesrName.'</p>
				<a href="#" data-role="button" data-mini="true" data-theme="d" data-inline="true">Help Me!</a>
			</div>
		';
	}
	/**
	* this function dose not reutrn any thing but take a replyToShout object this tacks replys to an array
	* in this class.
	* args [obj]
	*/
	function addReply($replyObject){
		$this->replyArray = array_merge($this->replyArray, array($replyObject));
	}
}
class user{

	private $userName; //holds the user name
	private $password; //holds the password

	private $shoutOuts = array(); //holds all of the shoutouts
	private $zipcode; //holds the zipcode of of this person

	function __construct($name, $password, $zipcode, $shouts){
		$this->userName = $name;
		$this->password = $password;
		$this->zipcode = $zipcode;
		$this->shoutOuts = $shouts;
	}
	function addShoutOut($body, $head){
		$tepShout = new shoutOut($this->userName, $body, $head);
		array_merge($this->shoutOuts, array($tepShout));
	}
	function makeLiveUser(){
		session_start();
		$_SESSION['LogedInUser'] = $this->userName;
	}
	function getUserName(){return $this->userName;}
	function getPassword(){return $this->password;}
	function getZip(){return $this->zipcode;}
}
class replyToShout{

	private $commenterName;//holds the user name of the replyer
	private $messgae;//holds the message as a string

	function __construct($commenterName, $message){
		$this->commenterName = $commenterName;
		$this->messgae = $messgae;
	}
	/**
	* all of getters of the instance varuables
	*/
	function getUser(){return $this->commenterName;}
	function getMessage(){return $this->messgae;}
}

?>