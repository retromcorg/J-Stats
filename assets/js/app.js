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


