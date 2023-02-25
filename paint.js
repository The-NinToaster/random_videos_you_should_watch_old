const canvas = document.getElementById("canvas")
canvas.height = 500;
canvas.width = 500;

const turtle = document.getElementById("follow")
var initbound = canvas.getBoundingClientRect()
turtle.style.left = initbound.left - 5 + 'px'
turtle.style.top = initbound.height - 410 + 'px'

var saul = document.getElementById("Saul")


function togglePlay()
{
    return saul.paused ? saul.play() : saul.pause();
}

const ctx = canvas.getContext("2d")
let prevX = null
let prevY = null

let clear = document.querySelector(".clear")
clear.addEventListener("click", () =>
{
    ctx.clearRect(0, 0, canvas.width, canvas.height)
})

ctx.lineWidth = 5

let draw = false

window.addEventListener('pointerdown', onMouseDown);
window.addEventListener('pointerup', onMouseUp);
window.addEventListener('pointermove', onMouseMove);


function onMouseDown(e)
{

    draw = true;
    document.getElementById("img").src="/pencil down.png";
    document.getElementById("big").src="/pencil down.png";

}

function onMouseUp(e)
{
    draw = false;
    document.getElementById("img").src="/pencil up.png";
    document.getElementById("big").src="/pencil up.png";
}



function onMouseMove(e){
    
    var rect = canvas.getBoundingClientRect() 

    if(prevX == null || prevY == null || !draw)
    {
        prevX = e.clientX - rect.left 
        prevY = e.clientY - rect.top
        if(e.clientX >= rect.left &&
        e.clientX <= rect.right &&
        e.clientY >= rect.top &&
        e.clientY <= rect.bottom)
        {
            turtle.style.left = e.clientX - 10 + 'px'
            turtle.style.top = e.clientY - 20 + 'px' 
        }

        return
    }

    let currentX = e.clientX - rect.left
    let currentY = e.clientY - rect.top

    ctx.beginPath()
    ctx.moveTo(prevX, prevY)
    ctx.lineTo(currentX, currentY)
    ctx.stroke()

    prevX = currentX 
    prevY = currentY 

    if( e.clientX >= rect.left &&
        e.clientX <= rect.right &&
        e.clientY >= rect.top &&
        e.clientY <= rect.bottom)
    {
        turtle.style.left = (e.clientX - 10) + 'px'            
        turtle.style.top = (e.clientY - 20) + 'px'
    }

}