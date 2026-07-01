function xmlobject()
{
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
}




function showUser1(str)
{
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q1="+str,true);
xmlhttp.send();
}


function showUser2(str)
{
if (str=="")
  {
  document.getElementById("txtHint2").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q2="+str,true);
xmlhttp.send();
}

function showUser3(str)
{
if (str=="")
  {
  document.getElementById("txtHint3").innerHTML="";
  //document.getElementById("txtHint7").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
	//document.getElementById("txtHint7").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q3="+str,true);
xmlhttp.send();
}


function showUser4(str)
{
if (str=="")
  {
  document.getElementById("txtHint4").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint4").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q4="+str,true);
xmlhttp.send();
}

function showUser5(str)
{
if (str=="")
  {
  document.getElementById("txtHint5").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint5").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q5="+str,true);
xmlhttp.send();
}

function showUser6(str)
{
	if (str=="")
  {
  document.getElementById("txtHint6").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint6").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q6="+str,true);
xmlhttp.send();
}


function showUser7(str)
{
	
  if (str=="")
  {
  document.getElementById("txtHint7").innerHTML="";
  //document.getElementById("txtHint9").innerHTML="";
  //document.getElementById("txtHint10").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint7").innerHTML=xmlhttp.responseText;
	//document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
	//document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;
	}
  }
  
xmlhttp.open("GET","getuser.php?q7="+str,true);
xmlhttp.send();
}

function showUser8(str)
{
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q8="+str,true);
xmlhttp.send();
}

function showUser9(str)
{
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q9="+str,true);
xmlhttp.send();
}

function showUser10(str)
{
if (str=="")
  {
  document.getElementById("txtHint2").innerHTML="";
  return;
  }

xmlobject();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
  
xmlhttp.open("GET","getuser.php?q10="+str,true);
xmlhttp.send();
}

