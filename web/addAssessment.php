<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - Assessment
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

       /* $("#sel_module").change(function() {
            var sel_course = $('#sel_course').find('option:selected').val(),
            sel_module = $('#sel_module').find('option:selected').val(),

             getData = {
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
                    var len = response.length;
                    
                    console.log('response:', response);
                    $("#sel_topic").empty();
                    console.log('len:',len);
                    for ( var i = 0; i <len; i++ ) {
                            var tid = response[i]['tid'],
                            topic = response[i]['topic'];
                            console.log('tid:',tid,'topic:', topic);
                            $("#sel_topic").append("<option value='"+tid+"'>"+topic+"</option>");


                           
                        }
                }

            });

        });*/

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

            $('#sel_qType').change(function() {
            console.log('test');
                var option = $(this).find('option:selected').val(),
                sel_course = $('#sel_course').find('option:selected').val();
                
                console.log('option **** ', option, sel_course);
                if ( option === '1') {
                    var quest = document.getElementById("question").innerHTML='<form id="questData" method="POST">'
                    +'<div class="form-group"><label class="col-sm-2 control-label"><b>Enter your question:<id="quest_desc"></b></label>'
                    +'<div class="col-sm-10"><textarea rows="5" cols="40" id="question" name="question" form="questData"></textarea></div></div>'
                    +'<strong>Enter the multiple choice solution<id="choice1"></strong><br>'
                    +'<div class="form-group"><label for="sel_choice1" class="col-sm-2 control-label"><b></b></label><div class="col-sm-10">A: <input type="text" id="choice1" name="choice1></div></div>'
                    +'<strong>Enter the multiple choice solution<id="choice2"></strong><br>'
                   // +'<br>'
                    +'B: <input type="text" id = "choice2" name="choice2>'
                    +'<br>'
                    +'<strong>Enter the multiple choice solution<id="choice3"></strong><br>'
                    +'C: <input type="text" id = "choice3" name="choice3>'
                    +'<br>'
                    +'<strong>Enter the multiple choice solution<id="choice4"></strong><br>'
                    +'D: <input type="text" id="choice4" name="choice4>'
            //        +'<br>'
                    +'<strong>Correct Solution<id="solution"></strong><br><br>'
                    +'A <input type="radio" id="solution" name="solution" value="A">'
                    +'&nbsp'
                    +'B <input type="radio" id="solution" name="solution" value="B">'
                    +'&nbsp'
                    +'C <input type="radio" id="solution" name="solution" value="C">'
                    +'&nbsp'
                    +'D <input type="radio" id="solution" name="solution" value="D"><br>'
            //        +'<strong>Enter Correct Solution:</strong> <input type="text" id = "choice5" name="choice5"><br>'
                    +'<strong>Correct Solution<id="solution"></strong><br>'
                    +'<br>'
                     +'<input type="button" name="quest" value="Submit" onclick="SubmitQuestion('+option+','+sel_course+')">'
            //        +'<input type="submit" id = "quest_id" name="quest" value="Submit" onclick="SubmitQuestion()">'
                    +'</form>';
                } else if ( option === '2') {
                    var quest = document.getElementById("question").innerHTML = '<form id="questData" method="POST">'
                    +'<div class="form-group"><label class="col-sm-2 control-label"><b>Enter your question:<id="quest_desc"></b><label>'
                    +'<div class="col-sm-10"><textarea rows="5" cols="40" id="question" name="question" form="questData"></textarea></div>'
                    +'<div class="form-group"><label class="col-sm-10 control-label"><b>Answer:<id="quest_desc"></b><label>'
                    +'<div class="col-sm-10"><input type="text" id="solution" name="solution" ></textarea></div>'
                    +'<div class="col-sm-10"><input type="button" name="quest" value="Submit" onclick="SubmitQuestion('+option+','+sel_course+')"></div></div>'
                    +'</form>';

                }

                
                
            });
            
        
    });  

    function SubmitQuestion(qtypeval, cidval)
    {
        console.log('qtype:',qtypeval, 'cid:', cidval);
        var uidval = getCookie('uid');
        var questform = document.getElementById("questData");
            var qd = new FormData(questform);

            var quest_desc = questform['question'].value;
            var choice1val = '',
                choice2val = '',
                choice3val = '',
                choice4val = '';
            console.log('Before If',parseInt(qtypeval),":");
            if ( parseInt(qtypeval) == 1 ) {
                console.log('choice1: ', questform['choice1'].value); 
                console.log('choice2: ', questform['choice2'].value); 
                console.log('choice3: ', questform['choice3'].value); 
                console.log('choice4: ', questform['choice4'].value); 
                choice1val = questform['choice1'].value;
                choice2val = questform['choice2'].value;
                choice3val = questform['choice3'].value;
                choice4val = questform['choice4'].value;
            }

            var answer = questform['solution'].value;
           
           console.log('quest_desc:', quest_desc, 'choice1val: ', choice1val, 'choice2val: ', choice2val, 'choice3val : ', choice3val,'choice4val: ', choice4val, 'answer:', answer);

            $.ajax({
            url: 'addQuestion.php',
                type: 'POST',
                data: {question: quest_desc, choice1:choice1val, choice2:choice2val, choice3:choice3val, choice4:choice4val, solution:answer, uid:uidval, cid:cidval, qtype:qtypeval},
                dataType: 'json',
                success: function(response) {
              
                    $("#question").html('<span style="color:green" "font-weight:bold">Question Submitted!</span>');

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
                <h2>Assessment</h2>
                </label>
            </div>

            <div class="form-group">
                <label for="sel_course" class="col-sm-2 control-label"><b>Select Course</b></label>
                <div class="col-sm-10">
                    <select id="sel_course">
                        <option id="0" value="0">- Select -</option>
                    </select>
                </div>
            </div>
            
          
            
            <div class="form-group">
                <label for="sel_qType"  class="col-sm-2 control-label"><b>Select Type of Question</b></label>
                <div class="col-sm-10">
                    <select id="sel_qType">
                        <option id="0" value="0">- Select -</option>
                        <option id="1" value="1">- Multiple Choice -</option>
                        <option id="2" value="2">- Fill In the blanks -</option>
                    </select>
                </div>
            </div>
       
           
            
            </form>
            <p  id="question"></p>  
         </div>

         <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>
</body>
</html>