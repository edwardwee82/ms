<?php

$x='';
if(isset($_POST['username']))
{

    $uname=$_POST['username'];
    $pass= $_POST['password'];
    $x="$uname  $pass";
    return $x;
}

    echo $x;
function login()
{

}
function loginfrm(){
    $x='
    <form id="loginForm">
    <label for="username">Username:</label> 
    <input type="text" id="username" name="username" required> <br>
    <label for="password">Password:</label> 
    <input type="password" id="password" name="password" required> 
    <button type="submit">Login</button> 
    </form> 
    <div id="loginmsg"></div> 
    <script> 
        $(document).ready(function() { 
            $("#loginForm").on("submit", function(e) { 
                //var uname = tinymce.get(tbid).getContent();
                e.preventDefault(); 
                $.ajax({ 
                    type: "POST", url: "./api/login.php", 
                    data: {uname: "uname", pass: "pass"}, 
                    success: function(response) { 
                        
                        $("#loginmsg").html(response)
                        alert("Test");
                        ; } 
                    }); 
                }); 
            }); 
                    
    </script>
    
    ';
    return $x;
}