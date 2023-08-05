<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool animation tricks |Praroz</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <p id="error">E <span>r</span>ror</p>
    <p id="code"><?=$error[0]?><span><?=$error[1]?></span><span><?=$error[2]?></span></p>
</div>

</body>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Monoton&display=swap');

    body {
        background-color: #111111;
    }
    div {
        margin-top: 90px;
        padding: 40px;
        font-size: 95px;
        font-family: 'Monoton', cursive;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 0 0 80px red,0 0 30px FireBrick,0 0 6px DarkRed;
        color: red;
    }
    div p{
        margin:5px;
    }
    #error:hover {
        text-shadow: 0 0 200px #ffffff,0 0 80px #008000,0 0 6px #0000ff;
    }
    #code:hover {
        text-shadow: 0 0 100px red,0 0 40px FireBrick,0 0 8px DarkRed;
    }
    #error {
        color: #fff;
        text-shadow: 0 0 80px #ffffff,0 0 30px #008000,0 0 6px #0000ff;
    }
    #error span {
        animation: upper 6s linear infinite;
    }
    #code span:nth-of-type(2) {
        animation: lower 9s linear infinite;
    }
    #code span:nth-of-type(1) {
        text-shadow: none;
        opacity:.4;
    }
    @keyframes upper {
        0%,19.999%,22%,62.999%,64%, 64.999%,70%,100% {
            opacity:.99;
            text-shadow: 0 0 80px #ffffff,0 0 30px #008000,0 0 6px #0000ff;
        }
        20%,21.999%,63%,63.999%,65%,69.999% {
            opacity:0.4;
            text-shadow: none;
        }
    }
    @keyframes lower {
        0%,12%,18.999%,23%,31.999%,37%,44.999%,46%,49.999%,51%,58.999%,61%,68.999%,71%,85.999%,96%,100% {
            opacity:0.99;
            text-shadow: 0 0 80px red,0 0 30px FireBrick,0 0 6px DarkRed;
        }
        19%,22.99%,32%,36.999%,45%,45.999%,50%,50.99%,59%,60.999%,69%,70.999%,86%,95.999% {
            opacity:0.4;
            text-shadow: none;
        }
    }

</style>


<!--<div class="error-404-wrap">-->
<!--    <h1 data-t="404" class="h1">404</h1>-->
<!--</div>-->
<!---->
<!--<style>-->
<!--    body {-->
<!--        margin: 0;-->
<!--    }-->
<!---->
<!--    h1 {-->
<!--        text-align: center;-->
<!--        width: 100%;-->
<!--        font-size: 6rem;-->
<!--        animation: shake .6s ease-in-out infinite alternate;-->
<!--        position: absolute;-->
<!--        margin: 0 auto;-->
<!--    }-->
<!--    h1:before {-->
<!--        content: attr(data-t);-->
<!--        position: absolute;-->
<!--        left: 50%;-->
<!--        transform: translate(-50%,.34em);-->
<!--        height: .1em;-->
<!--        line-height: .5em;-->
<!--        width: 100%;-->
<!--        animation: scan .5s ease-in-out 275ms infinite alternate,glitch-anim .3s ease-in-out infinite alternate;-->
<!--        overflow: hidden;-->
<!--        opacity: .7;-->
<!--    }-->
<!--    h1:after {-->
<!--        content: attr(data-t);-->
<!--        position: absolute;-->
<!--        top: -8px;-->
<!--        left: 50%;-->
<!--        transform: translate(-50%,.34em);-->
<!--        height: .5em;-->
<!--        line-height: .1em;-->
<!--        width: 100%;-->
<!--        animation: scan 665ms ease-in-out .59s infinite alternate,glitch-anim .3s ease-in-out infinite alternate;-->
<!--        overflow: hidden;-->
<!--        opacity: .8-->
<!--    }-->
<!---->
<!--    .error-404-wrap {-->
<!--        width: 100vw;-->
<!--        height: 100vh;-->
<!--        display: flex;-->
<!--        justify-content: center;-->
<!--        align-items: center;-->
<!--        overflow: hidden;-->
<!--        position: relative;-->
<!--    }-->
<!---->
<!--    @keyframes glitch-anim {-->
<!--        0% {-->
<!--            clip: rect(32px,9999px,28px,0)-->
<!--        }-->
<!---->
<!--        10% {-->
<!--            clip: rect(13px,9999px,37px,0)-->
<!--        }-->
<!---->
<!--        20% {-->
<!--            clip: rect(45px,9999px,33px,0)-->
<!--        }-->
<!---->
<!--        30% {-->
<!--            clip: rect(31px,9999px,94px,0)-->
<!--        }-->
<!---->
<!--        40% {-->
<!--            clip: rect(88px,9999px,98px,0)-->
<!--        }-->
<!---->
<!--        50% {-->
<!--            clip: rect(9px,9999px,98px,0)-->
<!--        }-->
<!---->
<!--        60% {-->
<!--            clip: rect(37px,9999px,17px,0)-->
<!--        }-->
<!---->
<!--        70% {-->
<!--            clip: rect(77px,9999px,34px,0)-->
<!--        }-->
<!---->
<!--        80% {-->
<!--            clip: rect(55px,9999px,49px,0)-->
<!--        }-->
<!---->
<!--        90% {-->
<!--            clip: rect(10px,9999px,2px,0)-->
<!--        }-->
<!---->
<!--        to {-->
<!--            clip: rect(35px,9999px,53px,0)-->
<!--        }-->
<!--    }-->
<!--    @keyframes scan {-->
<!--        0%,20%,to {-->
<!--            height: 0;-->
<!--            transform: translate(-50%,.44em)-->
<!--        }-->
<!---->
<!--        10%,15% {-->
<!--            height: 1em;-->
<!--            line-height: .2em;-->
<!--            transform: translate(-55%,.09em)-->
<!--        }-->
<!--    }-->
<!--    @keyframes shake {-->
<!--        0% {-->
<!--            transform: translate(-1px)-->
<!--        }-->
<!---->
<!--        10% {-->
<!--            transform: translate(2px,1px)-->
<!--        }-->
<!---->
<!--        30% {-->
<!--            transform: translate(-3px,2px)-->
<!--        }-->
<!---->
<!--        35% {-->
<!--            transform: translate(2px,-3px);-->
<!--            filter: blur(4px)-->
<!--        }-->
<!---->
<!--        45% {-->
<!--            transform: translate(2px,2px) skewY(-8deg) scaleX(.96);-->
<!--            filter: blur(0)-->
<!--        }-->
<!---->
<!--        50% {-->
<!--            transform: translate(-3px,1px)-->
<!--        }-->
<!--    }-->
<!--</style>-->