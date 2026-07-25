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

        menuToggle.addEventListener("click", (e) => {

            e.stopPropagation();
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

            if (window.innerWidth <= 992) {

                sidebar.classList.remove("active");

            }

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

                item.style.display = text.includes(value)
                    ? "block"
                    : "none";

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

            clock.innerHTML = new Date().toLocaleTimeString();

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

        if (isNaN(target)) return;

        let count = 0;

        const speed = Math.max(1, Math.ceil(target / 50));

        counter.innerText = "0";

        function animate() {

            if (count < target) {

                count += speed;

                if (count > target) count = target;

                counter.innerText = count;

                requestAnimationFrame(animate);

            }

        }

        animate();

    });

});


/*=========================================
    Dynamic Sales Chart
=========================================*/

const ctx = document.getElementById("salesChart");

if (
    ctx &&
    typeof chartMonths !== "undefined" &&
    typeof chartTotals !== "undefined"
) {

    new Chart(ctx, {

        type: "line",

        data: {

            labels: chartMonths,

            datasets: [{

                label: "Sales",

                data: chartTotals,

                borderColor: "#22c55e",

                backgroundColor: "rgba(34,197,94,0.15)",

                borderWidth: 3,

                fill: true,

                tension: 0.4,

                pointRadius: 5,

                pointHoverRadius: 8,

                pointBackgroundColor: "#22c55e",

                pointBorderColor: "#ffffff",

                pointBorderWidth: 2

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