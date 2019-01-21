
<!DOCTYPE html>
<html>
<head>
<title>
    Its my page!
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }
    .menu{
        float: left;
        width: 20%;
        text-align: center;
    }
    .menuitem {
        background-color: #e5e5e5;
        padding: 8px;
        margin-top: 7px;
    }
    .main {
        float: left;
        width: 60%;
        padding:0 20px;
    }
    .right {
        background-color: #e5e5e5;
        float: left;
        width: 20%;
        padding: 15px;
        margin-top: 7px;
        text-align: center;
    }
    .c_color {
        color: #fff!important;
        background-color: #2196F3!important;
        padding: 0.01em 16px;
        margin-top: 16px;
        margin-botton: 16px;
    }
    @media only screen and (max-width:620px) {
        .menu, .main, .right {
            width: 100%
        }
    }

    </style>
</head>
<body>
    <div class="container c_color">
        <h1>Demo</h1>
        <p>Resize this response page!</p>
    </div>

    <div style="overflow:auto">
        <div class="menu">
            <div class="menuitem"><a href="/OLS/web/login.php" >Sign in</a></div>
            <div class="menuitem"><a href="/OLS/web/signup.php">Sign up</a></div>
            <div class="menuitem">Link3</div>
            <div class="menuitem">Link4</div>
        </div>

        <div class="main">
            <h2>Lorum Ipsum</h2>
            <p>Loren ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        </div>

        <div class="right"
            <h2>About</h2>
            <p>Lorem ipsum dolor sit amet, consectetuer adipuscung elit.</p>
        </div>
    </div>
</body>
</html>





