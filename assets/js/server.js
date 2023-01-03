$(document).ready(function () {
    $.ajax({
    url: 'ajax/getServer',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
    let result = ''; 
    response.forEach(element => {
    $(".player").text(`${element.online} Players Online`);
    result += '<div class="row">';
    element.players.forEach(e => {
    result += `<div class="col-md-4"><img src="https://minotar.net/helm/${e[1]}/25.png" alt="${e[0]}" title="${e[0]}"><a href="player?u=${e[1]}&n=${e[0]}">${e[0]}</a></div>`
    })
    result += '</div>';
    result += `<br><br>`;
    $(".fetchServers").html(result);
    
    new Chart("myChart", {
    type: "line",
    data: {
    labels: element.player_date,
    datasets: [{
    fill: false,
    lineTension: 0,
    backgroundColor: "rgb(44, 207, 97)",
    borderColor: "rgba(44, 207, 97,0.7)",
    data: element.player_history
    }]
    },
    options: {
    legend: {display: false},
    scales: {
    xAxes: [{
    gridLines: {
    display:false
    },
    ticks: {
    display: false
    }
    }],
    
    yAxes: [{
    gridLines: {
    display:false
    },
    ticks: {
    display: false
    }
    }]
    }
    }
    });
    });
    }
    });
    });