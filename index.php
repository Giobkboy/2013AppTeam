<?php 
	include 'dataStructs.php';
	$userarray = LoadUsers();
	$shoutOutArray = LoadShoutOuts();


	function LoadUsers(){
		return array("Gio" => new user("Gio", "pies", "11231", array()), "bob" => new user("bob", "pies", "11231", array()));
	}
	function LoginUser($user){//checks if it is a real user and sets a live user and then reloads
		foreach ($user as $userInstance){
			if ($_POST['userName'] == $userInstance->getUserName() && $_POST['Password'] == $userInstance->getPassword()){
				$userInstance->makeLiveUser();
			} 
		}
		echo "<html><body><script>location.reload();</script></body></html>";
	}
	function LoadShoutOuts(){
		return array(
			new shoutOut("Gio", "this is a test of the fact that this sould be working", "testing 123"), 
			new shoutOut("bob", "this is anohter test of stuff and things", "testing 345"), 
			new shoutOut("Gio", "yet another test wow this is alot of tests my hands just seam to move today", "MORE TESTS!!!")
			);
	}
	function getShoutOutHTML($shouts, $users){
		$fullHtml = '';
		foreach($shouts as $Shout){
			if ($users[$Shout->getUser()]->getZip() == $users[$_SESSION['LogedInUser']]->getZip()){
				$fullHtml = $fullHtml.''.$Shout->getHtml();
			}
		}
		return $fullHtml;
	}

	session_start();

	if(isset($_POST['userName'])){
		//echo "hello world";
		LoginUser($userarray);
	}else if (isset($_SESSION['LogedInUser'])){//checks if is actrlylogedin
		$desktopString = file_get_contents("main.html");
		$desktopString = str_replace('////everyThing////', getShoutOutHTML($shoutOutArray, $userarray), $desktopString);
		echo $desktopString;
		

	}else{ //just runs the login page
		echo file_get_contents("login.html");
	}


?>
