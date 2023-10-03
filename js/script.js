function aumentaAltezza(chk, idmain) {
  const chkBox = document.getElementById(chk);
  const main = document.getElementById(idmain);
  if (chkBox.checked == true) {
    main.style.height = "auto";
  } else {
    main.style.height = "";
  }
}

function VerificaUtente(idmail,idPsw){
  const txtMail=document.getElementById(idmail)
  const txtPsw=document.getElementById(idPsw)
  let risultatojs
  $.ajax({
    type: "GET",
    url: "../../WeRun/php/verificaUtente.php",
    data: {
      mail: txtMail.value,
      psw: txtPsw.value,
    },
    error: function () {
      alert("errore");
    },
    success: function (result) { 
      risultatojs=result.trim();
      if (risultatojs == "atleta") {
        window.location.href="pages/areaAccessoAtleta.php";
      }
      if (risultatojs == "allenatore") {
        window.location.href="pages/areaAccessoAllenatore.php";
      }
      if (risultatojs == "manca") {
        alert("Nome Utente o Password errati");
      }
      
    },
  });
 
}

function rotate() {
  var lastChild = $(".slider div:last-child").clone();
 
  $(".slider div").removeClass("firstSlide");
  $(".slider div:last-child").remove();
  $(".slider").prepend(lastChild);
  $(lastChild).addClass("firstSlide");
}

window.setInterval(function () {
  rotate();
}, 4000);
