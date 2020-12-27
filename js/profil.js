var mdp=document.getElementById("mdpi");
console.log(document.getElementById("mdpi"));
mdp.style.display="none";
$(".mdp").bind("click",function (event,ui) {
    if(mdp.style.display == "none") {
        mdp.style.display="block";
    }else{
        mdp.style.display="none";
    }
});
var user=document.getElementById("user");
user.style.display="none";
$(".username").bind("click",function (event,ui) {
    if(user.style.display == "none") {
        user.style.display="block";
    }else{
        user.style.display="none";
    }
});