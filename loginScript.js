$(document).ready(function(){

    //Get values at buttonclick in activity modal
    $(".inlogBtn").click(function() {
        let username = $("#username").val();
        let pswrd = $("#pswrd").val();
        alert(username + pswrd);

        if (username == "" || pswrd == "") {
            alert("WEL EVEN ALLE VELDEN INVULLEN A.U.B.")
        }
    })
});