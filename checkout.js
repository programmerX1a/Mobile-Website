document.addEventListener("DOMContentLoaded",()=>{document.getElementById("image").style.display="none";})

new Cleave('#credit', {
    creditCard: true,
    onCreditCardTypeChanged: function (type) {
       let img=document.getElementById("image");
    
       string="images/"+type+".png";
       console.log(string);
       img.setAttribute('src',string);
       if(type=="unknown")
        img.style.display="none";
       else
        img.style.display="inline-block";
    }
});
 
new Cleave('#MMYYYY', {
    date: true,
    datePattern: ['m', 'y']
});

new Cleave('#cvv', {
    blocks: [3],           // Limits block to 3 characters
    numericOnly: true      // Restricts input to numbers only
});

