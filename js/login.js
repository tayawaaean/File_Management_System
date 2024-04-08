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