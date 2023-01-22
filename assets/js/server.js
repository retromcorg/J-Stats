$(document).ready(function () {
    $.ajax({
    url: 'ajax/getServer',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
    let result = ''; 
    response.forEach(element => {
    $("#player").html(`<strong class="text-info">${element.online}</strong> players online,`);
    result += '<div class="row">';
if(element.players) {
    element.players.forEach(e => {
    result += `<div class="col-md-6"><span data-toggle="tooltip" title="x: ${Math.floor(e.coords.x)}, y: ${Math.floor(e.coords.y)}, z: ${Math.floor(e.coords.z)}, world: ${e.coords.world}"><img src="https://minotar.net/helm/${e[1]}/25.png" alt="${e[0]}"></span> <a href="player?u=${e[1]}">${e[0]}</a></div>`
    })
    result += '</div>';
    result += `<br>`;
	}
	else {
	result += '<div class="col-md-12"><p class="text-danger">No users online.</p></div>';
	}
    $(".fetchServers").html(result);
    
  $('[data-toggle="tooltip"]').tooltip(); 
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
