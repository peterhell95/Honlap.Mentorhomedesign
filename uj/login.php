<?php
$alert="";
if(isset($_POST["submit"])){
    $username=$_POST["Username"];
    $password =$_POST["Password"];
    if($username==""||$password==""){
        $alert= "Please enter the value";
    }
    else
    {
        include_once './manage/login/loginClass.php';
        $loginClass=new loginClass();
        $alert=$loginClass->checkLogin($username, $password);
    }
}
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<link rel="stylesheet" href="//bootsnipp.com/dist/bootsnipp.min.css">
<!DOCTYPE html>
<html lang="en">
<style>
input[type=text], select {
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #fec810;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jó lenne ,ha...</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" >
  </head>

<body>

<div class="container">
    <div class="col-md-5">
      <div class="masthead">
        <h3 class="text-muted"> --- Bejelentkezés ---</h3>
      </div>
      <form class="form-signin" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <?php echo $alert; ?>
           <div class="form-group">
                <label for="username"><p> Felhasználónév</p></label><br>
                <input type="text" id="inputEmail" class="form-control" name="Username" placeholder="Enter Username" autofocus><br>
                <label for="password"><p> Jelszó</p></label><br>
                <input type="text" id="inputPassword" class="form-control" name="Password" placeholder="Enter Password">
            </div>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" class="btn btn-success btn-block"  value="Bejelentkezés" />
        </form>
    </div>
    <div class="col-md-5">
    </div>
 </div>
    
</body>
</html>
