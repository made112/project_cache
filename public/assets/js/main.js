let bar = document.querySelector("nav .bar");
let nav = document.querySelector("nav");
let ul = document.querySelector("nav ul");
let close = document.querySelector("nav ul li .close");
let slider = document.getElementById("cache-capcity");
let value = document.getElementById("value");
let reset = document.getElementById("reset");

// reset.onclick = function () {
//   value.innerHTML = "0 MB";
// };

// slider.oninput = function () {
//   value.innerHTML = `${slider.value} MB`;
// };

function reset_btn() {
  value.innerHTML = "0 MB";
}
function slider_value() {
  value.innerHTML = `${slider.value} MB`;
}

bar.onclick = function () {
  ul.classList.toggle("active");
};

close.onclick = function () {
  ul.classList.toggle("active");
};

let allSkills = document.querySelectorAll(".result-box .result-progress span");
let before = document.querySelectorAll(".result-box .result-name .before");

allSkills.forEach((span, index) => {
  span.style.width = span.dataset.progress;
  before[index].innerHTML = span.dataset.progress;
});
const c = setInterval(function(){
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
    }
  };
  xhttp.open("GET", "../app/core/uploadStatistics.php", true);
  xhttp.send();
}, 5000);