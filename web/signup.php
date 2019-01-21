

<!DOCTYPE html>
<html>
<head>
<title>
    Online Learning System - Sign up
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/OLS/web/css/ols.main.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    var resLevel;

    $(document).ready(function(){
      
        $.ajax({
            url: 'getRole.php',
            type: 'POST',
            dataType: 'json',
            success:function(response) {
                var len = response.length;
                resLevel = response;
                console.log('length :', len);
                $("#sel_role").empty();

                for ( var i = 0; i <len; i++ ) {
                        var roleId = response[i]['rid'],
                        strrole = response[i]['role'];
                        
                        $("#sel_role").append("<option value='"+roleId+"'>"+strrole+"</option>");
                       
                    }

                
            }
        });
        $('#submitUserRegistration').click(function() {
                //alert('test2');
                console.log('userName :',document.getElementById("userName").value);
                //var selConcept = $('#sel_concept').find('option:selected').val(),
                //selLevel =  $('#sel_level').find('option:selected').val();
                //console.log('selLevel :', selLevel, ' : selConcept :', selConcept);
                
                //window.location.href = 'display_quests.php?sel_level='+selLevel+'&selconcept='+selConcept;
                var userName = document.getElementById('userName').value,
                fName = document.getElementById('fName').value,
                lName = document.getElementById('lName').value,
                dob = document.getElementById('dob').value,
                email = document.getElementById('email').value,
                psw = document.getElementById('psw').value,
                psw_repeat = document.getElementById('psw_repeat').value,
                sel_role = $('#sel_role').find('option:selected').val(),
                gender = $("input[name='gender']:checked"). val(),
                dataset = {
                            'userName': userName, 
                            'fName': fName, 
                            'lName': lName, 
                            'dob': dob, 
                            'email': email, 
                            'psw': psw,
                            'gender': gender, 
                            'sel_role': sel_role
                        };
                console.log('gender', gender);
                console.log('values : ' , userName, fName, lName, dob, email, psw, psw_repeat, sel_role);
                console.log('dataset : ', dataset);

                $.ajax({
                    url: 'registration.php',
                    type: 'POST',
                    data: dataset,
                    dataType: 'json',
                    success:function(response) {
                        console.log('success', response);
                        console.log('res: ', JSON.stringify(response));
                        console.log('Before redirect');
                        window.location = 'login.php';
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
            <form  method="POST" class = "form-horizontal" role = "form">
            <h1>Register to Online Learning System</h1>
            <form  method="POST" style="border:1px solid #ccc">
            <div class="container">
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>User Name</b></label>
              <div class="col-sm-10">
                <input type="text" placeholder="User Name" id="userName" name="userName" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>First Name</b></label>
              <div class="col-sm-10">
                <input type="text" placeholder="First Name" id="fName" name="fName" required>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Last Name</b></label>
              <div class="col-sm-10">
                 <input type="text" placeholder="Last Name" id="lName" name="lName" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Date of Birth</b></label>
              <div class="col-sm-10">
              <input type="date" placeholder="Date of Birth" id="dob" name="dob" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Email</b></label>
              <div class="col-sm-10">
              <input type="text" placeholder="Enter Email" id="email" name="email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Password</b></label>
              <div class="col-sm-10">
              <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Repeat Password</b></label>
              <div class="col-sm-10">
              <input type="password" placeholder="Repeat Password" id="psw_repeat" name="psw_repeat" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><b>Gender</b></label>
              <div class="col-sm-10">
              <input type="radio" name="gender" value="M"> Male 
          
              <input type="radio" name="gender" value="F"> Female
              </div>
            </div>  
            <div class="form-group">
              <label for="sel_level" class="col-sm-2 control-label"><b>Select Role</b></label>
              <div class="col-sm-10">
              <select id="sel_role">
                  <option id="0" value="0">- Select -</option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label for="sel_level" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="checkbox" checked="checked"> Remember me
              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
              </div>
            </div>
              <div class="clearfix">
              <label for="sel_level" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <button type="button" class="cancelbtn">Cancel</button>
                <button type="submit" id="submitUserRegistration" class="signupbtn">Sign Up</button>
                </div>
              </div>
            </div>
          </form>
            </div>
                </form>
            </div>

            <div class="footer"><div style="color:white;">While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
            <strong>Copyright YYYY-YYYY by ABC Data. All Rights Reserved.</strong>.</div></div>
</body>
</html>
