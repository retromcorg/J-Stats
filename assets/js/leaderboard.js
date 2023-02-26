$(document).ready(function() {
document.getElementsByName("cat")[0].addEventListener('change', getLb);

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
    result += `<td>${element.value}</td>`;
    result += '</tr>';

});

$(".leaderboard").html(result);
$(".lb").show();

}
});
};


});
function stringSentenceCase(str) {
    return str.replace(/\.\s+([a-z])[^\.]|^(\s*[a-z])[^\.]/g, s => s.replace(/([a-z])/,s => s.toUpperCase()))
}