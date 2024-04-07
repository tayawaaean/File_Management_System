let front= document.querySelector('.containerFront');
let back = document.querySelector('.containerBack');
let side = document.querySelector('.containerSide');

let newUser = document.querySelector('.newUser');
let existingUser = document.querySelector('.existingUser');
let existingUser2 = document.querySelector('.existingUser2');
let forgotPass = document.querySelector('.forgotPass')

newUser.addEventListener('click', function(){
    front.style.zIndex = "1"
    back.style.zIndex = "2"
    side.style.zIndex = "0"
    front.style.transform = "rotateY(180deg)"
    back.style.transform = "rotateY(0deg)"
    side.style.transform = "rotateY(0deg)"
})
existingUser.addEventListener('click',function(){
    back.style.zIndex = "0"
    front.style.zIndex = "2"
    side.style.zIndex = "1"
    back.style.transform = "rotateY(180deg)" 
    front.style.transform = "rotateY(0deg)"
    side.style.transform = "rotateY(180deg)"
})
existingUser2.addEventListener('click',function(){
    back.style.zIndex = "0"
    front.style.zIndex = "2"
    side.style.zIndex = "1"
    back.style.transform = "rotateY(180deg)" 
    front.style.transform = "rotateY(0deg)"
    side.style.transform = "rotateY(180deg)"
})
forgotPass.addEventListener('click',function(){
    back.style.zIndex = "0"
    front.style.zIndex = "1"
    side.style.zIndex = "2"
    back.style.transform = "rotateY(0deg)" 
    front.style.transform = "rotateY(180deg)"
    side.style.transform = "rotateY(0deg)"
})

