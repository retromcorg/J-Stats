$(document).ready(function () {

let skinViewer = new skinview3d.SkinViewer({
canvas: document.getElementById("skin_container"),
skin: `https://minotar.net/skin/` + $("#q_uuid").val()
});

skinViewer.width = 350;
skinViewer.height = 350;
skinViewer.loadCape($("#q_cape").val());
skinViewer.controls.enableZoom = false
skinViewer.zoom = 0.8;
skinViewer.fov = 85;
skinViewer.animation = new skinview3d.WalkingAnimation();
skinViewer.animation.headBobbing = false;
skinViewer.animation.speed = 0.5;

});


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
if(response.length != 0) {
$(".villages").show();

if(typeof response.owner != 'undefined' && response.owner.length != 0) {
let o = [];
response.owner.forEach(l => {
o.push(`<a href="village?u=${l.village_uuid}">${l.village}</a>`);
});
$("#owned").html(o.join(', '));
$(".own").show();
}

if(typeof response.assistant != 'undefined' && response.assistant.length != 0) {
let a = [];
response.assistant.forEach(k => {
a.push(`<a href="village?u=${k.village_uuid}">${k.village}</a>`);
});
$("#assistant").html(a.join(", "));
$(".asst").show();
}

if(typeof response.member != 'undefined' && response.member.length != 0) {
let a = [];
response.member.forEach(k => {
a.push(`<a href="village?u=${k.village_uuid}">${k.village}</a>`);
});
$("#member").html(a.join(", "));
$(".mem").show();
}
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
