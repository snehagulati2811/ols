<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - Create Module
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
    var resLevel;
   
    var dataset = {
        uid: getCookie('uid')
    };
    $(document).ready(function(){
       var  uName = getCookie('userName'),
       role =  "<?php echo $_SESSION["descRole"]; ?>";
    

     $("#userName").text(" " +uName);
     console.log('Role: ',role);
        if ( role === 'STUDENT' ) {
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'takeExams.php\'>Quiz</a> </li>');
        }  else if ( role === 'FACULTY' ) {
            $('#olsNav').append('<li id=\'olsReport\'><a href=\'genReport.php\'>Report</a> </li>');
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'addAssessment.php\'>Create Questions</a> </li>');
            $('#olsNav').append('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Module/Topic<span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/OLS/web/createModule.php">Create Module</a></li><li><a href="/OLS/web/createTopic.php">Create Topic</a></li></ul></li>');
            //$('#olsNav').append('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Assignment <span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="/OLS/web/createModule.php">Create Module</a></li><li><a href="/OLS/web/createTopic.php">Create Topic</a></li></ul></li>');
            $('#olsNav').append('<li id=\'olsPublish\'><a href=\'publishExam.php\'>Examination</a> </li>');
        }
        $.ajax({
            url: 'getCourses.php',
            type: 'POST',
            data: dataset,
            dataType: 'json',
            success:function(response) {
                var len = response.length;
                resLevel = response;
               // console.log('length :', len);
                $("#sel_course").empty();

                for ( var i = 0; i <len; i++ ) {
                        var cid = response[i]['cid'],
                        course = response[i]['course'];
                        
                        $("#sel_course").append("<option value='"+cid+"'>"+course+"</option>");
                       
                    }

                
            }
        });

        
        $('#sel_course').change(function() {
            console.log('test');
                var option = $(this).find('option:selected').val(),
                dataset = {
                    'cid' : option
                };

                $.ajax({
                    url: 'getModule.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        var len = response.length;
                        
                        console.log('response:', JSON.stringify(response));
                        $("#tModule").empty();
                        $("#tModule").append("<thead><tr><th>S.No</th><th>Module</th><th>Action</th></tr></thead><tbody>");

                        for (var i=0; i < len ; i++) {
                           var mid = response[i].mid;
                           var module = response[i].module;
                            
                            $("#tModule").append("<tr><td>"+(i+1)+"</td><td id='tModule"+i+"' contenteditable='true'>"+module+"</td><td><input type='button' id='eModule"+i+"' onclick='edit_item(this,"+mid+")' value='Edit'/><input type='button' id='dModule"+i+"' onclick='delete_item(this,"+mid+")' value='Delete'/></tr>");

                        }

                        $("#tModule").append("</tbody>");
                        
                    }
                });
                
            });
            
        $('#submitModule').click(function() {
                
                var mName = document.getElementById('mName').value,
              
                sel_course = $('#sel_course').find('option:selected').val(),
                dataset = {
                            'mName': mName, 
                            'sel_course': sel_course
                        };

                
                console.log('dataset : ', dataset);

                $.ajax({
                    url: 'addModule.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                        var len = response.length;
            

                        for ( var i = 0; i <len; i++ ) {
                                var mid = response[i]['mid'],
                                module = response[i]['module'];
                                console.log(mid, module);
                            
                            }

                    }
            });


        });
       
    });  

    function edit_item(e,mid) {
           var getthevalue = $(e).attr('id'),
           tvalue = getthevalue.slice(-1);
           
           console.log('getthevalue : ', getthevalue, tvalue, mid);
           console.log('inner : ', $("#tModule"+tvalue).text());
         
           var dataset = {
                            'mid': mid, 
                            'module': $("#tModule"+tvalue).text()
                        };


           $.ajax({
                    url: 'updateModule.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                        var len = response.length;
            

                        for ( var i = 0; i <len; i++ ) {
                                var mid = response[i]['mid'],
                                module = response[i]['module'];
                                console.log(mid, module);
                            
                            }

                    }
            });

       }

       function delete_item(e,mid) {
           var getthevalue = $(e).attr('id'),
           tvalue = getthevalue.slice(-1);
           
           console.log('getthevalue : ', getthevalue, tvalue, mid);
           console.log('inner : ', $("#tModule"+tvalue).text());
         
           var dataset = {
                            'mid': mid, 
                            'module': $("#tModule"+tvalue).text()
                        };


           $.ajax({
                    url: 'deleteModule.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                        var len = response.length;
            

                        for ( var i = 0; i <len; i++ ) {
                                var mid = response[i]['mid'],
                                module = response[i]['module'];
                                console.log(mid, module);
                            
                            }

                    }
            });

       }

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
        
        
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span id="userName"class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="#" id="ols_logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    </div>
    </nav>


    <div class="container">
    

            <form  method="POST" class = "form-horizontal">
            <div class="form-group">
                <label class="col-sm-4 control-label">
                <h2>Create Module</h2>
                </label>
            </div>
            <div class="form-group">
                <label for="sel_course"  class="col-sm-2 control-label"><b>Select Course</b></label>
                <div class="col-sm-10">
                    <select id="sel_course">
                        <option id="0" value="0">- Select -</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label"><b>Module Name</b></label>
                <div class="col-sm-10">
                <input type="text" placeholder="Module Name" id="mName" name="mName" required>
                </div>
            </div> 
               
            <div class="form-group">
            <label  class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <div class="clearfix">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <button type="submit" id="submitModule" class="signupbtn">Create</button>
                </div>
            </div>
            </div>   
                <table id="tModule" class="table table-striped">
               
                </table>
                
                
               
            </form>
            </div>
            <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>
</body>
</html>