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
            height: "400px"
            },700
        )
        menuVisible = true
    }

});