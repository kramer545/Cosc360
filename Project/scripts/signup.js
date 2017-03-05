function setForm()
{
	var formElement  = document.getElementById("signupForm");
	formElement.onsubmit = function(e){e.preventDefault();FormCheck();}//stop default, use my own
	formElement.onchange = function(e){resetElement(e);}//resets element to default on change
}

function resetElement(e)
{
	e.target.className = "";
}

function resetAll() //called by reset button to remove styling
{
	var formElement  = document.getElementById("signupForm").elements;
	for(var x = 0,element;element = formElement[x++];)
	{
		element.className = "";
	}
}
	



function FormCheck()
{
	var submitForm = true;
	var loginForm = document.getElementById("signupForm");
	if(document.getElementById("username").value == "")
	{
		document.getElementById("username").className="highlight";
		submitForm = false;
	}
	if(document.getElementById("email").value == "")
	{
		document.getElementById("email").className="highlight";
		submitForm = false;
	}
	//check for .com at end? what if it's .ca or something?
	//email autochecks for @ symbol in html
	if(document.getElementById("password").value == "")
	{
		document.getElementById("password").className="highlight";
		submitForm = false;
	}
	if(document.getElementById("password2").value == "")
	{
		document.getElementById("password2").className="highlight";
		submitForm = false;
	}
	//add php later to write text saying passwords must match
	if(document.getElementById("password").value != document.getElementById("password2").value)//check if passwords match
	{
		document.getElementById("password").className="matchHighlight";
		document.getElementById("password2").className="matchHighlight";
		submitForm = false;
	}
	if(submitForm == true)
	{
		loginForm.submit();
	}
}

window.onload = setForm;