
function next(i){
    i++;
    Page(i);
}
function prev(i){
    i--;
    Page(i);
}
function current(x){
    i=x;
    Page(i);
}
function Page(i){
    let dots=document.getElementsByClassName("dot");
    if(i<1){
        i=dots.length;
    }
    if(i>dots.length){
        i=1;
        
    }
    dots[i].style.backgroundColor="background-color: rgb(174, 168, 168)";
    


    
}