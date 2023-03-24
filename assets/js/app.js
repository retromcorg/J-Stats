$('.copybtn').tooltip({
trigger: 'click',
placement: 'bottom'
});

function setTooltip(message, btn) {
$(btn).tooltip('hide')
  .attr('data-original-title', message)
  .tooltip('show');
}

function hideTooltip(btn) {
setTimeout(function() {
  $(btn).tooltip('hide');
}, 1000);
}


$('[data-toggle="tooltip"]').tooltip();   

var clipboard = new ClipboardJS('.copybtn');

clipboard.on('success', function(e) {
setTooltip('Copied!', '.copybtn');
hideTooltip(e.trigger, '.copybtn');
});

let lastValue = null;
let empty = true;

$("#villageSearch").on('paste', function(e) {
  $(e.target).keyup();
});

$("#villageSearch").keyup(function() {
  let name = $('#villageSearch').val();
  if (name == "" || name.length < 3) {
    $("#villagestb").html("");
$(".villagetb").hide();
    empty = true;
  }else{
    if(name == lastValue && empty == false){
     return; 
    }else{
        lastValue = name;   
        empty = false;
    }
    
    $.ajax({
      type: "POST",
      url: "ajax/searchVillage.php",
      data: {
        search: name
      },
      dataType: 'json',
      success: function(data) {
        if(data.code == 2) {
          $(".villagestb").show().html("No villages found");
		$(".villagetb").hide();
        }
        else {
          let builder = '';
          data.data.forEach((element, key) => {
              builder += `<tr>`
              builder += `<td>${key+1}</td>`
              builder += `<td><a href="./village?u=${element.uuid}">${element.name}</a></td>`
              builder += `<td><img src="https://crafatar.com/avatars/${element.owner_uuid}?size=25&amp;overlay"> <a href="./player?u=${element.owner_uuid}"> ${element.owner}</a></td>`
              builder += `<td>${element.claims.toLocaleString()}</td>`
              builder += `<td>${element.members.toLocaleString()}</td>`
              builder += `<td>${element.assistants.toLocaleString()}</td>`
              builder += `</tr>`;
          });

	$(".villagestb").hide();
	$(".villagetb").show();
          $(".village").html(builder).show();
        }
      }
    });
  }
});

$("#searchForm").on("submit", function(event){
event.preventDefault();
var query = $("#search").val();
$.ajax({
  url:"api/getUser",
    data: {user: query},
    method: "GET",
    success: function(data){

    if(data.status != 'success') {
    Swal.fire({
      title: "Uh oh!",
      icon: data.status,
      text: data.msg,
      allowOutsideClick: false,
      allowEscapeKey: false
      })
    }
  else {
      window.location = `player?u=${data.uuid}`;
  }
}
});
});

function loadPlayer() {

let skinViewer = new skinview3d.SkinViewer({
canvas: document.getElementById("skin_container"),
skin: `https://minotar.net/skin/` + $("#q_uuid").val()
});

skinViewer.width = 350;
skinViewer.height = 350;

if($("#q_cape").val() != "") {
skinViewer.loadCape($("#q_cape").val());
}
skinViewer.controls.enableZoom = false
skinViewer.zoom = 0.8;
skinViewer.fov = 85;
skinViewer.animation = new skinview3d.WalkingAnimation();
skinViewer.animation.headBobbing = false;
skinViewer.animation.speed = 0.5;

$.ajax({
url: 'ajax/isUserOnline',
type: 'POST',
data: {
username: $("#q_username").val()
},
dataType: 'json',
success: function(response) {
$('#status').show();
if(response.status == "online") {
$(".status-result").html(' <span class="badge badge-pill badge-success"> </span></span>');
$(".coords").show();
$("#x").text(response.x);
$("#y").text(response.y);
$("#z").text(response.z);
} 
}
});

$.ajax({
url: 'api/v2/uservillage',
type: 'GET',
data: {
user: $("#q_uuid").val()
},
dataType: 'json',
success: function(response) {
if(response.status == 'success') {

if(response.data.owner != 0) {
let o = [];
response.data.owner.forEach(l => {
o.push(`<a href="village?u=${l.village_uuid}">${l.village}</a>`);
});
$("#owned").html(o.join(', '));
$(".owns").show();
}

if(response.data.assistant != 0) {
let a = [];
response.data.assistant.forEach(k => {
a.push(`<a href="village?u=${k.village_uuid}">${k.village}</a>`);
});
$("#assistant").html(a.join(", "));
$(".asst").show();
}


if(response.data.member != 0) {
let a = [];
response.data.member.forEach(k => {
a.push(`<a href="village?u=${k.village_uuid}">${k.village}</a>`);
});
$("#member").html(a.join(", "));
$(".mem").show();
}
$(".villages").show();
}
}

});

$.ajax({
url: 'ajax/isUserBanned',
type: 'POST',
data: {
uuid: $("#q_uuid").val()
},
dataType: 'json',
success: function(response) {
if(response.total != 0) {
$(".bans").show();
if(response.isBanned) {
$(".banned").prop({"id": "is_banned", "title":"This user has this color because they have been banned from the server."});
$(".banned").attr({"data-toggle": "banned", "data-placement": "left"});
$('[data-toggle="banned"]').tooltip();   
}

$(".modal-title").text("Bans");
$(".own").show();
$("#total-bans").text(response.total);
let result = '';
result += '<table class="table table-borderless table-sm">';
result += `<thead><tr><th></th><th>Admin</th><th>Reason</th><th>Pardoned</th><th>evidence</th></tr></thead><tbody>`;

response.bans.forEach(ban => {
let e = [];

if(ban.evidence.length != 0) {
ban.evidence.forEach(evidence => {
e.push(`<a href="${evidence.url}" target="_blank" rel="noopener">view</a>`);
});
}
else {
e.push("no evidence available");
}
result += `<tr><td><img src="https://crafatar.com/avatars/${ban.admin[1]}?size=25&overlay"></td><td><a href="./player?u=${ban.admin[1]}&n=${ban.admin[0]}">${ban.admin[0]}</a></td><td>${ban.reason}</td><td>${ban.pardoned}</td><td>${e.join(", ")}</td></tr>`;
});
result += '</tbody></table>';            
$(".modal-body").html(result)
$(".ban-list").show();
}
}
});

}

function loadServer() {
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
}


function getLb() {
let cat = document.getElementsByName("cat")[0].value;
$.ajax({
url: 'api/v2/leaderboard',
type: 'GET',
data: {
category: cat
},
dataType: 'text',
success: function(response) {

let res = JSON.parse(response);
let result = '';

$("#t").text(stringSentenceCase(res.type));
$("#n").text(res.category_name);

res.data.forEach((element, key) => {

let text = '';

if(res.type == 'village') {
text = `<a href="./village?u=${element.uuid}">${element.key}</a>`
}
else {
text = `<img src="https://crafatar.com/avatars/${element.uuid}?size=25&amp;overlay"> <a href="./player?u=${element.uuid}"> ${element.key}</a>`
}

result += '<tr>';
result += `<td class="text-center">${key+1}</td>`;
result += `<td>${text}</td>`;

if(res.category == "playTime") {
result += `<td>${moment.duration(element.value, "seconds").format("hh.mm")} hours</td>`
}
else {
result += `<td>${element.value.toLocaleString()}</td>`;
}
result += '</tr>';

});

$(".leaderboard").html(result);
$(".lb").show();

}
});
}

function stringSentenceCase(str) {
return str.replace(/\.\s+([a-z])[^\.]|^(\s*[a-z])[^\.]/g, s => s.replace(/([a-z])/,s => s.toUpperCase()))
}
