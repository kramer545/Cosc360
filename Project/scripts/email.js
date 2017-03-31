function setForm()
{
	var formElement  = document.getElementById("emailForm");
	formElement.onsubmit = function(e){e.preventDefault();FormCheck();}//stop default, use my own
	formElement.onchange = function(e){resetElement(e);}//resets element to default on change
}

function resetElement(e)
{
	e.target.className = "";
}

function resetAll() //called by reset button to remove styling
{
	var formElement  = document.getElementById("emailForm").elements;
	for(var x = 0,element;element = formElement[x++];)
	{
		element.className = "";
	}
}
	



function FormCheck()
{
	var submitForm = true;
	var loginForm = document.getElementById("loginForm");
	if(document.getElementById("email").value == "")
	{
		document.getElementById("email").className="highlight";
		submitForm = false;
	}
	if(document.getElementById("email2").value == "")
	{
		document.getElementById("email2").className="highlight";
		submitForm = false;
	}
	if(document.getElementById("email2").value != document.getElementById("email").value)
	{
		document.getElementById("email").className="highlight";
		document.getElementById("email2").className="highlight";
		submitForm = false;
	}
	
	if(submitForm == true)
	{
		loginForm.submit();
	}
}

window.onload = setForm;