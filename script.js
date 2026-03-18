const botao = document.getElementById("voltarTopo");

window.addEventListener("scroll", function() {

  if (window.scrollY > 200) {
    botao.style.display = "block";
  } else {
    botao.style.display = "none";
  }

});

botao.addEventListener("click", function() {

  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });

});

