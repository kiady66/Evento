console.log("JS Condition loaded");

$("#select-lang").on("change",function(){

});

$(".option").each(function(){
    $(this).css("backgroundImage",'url("image/"+$(this).val()+".png")');
});