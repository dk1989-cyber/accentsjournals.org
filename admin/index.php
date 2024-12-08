<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Accent Journal </title>
  <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
  <link rel="stylesheet" href="css/quirk.css">
  <script src="lib/modernizr/modernizr.js"></script>
</head>

<body class="">
  <div class="sign-overlay"></div>
  <div class="signpanel"></div>
   <div class="panel signin">
    <div class="panel-heading" style="margin-bottom:10px">
      <h1>Admin Panel </h1>
    </div>
    <div class="panel-body">
      <form >
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id='userid' type="text" class="form-control" placeholder="Enter email">
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id='password' type="text" class="form-control" placeholder="Enter Password">
          </div>
        </div>        
        <div class="form-group" style='margin-top:10px'>
       
          <button type='button' onclick="login();" class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
        <p id='msg' style='color:red;font-weight:bold;text-align:center'></p>
      </form>
      <hr class="invisible">
    </div>
  </div><!-- panel -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function login(){
        user_id=$("#userid").val();
        password=$("#password").val();
        burl="application/action/auth.php";
        $.post(burl,{"email":user_id,"password":password},function(data,status){
            if(data=="1"){
              window.location.replace("application/view/dashboard.php");
            }
            else{
              $("#msg").html("Invalid Credentials");
            }
        });
    }
</script>

</body>
</html>
