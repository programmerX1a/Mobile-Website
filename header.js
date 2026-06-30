function Search(){
    let category=document.getElementById("search_category").value;
    let search=document.getElementById("search").value
    window.location.href="search.php?category="+category+"&search="+search;
}
