$(document).ready(function () {
$.ajax({
url: 'api/v2/server',
type: 'GET',
dataType: 'json',
success: function(response) {


let result = ''; 


$("#player").html(`<strong class="text-info">${response.online}</strong> online,`);
$("#today").html(`<strong class="text-info">${response.daily_total}</strong> today's peak,`);
$("#week").html(`<strong class="text-info">${response.weekly_total}</strong> weekly peak,`);
$("#total").html(`<strong class="text-info">${response.peek_total}</strong> all time peak`);
$(".sstats").show();

if(response.players) {

result += '<div class="row">';
response.players.forEach(e => {
result += `<div class="col-md-6"><span data-toggle="tooltip" title="x: ${Math.floor(e.coords.x)}, y: ${Math.floor(e.coords.y)}, z: ${Math.floor(e.coords.z)}, world: ${e.coords.world}"><img src="https://minotar.net/helm/${e.uuid}/25.png" alt="${e[0]}"></span> <a href="player?u=${e.uuid}">${e.username}</a></div>`
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
labels: response.player_date,
datasets: [{
fill: false,
lineTension: 0,
backgroundColor: "rgb(44, 207, 97)",
borderColor: "rgba(44, 207, 97,0.7)",
data: response.player_history
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

}
});
});
