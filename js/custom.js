


function openPage(loc){
	window.location.href=loc;
}

function verifyform(){
	var f_name=document.getElementsByName("f_name").value;
	var m_ini=document.getElementsByName("m_ini").value;
	var l_name=document.getElementsByName("l_name").value;
	var ssn=document.getElementsByName("ssn").value;
	var email = document.getElementsByName("email").value;
	var p1 = document.getElementsByName("p1").value;
	var p2 = document.getElementsByName("p2").value;
}

function sortTable(n) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById("currentstable");
	switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("tr");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
      	if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
      }
  } else if (dir == "desc") {
  	if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
      }
  }
}
if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
  } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
      	dir = "desc";
      	switching = true;
      }
  }
}
}

/*function updatesolicitation(sid){
	document.write("<?php updatesolicitation("+sid+") ?>");
}*/

function setvalues(sid,stitle,type,category,status,final_filing_date,description,flag){
	document.getElementById("snumber").value=sid;
	document.getElementById("snumber").readOnly=true;
	document.getElementById("stitle").value=stitle;
	document.getElementById("stype").value=type;
	//alert(final_filing_date);
	var displaydate= final_filing_date.replace(" ","T");
	//alert(displaydate);
	document.getElementById("sfinalfiling").value=displaydate;//	Need to be updated
	document.getElementById("scategory").value=category;
	document.getElementById("summernote").value=description;


	if(flag==0){
		document.getElementById("snumber").style.backgroundColor="#f1f1f1";
		document.getElementById("submit").className="btn btn-warning";	
	}
	 if(flag==1){
	document.getElementById("stitle").disabled=true;
	document.getElementById("stype").disabled=true;
	document.getElementById("scategory").disabled=true;
	document.getElementById("summernote").disabled=true;
	document.getElementById("submit").style.display='none';
  document.getElementById("upbtn").style.display='none';
  document.getElementById("cancelSolicitation").style.display='none';
  document.getElementById("PublishSolicitation").style.display='none';  
	document.getElementById("sfinalfiling").disabled=true;
	}
}








