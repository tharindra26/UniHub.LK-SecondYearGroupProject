//Read More section
const description = document.querySelector(".description");
description.addEventListener("click", (event) => {
  const current = event.target;

  const isReadMoreBtn = current.className.includes("read-more-btn");

  if (!isReadMoreBtn) return;

  const currentText = event.target.parentNode.querySelector(".read-more-text");

  currentText.classList.toggle("read-more-text--show");
  console.log(currentText.textContent.includes("Read More"));
  current.textContent = currentText.classList.contains("read-more-text--show")
    ? "Read Less"
    : "Read More";
});
//Read More section

var countDown = new Date("Dec 31, 2023 00:00:00").getTime();
var x = setInterval(function () {
  var now = new Date().getTime();
  var distance = countDown - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML = seconds;
}, 1000);

