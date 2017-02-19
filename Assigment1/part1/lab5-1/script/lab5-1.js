function setForm()
{
	var formElement  = document.forms[0];
	formElement.onsubmit = function(e){e.preventDefault();FormCheck();}//stop default, use my own
	formElement.onchange = function(e){resetElement(e);}//resets element to default on change
}

function resetElement(e)
{
	e.target.className = "";
	if(e.target.name == "accept")
		document.getElementsByClassName("rectangle")[0].className = "rectangle";
}



function FormCheck()
{
	var submitForm = true;
	var elementNames = ["title","description","city","rate"];
	for (var x = 0; x < elementNames.length; x++)//loop through all places where the value can be empty
	{ 
		var elementValue = (document.getElementsByName(elementNames[x]))[0].value;
		if(elementValue == "")
		{
			document.getElementsByName(elementNames[x])[0].className+=" highlight";
			if(elementNames[x] == "title" || elementNames[x] == "description")
			{
				submitForm = false;
			}
		}
	}
	elementValue = document.getElementsByName("continent")[0].value;//continent
	if(elementValue == "Choose continent")//default value, dont want it selected
	{
		document.getElementsByName("continent")[0].className+=" highlight";
	}
	elementValue = document.getElementsByName("country")[0].value;//country
	if(elementValue == "Choose country")
	{
		document.getElementsByName("country")[0].className+=" highlight";
	}
	elementValue = document.getElementsByName("accept")[0].checked;//accept terms
	if(elementValue == false)
	{
		document.getElementsByClassName("rectangle")[0].className+=" highlight";
		submitForm = false;
	}
	elementValue = document.getElementsByName("date")[0].value;//date
	if(elementValue == "")
	{
		document.getElementsByName("date")[0].className+=" highlight";
	}
	elementValue = document.getElementsByName("time")[0].value;//time
	if(elementValue == "")
	{
		document.getElementsByName("time")[0].className+=" highlight";
	}
	//do we check creative commons? can they all be unclicked?
	if(submitForm == true)
	{
		document.forms[0].submit();
	}
}

window.onload = setForm;