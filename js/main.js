var _fslide = 1;
var _tslide = 5000;
function setTopMenuFixed(){
    var menu = document.getElementById('mainmenu').style;
    var logo = document.getElementById('logo').style;
    if(document.body.scrollTop >= 165){
        menu.position = "fixed";
        menu.top = "0";
        document.getElementById('slider').style.marginTop = "60px";
        document.getElementById('imglogo').style.transform = "scale(0.6)";
        logo.position = "fixed";
        logo.top = "-40px";
        logo.left = "-30px";
    }else{
        document.getElementById('slider').style.marginTop = "0px";
        document.getElementById('imglogo').style.transform = "scale(1)";
        menu.position = "relative";
        menu.top = "0";
        logo.position = "relative";
        logo.top = "0";
        logo.left = "0";
    }
}
function carousel_autoplay(){
    carousel_next();
    setTimeout("carousel_autoplay()", _tslide);
}
carousel_autoplay();
function startcarousel(){
    for(var i=1;i<=4;i++){
        document.getElementById("slide"+i).style.visibility = "hidden";
    }
    document.getElementById("slide"+_fslide).style.visibility = "visible";
}
function carousel_flash(){
    document.getElementById("slide"+_fslide).style.opacity = "0.3";
    setTimeout("carousel_regain_flash()", 500);
}
function carousel_regain_flash(){
    document.getElementById("slide"+_fslide).style.opacity = "1";
}
function carousel_next(){
    if(_fslide>=4) _fslide = 1;
    else _fslide++;
    carousel_flash();
    startcarousel();
}
function carousel_prev(){
    if(_fslide<=1) _fslide = 4;
    else _fslide--;
    carousel_flash();
    startcarousel();
}
function regainmyslide(){
    if(_fslide<=1) _fslide = 4;
    else _fslide--;
}
