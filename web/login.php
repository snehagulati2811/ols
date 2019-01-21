

<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - Login
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/OLS/web/css/ols.main.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script>document.write('<base href="' + document.location + '" />');</script>


  <script type="text/javascript">
    var resLevel;

    $(document).ready(function(){
      console.log('Inside dom ready..');
      
     // var x = Math.floor((Math.random() * 3) + 1);
     // console.log(x);
     
      //$('#vname').attr('src', 'Sneha_video'+x+'.mp4');
      //$('#vtag').load();

       /* var video = document.getElementById('vtag');
        var sources = video.getElementsByTagName('source');
        sources[0].src = 'Sneha_video'+x+'.mp4';
        video.load(); */
      //  document.getElementById('quoteimg').src = 'images/quote'+x+'.jpg';
        $('#login_submit').click(function() {
                
                console.log('userName :',document.getElementById("userName").value);
               
                var userName = document.getElementById('userName').value,
                psw = document.getElementById('psw').value,
                dataset = {
                            'userName': userName, 
                            'psw': psw
                        };

               
                console.log('dataset : ', dataset);

               
                $.ajax({
                    url: 'validate.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));
                        var len = response.length,
                        userId, 
                        loginFlag;

                        if (parseInt(len) != 0) {
                            for( var i = 0; i<len; i++){
                                var count = response[i]['count'],
                                uid = response[i]['uid'],
                                rid = response[i]['rid'];
                                role = response[i]['role'];
                                
                                document.cookie = "uid="+uid;
                                document.cookie = "rid="+rid;
                                document.cookie = "userName="+userName;
                                document.cookie = "role="+role;
                                loginFlag = 0;
                                console.log('userId : ',count);
                            }

                            if ( role === 'STUDENT') {
                                window.location = 'takeExams.php';
                            } else if ( role === 'FACULTY'){
                                window.location = 'genReport.php';
                            }
                        } 
                        if (parseInt(loginFlag) == 0) {
                            $('#olserror').append(' <div class=\"alert alert-danger\"><strong>Invalid Login! Try again</strong>  </div>');
                        }
                    }
            });

            return false;
        });

       
    });  
    // End: Level
</script>
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
    <a  href="#"><img class="img-responsive" src="images/ols_logo.png" style="max-width:100%; height:auto;display:block;" alt=""></a>
    </div>
    
    <ul class="nav navbar-nav navbar-right">
        <li><a href="/OLS/web/signup.php"><span id="signUp" class="glyphicon glyphicon-user"> SignUp</span></a></li>
       
    </ul>
    </div>
    </nav>
            <div class="container">
            <div class="row">

            <div class="col-sm-6">
                        <form  method="POST" >
                        <div id="olserror">
                        
                        </div>
                        <h1>Login to Online Learning System</h1>
                        <form method="post" >
                            <p><input type="text" name="login" value="" id="userName" placeholder="Username or Email"></p>
                            <p><input type="password" name="password" id="psw" value="" placeholder="Password"></p>
                           <!-- <p class="remember_me">
                            <label>
                                <input type="checkbox" name="remember_me" id="remember_me">
                                Remember me on this computer
                            </label>
                            <label>
                                
                                Remember me on this computer
                            </label>
                            </p> -->
                            <p class="submit"><input type="submit" id="login_submit" name="commit" value="Login"></p>
                    </form>
                </div>
                <!--<div class="col-sm-6">
                    <img id="quoteimg" src="images/quote1.jpg" class="img-responsive" />
                </div>-->
                
                <div class="col-sm-6">
              <!--  <div><h2>Lectures which makes a difference ... </h2></div>
                    <video id="vtag" width="320" height="240" controls>
                    <source id="vname" src="Sneha_video1.mp4" type="video/mp4">
                    </video>
                </div> -->
                

                
            </div>
           <!-- <div class="row"> 
                <div class="col-sm-6">
                <div><h2>Lectures which makes a difference ... </h2></div>
                    <video id="vtag" width="320" height="240" controls>
                    <source id="vname" src="Sneha_video1.mp4" type="video/mp4">
                    </video>
                    </div>
                </div>
            </div>-->
           <!-- <div class="row"> 
            <div class="col-sm-3">
            </div>      
                <div class="col-sm-6">
                <lassi-carousel></lassi-carousel>
                </div>
                <div class="col-sm-3">
            </div>
            </div> -->
         <!--[ footer ] -->
 

         </div>   
         
         
         <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>

         <!--<script type="text/javascript" src="inline.bundle.js"></script><script type="text/javascript" src="polyfills.bundle.js"></script><script type="text/javascript" src="styles.bundle.js"></script><script type="text/javascript" src="vendor.bundle.js"></script><script type="text/javascript" src="main.bundle.js"></script>-->

</body>
</html>