function random(num) {
    return Math.floor(Math.random()*num)
}
  
  var colors = ["red","goldenrod"];

  function getRandomStyles() {
    var r = colors[Math.floor(Math.random() * colors.length)];
    var mt = random(200);
    var ml = random(500);
    var dur = Math.random() * (4) + 6;
    return `
    background-color: ${r};
    color: ${r}; 
    box-shadow: inset -7px -3px 10px ${r};
    margin: ${mt}px 0 0 ${ml}px;
    animation: float ${dur}s ease-in 1;
    animation-fill-mode:forwards
    `
  }
  
  function createBalloons(num) {
    var balloonContainer = document.getElementById("balloon-container")
    for (var i = num; i > 0; i--) {
    var balloon = document.createElement("div");
    balloon.className = "balloon";
    balloon.style.cssText = getRandomStyles();           balloonContainer.append(balloon);
    }
  }



//Verhot

window.onload = function() {
  try {
    document.getElementsByClassName("curtainContainer")[0].style.transform =
    "translatex(-150vw) ";
    document.getElementsByClassName("curtainContainer")[1].style.transform =
    "translatex(150vw)";
  } finally {
    createBalloons(7);
  }

}