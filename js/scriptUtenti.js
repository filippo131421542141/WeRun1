function popoladtl(idDtl) {
  let arrProvince = [
    "Agrigento",
    "Alessandria",
    "Ancona",
    "Aosta",
    "Arezzo",
    "Ascoli Piceno",
    "Asti",
    "Avellino",
    "Bari",
    "Barletta-Andria-Trani",
    "Belluno",
    "Benevento",
    "Bergamo",
    "Biella",
    "Bologna",
    "Bolzano",
    "Brescia",
    "Brindisi",
    "Cagliari",
    "Caltanissetta",
    "Campobasso",
    "Carbonia-Iglesias",
    "Caserta",
    "Catania",
    "Catanzaro",
    "Chieti",
    "Como",
    "Cosenza",
    "Cremona",
    "Crotone",
    "Cuneo",
    "Enna",
    "Fermo",
    "Ferrara",
    "Firenze",
    "Foggia",
    "Forlì-Cesena",
    "Frosinone",
    "Genova",
    "Gorizia",
    "Grosseto",
    "Imperia",
    "Isernia",
    "La Spezia",
    "L'Aquila",
    "Latina",
    "Lecce",
    "Lecco",
    "Livorno",
    "Lodi",
    "Lucca",
    "Macerata",
    "Mantova",
    "Massa-Carrara",
    "Matera",
    "Messina",
    "Milano",
    "Modena",
    "Monza e della Brianza",
    "Napoli",
    "Novara",
    "Nuoro",
    "Olbia-Tempio",
    "Oristano",
    "Padova",
    "Palermo",
    "Parma",
    "Pavia",
    "Perugia",
    "Pesaro e Urbino",
    "Pescara",
    "Piacenza",
    "Pisa",
    "Pistoia",
    "Pordenone",
    "Potenza",
    "Prato",
    "Ragusa",
    "Ravenna",
    "Reggio Calabria",
    "Reggio Emilia",
    "Rieti",
    "Rimini",
    "Roma",
    "Rovigo",
    "Salerno",
    "Medio Campidano",
    "Sassari",
    "Savona",
    "Siena",
    "Siracusa",
    "Sondrio",
    "Taranto",
    "Teramo",
    "Terni",
    "Torino",
    "Ogliastra",
    "Trapani",
    "Trento",
    "Treviso",
    "Trieste",
    "Udine",
    "Varese",
    "Venezia",
    "Verbano-Cusio-Ossola",
    "Vercelli",
    "Verona",
    "Vibo Valentia",
    "Vicenza",
    "Viterbo",
  ];
  let dtl = document.getElementById(idDtl);
  for (let i = 0; i < arrProvince.length; i++) {
    let opzioneProvincia = document.createElement("option");
    opzioneProvincia.value = arrProvince[i];
    dtl.appendChild(opzioneProvincia);
  }
}
let arrpkDistanzaPredefinita = [1, 2, 3, 8, 9];
function caricaDatiUtente() {
  //Caricamento Tempi e Tragitti
  const divTipiCorsa = document.getElementsByClassName("tipoCorsa");
  let divPercorsi = document.getElementsByClassName("percorsi");
  let risultatoTragitto = [];
  let arrTempi = [];
  for (let i = 0; i < divTipiCorsa.length; i++) {
    let tipo = divTipiCorsa[i].children[0].innerHTML;
    $.ajax({
      type: "get",
      url: "../php/percorsiXtipo&Atleta.php",
      data: {
        tipo: tipo,
      },
      success: function (response) {
        risultatoDiviso = response.split("-");
        risultatoTragitto = JSON.parse("[" + risultatoDiviso + "]");

        for (let j = 0; j < risultatoTragitto[0].length; j++) {
          let rigaPercorso = document.createElement("div");
          let cellaPercorso = document.createElement("span");
          rigaPercorso.appendChild(cellaPercorso);
          divPercorsi[i].appendChild(rigaPercorso);
          cellaPercorso.innerHTML = risultatoTragitto[0][j];
          rigaPercorso.id = risultatoTragitto[1][j];
          rigaPercorso.className = "rigaNomePercorso";
          cellaPercorso.className = "cellaNomePercorso";
          $.ajax({
            type: "get",
            url: "../php/tempiXpercorso&Atleta.php",
            data: {
              pkTragitto: risultatoTragitto[1][j],
            },

            success: function (risultatoTempi) {
              arrTempi = JSON.parse(risultatoTempi);

              for (let k = arrTempi.length - 1; k >= 0; k--) {
                let cellaTempo = document.createElement("span");
                rigaPercorso.appendChild(cellaTempo);
                cellaTempo.innerHTML = arrTempi[k];
                cellaTempo.className = "cellaTempo";
                if (arrTempi.length - k > 4) {
                  break;
                }
              }
              let btnAggiungiPerformance = document.createElement("button");
              let Icona = document.createElement("i");
              let testoAggiungiPerformance =
                "displayAggiungiPerformance(" + rigaPercorso.id + ",this" + ")";
              btnAggiungiPerformance.setAttribute(
                "onclick",
                testoAggiungiPerformance
              );
              Icona.className = "gg-add-r";
              btnAggiungiPerformance.appendChild(Icona);
              rigaPercorso.appendChild(btnAggiungiPerformance);
            },
          });
        }
      },
    });
  }
  //Caricamento Medie
  const divStatisticheMedie =
    document.getElementsByClassName("statisticheMedie");
  let arrDati = [];
  for (let i = 0; i < divStatisticheMedie.length; i++) {
    //km medi
    let divKmPercorsi = document.createElement("div");
    let spanDatoVelocita = document.createElement("span");
    let spanMedia = document.createElement("span");
    let IconaKmMedi = document.createElement("i");
    IconaKmMedi.className = "fa-solid fa-route style='color: #000000;'";
    divKmPercorsi.appendChild(IconaKmMedi);

    divKmPercorsi.appendChild(spanDatoVelocita);
    divKmPercorsi.appendChild(spanMedia);

    divStatisticheMedie[i].appendChild(divKmPercorsi);
    spanMedia.className = "mediaNumero";
    spanDatoVelocita.className = "descrizioneMedia";
    spanDatoVelocita.innerHTML = "Media Km Percorsi";

    //velocità media
    let divVelocitaMedia = document.createElement("div");
    let spanDescrizioneVelocita = document.createElement("span");
    let IconaVelocita = document.createElement("i");
    IconaVelocita.className = "fa-solid fa-gauge-high style='color: #000000;'";
    spanDescrizioneVelocita.innerHTML = "Velocità Media";
    let datoVelocitaMedia = document.createElement("span");
    divVelocitaMedia.appendChild(IconaVelocita);

    divVelocitaMedia.appendChild(spanDescrizioneVelocita);
    divVelocitaMedia.appendChild(datoVelocitaMedia);
    divStatisticheMedie[i].appendChild(divVelocitaMedia);

    //andatura

    let divAndatura = document.createElement("div");
    let spanAndaturaDescrizione = document.createElement("span");
    let IconaAndatura = document.createElement("i");
    IconaAndatura.className =
      "fa-solid fa-person-running style='color: #000000;'";
    spanAndaturaDescrizione.innerHTML = "Andatura Media";
    let spanAndaturaDato = document.createElement("span");
    divAndatura.appendChild(IconaAndatura);

    divAndatura.appendChild(spanAndaturaDescrizione);
    divAndatura.appendChild(spanAndaturaDato);
    divStatisticheMedie[i].appendChild(divAndatura);
    $.ajax({
      type: "GET",
      url: "../php/medieXTipoEUtente.php",
      data: {
        tipo: divStatisticheMedie[i].parentElement.id,
      },
      success: function (Medie) {
        medieDivise = Medie.split("-");
        arrDati = JSON.parse("[" + medieDivise + "]");
        let kmMedi = mediaArray(arrDati[1]);
        if (!isNaN(kmMedi)) {
          spanMedia.innerHTML = kmMedi.toFixed(2) + "km";
        }
        let mediaTempo = mediaMinutiArray(arrDati[0]);
        if (!isNaN(mediaTempo)) {
          let kmH = (kmMedi / mediaTempo) * 60;
          datoVelocitaMedia.innerHTML = kmH.toFixed(2) + "km/h";
        }
        let andatura = mediaTempo / kmMedi;
        if (!isNaN(andatura)) {
          let andaturaGiusta = andatura.toString(6);
          spanAndaturaDato.innerHTML =
            parseFloat(andaturaGiusta).toFixed(2) + "min/km";
        }
      },
    });
  }
}
function mediaArray(arr) {
  let media;
  let somma = 0;
  for (let i = 0; i < arr.length; i++) {
    somma += parseFloat(arr[i]);
  }
  media = somma / arr.length;
  return media;
}
function mediaMinutiArray(arr) {
  let media;
  let somma = 0;
  for (let i = 0; i < arr.length; i++) {
    let dataSeparata = arr[i].split(":");
    let hh = dataSeparata[0] * 60;
    let min = dataSeparata[1];
    let ss = dataSeparata[2] / 60;
    somma += parseFloat(hh) + parseFloat(min) + parseFloat(ss);
  }
  media = somma / arr.length;

  return media;
}
function puliziaDiv(div) {
  while (div.firstChild) {
    div.removeChild(div.firstChild);
  }
}
function displayAggiungiPercorso(namePercorsoDaAggiungere, btnAggiungi) {
  let textOnClik = "AggiungiPrimoPercorsoDb(" + namePercorsoDaAggiungere + ")";
  //Pulizia
  const inserimentoPercorso = document.getElementsByClassName(
    "inserimentoPercorso"
  );
  if (inserimentoPercorso.length > 0) {
    for (let i = 0; i < inserimentoPercorso.length; i++) {
      inserimentoPercorso[i].remove();
    }
    btnAggiungi.removeAttribute("onclick");
  }

  const divPercorso = document.getElementsByName(namePercorsoDaAggiungere);
  let spanTesto = document.createElement("span");
  spanTesto.innerHTML = "Inserisci un Nuovo Percorso";
  let divInserimentoPercorso = document.createElement("div");
  let inptPercorso = document.createElement("input");
  let inptDistanza = document.createElement("input");
  let inptTempo = document.createElement("input");

  let inptData = document.createElement("input");

  inptData.type = "date";

  inptTempo.placeholder = "Tempo nel formato HH:mm:ss";
  inptTempo.id = namePercorsoDaAggiungere;

  divInserimentoPercorso.className = "inserimentoPercorso";
  inptPercorso.setAttribute("type", "text");
  inptPercorso.setAttribute("pkTipo", namePercorsoDaAggiungere);
  inptPercorso.setAttribute("id", namePercorsoDaAggiungere);

  inptPercorso.placeholder = "Nome Percorso";
  divInserimentoPercorso.appendChild(spanTesto);
  divInserimentoPercorso.appendChild(inptPercorso);
  divInserimentoPercorso.appendChild(inptTempo);
  divInserimentoPercorso.appendChild(inptData);
  if (!arrpkDistanzaPredefinita.includes(namePercorsoDaAggiungere)) {
    inptDistanza.setAttribute("type", "number");
    inptDistanza.placeholder = "Distanza (km)";
    divInserimentoPercorso.appendChild(inptDistanza);
  }

  divPercorso[0].appendChild(divInserimentoPercorso);
  btnAggiungi.setAttribute("onclick", textOnClik);
}

function AggiungiPrimoPercorsoDb(pkTipo) {
  const inptPercorso = document.getElementsByName(pkTipo);
  const inptTempo = inptPercorso[0].lastChild.childNodes[2];
  const inptData = inptPercorso[0].lastChild.childNodes[3];
  const inptDescrizione = inptPercorso[0].lastChild.childNodes[1];
  if (
    (inptTempo.value != "") &
    (inptData.value != "") &
    (inptDescrizione.value != "")
  ) {
    if (controlloformatoTempo(inptTempo.value)) {
      if (!arrpkDistanzaPredefinita.includes(pkTipo)) {
        const inptDistanza = inptPercorso[0].lastChild.childNodes[4];
        if (inptDistanza.value != "") {
          $.ajax({
            type: "GET",
            url: "../php/inserimentoPercorso.php",
            data: {
              fkTipo: pkTipo,
              descrizione: inptDescrizione.value,
              distanza: inptDistanza.value,
            },
            success: function (pkTragitto) {
              $.ajax({
                type: "GET",
                url: "../php/inserimentoPerformance.php",
                data: {
                  fkTragitto: pkTragitto.trim(),
                  data: inptData.value,
                  durata: inptTempo.value,
                },

                success: function (response) {
                  alert(response);
                  window.location.reload(true);
                },
              });
            },
          });
        } else {
          alert("Attenzione Distanza Mancante");
        }
      } else {
        $.ajax({
          type: "GET",
          url: "../php/inserimentoPercorso.php",
          data: { fkTipo: pkTipo, descrizione: inptDescrizione.value },

          success: function (pkTragitto) {
            $.ajax({
              type: "GET",
              url: "../php/inserimentoPerformance.php",
              data: {
                fkTragitto: pkTragitto.trim(),
                data: inptData.value,
                durata: inptTempo.value,
              },

              success: function (response) {
                alert(response);
                window.location.reload(true);
              },
            });
          },
        });
      }
    } else {
      alert("Attenzione Inserire la il tempo nel formato HH:mm:ss");
    }
  } else {
    alert("Attenzione Dati Mancanti");
  }
}

function displayAggiungiPerformance(pkTragitto, btnAggiungiPerformance) {
  //pulizia
  let divInserimentoPerformance = document.createElement("div");
  let inptdata = document.createElement("input");
  let inptdurata = document.createElement("input");

  divInserimentoPerformance.appendChild(inptdata);
  divInserimentoPerformance.appendChild(inptdurata);
  divInserimentoPerformance.id = "inerimentoPerformance";
  $(divInserimentoPerformance).insertBefore(btnAggiungiPerformance);

  inptdurata.placeholder = "Tempo nel Formato HH:mm:ss";
  inptdata.type = "date";

  let testoParametri =
    "aggiungiPerformaceDb(" + pkTragitto + ",inerimentoPerformance" + ")";
  btnAggiungiPerformance.setAttribute("onclick", testoParametri);
  btnAggiungiPerformance.childNodes[0].className = "gg-check-r";
}
function aggiungiPerformaceDb(pkTragitto, divInptPerformance) {
  const inptData = divInptPerformance.children[0];
  const inptdurata = divInptPerformance.children[1];
  if ((inptData.value != "") & (inptdurata.value != "")) {
    if (controlloformatoTempo(inptdurata.value)) {
      $.ajax({
        type: "get",
        url: "../php/inserimentoPerformance.php",
        data: {
          data: inptData.value,
          durata: inptdurata.value,
          fkTragitto: pkTragitto,
        },

        success: function (ok) {
          alert(ok);
          window.location.reload(true);
        },
      });
    } else {
      alert("Attenzione inserire il tempo nel Formato HH:mm:ss");
    }
  } else {
    alert("Dati Mancanti");
  }
}

function positioSticky() {
  const tipoCorsa = document.getElementsByClassName("tipoCorsa");
  for (let i = 0; i < tipoCorsa.length; i++) {
    tipoCorsa[i].style.zIndex = i;
  }
}

function controlloformatoTempo(strTempo) {
  let tuttOk = true;
  let arrStrTempo = strTempo.split(":");

  for (let i = arrStrTempo.length; i > 0; i--) {
    if (arrStrTempo[i - 1].length > 2) {
      tuttOk = false;
      break;
    }
    if (isNaN(arrStrTempo[i - 1])) {
      tuttOk = false;
      break;
    }
  }

  return tuttOk;
}

function modificaTragitto(pkTragitto, btnModifica) {
  let divDati = document.getElementById("datiModificati");
  if (divDati != null) {
    divDati.remove();
  }
  const divRigaTragitto = btnModifica.parentElement.parentElement;
  let inpuDescrizione = document.createElement("input");
  let inputKm = document.createElement("input");
  let btnConferma = document.createElement("button");
  btnConferma.innerHTML = "Conferma";
  let testo = "modificaTragittoDb(" + pkTragitto + ", 'datiModificati'" + ")";
  btnConferma.setAttribute("onclick", testo);
  let divInserimento = document.createElement("div");
  divInserimento.id = "datiModificati";
  divInserimento.appendChild(inpuDescrizione);
  divInserimento.appendChild(inputKm);
  divInserimento.appendChild(btnConferma);
  btnConferma.className = "btnConferma";

  inputKm.type = "number";
  inpuDescrizione.placeholder = "Inserire la Nuova descrizione";
  inputKm.placeholder = "Inserire la nuova Distanza in Km";

  $(divInserimento).appendTo(divRigaTragitto.firstElementChild);
}

function modificaTragittoDb(pkTragitto, iddivDati) {
  const divDati = document.getElementById(iddivDati);
  if ((divDati.children[0].value != "") & (divDati.children[1].value != "")) {
    $.ajax({
      type: "get",
      url: "../php/modificaPercorso.php",
      data: {
        pkTragitto: pkTragitto,
        descrizione: divDati.children[0].value,
        km: divDati.children[1].value,
      },

      success: function (response) {
        window.location.reload(true);
      },
    });
  } else {
    alert("Inserire Tutti i Dati");
  }
}

function eliminaTragitto(pkTragitto) {
  let text =
    "Vuoi Eliminare il Tragitto, Verranno Eliminati anche i tempi associati!!";
  if (confirm(text) == true) {
    $.ajax({
      type: "get",
      url: "../php/perforanceXtragitto.php",
      data: { pkTragitto: pkTragitto },

      success: function (response) {
        let performanceDivisie = response.split("*");
        let arrPkPerfomance = [];
        arrPkPerfomance = JSON.parse("[" + performanceDivisie[0] + "]");
        for (let i = 0; i < arrPkPerfomance.length; i++) {
          $.ajax({
            type: "get",
            url: "../php/eliminazionePerformance.php",
            data: { pkPerformance: parseInt(arrPkPerfomance[i]) },

            success: function (response) {
              if (i + 1 == arrPkPerfomance.length) {
                $.ajax({
                  type: "get",
                  url: "../php/eliminazioneTragitto.php",
                  data: { pkTragitto: pkTragitto },
                  success: function (response) {
                    window.location.reload(true);
                  },
                });
              }
            },
          });
        }
      },
    });
  }
}

function inseirmentoPerformance(classDivPerformance) {
  const divsPerformance = document.getElementsByClassName(classDivPerformance);
  for (let i = 0; i < divsPerformance.length; i++) {
    const pkTragitto = divsPerformance[i].parentElement.id;
    $.ajax({
      type: "get",
      url: "../php/perforanceXtragitto.php",
      data: { pkTragitto: pkTragitto },

      success: function (response) {
        let performanceDivisie = response.split("*");
        let arrPerormance = JSON.parse("[" + performanceDivisie + "]");
        for (let j = 0; j < arrPerormance[0].length; j++) {
          let rigaPerformnce = document.createElement("div");
          let data = document.createElement("span");
          let tempo = document.createElement("span");
          let iconaData = document.createElement("i");

          let iconaTempo = document.createElement("i");
          let divTempo = document.createElement("div");
          let divData = document.createElement("div");
          let divStatistiche = document.createElement("div");
          let divBtn = document.createElement("div");

          iconaData.className =
            "fa-regular fa-calendar-check fa-2x style='color: #000000;'";
          iconaTempo.className =
            "fa-solid fa-hourglass-half fa-2x style='color: #000000;'";
          divTempo.appendChild(iconaTempo);
          divTempo.appendChild(tempo);
          divData.appendChild(iconaData);
          divData.appendChild(data);

          divStatistiche.appendChild(divTempo);
          divStatistiche.appendChild(divData);

          rigaPerformnce.appendChild(divStatistiche);
          rigaPerformnce.appendChild(divBtn);

          rigaPerformnce.id = arrPerormance[0][j];
          rigaPerformnce.className = "rigaPerformance";
          data.innerHTML = arrPerormance[1][j];
          tempo.innerHTML = arrPerormance[2][j];
          data.className = "cellaPerformance";
          tempo.className = "cellaPerformance";
          divStatistiche.className = "divStatistiche";

          let iconaModifica = document.createElement("i");
          let iconaElimina = document.createElement("i");
          iconaElimina.className =
            "fa-regular fa-trash-can fa-3x style='color: #000000;'";
          iconaModifica.className =
            "fa-solid fa-wrench  fa-3x style='color: #000000;'";

          let btnModifica = document.createElement("button");
          btnModifica.setAttribute("onclick", "modificaPerformance(this)");
          let btnElimina = document.createElement("button");
          btnElimina.setAttribute("onclick", "eliminaPerformance(this)");

          btnElimina.appendChild(iconaElimina);
          btnModifica.appendChild(iconaModifica);
          divBtn.className = "btnGestione";

          divBtn.appendChild(btnModifica);
          divBtn.appendChild(btnElimina);

          divsPerformance[i].appendChild(rigaPerformnce);
        }
      },
    });
  }
}

function modificaPerformance(btnModifica) {
  let giaEsistente = document.getElementById("divModificaPerformance");
  if (giaEsistente != null) {
    giaEsistente.remove();
  }
  let id = btnModifica.parentElement.parentElement.id;
  let rigaPerformance = document.getElementById(id);
  let inptData = document.createElement("input");
  let inptTempo = document.createElement("input");
  let btnConferma = document.createElement("input");
  let divModificaPerformance = document.createElement("div");

  inptData.type = "date";
  inptTempo.type = "text";
  btnConferma.type = "button";
  divModificaPerformance.id = "divModificaPerformance";
  inptData.placeholder = "Inserire la Data";
  inptTempo.placeholder = "Tempo nel formato HH:mm:ss";
  btnConferma.value = "Conferma";
  btnConferma.className = "btnConferma";
  btnConferma.setAttribute("onclick", "modificaPerformanceDb(this)");

  divModificaPerformance.appendChild(inptData);
  divModificaPerformance.appendChild(inptTempo);
  divModificaPerformance.appendChild(btnConferma);

  $(rigaPerformance.children[0]).append(divModificaPerformance);
}
function modificaPerformanceDb(btnConferma) {
  const divModfica = btnConferma.parentElement;
  const inptData = divModfica.childNodes[0];
  const inptTempo = divModfica.childNodes[1];
  const pkPerformance =
    btnConferma.parentElement.parentElement.parentElement.id;
  if ((inptData.value != "") & (inptTempo.value != "")) {
    if (controlloformatoTempo(inptTempo.value)) {
      $.ajax({
        type: "get",
        url: "../php/modificaPerformance.php",
        data: {
          pkPerformance: pkPerformance,
          tempo: inptTempo.value,
          data: inptData.value,
        },

        success: function (response) {
          window.location.reload(true);
        },
      });
    } else {
      alert("Attenzione Inserire la il tempo nel formato HH:mm:ss");
    }
  } else {
    alert("Inserire Dati Validi");
  }
}

function eliminaPerformance(btnElimina) {
  const pkPerformance = btnElimina.parentElement.parentElement.id;
  let domanda = "Vuoi Eliminare la Perfomrmance?";
  if (confirm(domanda) == true) {
    $.ajax({
      type: "get",
      url: "../php/eliminazionePerformance.php",
      data: { pkPerformance: pkPerformance },

      success: function (response) {
        window.location.reload(true);
      },
    });
  }
}

function inserimentoDatiUtente(idgestioneUtente) {
  const divGestioneUtente = document.getElementById(idgestioneUtente);
  $.ajax({
    url: "../php/datiAtletaXpk.php",

    success: function (arrDati) {
      let objDatiAtleta = JSON.parse(arrDati);

      let divRigaDato = document.createElement("div");
      let spanDato = document.createElement("span");

      let btnModifica = document.createElement("button");

      let divGestione = document.createElement("div");

      let indici = Object.keys(objDatiAtleta);
      let arrDatiAtleta = Object.values(objDatiAtleta);
      for (let i = 0; i < indici.length; i++) {
        let divDati = document.createElement("div");
        divDati.className = "rigaDato";
        let spanDato = document.createElement("span");
        let spanDefinizione = document.createElement("span");
        spanDefinizione.innerHTML = indici[i] + " : ";
        spanDato.className = "celleDati";
        spanDato.innerHTML = arrDatiAtleta[i];
        divDati.appendChild(spanDefinizione);
        divDati.appendChild(spanDato);

        divGestioneUtente.appendChild(divDati);
      }
      let iconaModifica = document.createElement("i");
      iconaModifica.className =
        "fa-solid fa-wrench  fa-3x style='color: #000000;'";
      spanDato.innerHTML;

      btnModifica.appendChild(iconaModifica);
      btnModifica.setAttribute(
        "onclick",
        "modificaDatiUtente('celleDati','btnModificaDatiUtente')"
      );
      btnModifica.id = "btnModificaDatiUtente";

      divGestioneUtente.appendChild(btnModifica);
    },
  });
}

function modificaDatiUtente(clsCelleDati, idBtnModifica) {
  const celleDati = document.getElementsByClassName(clsCelleDati);
  for (let i = 0; i < celleDati.length; i++) {
    let inpt = document.createElement("input");
    inpt.className = "nuoviDati";
    inpt.value = celleDati[i].innerHTML;
    celleDati[i].appendChild(inpt);
    celleDati[i].firstChild.remove();
    if (i == celleDati.length - 1) {
      inpt.setAttribute("list", "listaProvincie");
      let dtlProvincie = document.createElement("datalist");

      dtlProvincie.id = "listaProvincie";
      inpt.parentElement.appendChild(dtlProvincie);
      popoladtl("listaProvincie");
    }
  }
  const btnModifica = document.getElementById(idBtnModifica);
  btnModifica.setAttribute("onclick", "modificaDatiUtenteDb('nuoviDati')");
}

function modificaDatiUtenteDb(clsCelleDati) {
  const datiModificati = document.getElementsByClassName(clsCelleDati);
  let arrDati = [];
  for (let i = 0; i < datiModificati.length; i++) {
    arrDati.push(datiModificati[i].value);
  }
  $.ajax({
    type: "get",
    url: "../php/modificaDatiAtleta.php",
    data: {
      nome: arrDati[0].toString(),
      cognome: arrDati[1].toString(),
      mail: arrDati[2].toString(),
      psw: arrDati[3].toString(),
      luogo: arrDati[4].toString(),
    },

    success: function (response) {
      alert("Modifica Avvenuta con Successo");
      window.location.reload(true);
    },
  });
}

function reindirizzamento(pkAtleta) {
  $.ajax({
    type: "get",
    url: "../php/setPkAtletaSelezionato.php",
    data: { pkAtleta: pkAtleta },

    success: function () {
      location.href = "../pages/areaAccessoAtleta.php";
    },
  });
}

function inviaMail() {
  const service_id = "service_2mgmf25";
  const template_id = "template_pp3u2xt";
  let params = {
    nomeAll: document.getElementById("nomeAll").value,
    cognomeAll: document.getElementById("cognomeAll").value,
    pkAll: document.getElementById("pkAll").value,
    mailAlt: document.getElementById("inptMail").value,
  };
  emailjs
    .send(service_id, template_id, params)
    .then((res) => console.log(res))
    .catch((err) => console.error(err));
}


