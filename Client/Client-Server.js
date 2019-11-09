
function LoginHandler()
{
   var Obj, DbParam, XmlHttp;
		Obj = {
		    "Email": document.getElementsByName("UserInfo")[0].value,
		    "Password": document.getElementsByName("UserInfo")[1].value
		};

		DbParam = JSON.stringify(Obj);
		XmlHttp = new XMLHttpRequest(); 
	
		XmlHttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200)
		    {
		        S_Response = JSON.parse(this.responseText);
		        if (S_Response['Check'] == false)
		            document.getElementById("ErrorMessage").innerHTML = '<h5 style="color:red">' + S_Response['Info'] + '</h5>';
		        else
		            window.location.href = "profile.html";
		    }
		};
    XmlHttp.open("POST", "../Server/Login.php", true);
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XmlHttp.send("x=" + DbParam);

    return false;
}

function SignupHandler()
{
     var Obj, DbParam, XmlHttp;
     Obj = {
            "FirstName": document.getElementsByName("UserInfo")[0].value,
            "LastName": document.getElementsByName("UserInfo")[1].value,
            "Email": document.getElementsByName("UserInfo")[2].value,
            "Phone": document.getElementsByName("UserInfo")[3].value,
			"Referral": document.getElementsByName("UserInfo")[4].value,
			"Password": document.getElementsByName("UserInfo")[5].value,
			"ConfirmPass": document.getElementsByName("UserInfo")[6].value,
		   };

     DbParam = JSON.stringify(Obj);
     XmlHttp = new XMLHttpRequest(); 
   
    XmlHttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
    {
        S_Response = JSON.parse(this.responseText);
        myObj = JSON.parse(this.responseText);
        if (S_Response[0]['FirstName'] == false)
            document.getElementById("ErrorMessage").innerHTML = '<h5 style="color:red">' + S_Response[1]['FirstName'] + '</h5>';
        else if (S_Response[0]['LastName'] == false)
              document.getElementById("ErrorMessage").innerHTML = '<h5 style="color:red">' + S_Response[1]['LastName'] + '</h5>';
        else if (S_Response[0]['Phone'] == false)
                 document.getElementById("ErrorMessage").innerHTML = '<h5 style="color:red">' + S_Response[1]['Phone'] + '</h5>';
        else if (S_Response[0]['Email'] == false)
                 document.getElementById("ErrorMessage").innerHTML = '<h5 style="color:red">' + S_Response[1]['Email'] + '</h5>';
        else
            window.location.href = "../Server/SendConfirmation.php?Email="+myObj[2]['Email']+"&Key="+myObj[2]['key']+"";
    }
      };

    XmlHttp.open("POST", "../Server/SignUp.php", true);
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XmlHttp.send("x=" + DbParam);

    return false;
}