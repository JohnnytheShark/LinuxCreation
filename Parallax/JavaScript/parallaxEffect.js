window.addEventListener('scroll', function(e) {
// The below code will select all items that have a scroll class
const target = document.querySelectorAll('.scroll');
//The below will only select one item
//  const target = document.querySelector('.scroll');
//Just to move something based on scroll use the below:
/*
  target.style.transform = 'translate3d(0px,50px,0px)';
*/
  var scrolled = window.pageYOffset;
// Below would be if you are only targetting one item
//  var rate = scrolled * -1;
//  target.style.transform = 'translate3d(0px,'+rate+'px,0px)';

//For loop to iterate through each of the list items
  for(let i = 0; i < target.length; i++){
    var pos = window.pageYOffset * target[i].dataset.rate;
// If statement to determine the style of flow
    if(target[i].dataset.direction === "vertical"){
      target[i].style.transform = 'translate3d(0px,'+pos+'px,0px)';
    } else {
      var posX = window.pageYOffset * target[i].dataset.ratex;
      var posY = window.pageYOffset * target[i].dataset.ratey;
      target[i].style.transform = 'translate3d('+posX+'px, '+posY+'px, 0px)';
    }
  }
// The below would change the background if we scrolled
/*  target.style.background = "#ffcc00"
// The below console logs out the styles of the given item whenever scrolling
  console.log(target.style); */
});
