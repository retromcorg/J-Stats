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
  

var clipboard = new ClipboardJS('.copybtn');

clipboard.on('success', function(e) {
    setTooltip('Copied!', '.copybtn');
    hideTooltip(e.trigger, '.copybtn');
});


$("#searchForm").on("submit", function(event){
    event.preventDefault();
    var query = $("#search").val();
    $.ajax({
      url:"ajax/getUser",
        data: {search: query},
        method: "POST",
        success: function(data){

        if(data.type != 'success') {
        Swal.fire({
          title: data.title,
          icon: data.type,
          text: data.message,
          allowOutsideClick: false,
          allowEscapeKey: false
          })
        }
      else {
          window.location = `player?u=${data.uuid}&n=${data.name}`;
      }
    }
  });
});