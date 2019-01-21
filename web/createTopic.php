
<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - Create Topic
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
    
    $(document).ready(function(){
        console.log('uid : ',getCookie('uid'));
        var dataset = {
        uid: parseInt(getCookie('uid'))
        };
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
               // document.cookie = "cid="+option;
                $.ajax({
                    url: 'getModule.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        var len = response.length;
                        resLevel = response;
                        console.log('response:', response);
                        $("#sel_module").empty();
                        console.log('len:',len);
                        for ( var i = 0; i <len; i++ ) {
                                var mid = response[i]['mid'],
                                module = response[i]['module'];
                                console.log('mid:',mid,'module:', module);
                                $("#sel_module").append("<option value='"+mid+"'>"+module+"</option>");
                            }
                    }
                });
                
            });        
        $("#sel_module").change(function() {
            var sel_course = $('#sel_course').find('option:selected').val(),
            sel_module = $('#sel_module').find('option:selected').val(),

             getData = {
                'sel_course': sel_course,
                'sel_module': sel_module
            };
            document.cookie = "cid="+sel_course;
            document.cookie = "mid="+sel_module;
            $.ajax({
                url: 'getTopic.php',
                type: 'POST',
                data: getData,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: 'json',
                success:function(response) {
                    console.log('Success: ', JSON.stringify(response));
                    var len = response.length;
                    $("#tTopic").empty();
                    $("#tTopic").append("<thead><tr><th>S.no</th><th>Topic</th><th>Course</th><th>Module</th><th>Download</th><th>Action</th></tr></thead><tbody>");
                    
                        for (var i=0; i < len ; i++) {
                           var tid = response[i].tid,
                           topic = response[i].topic, 
                           course = response[i].course,
                           smodule = response[i].module,
                           cid = response[i].cid,
                           mid = response[i].mid;
                           fname = response[i].name;
                           document.cookie = "selcid="+cid;
                           document.cookie = "selmid="+mid;
                            $("#tTopic").append("<tr><td>"+(i+1)+"</td><td id='tTopic"+i+"' contenteditable='true'>"+topic+"</td><td>"+course+"</td><td>"+smodule+"</td><td><a href='download.php?tid="+tid+"'>"+fname+"</a></td><td><input type='button' id='eTopic"+i+"' onclick='edit_item(this,"+tid+")' value='Edit'/><input type='button' id='dTopic"+i+"' onclick='delete_item(this,"+tid+")' value='Delete'/></td></tr>");
                            
                        }
                        $("$tTopic").append("</tbody>");
                }

            });

        });
      /*  $('#submitTopic').click(function() {
                
                var tName = document.getElementById('tName').value,
                sel_course = $('#sel_course').find('option:selected').val(),
                sel_module = $('#sel_module').find('option:selected').val(),
                dataset = {
                            'tName': tName, 
                            'sel_course': sel_course,
                            'sel_module': sel_module
                        };

                
                console.log('dataset : ', dataset);

                $.ajax({
                    url: 'addTopic.php',
                    type: 'POST',
                    data: dataset,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                      

                    }
            });
            var getData = {
                'sel_course': sel_course,
                'sel_module': sel_module
            };
            $.ajax({
                url: 'getTopic.php',
                type: 'POST',
                data: getData,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: 'json',
                success:function(response) {
                    console.log('Success: ', JSON.stringify(response));
                }

            });


        });*/
       
    });  

    function edit_item(e,tid) {
           var getthevalue = $(e).attr('id'),
           tvalue = getthevalue.slice(-1);
           
           console.log('getthevalue : ', getthevalue, tvalue, tid);
           console.log('inner : ', $("#tTopic"+tvalue).text());
         
           var dataset = {
                            'tid': tid, 
                            'topic': $("#tTopic"+tvalue).text()
                        };


           $.ajax({
                    url: 'updateTopic.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                        var len = response.length;
            

                        for ( var i = 0; i <len; i++ ) {
                                var tid = response[i]['tid'],
                                topic = response[i]['topic'];
                                console.log(tid, topic);
                            
                            }

                    }
            });

       }

       function delete_item(e,tid) {
           var getthevalue = $(e).attr('id'),
           tvalue = getthevalue.slice(-1);
           
           console.log('getthevalue : ', getthevalue, tvalue, tid);
           console.log('inner : ', $("#tModule"+tvalue).text());
         
           var dataset = {
                            'tid': tid, 
                            'topic': $("#tTopic"+tvalue).text()
                        };


           $.ajax({
                    url: 'deleteTopic.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));

                        var len = response.length;
            

                        for ( var i = 0; i <len; i++ ) {
                                var tid = response[i]['tid'],
                                topic = response[i]['topic'];
                                console.log(tid, topic);
                            
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

<?php 
//echo "mytest ";
//echo "sub $_POST[\'submitTopic\'] and $_FILES[\'userfile\'][\'size\']";
//echo isset($_POST['submitTopic']);
//echo " Divide ";

if( isset($_POST['submit']) && $_FILES['userfile']['size'] > 0) {
   // echo "Inide if";
    require('ols_config.php');
    //session_start();
    $fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];

    
    //session_start();
    $tName = $_POST['tName'];
    $cid = $_COOKIE['selcid'];
    $mid = $_COOKIE['selmid'];

    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }

    $sql = "INSERT into ols_topic(tid, topic, cid, mid, name, size, type, content) VALUES (NULL, '$tName','$cid','$mid', '$fileName', '$fileSize', '$fileType', '$content')";
    $result=mysqli_query($con,$sql);

    echo "File $fileName uploaded";
} else {

    //echo 'Inside else';
}
?>
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
    <h2>Create Topic</h2>

            <form  method="post" enctype="multipart/form-data" action="" >
            <div class="form-group">
                <label class="col-sm-4 control-label"><b>Topic Name</b></label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Topic Name" id="tName" name="tName" required>
                </div>
            </div>
            <div class="form-group">
                <label for="sel_course" class="col-sm-4 control-label"><b>Select Course</b></label>
                <div class="col-sm-10">
                    <select id="sel_course">
                        <option id="0" value="0">- Select -</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="sel_module" class="col-sm-4 control-label"><b>Select Module</b></label>
                <div class="col-sm-10">
                    <select id="sel_module">
                        <option id="0" value="0">- Select -</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="upload_file" class="col-sm-4 control-label"><b>Upload File</b></label>
                <div class="col-sm-10">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                    <input id="userfile" type="file" name="userfile" />
                </div>
            </div>
            <div class="form-group">
            <label  class="col-sm-4 control-label"></label>
            <div class="col-sm-10">
                <div class="clearfix">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <input type="submit" name="submit" id="submitTopic" value='submit' />
                </div>
            </div>
            </div>
            <br/><br/>
            <table id="tTopic" class="table table-striped">
               
            </table>
        </form>
            </div>

            <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>
    
</body>
</html>