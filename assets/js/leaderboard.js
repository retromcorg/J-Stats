$(document).ready(function() {
    document.getElementsByName("cat")[0].addEventListener('change', getLb);

function getLb() {
    let cat = document.getElementsByName("cat")[0].value;
    $.ajax({
        url: 'ajax/getLeaderboard',
        type: 'POST',
        data: {
        category: cat
        },
        dataType: 'text',
        success: function(response) {
            $(".leaderboard").html(response);
        }
});
};

$('[data-toggle="tooltip"]').tooltip();   


});