// // Toggle FAQs
// $(".btn-featurelistlist-toggle .btn").click(function() {
//     $(this).closest('.featurelistlist-wrapper').toggleClass('reveal-details');
// });
// // el.classList.toggle('active');

var btn_el = document.querySelector('.btn-featurelist-toggle .btn');

btn_el.onclick = function() {
    //console.log(btn_el.classList);
    btn_el.closest('.featurelist-wrapper').classList.toggle('reveal-details');
}