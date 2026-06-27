let n=1;

function SlideShow(){
    let slides=document.getElementsByClassName("images");
    let dots=document.getElementsByClassName("dot");
    for(let i=0; i<slides.length;i++){
        slides[i].style.display="none";
        dots[i].style.backgroundColor="rgb(174, 164, 164)";
    }
    if(n<1){
        n=slides.length;
    }
    if(n>slides.length){
        n=1;
    }
    slides[n-1].style.display="inline-block";
    dots[n-1].style.backgroundColor="grey";



}
function nextSlide(){
    n+=1;
    SlideShow();
}
function previousSlide(){
    n-=1;
    SlideShow();
}
function currentSlide(x){
    n=x;
    SlideShow();
}
document.addEventListener('DOMContentLoaded',SlideShow);