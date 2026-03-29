document.addEventListener("DOMContentLoaded", function () {
  const grid = document.getElementById("cal");
  const mon = document.getElementById("mon");

  const now = new Date();

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  mon.innerText = `${months[now.getMonth()]} ${now.getFullYear()}`;

  const days = ["S", "M", "T", "W", "T", "F", "S"];

  days.forEach((d) => {
    const div = document.createElement("div");
    div.className = "cal-h";
    div.innerText = d;
    grid.appendChild(div);
  });

  const daysInMonth = new Date(now.getFullYear(), now.getMonth(), 1).getDay();
  const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();

  for (let i = 0; i < daysInMonth; i++) {
    grid.appendChild(document.createElement("div"));
  }

  for (let i = 1; i <= lastDay; i++) {
    const d = document.createElement("div");
    d.className = "cal-d";

    if (i === now.getDate()) {
      d.classList.add("act");
    }

    d.innerText = i;
    grid.appendChild(d);
  }
});
