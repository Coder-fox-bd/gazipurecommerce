$(".piclist li img").first().addClass("active");

let thumbnails = document.getElementsByClassName('thumbnail')	
let activeImages = document.getElementsByClassName('active')

for (var i=0; i < thumbnails.length; i++){

    thumbnails[i].addEventListener('mouseover', function(){
        
        if (activeImages.length > 0){
            activeImages[0].classList.remove('active')
        }
        

        this.classList.add('active')
        document.getElementById('featured').srcset = this.srcset
    })
}


let buttonRight = document.getElementById('slideRight');
let buttonLeft = document.getElementById('slideLeft');

buttonLeft.addEventListener('click', function(){
    document.getElementById('slider').scrollTop -= 70;
})

buttonRight.addEventListener('click', function(){
    document.getElementById('slider').scrollTop += 70;
})