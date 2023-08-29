function shift(){    
    var name=document.getElementsById("namebox").value;
    var userid=document.getElementById("emailbox").value;
    var password=document.getElementById("passbox").value;
    var cnfpass=document.getElementById("cnfpassbox").value;
    var gender=document.getElementById("gender").value;    
    if(name=='')
    alert("Enter name");
    else if(userid=='')
    alert("Enter userid");
    else if(password=='')
    alert("Enter password");
    else if(cnfpass=='')
    alert("Enter confirm password");
    else if(password!=cnfpass)
    alert("Password and confirm password doesn't match");
    else if(gender='')
    alert("Enter Gender");
    else if(gender!="male" || gender!="female")
    alert("Select Gender correctly");

}
