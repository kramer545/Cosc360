function setHeights()
{
	var sidebarA = document.getElementById("sidebar-a");
	var sidebarB = document.getElementById("sidebar-b");
	var content = document.getElementById("content");
	var max = sidebarA.scrollHeight;
	if(sidebarB.scrollHeight > max)
		max = sidebarB.scrollHeight;
	if(content.scrollHeight > max)
		max = content.scrollHeight;
	max = max+"px";
	sidebarA.style.height = max;
	sidebarB.style.height = max;
	content.style.height = max;
}

window.onload = setHeights;