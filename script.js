$(document).ready(function(){

//Get values at buttonclick in activity modal
$("#actSubmitBtn").click(function() {

    let actValue = $("#input1").val();
    let actUrgency = $("input[name='urgentie']:checked").val();
    let idClass = actValue + actUrgency;


    //Check if text field isn't empty before adding activity 
    if (actValue != "") {

        //Create json object
        let jsonObj = {};
        jsonObj.action = actValue;
        jsonObj.urgency = actUrgency;
        console.log(jsonObj);

        //Ajaxcall to create new record in database
        $.ajax({
            url: "create.php",
            data: {jsonObj: JSON.stringify(jsonObj)},
            type: "POST",
            dataType : "JSON",
   
            //Upon succes
            success: function(result) { 
               if (result){console.log('succes')};
               console.log(result);
               createTaskFromObj(result); 
            },
   
            //Upon error
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
               }  
            })

    //Close Modal and reset modal fields 
    $("#inputAct").val("");
    $("input[name='urgentie']").prop("checked", false);
    $("#modalContainer").css("display", "none");
    } else {
        alert("Graag tekst invullen en/of een urgentie kiezen!!");
    }     


}); //Click event end

}) //Document ready end

//Drag and drop functions

//Set the column divs to allow drops from drags
function allowDrop(ev) {
    ev.preventDefault();
  }

//Set what data is to be dragged from the source div
function drag(ev) {
ev.dataTransfer.setData("text", ev.target.id);
}

//On drop drop the source div in the target div
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }

//Create new task based on object
function createTaskFromObj(obj) {
    if (obj.urgencyvalue == "middel") {
        $("#rowOne").append("<span id='" + obj.id + "' class='urgencyNormal' draggable=true ondragstart=drag(event)>" + obj.textvalue + "</span>");
    } else if(obj.urgencyvalue == "hoog") {
        $("#rowOne").append("<span id='" + obj.id + "' class='urgencyHigh' draggable=true ondragstart=drag(event)>" + obj.textvalue + "</span>");
    } else {
        $("#rowOne").append("<span id='" + obj.id + "' class='urgencyLow' draggable=true ondragstart=drag(event)>" + obj.textvalue + "</span>");
    }
}  