
<nav>
    <a href="#">Features</a>
    <a href="#">PressKit</a>
    <a href="#">Download</a>
</nav>


<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #282d2d;
        font: normal 400 130%/1.5 -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    nav {
        display: grid;
        grid-auto-flow: column;
        grid-gap: 1em;
    }

    a {
        position: relative;
        font-weight: 600;
        text-decoration: none;
        color: white;
        opacity: 0.7;
        transition: opacity 0.3s cubic-bezier(0.51, 0.92, 0.24, 1);
    }
    a::after {
        --scale: 0;
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 100%;
        height: 3px;
        background: linear-gradient(135deg, #73fac8, #00bee1);
        transform: scaleX(var(--scale));
        transform-origin: var(--x) 50%;
        transition: transform 0.3s cubic-bezier(0.51, 0.92, 0.24, 1);
    }
    a:hover {
        opacity: 1;
    }
    a:hover::after {
        --scale: 1;
    }
</style>

<script>
    document.querySelectorAll('a').forEach(elem => {

        elem.onmouseenter =
            elem.onmouseleave = e => {

                const tolerance = 10;

                const left = 0;
                const right = elem.clientWidth;

                let x = e.pageX - elem.offsetLeft;

                if (x - tolerance < left) x = left;
                if (x + tolerance > right) x = right;

                elem.style.setProperty('--x', `${x}px`);

            };

    });
</script>

</style>
<!---->
<!---->
<!---->
<!--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">-->
<!---->
<!--<section class="hero-section">-->
<!--    <div class="card-grid">-->
<!--        <a class="card" href="#">-->
<!--            <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1557177324-56c542165309?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80)"></div>-->
<!--            <div class="card__content">-->
<!--                <p class="card__category">Category</p>-->
<!--                <h3 class="card__heading">Example Card Heading</h3>-->
<!--            </div>-->
<!--        </a>-->
<!--        <a class="card" href="#">-->
<!--            <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1557187666-4fd70cf76254?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60)"></div>-->
<!--            <div class="card__content">-->
<!--                <p class="card__category">Category</p>-->
<!--                <h3 class="card__heading">Example Card Heading</h3>-->
<!--            </div>-->
<!--        </a>-->
<!--        <a class="card" href="#">-->
<!--            <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1556680262-9990363a3e6d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60)"></div>-->
<!--            <div class="card__content">-->
<!--                <p class="card__category">Category</p>-->
<!--                <h3 class="card__heading">Example Card Heading</h3>-->
<!--            </div>-->
<!--        </a>-->
<!--        <a class="card" href="#">-->
<!--            <div class="card__background" style="background-image: url(https://images.unsplash.com/photo-1557004396-66e4174d7bf6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60)"></div>-->
<!--            <div class="card__content">-->
<!--                <p class="card__category">Category</p>-->
<!--                <h3 class="card__heading">Example Card Heading</h3>-->
<!--            </div>-->
<!--        </a>-->
<!--        <div>-->
<!--</section>-->
<!--<style>-->
<!--    :root{-->
<!--        --background-dark: #2d3548;-->
<!--        --text-light: rgba(255,255,255,0.6);-->
<!--        --text-lighter: rgba(255,255,255,0.9);-->
<!--        --spacing-s: 8px;-->
<!--        --spacing-m: 16px;-->
<!--        --spacing-l: 24px;-->
<!--        --spacing-xl: 32px;-->
<!--        --spacing-xxl: 64px;-->
<!--        --width-container: 1200px;-->
<!--    }-->
<!---->
<!--    *{-->
<!--        border: 0;-->
<!--        margin: 0;-->
<!--        padding: 0;-->
<!--        box-sizing: border-box;-->
<!--    }-->
<!---->
<!--    html{-->
<!--        height: 100%;-->
<!--        font-family: 'Montserrat', sans-serif;-->
<!--        font-size: 14px;-->
<!--    }-->
<!---->
<!--    body{-->
<!--        height: 100%;-->
<!--    }-->
<!---->
<!--    .hero-section{-->
<!--        align-items: flex-start;-->
<!--        background-image: linear-gradient(15deg, #0f4667 0%, #2a6973 150%);-->
<!--        display: flex;-->
<!--        min-height: 100%;-->
<!--        justify-content: center;-->
<!--        padding: var(--spacing-xxl) var(--spacing-l);-->
<!--    }-->
<!---->
<!--    .card-grid{-->
<!--        display: grid;-->
<!--        grid-template-columns: repeat(1, 1fr);-->
<!--        grid-column-gap: var(--spacing-l);-->
<!--        grid-row-gap: var(--spacing-l);-->
<!--        max-width: var(--width-container);-->
<!--        width: 100%;-->
<!--    }-->
<!---->
<!--    @media(min-width: 540px){-->
<!--        .card-grid{-->
<!--            grid-template-columns: repeat(2, 1fr);-->
<!--        }-->
<!--    }-->
<!---->
<!--    @media(min-width: 960px){-->
<!--        .card-grid{-->
<!--            grid-template-columns: repeat(4, 1fr);-->
<!--        }-->
<!--    }-->
<!---->
<!--    .card{-->
<!--        list-style: none;-->
<!--        position: relative;-->
<!--    }-->
<!---->
<!--    .card:before{-->
<!--        content: '';-->
<!--        display: block;-->
<!--        padding-bottom: 150%;-->
<!--        width: 100%;-->
<!--    }-->
<!---->
<!--    .card__background{-->
<!--        background-size: cover;-->
<!--        background-position: center;-->
<!--        border-radius: var(--spacing-l);-->
<!--        bottom: 0;-->
<!--        filter: brightness(0.75) saturate(1.2) contrast(0.85);-->
<!--        left: 0;-->
<!--        position: absolute;-->
<!--        right: 0;-->
<!--        top: 0;-->
<!--        transform-origin: center;-->
<!--        trsnsform: scale(1) translateZ(0);-->
<!--        transition:-->
<!--                filter 200ms linear,-->
<!--                transform 200ms linear;-->
<!--    }-->
<!---->
<!--    .card:hover .card__background{-->
<!--        transform: scale(1.05) translateZ(0);-->
<!--    }-->
<!---->
<!--    .card-grid:hover > .card:not(:hover) .card__background{-->
<!--        filter: brightness(0.5) saturate(0) contrast(1.2) blur(20px);-->
<!--    }-->
<!---->
<!--    .card__content{-->
<!--        left: 0;-->
<!--        padding: var(--spacing-l);-->
<!--        position: absolute;-->
<!--        top: 0;-->
<!--    }-->
<!---->
<!--    .card__category{-->
<!--        color: var(--text-light);-->
<!--        font-size: 0.9rem;-->
<!--        margin-bottom: var(--spacing-s);-->
<!--        text-transform: uppercase;-->
<!--    }-->
<!---->
<!--    .card__heading{-->
<!--        color: var(--text-lighter);-->
<!--        font-size: 1.9rem;-->
<!--        text-shadow: 2px 2px 20px rgba(0,0,0,0.2);-->
<!--        line-height: 1.4;-->
<!--        word-spacing: 100vw;-->
<!--    }-->
<!--</style>-->