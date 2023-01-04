$(document).ready(function () {

    let skinViewer = new skinview3d.SkinViewer({
    canvas: document.getElementById("skin_container"),
    skin: `https://minotar.net/skin/` + $("#q_uuid").val()
    });
    
    skinViewer.width = 350;
    skinViewer.height = 350;
    
    $.ajax({
    url: 'ajax/getUserCape',
    type: 'POST',
    data: {
    uuid: $("#q_uuid").val()
    },
    dataType: 'text',
    success: function(response) {
    
    if(response.length != 0) {
    skinViewer.loadCape(response);
    }
    }
    });
    
    skinViewer.controls.enableZoom = false
    skinViewer.zoom = 0.8;
    skinViewer.fov = 85;
    skinViewer.animation = new skinview3d.WalkingAnimation();
    skinViewer.animation.headBobbing = false;
    skinViewer.animation.speed = 0.5;
    
    $('[data-toggle="tooltip"]').tooltip();   
    
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
    });
    
    
    $.ajax({
    url: 'ajax/getUserVillage',
    type: 'POST',
    data: {
    uuid: $("#q_uuid").val()
    },
    dataType: 'json',
    success: function(response) {
    if(response.length != 0) {
    $(".villages").show();
    if(typeof response.owner != 'undefined') {
    let o = [];
    response.owner.forEach(l => {
    o.push(`<a href="village?u=${l[0]}">${l[1]}</a>`);
    });
    $("#owned").html(o.join(', '));
    $(".own").show();
    }
    if(typeof response.assistant != 'undefined') {
    let a = [];
    response.assistant.forEach(k => {
    a.push(`<a href="village?u=${k[0]}">${k[1]}</a>`);
    });
    $("#assistant").html(a.join(", "));
    $(".asst").show();
    }
    if(typeof response.member != 'undefined') {
    let a = [];
    response.member.forEach(k => {
    a.push(`<a href="village?u=${k[0]}">${k[1]}</a>`);
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
            $('[data-toggle="banned"]').tooltip();   
            $(".banned").prop("id", "is_banned");
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
