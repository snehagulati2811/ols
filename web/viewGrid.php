
<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - My View
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/OLS/web/css/ols.main.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/OLS/web/js/ols.main.min.js" ></script>
 

<?php
session_start();
// Set session variables
//$_SESSION["favcolor"] = "green";
//$_SESSION["favanimal"] = "cat";
//echo $_SESSION["descRole"];
?>

<script type="text/javascript">
   
    $(document).ready(function(){
        var userId = getCookie('uid'),
        role =  "<?php echo $_SESSION["descRole"]; ?>",
        uName = getCookie('userName'),
         dataset = {
            uid: userId
        };

        $('#userName').text(''  +uName);
        console.log('Role: ',role);
        if ( role === 'STUDENT' ) {
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'takeExams.php\'>Quiz</a> </li>');
        } else if ( role === 'FACULTY' ) {
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'addAssessment.php\'>Create Questions</a> </li>');
            $('#olsNav').append('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Module/Topic<span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/OLS/web/createModule.php">Create Module</a></li><li><a href="/OLS/web/createTopic.php">Create Topic</a></li></ul></li>');
           // $('#olsNav').append('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Assignment <span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/OLS/web/createModule.php">Create Module</a></li><li><a href="/OLS/web/createTopic.php">Create Topic</a></li></ul></li>');
            $('#olsNav').append('<li id=\'olsPublish\'><a href=\'publishExam.php\'>Examination</a> </li>');
        }
        

        $.ajax({
            url: 'getGrid.php',
            type: 'POST',
            data: dataset,
            dataType: 'json',
            success:function(response) {
                var len = response.length;
                
                console.log('rest : ', JSON.stringify(response), len);

                $("#tGrid").empty();
                $("#tGrid").append("<thead><tr><th>S.No</th><th>Topic</th><th>Course</th><th>Module</th><th>Material</th></tr></thead><tbody>");
                for ( var i = 0; i <len; i++ ) {
                        var cid = response[i]['cid'],
                        course = response[i]['course'],
                        mid = response[i]['mid'],
                        smodule = response[i]['module'],
                        tid = response[i]['tid'],
                        topic = response[i]['topic'],
                        fname = response[i]['name'],
                        regid = response[i]['regid'];
                        
                        $("#tGrid").append("<tr><td>"+(i+1)+"</td><td id='tTopic"+i+"'>"+topic+"</td><td>"+course+"</td><td>"+smodule+"</td><td><a href='download.php?tid="+tid+"'>"+fname+"</a></td></tr>");
                       
                }
                $("#tGrid").append("</tbody>");

               
                
            }
        });


        
    });  

   
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

     
</script>
</head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
        <a  href="#"><img class="img-responsive" src="images/ols_logo.png" style="max-width:100%; height:auto;display:block;" alt=""></a>
    </div>
    <ul id="olsNav" class="nav navbar-nav">
        <li id="olsGrid" ><a href="viewGrid.php">My View</a></li>
        </li>
        
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span id="userName"class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="#" id="ols_logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    </div>
    </nav>
            <div class="container">
            <form  method="POST" >
                <div >
                    <table id="tGrid" class="table table-striped">
                        
                    </table>
                </div>
                </form>
            </div>
          
      
        
    
            <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>

</body>
</html>