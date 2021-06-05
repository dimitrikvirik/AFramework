var menuVisible = true;
function responsive(){
    if($(window).width() < 750){
        $("#menu").hide();
        $("#menu-button").show()
         menuVisible = false;
        $("header").prepend( $("#title"))
    }
    else{
        $("#menu-button").hide()
        $("#menu").prepend( $("#title"))
        menuVisible = true
        $("#menu").show().css("height", "auto")
    }
}
responsive();
$(window).resize(function (){
    responsive();
});
$("#menu-button").click(function (){
    if(menuVisible){
        $("#menu").animate({
            height: "0"
        }, 700, function (){
            $("#menu").hide()
        });
        menuVisible = false
    }
    else{
        $("#menu").show().css("height", "0").animate({
            height: "300px"
            },700
        )
        menuVisible = true
    }

});


function deleteProgram(id){
    $.ajax({
        method: "DELETE",
        url: "/programs/del/"+id
    }).done(function (msg){
       location.reload()
    });
}
function editProgram(id){
   var title = prompt("Enter Title:");
    var description = prompt("Enter description:");

    mydata = {
        title,
        description
    }
    const json = JSON.stringify(mydata)
    $.ajax({
        method: "PUT",
        url: "/programs/edit/"+id,
        data: json
    }).done(function (msg){
        location.reload()
    });
}
function exportUserData(id){
    alert(id);
}