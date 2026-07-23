/*=========================================
    BMS Dashboard JS
=========================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*==============================
        Sidebar Toggle
    ==============================*/

    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    if (menuToggle && sidebar) {

        menuToggle.addEventListener("click", () => {

            sidebar.classList.toggle("active");

        });

    }

    /*==============================
        Close Sidebar Outside Click
    ==============================*/

    document.addEventListener("click", (e) => {

        if (window.innerWidth <= 992) {

            if (
                sidebar &&
                !sidebar.contains(e.target) &&
                menuToggle &&
                !menuToggle.contains(e.target)
            ) {

                sidebar.classList.remove("active");

            }

        }

    });

    /*==============================
        Active Sidebar Link
    ==============================*/

    const links = document.querySelectorAll(".sidebar ul li");

    links.forEach(item => {

        item.addEventListener("click", () => {

            links.forEach(li => li.classList.remove("active"));

            item.classList.add("active");

        });

    });

    /*==============================
        Search Filter
    ==============================*/

    const searchInput = document.querySelector(".search input");

    if (searchInput) {

        searchInput.addEventListener("keyup", function () {

            const value = this.value.toLowerCase();

            document.querySelectorAll(".sidebar ul li").forEach(item => {

                const text = item.innerText.toLowerCase();

                item.style.display = text.includes(value) ? "block" : "none";

            });

        });

    }

    /*==============================
        Notification
    ==============================*/

    const notification = document.querySelector(".notification");

    if (notification) {

        notification.addEventListener("click", () => {

            alert("No New Notifications");

        });

    }

    /*==============================
        Card Hover
    ==============================*/

    document.querySelectorAll(".card").forEach(card => {

        card.addEventListener("mouseenter", () => {

            card.style.transform = "translateY(-8px)";

        });

        card.addEventListener("mouseleave", () => {

            card.style.transform = "translateY(0px)";

        });

    });

    /*==============================
        Current Time
    ==============================*/

    function updateTime() {

        const clock = document.getElementById("clock");

        if (clock) {

            const now = new Date();

            clock.innerHTML = now.toLocaleTimeString();

        }

    }

    updateTime();

    setInterval(updateTime, 1000);

    /*==============================
        Counter Animation
    ==============================*/

    const counters = document.querySelectorAll(".card h3");

    counters.forEach(counter => {

        const target = Number(counter.innerText);

        let count = 0;

        const speed = Math.max(1, Math.ceil(target / 50));

        function animate() {

            if (count < target) {

                count += speed;

                if (count > target) count = target;

                counter.innerText = count;

                requestAnimationFrame(animate);

            }

        }

        if (!isNaN(target)) {

            counter.innerText = "0";

            animate();

        }

    });

});

/*=========================================
    Chart.js
=========================================*/

const chartCanvas = document.getElementById("salesChart");

if (chartCanvas) {

    new Chart(chartCanvas, {

        type: "line",

        data: {

            labels: [

                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun"

            ],

            datasets: [{

                label: "Sales",

                data: [

                    12000,
                    18000,
                    15000,
                    22000,
                    26000,
                    30000

                ],

                borderColor: "#2563eb",

                backgroundColor: "rgba(37,99,235,.15)",

                fill: true,

                tension: .4,

                borderWidth: 3,

                pointRadius: 5,

                pointHoverRadius: 8

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    grid: {

                        color: "#e5e7eb"

                    }

                },

                x: {

                    grid: {

                        display: false

                    }

                }

            }

        }

    });

}

const ctx = document.getElementById("salesChart");

if(ctx){

new Chart(ctx,{

type:"line",

data:{

labels: chartMonths,

datasets:[{

label:"Sales",

data: chartTotals,

borderWidth:3,

fill:true,

tension:.4

}]

},

options:{

responsive:true,

plugins:{

legend:{
display:false
}

}

}

});

}
