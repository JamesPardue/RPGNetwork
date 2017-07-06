<script>
function VerifyField()
{
    document.getElementById("ID_email").classList.add("emailinput");
}
    
function ToggleDropdown()
{
    document.getElementById("ID_dropdown").classList.toggle("dropdown_visible");
    document.getElementById("ID_headertoggle").classList.toggle("headertogglehighlight");
}
    
function ToggleSignup()
{
    VerifyField();
    document.getElementById("ID_joinbutton").classList.toggle("joinbuttoninvisable");
    document.getElementById("ID_signup").classList.toggle("signupvisable");
}
    
function ToggleHeaderLogin()
{
    document.getElementById("ID_headerlogin").classList.toggle("headerloginvisable");
}
    
function ToggleDropdownLogin()
{
    document.getElementById("ID_dropdownlogin").classList.toggle("dropdownloginvisable");
}
 
function CloseLogins()
{
    document.getElementById("ID_headerlogin").classList.remove("headerloginvisable");
	document.getElementById("ID_dropdownlogin").classList.remove("dropdownloginvisable");
	document.getElementById("ID_dropdown").classList.remove("dropdown_visible");
}
  
function LogOut()
{
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "logout.php", true);
	xhttp.send();
    
    window.location.href="index.php";
}
    
</script>