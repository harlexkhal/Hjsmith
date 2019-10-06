
function LoginHandler()
{
    var Obj, DbParam, XmlHttp;
    Obj = { "Title": document.getElementsByName("UserInfo")[0].value,
            "Post": document.getElementsByName("UserInfo")[1].value };

    dbParam = JSON.stringify(Obj);
    XmlHttp = new XMLHttpRequest();

    XmlHttp.onreadystatechange = function ()
    {
        if (this.readyState == 4 && this.status == 200)
        {
           
        }
    };

    XmlHttp.open("POST", "../Server/Login.php", true);
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XmlHttp.send("x=" + DbParam);

    return false;
}