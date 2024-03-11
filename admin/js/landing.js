const cards = document.getElementById("cards");

const max = cards.scrollWidth;
var i =0;
setInterval(()=>{
    if(i>max) {
        i=0;
    }
    cards.scrollLeft = i;
    i++;
}, 35)