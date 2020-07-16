<html>

<body>
<label><input type='radio' id='r2' name="quiz" />2</label>
<label><input type='radio' id='r3' name="quiz" checked='checked'/>3</label>
<label><input type='radio' id='r4' name="quiz" />4</label>
<label><input type='radio' id='r5' name="quiz" />5</label>
<input type='button' value='시작' onclick='myFunction();'/>
 
<div>
    <div id="d1" style="width:100px; float: left;"><img id="img1" src=" "></div>
    <div id="d2" style="width:100px; float: left;"><img id="img2" src=" "></div>
    <div id="d3" style="width:100px; float: left;"><img id="img3" src=" "></div>
    <div id="d4" style="width:100px; float: left;"><img id="img4" src=" "></div>
    <div id="d5" style="width:100px; float: left;"><img id="img5" src=" "></div>
</div>
 
<script>
 	var g_d1 = document.getElementById("d1")
	var g_d2 = document.getElementById("d2")
	var g_d3 = document.getElementById("d3")
	var g_d4 = document.getElementById("d4")
	var g_d5 = document.getElementById("d5")
	var img_1 = document.getElementById("img1")
	var img_2 = document.getElementById("img2")
	var img_3 = document.getElementById("img3")
	var img_4 = document.getElementById("img4")
	var img_5 = document.getElementById("img5")
	
function myFunction() {
	 
    if (document.getElementById('r2').checked) {
      clear();    
      g_d1.innerHTML = Math.floor(Math.random() * 13);
      g_d2.innerHTML = Math.floor(Math.random() * 13);	  
	  img_add();	  
	 } 
 
    if (document.getElementById('r3').checked) {
      clear();
      g_d1.innerHTML = Math.floor(Math.random() * 13);
      g_d2.innerHTML = Math.floor(Math.random() * 13);
      g_d3.innerHTML = Math.floor(Math.random() * 13);
	  img_add();
	}
 
    if (document.getElementById('r4').checked) {
      clear();
      g_d1.innerHTML = Math.floor(Math.random() * 13);
      g_d2.innerHTML = Math.floor(Math.random() * 13);
      g_d3.innerHTML = Math.floor(Math.random() * 13);
      g_d4.innerHTML = Math.floor(Math.random() * 13);
	  img_add();	  
    }
 
    if (document.getElementById('r5').checked) {
      clear();
      g_d1.innerHTML = Math.floor(Math.random() * 13);
      g_d2.innerHTML = Math.floor(Math.random() * 13);
      g_d3.innerHTML = Math.floor(Math.random() * 13);
      g_d4.innerHTML = Math.floor(Math.random() * 13);
      g_d5.innerHTML = Math.floor(Math.random() * 13);
	  img_add();	  
    }
}
 
function clear() {
      g_d1.innerHTML = "";
      g_d2.innerHTML = "";
      g_d3.innerHTML = "";
      g_d4.innerHTML = "";
      g_d5.innerHTML = "";
}
function img_add() {
	img_1.setAttribute("src", g_d1.innerHTML+".jpg");
	img_2.setAttribute("src", g_d2.innerHTML+".jpg");
	img_3.setAttribute("src", g_d3.innerHTML+".jpg");
	img_4.setAttribute("src", g_d4.innerHTML+".jpg");
	img_5.setAttribute("src", g_d5.innerHTML+".jpg");
	document.body.appendChild(img_1);
	document.body.appendChild(img_2);
	document.body.appendChild(img_3);
	document.body.appendChild(img_4);
	document.body.appendChild(img_5);
}
</script>
 
</body>
</html>