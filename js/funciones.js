function hideshow(){
var frm=document.getElementById("form1");
var btn_create=document.getElementById("create-btn");
if(frm.style.display=="block"){frm.style.display="none"}
else
if(frm.style.display=="none"){frm.style.display="block"; btn_create.style.display="none"}
}

function showBtn(){
  var btn_create=document.getElementById("create-btn");
  var frm=document.getElementById("form1");
  if (btn_create.style.display=='none'){
    frm.style.display="none";
    btn_create.style.display="inline-block";;
  }
}
 

function Shared(idFile){
	
	 s.setItemIds([idFile]);
     s.showSettingsDialog();
}
