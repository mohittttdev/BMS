/*=========================================
    BMS DASHBOARD JAVASCRIPT
=========================================*/


document.addEventListener("DOMContentLoaded",()=>{


/*=========================================
    SIDEBAR TOGGLE
=========================================*/


const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");


let overlay = document.querySelector(".overlay");


if(!overlay){

    overlay = document.createElement("div");

    overlay.className="overlay";

    document.body.appendChild(overlay);

}



function openSidebar(){

    sidebar.classList.add("active");
    overlay.classList.add("show");

}



function closeSidebar(){

    sidebar.classList.remove("active");
    overlay.classList.remove("show");

}




if(menuToggle){

menuToggle.addEventListener("click",(e)=>{

    e.stopPropagation();

    sidebar.classList.contains("active")
    ? closeSidebar()
    : openSidebar();

});

}




overlay.addEventListener("click",()=>{

    closeSidebar();

});





/* ESC BUTTON CLOSE */


document.addEventListener("keydown",(e)=>{

    if(e.key==="Escape"){

        closeSidebar();

    }

});





/* WINDOW RESIZE */


window.addEventListener("resize",()=>{


if(window.innerWidth > 992){

    closeSidebar();

}


});





/*=========================================
    ACTIVE MENU
=========================================*/


const menuLinks=document.querySelectorAll(".sidebar ul li");


menuLinks.forEach(link=>{


link.addEventListener("click",()=>{


menuLinks.forEach(item=>{

    item.classList.remove("active");

});


link.classList.add("active");



if(window.innerWidth <=992){

    closeSidebar();

}



});


});






/*=========================================
    SEARCH FILTER
=========================================*/


const search=document.querySelector(".search input");


if(search){


search.addEventListener("keyup",()=>{


let value=search.value.toLowerCase();



document.querySelectorAll(".sidebar li").forEach(item=>{


let text=item.innerText.toLowerCase();



if(text.includes(value)){

    item.style.display="block";

}

else{

    item.style.display="none";

}


});


});


}






/*=========================================
    NOTIFICATION POPUP
=========================================*/


const notification=document.querySelector(".notification");


if(notification){


notification.addEventListener("click",()=>{


let box=document.createElement("div");


box.className="notify-box";


box.innerHTML=`

<h4>Notifications</h4>

<p>✔ New sale created</p>

<p>📦 Stock updated</p>

<p>👤 New customer added</p>

`;



document.body.appendChild(box);



setTimeout(()=>{

box.classList.add("show");

},100);



setTimeout(()=>{

box.remove();

},4000);



});


}








/*=========================================
    COUNTER ANIMATION
=========================================*/


const counters=document.querySelectorAll(".card h3");


counters.forEach(counter=>{


let target=parseInt(counter.innerText);



if(isNaN(target)) return;



let count=0;



let speed=Math.ceil(target/60);



function update(){


if(count < target){


count += speed;


if(count > target){

count=target;

}


counter.innerText=count;


requestAnimationFrame(update);


}


}



counter.innerText="0";

update();



});








/*=========================================
    SCROLL ANIMATION
=========================================*/


const elements=document.querySelectorAll(
".card,.chart-card,.table-card,.activity-card,.action-card"
);



const observer=new IntersectionObserver((entries)=>{


entries.forEach(entry=>{


if(entry.isIntersecting){


entry.target.classList.add("show");


}


});


},
{
threshold:.15
});



elements.forEach(el=>{

observer.observe(el);

});





});









/*=========================================
    SALES CHART
=========================================*/


const canvas=document.getElementById("salesChart");



if(
canvas &&
typeof chartMonths !== "undefined" &&
typeof chartTotals !== "undefined"
){


const ctx=canvas.getContext("2d");



let gradient=ctx.createLinearGradient(
0,
0,
0,
300
);



gradient.addColorStop(
0,
"rgba(34,197,94,.35)"
);



gradient.addColorStop(
1,
"rgba(34,197,94,0)"
);





new Chart(canvas,{

type:"line",


data:{


labels:chartMonths,


datasets:[{

label:"Sales",


data:chartTotals,


borderColor:"#16a34a",


backgroundColor:gradient,


fill:true,


borderWidth:3,


tension:.4,


pointRadius:5,


pointHoverRadius:8


}]


},



options:{


responsive:true,


maintainAspectRatio:false,



animation:{

duration:1500

},



plugins:{


legend:{


display:false


}


},



scales:{


y:{


beginAtZero:true,


grid:{


color:"#e5e7eb"


}


},



x:{


grid:{


display:false


}


}


}



}



});



}