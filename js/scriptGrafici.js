let arrKm;
let arrtempi;
let arrdate;
let arrMediaKm;

function mostraGrafici(idgMediaKm, idgAndaturaMedia, idgTempoSforzo) {
  $.ajax({
    type: "get",
    url: "../php/kmXAtleta.php",

    success: function (response) {
      let risultatoDiviso = response.split("*");
      arrKm = JSON.parse(risultatoDiviso[0]);
      arrtempi = JSON.parse(risultatoDiviso[1]);
      arrdate = JSON.parse(risultatoDiviso[2]);

$.ajax({
  type: "get",
  url: "../php/datiMediXgiornata.php" ,
  
  success: function (response) {
     arrMediaKm = JSON.parse(response); 
     //Media Km

      new Chart(idgMediaKm, {
        type: "line",
        data: {
          labels: arrdate,
          datasets: [
            {
              data: arrKm,
              borderColor: "#222ba6",
              label: "Km Percorsi da te ",
              fill: false,
              pointRadius: 4,
            },
            {
              label: "Media Km Percorsi dalla Comunity",
              data: arrMediaKm,
              borderColor: "#F29727",
              fill: false,
            },
          ],
        },
        options: {
          responsive: true,
        },
      });

      //tempo Sforzo
      function formatSeconds(seconds) {
        let secondi = seconds/100
        let ore = secondi / 3600;
        let t= ore.toString().split(".")
        ore=t[0]
        let minuti=Math.floor(t[1]*60)
        minuti=minuti.toString().substring(0,2);
        secondi=secondi.toString().substring(0,2);
        if(minuti>60){
          minuti=60
        }
         if (secondi > 60) {
          secondi=50
         }

        if(isNaN(ore)){
          ore="00"
        }
        if (isNaN(minuti)) {
          minuti = "00";
        }
        if (isNaN(secondi)) {
          secondi = "00";
        }

        return ore +":" + minuti +":" + secondi ;
      }
      let arrtempiSec = arrtempi.map(function (e) {
        e = e.split(":");
        e = e[0] * 3600 + e[1] * 60 + e[2];
        return e;
      });
      new Chart(idgTempoSforzo, {
        type: "line",
        data: {
          labels: arrdate,
          datasets: [
            {
              data: arrtempiSec,
              borderColor: "#22A699",
              fill: false,
              pointRadius: 4,
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              callbacks: {
                label: function (context) {
                  let label = context.dataset.label || "";
                  formatSeconds(label.text);
                },
              },
            },
          },
          responsive: true,
          legend: {
            display: false,
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  callback: formatSeconds,
                },
              },
            ],
          },
        },
      });

      //andatura 
      function aggiungiKmMin(e) {
        e += " min/km";
        return e 
      }
      
      function andaturaXtempoekm(tempo,km) {
        
        let somma = 0;
       
          let dataSeparata = tempo.split(":");
          let hh = dataSeparata[0] * 60;
          let min = dataSeparata[1];
          let ss = dataSeparata[2] /60;
          somma = parseFloat(hh) + parseFloat(min) + parseFloat(ss);
        
      let  andatura = somma / km;
      let andaturaSeparata = andatura.toString().split(".");
      andatura = andaturaSeparata[0] +"."+ Math.trunc(parseFloat(andaturaSeparata[1] * 60)) ;
andatura=Number(andatura).toFixed(2)
        return andatura ;
      }
      let arrAndatura=[]
      for (let i = 0; i < arrKm.length; i++) {
        let andatura = andaturaXtempoekm(arrtempi[i], arrKm[i]);
        arrAndatura.push(andatura)
        
      }

      new Chart(idgAndaturaMedia, {
        type: "line",
        data: {
          labels: arrdate,
          datasets: [
            {
              data: arrAndatura,
              borderColor: "#F2BE22",
              fill: false,
              pointRadius: 4,
            },
          ],
        },
        options: {
          responsive: true,
          legend: { display: false },
          scales: {
            yAxes: [
              {
                ticks: {
                  callback: aggiungiKmMin,
                },
              },
            ],
          },
        },
      });    
  }
});

      
    },
  });
}
