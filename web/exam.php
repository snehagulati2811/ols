
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
        uName = getCookie('userName'),
        role =  "<?php echo $_SESSION["descRole"]; ?>",
        cid = getUrlParameter('q'),
         dataset = {
            cid: cid
        };
        
       // console.log('Paranm: ',getUrlParameter('q'));

        $("#userName").text(" " +uName);
        console.log('Role: ',role);
        if ( role === 'STUDENT' ) {
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'takeExams.php\'>Quiz</a> </li>');
        } else if ( role === 'FACULTY' ) {
            $('#olsNav').append('<li id=\'olsAssignment\'><a href=\'viewGrid.php\'>Module/Topic</a> </li>');
        }
        $.ajax({
            url: 'getExamQuestion.php',
            type: 'POST',
            data: dataset,
            dataType: 'json',
            success:function(response) {
                var len = response.length;              
                console.log('rest : ', JSON.stringify(response), len);

                for ( var i = 0; i <len; i++ ) {
                        var qid = response[i]['qid'],
                        choice1 = response[i]['choice1'],
                        choice2 = response[i]['choice2'],
                        choice3 = response[i]['choice3'],
                        choice4 = response[i]['choice4'],
                        qdesc = response[i]['qdesc'],
                        qtype = response[i]['qtype'];
                        if ( qtype === '1' ) {
                            $("#q_container").append("<div id=\'qid_"+qid+"\'><h4>"+(i+1)+"->"+qdesc+"<p id=\'addclass_"+qid+"\'></p></h4><input type=\'radio\' name=\'q_"+qid+"\' value=\'A\'>"+choice1+"<br>")
                            .append("<input type=\'radio\' name=\'q_"+qid+"\' value=\'B\'>"+choice2+"<br>")
                            .append("<input type=\'radio\' name=\'q_"+qid+"\' value=\'C\'>"+choice3+"<br>")
                            .append("<input type=\'radio\' name=\'q_"+qid+"\' value=\'D\'>"+choice4+"<br></div>"); 
                        } else if ( qtype === '2') {
                            console.log('description:',qdesc);
                            var desc = qdesc.split('_');
                            
                            console.log('desc', desc, desc.length);
                            if (desc.length == 2) {
                                $("#q_container").append("<div id=\'qid_"+qid+"\'><h4>"+(i+1)+"->"+desc[0]+"<input type=\'text\' name=\'q_"+qid+"\' value=\'\'>"+desc[1]+"<p id=\'addclass_"+qid+"\'></p></h4></div>");
                            }
                            //$("#q_container").append("<div id=\'qid_"+qid+"\'><h4>"(i+1)+"->"+desc[0]+"<p id=\'addclass_"+qid+"\'></p></h4>")
                           // .append("<input type=\'text\' name=\'q_"+qid+"\' value=\'\'><div id=\'qid_"+qid+"\'><p id=\'addclass_"+qid+"\'></p></div>");
                        }                   
                }
                
                $("#sbbutton").append("<input type='hidden' id='res' value='"+JSON.stringify(response)+"' >");
                // <input type='button' id='submitTest' value='Submit Test' onclick='submitResults()' >d='eModule"+i+"' onclick='edit_item(this,"+mid+")'find('option:selected')
               
 
            }
        });

        $("#submitTest").click(function() {
            var obj = JSON.parse($("#res").val()),
            userId = getCookie('uid'),
            cidval = getUrlParameter('q'),
            dataset = new Array;
            
            console.log('cid: ', cidval, 'uid:', userId);
            for ( var i = 0; i <obj.length; i++ ) {
                console.log(obj[i]['qid']);
                console.log('qtype :', obj[i]['qtype']);
               var x ='';
               if ( obj[i]['qtype'] === '2') { 
                x = $("input[name='q_"+obj[i]['qid']+"']").val();
            } else {
                x=  $("input[name='q_"+obj[i]['qid']+"']:checked").val();
               }
               console.log('checked option ', x);
               dataset.push({qid: obj[i]['qid'], option: x, uid: userId, cid: cidval});
            }
           // console.log(JSON.stringify(dataset).serializeArray());
            //var dataString = JSON.stringify(dataset);
            console.log('send:', dataset);

            $.ajax({
            url: 'getResult.php',
            type: 'POST',
            data: JSON.stringify(dataset),
            dataType: 'json',
            success:function(response) {
                var len = response.length;
                
                console.log('rest : ', JSON.stringify(response), len);
                for ( var i=0; i < len; i++ ) {
                    var qid = response[i]['qid'],
                    correct = response[i]['correct'];
                    
                    console.log('qid : ', qid);
                    if (correct === '1') {
                        $("#addclass_"+qid).addClass('glyphicon glyphicon-ok');
                    } else {
                        $("#addclass_"+qid).addClass('glyphicon glyphicon-remove');
                    }
                }
            }
            });
        }); 

       
        
    }); 
    
   
    
    function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
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
    <li id="olsGrid" ><a id="olsGrid_a" href="viewGrid.php">My View</a></li>
    

    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span id="userName"class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="#" id="ols_logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    </div>
    </nav>
            <div class="container">
            <form  method="POST" >
                <div id="q_container">
                     
                </div>
                <div id="sbbutton">
               <!-- <input type='button' id='submitTest' value='Submit Test' onclick='submitResults()' >-->
               <input type='button' id='submitTest' value='Submit Test' >
                </div>
            </form>
            </div>
          
      
        
            <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>    


</body>
</html>