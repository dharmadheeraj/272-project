<html>
	<head>
		<script type="text/javascript">
	
	function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '329996781167151',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v3.2' // use graph api version 2.8
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    FB.api('/me?fields=picture,name', function(response) {
	console.log(response);
	  document.getElementById('profilepic').src =response.picture.data.url;
      document.getElementById('fbLogIn').innerHTML = response.name;
    });
  }

</script>
	</head>
	<body>

<?php

include_once './config/database.php';
include_once './config/user.php';

session_start();

$data = json_decode(file_get_contents("php://input"));
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$login = $user->readOne($_POST["name"],$_POST["password"]);

if($login>0){
	$_SESSION['login'] = $_POST["name"];
	echo $_POST["name"];
	header("Location: index.php");
}else{

	header("Location: login.php");
}


	
   
?>

	</body>

</html>