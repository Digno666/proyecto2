<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is where your description goes">
        <meta name="keywords" content="one, two, three">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>YhamilkaTL-Beauty</title>
        <link rel="shortcut icon" href="./assets/favicon.png" />
        <!-- external CSS link -->
        <script src="https://kit.fontawesome.com/3f7da84ca4.js" crossorigin="anonymous"></script>

        <!-- font Crimson Text -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">

        <style>
            * {
    box-sizing: border-box;
  }
  html,
  body {
    width: 100%;
    overflow-x: hidden;
  }
  
  html {
    font-size: 62.5%;
  }
  
  body {
    background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center fixed;
    background-size: cover; 
    font-family: 'Crimson Text', serif;
    position: relative; 
    min-height: 100vh; 
    margin: 0; 
  }
  
  body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #f6f0e9;
    opacity: 0.92;
    z-index: 1; 
    pointer-events: none; 
  }
  
  body * {
    position: relative; 
    z-index: 2;
  }
  
  
  header {
    height: 55px;
  }
  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f6f0e9;
    box-shadow: 0px 8px 20px rgba(58, 27, 15, 0.8); 
    padding: 10px 50px; 
    position: sticky;
    top: 0; 
    z-index: 1000;
  }
  main {
    box-shadow: 0px 8px 20px rgba(58, 27, 15, 0.8);
    z-index: 1;
  }
  #servicio {
    box-shadow: 
      /* 0 -8px 20px rgba(58, 27, 15, 0.5),*/
      0 8px 20px rgba(58, 27, 15, 0.8); 
  }
  footer {
    padding-top: 20px;
    padding-bottom: 30px; 
    display: flex;
    justify-content: center;
    position: relative;
    background: url('{{ asset('img/fondo.jpg') }}') no-repeat center center;
    background-size: cover;
  }
  
  footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #C3B3AE;
    opacity: 0.7;
    z-index: 1; 
  }
  
  footer * {
    position: relative; 
    z-index: 2;
  }
  
  
  
  
  nav img {
    height: 50px;
    width: auto;
  
    padding-left: 50px;
  }
  #ioio{
    margin-top: 0 !important;
  }
  .menu a{
    font-size: 18px;
  }
  
  .imageFull {
    display: block;
  }
  
  .imageMobile,
  #menu-toggle,
  .menu:first-child {
    display: none;
  }
  
  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
  
  }
  
  nav a {
    text-decoration: none;
    color: #3a1b0f;
    font-weight: bold;
    font-size: 1.3rem;
    padding: 5px;
  
  }
  nav a:hover{
    border-bottom: #3a1b0f solid 2px;
    border-radius: 5px;
    box-shadow: #3a1b0f;
  }
  
  ul {
    display: flex;
    align-items: center;
  }
  
  ul li {
    list-style: none;
    width: 130px;
  }
  
  
  /* ============= main section ================*/
  
  main {
    background: url('{{ asset('img/mainbg.png') }}'), #f6f0e9;
    background-repeat: no-repeat, no-repeat;
    background-size: cover, cover;
    height: 675px;
  }
  
  main>section>* {
    margin: 0 150px;
  }
  
  main section {
    width: 800px;
  }
  
  main h1 {
    font-size: 9rem;
    padding-top: 100px;
    padding-bottom: 10px;
    color: #3a1b0f;
  }
  
  main h1+p {
    font-size: 1.25rem;
    padding: 0 0 30px 0;
  
  }
  
  .nuestrosserviciosprincipal,
  .links {
  
    border: #3a1b0f 1px solid;
    background: #3a1b0f;
    color: #f6f0e9;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
  }
  
  .nuestrosserviciosprincipal:hover,
  .links:hover {
  
    border: #3a1b0f 1px solid;
    background: #f6f0e9;
    color: #3a1b0f;
  }
  
  .firstVisitorsDiscount {
    border: #3a1b0f 1px solid;
    background: #3a1b0f;
    color: #f6f0e9;
    width: 180px;
    padding: 10px 10px 20px 20px;
    margin-top: 50px;
    border-radius: 5px;
  
  }
  
  .firstVisitorsDiscount p {
    font-size: 1.25rem;
    padding-bottom: 15px;
  }
  
  .firstVisitorsDiscount p span {
    font-size: 2.25rem;
    font-weight: bold;
  }
  
  .firstVisitorsDiscount a {
    border: #f6f0e9 1px solid;
    background: #f6f0e9;
    color: #3a1b0f;
    text-decoration: none;
    margin-top: 10px;
    padding: 5px 10px;
    font-weight: bold;
  }
  
  /* ============= about section ================*/
  
  .acercanosotros {
    margin: 100px 0 50px 0;
  
  }
  
  .acercanosotros h3 {
    font-size: 3rem;
  }
  
  .acercanosotros h1 {
    font-size: 6rem;
  }
  
  .acercanosotros p {
    font-size: 2rem;
    padding-bottom: 50px;
  }
  
  .acercanosotros a {
    text-decoration: none;
  
  }
  
  /* ============= servicio section ================*/
  
  .servicio {
    display: flex;
    justify-content: space-evenly;
    text-align: center;
    padding: 100px 0;
    position: relative; 
    background: url('{{ asset('img/fondo3.jpg') }}') no-repeat center center;
    background-size: cover; 
  }
  
  .servicio::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #C3B3AE;
    opacity: 0.95;
    z-index: 1; 
  }
  
  .servicio * {
    position: relative; 
    z-index: 2;
  }
  
  
  .servicio h3 {
    color: #f6f0e9;
  }
  
  .servicioIndividual {
    font-size: 1.5rem;
    width: 200px;
  }
  
  .acercanosotros,
  .galeria {
    text-align: center;
  }
  
  /* ============= servicio section ================*/
  .galeria {
    margin-top: 60px;
    margin-bottom: 40px;
  }
  
  .galeria h2 {
    font-size: 4rem;
  }
  
  .container,
  .wg-slider {
    display: flex;
    justify-content: center;
  }
  footer {
    padding-top: 20px;
    padding-bottom: 30px;
    display: flex;
    justify-content: center;
    position: relative; 
    background: url('{{ asset('img/fondo3.jpg') }}') no-repeat center center;
    background-size: cover;
  }
  
  footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #C3B3AE;
    opacity: 0.95;
    z-index: 1; 
  }
  
  footer * {
    position: relative; 
    z-index: 2;
  }
  
  
  .ourCare ul li:hover,
  .businessHours p a:hover {
    border-bottom: 2px solid #f6f0e9;
  
  }
  
  nav li a:hover {
    border-bottom: 2px solid #3a1b0f;
  }
  
  footer>section {
    padding: 0 70px;
    text-align: center;
  }
  
  footer h3 {
    color: #3a1b0f;
    font-size: 2.5rem;
    text-align: center;
  
  }
  
  footer span {
    font-weight: bold;
  }
  
  .ourCareUl {
    display: flex;
    flex-direction: column;
    text-align: center;
    display: inline-block;
    padding-left: 0;
  
  }
  
  .ourCare ul li {
    margin-top: 5px;
  }
  
  .ourCare a,
  .contacto h5 {
    text-decoration: none;
    color: #3a1b0f;
    font-size: 1.5rem;
  
  }
  
  .businessHours {
  
    text-align: center;
  }
  
  .businessHours h3+p {
    margin: 35px 0;
  }
  
  .businessHours ul {
    width: 180px;
    display: flex;
    justify-content: space-around;
    padding-left: 0;
  }
  
  .businessHours i {
    border: 1px solid #3a1b0f;
    padding: 8px;
    border-radius: 50%;
    color: #3a1b0f;
  
  }
  
  .businessHours i:hover {
    border: 1px solid #f6f0e9;
    padding: 8px;
    border-radius: 50%;
    color: #f6f0e9;
  
  }
  
  .businessHours p footer ul li {
    list-style: none;
    padding: 0 0 5px 0;
  }
  
  footer p {
    font-size: 1.5rem;
  }
  
  .businessHours ul+p {
    margin-top: 30px;
  
  }
  
  .businessHours p+p {
    margin: 0;
  }
  
  .businessHours ul+p a,
  .businessHours p+p a {
  
    color: #3a1b0f;
    font-weight: bold;
    text-decoration: none;
  }
  
  .contacto h5 {
    margin: 0;
  }
  @media screen and (max-width: 480px) {
    .menu {
        display: flex;
        flex-direction: row;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .menu>li {
        margin: 0 1rem;
        overflow: hidden;
    }

    .menu-button-container {
        display: none;
        height: 100%;
        width: 30px;
        cursor: pointer;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #menu-toggle {
        display: none;
    }

    .menu-button,
    .menu-button::before,
    .menu-button::after {
        display: block;
        background-color: #3a1b0f;
        position: absolute;
        height: 4px;
        width: 30px;
        transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
        border-radius: 2px;
    }

    .menu-button::before {
        content: '';
        margin-top: -8px;
    }

    .menu-button::after {
        content: '';
        margin-top: 8px;
    }

    #menu-toggle:checked+.menu-button-container .menu-button::before {
        margin-top: 0px;
        transform: rotate(405deg);
    }

    #menu-toggle:checked+.menu-button-container .menu-button {
        background: rgba(255, 255, 255, 0);
    }

    #menu-toggle:checked+.menu-button-container .menu-button::after {
        margin-top: 0px;
        transform: rotate(-405deg);
    }
}

@media screen and (max-width: 480px) and (max-width: 700px) {
    .menu-button-container {
        display: flex;
    }

    .menu {
        position: absolute;
        top: 0;
        margin-top: 50px;
        left: 0;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        align-items: center;
    }

    .menu li,
    .contacto,
    .bookOnline {
        list-style: none;
        width: 100%;
    }

    .contacto {
        padding-right: 0;
    }

    .bookOnline {
        padding: 0;
        border: none;
    }

    #menu-toggle~.menu li a {
        height: 0;
        margin: 0;
        padding: 0;
        border: 0;
        transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    #menu-toggle:checked~.menu li a {
        border: 1px solid #DED0C9;
        height: 2.5em;
        padding: 0.5em;
        transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    .menu>li a {
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0.5em 0;
        width: 100%;
        color: white;
        background-color: #3a1b0f;
    }

    .menu>li:not(:last-child) a {
        border-bottom: 1px solid #444;
    }
}@media screen and (max-width:480px) {
    html {
        font-size: 40%;
    }

    html,
    body {
        width: 100%;
        overflow-x: hidden;
    }

    header {
        height: 50px;
    }

    main section {
        width: 650px;
    }

    main>section>* {
        margin: 0 40px;
    }

    main h1 {
        font-size: 6rem;
        padding-top: 88px;
    }

    main {
        background: url('{{ asset('img/mainbg-mobile.png') }}');
        background-repeat: no-repeat;
        background-position: bottom right;
        background-size: cover;
        height: 475px;
    }

    .imageFull {
        display: block;
    }

    .imageMobile {
        display: block;
    }

    nav {
        justify-content: space-evenly;
        align-items: center;
    }

    nav img {
        height: 50px;
        width: auto;
        padding-right: 20vw;
        padding-left: 10px;
    }

    nav ul {
        display: none;
    }

    .acercanosotros {
        margin: 100px 20px 47px 20px;
    }

    .acercanosotros h3 {
        font-size: 1.5rem;
    }

    .acercanosotros h1 {
        font-size: 3rem;
    }

    .acercanosotros p {
        width: 200px;
        margin: auto;
        font-size: 1.45rem;
    }

    .servicio {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 0;
    }

    .galeria {
        margin-top: 150px;
    }

    footer {
        flex-direction: column;
    }

    footer>section {
        padding: 0;
    }

    .businessHours ul {
        width: 180px;
        margin: auto;
    }

}

@media (min-width:481px) and (max-width:825px) {

    html,
    body {
        width: 100%;
        overflow-x: hidden;
    }

    nav img {
        padding-right: 0px;
        padding-left: 10px;
    }

    html,
    body {
        width: 100%;
        overflow-x: hidden;
    }

    nav ul {
        display: flex;
        justify-content: space-evenly;
        padding-right: 10px
    }

    nav ul li:first-child,
    nav ul li:nth-child(2),
    nav ul li:nth-child(3) {
        display: none;
    }

    footer>section {
        padding: 0 10px;
        text-align: center;
    }

    main {
        background: url(../assets/mainbg-tablet.png);
        background-repeat: no-repeat;
        height: 600px;
    }

    .imageFull {
        height: 50px;
        width: auto;
        padding-right: 1vw;
        padding-left: 20px;
    }

    main>section>* {
        margin: 0 50px;
    }

    nav ul li {
        list-style: none;
        width: 100px;
    }


    .acercanosotros p {
        width: 400px;
        margin: auto;
    }

    .acercanosotros h1 {
        font-size: 5rem;
    }
}html {
    /* 1rem = 10px  */
    font-size: 62.5%;
}


.container {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}

.wgh-slider {
    position: relative;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
}

.wgh-slider__viewport {
    position: relative;
    height: 100%;
    width: 100%;
}

.wgh-slider__viewbox {
    display: block;
    position: relative;
    perspective: 100vw;
    margin: 0 auto;
    width: 50%;
    max-width: 400px;
    border-radius: 5px;
    transform-style: preserve-3d;
    z-index: 0;
}

.wgh-slider__viewbox::before {
    position: relative;
    top: 0;
    left: 0;
    display: block;
    content: "";
    height: 0;
    padding-bottom: 100%;
    width: 100%;
}

.wgh-slider__container {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    transition: transform 0.3s cubic-bezier(0.62, 0.28, 0.23, 0.99) 0.3s;
    transform-style: preserve-3d;
}

.wgh-slider-target {
    position: absolute;
    width: 0;
    height: 0;
    opacity: 0;
    visibility: hidden;
}

input.wgh-slider-target {
    display: none;
}

.wgh-slider-target:first-of-type:last-of-type~.wgh-slider__viewport .wgh-slider-item:nth-child(1) .wgh-slider-item__trigger {
    display: none;
}

.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(0%);
}

.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-50%);
}

.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-100%);
}

.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-150%);
}

.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-200%);
}

.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-250%);
}

.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-300%);
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider__container {
    transform: translateX(-350%);
}

.wgh-slider-item {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 1;
    transform: translate3d(0, 0, 0) rotateY(45deg);
    transition: transform 0.6s cubic-bezier(0.62, 0.28, 0.23, 0.99) 0.15s;
}

.wgh-slider-item:nth-child(1) {
    left: 0%;
}

.wgh-slider-item:nth-child(2) {
    left: 50%;
}

.wgh-slider-item:nth-child(3) {
    left: 100%;
}

.wgh-slider-item:nth-child(4) {
    left: 150%;
}

.wgh-slider-item:nth-child(5) {
    left: 200%;
}

.wgh-slider-item:nth-child(6) {
    left: 250%;
}

.wgh-slider-item:nth-child(7) {
    left: 300%;
}

.wgh-slider-item:nth-child(8) {
    left: 350%;
}

.wgh-slider-item__trigger {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    cursor: pointer;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2) .wgh-slider-item__trigger,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1) .wgh-slider-item__trigger {
    display: none;
}

.wgh-slider-item__inner {
    position: relative;
    width: 100%;
    height: 100%;
    transform-origin: center center;
    transform: scale(0.75);
    transition: transform 0.3s cubic-bezier(0.62, 0.28, 0.23, 0.99) 0s;
    z-index: 10;
}

.wgh-slider-item__inner::before,
.wgh-slider-item__inner::after {
    display: block;
    position: absolute;
    content: "";
}

.wgh-slider-item__inner::before {
    top: 24px;
    left: 24px;
    bottom: 24px;
    right: 24px;
    z-index: 0;
    transition: transform 0.3s cubic-bezier(0.62, 0.28, 0.23, 0.99) 0.15s;
    transform: translate(-24px, 12px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}

.wgh-slider-item__inner::after {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background-image: linear-gradient(90deg, rgba(0, 0, 0, 0) 0%, #000 50%, rgba(0, 0, 0, 0) 100%);
    background-repeat: repeat-x;
    background-size: 200% 100%;
    background-position: 0% 0%;
    transition: background-position 0.3s linear;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2) .wgh-slider-item__inner,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1) .wgh-slider-item__inner {
    transform: scale(1);
    transition-delay: 0.6s;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2) .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1) .wgh-slider-item__inner::before {
    transform: translate(0, 24px);
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2) .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1) .wgh-slider-item__inner::after {
    background-position: -50% 0%;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2)~.wgh-slider-item .wgh-slider-item__inner::before,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1)~.wgh-slider-item .wgh-slider-item__inner::before {
    transform: translate(24px, 12px);
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2)~.wgh-slider-item .wgh-slider-item__inner::after,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1)~.wgh-slider-item .wgh-slider-item__inner::after {
    background-position: -100% 0%;
}

.wgh-slider-item-figure {
    position: relative;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.wgh-slider-item-figure__image {
    position: absolute;
    display: block;
    max-width: 100%;
    max-height: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 1;
    opacity: 1;
}

.wgh-slider-item-figure__caption {
    position: absolute;
    display: block;
    overflow: hidden;
    left: 0;
    right: 0;
    bottom: 0;
    color: #fff;
    padding: 24px;
    background-image: linear-gradient(0deg, #000 0%, transparent 100%);
    z-index: 2;
}

.wgh-slider-item-figure__caption a {
    display: inline-block;
    text-decoration: none;
    font-size: 1.8rem;
    line-height: 2rem;
    font-weight: bold;
    color: #fff;
}

.wgh-slider-item-figure__caption span {
    display: block;
    font-size: 1.4rem;
    line-height: 1.6rem;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8),
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7),
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6),
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5),
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4),
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3),
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2),
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1) {
    transform: translate3d(0, 0, 0) rotateY(0deg);
    z-index: 9999;
}

.wgh-slider-target:nth-of-type(8):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(8)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(7):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(7)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(6):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(6)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(5):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(5)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(4):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(4)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(3):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(3)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(2):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(2)~.wgh-slider-item,
.wgh-slider-target:nth-of-type(1):checked~.wgh-slider__viewport .wgh-slider-item:nth-child(1)~.wgh-slider-item {
    transform: translate3d(0, 0, 0) rotateY(-45deg) !important;
}

/******************************************
/* MEDIA QUERIES
/*******************************************/

@media screen and (max-width: 480px) {
    .wgh-slider-item-figure__caption a {
        font-size: .75rem;
        line-height: 1rem;
    }

    .wgh-slider-item-figure__caption span {
        font-size: 1.2rem;
        line-height: .8rem;
    }

    .container {
        height: 300px;
    }
}

@media (min-width:481px) and (max-width:800px) {
    .wgh-slider-item-figure__caption a {
        font-size: 1.4rem;
        line-height: 1rem;
    }

    .wgh-slider-item-figure__caption span {
        font-size: 1.5rem;
        line-height: 1.5rem;
    }
}
#jojo{
    border: #3a1b0f solid 2px;
    border-radius: 2px;
}
#jojo:hover{
    background-color: #e07668 !important;
    color: #f6f0e9;
}
        </style>
    </head>

    <body>
        <header>
            <nav>
                <img src="{{asset('img/logoSalon.png')}}" alt="Hair icon with text Vige and Co." class="imageFull"> 
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <ul class="menu">
                    <li><a href="#servicio">Servicios</a></li>
                    <li><a href="#galeria">Galería</a></li>
                    <li><a href="#contacto">contacto</a></li>
                    <li>  <a href="{{ route('login.index') }}" id="jojo">Iniciar Sesión</a></li>   
                    {{-- <li><a href="#">Registrarse</a></li> --}}
                    <!--with border -->
                </ul>
            </nav>
        </header>
        <main id="inicio">
            <section>
                <h1>YhamilkaTL Beauty</h1>
                <p>EL LUGAR IDEAL DONDE RESALTAMOS TU BELLEZA</p>
                <section class="firstVisitorsDiscount">
                    <h3>Es la primera vez que nos visitas ?</h3>
                    <p> <span>-20%</span> Por tu primer peinado.</p>
                    <a href="#galeria">Galería </a>
                </section>
            </section>
        </main>

        <section id="about" class="acercanosotros">
            <h3>ACERCA DE NOSOTROS</h3>
            <h1>Tu belleza es tu prioridad</h1>
            <p>Somos un salón de belleza con un inicio de trayectoria enfocado en brindar la mejor experiencia con nuestros servicios para hacerte lucir mas bella.</p>
        </section>

        <section id="servicio" class="servicio">
            <section class="servicioIndividual">
                <img src="{{asset('img/icons8-hairdresser-64.png')}}" alt="beautician">
                <h2>Expertos en belleza</h2>
                <p>Con experiencia y conocimineto trabajando para obtener los mejores resultados.</p>
            </section>
            <section class="servicioIndividual">
                <img src="{{ asset('img/icons8-barber-chair-64.png') }}"
                alt="salon chair">
                <h2>calidad de servicios</h2>
                <p>Trabajmos constantemente enmejoras nuestros servicios ya que nuestra meta es que tu sinetas tu belleza.</p>
            </section>
            <section class="servicioIndividual">
              
                <img src=  "{{asset('img/icons8-grocery-shelf-64.png')}}" alt="beauty products">
                <h2>Productos originales</h2>
                <p>Utilizamos productos originales y verificados para cuidarte a ti.</p>
            </section>
        </section>

        <section id="galeria" class="galeria">
            <h2 id="ioio">Galería de servicios</h2>
            <!-- partial:index.partial.html -->
            <div class="container">
                <div class="wgh-slider">
                    <input class="wgh-slider-target" type="radio" id="slide-1" name="slider" />
                    <input class="wgh-slider-target" type="radio" id="slide-2" name="slider" />
                    <input class="wgh-slider-target" type="radio" id="slide-3" name="slider" checked="checked" />
                    <input class="wgh-slider-target" type="radio" id="slide-4" name="slider" />
                    <input class="wgh-slider-target" type="radio" id="slide-5" name="slider" />
                    <div class="wgh-slider__viewport">
                        <div class="wgh-slider__viewbox">
                            <div class="wgh-slider__container">
                                <div class="wgh-slider-item">
                                    <div class="wgh-slider-item__inner">
                                        <figure class="wgh-slider-item-figure"><img
                                                class="wgh-slider-item-figure__image" src="{{ asset('img/3.png') }}"
                                                alt="The 5th Exotic" />
                                            <figcaption class="wgh-slider-item-figure__caption"><a href="#">Peinados</a><span>Servicio</span></figcaption>
                                        </figure>
                                        <label class="wgh-slider-item__trigger" for="slide-1"
                                            title="Show product 1"></label>
                                    </div>
                                </div>
                                <div class="wgh-slider-item">
                                    <div class="wgh-slider-item__inner">
                                        <figure class="wgh-slider-item-figure"><img
                                                class="wgh-slider-item-figure__image" src="{{ asset('img/2.png') }}"
                                                alt="The 5th Exotic" />
                                            <figcaption class="wgh-slider-item-figure__caption"><a href="#">Cortes de cabello</a><span>Servicio</span></figcaption>
                                        </figure>
                                        <label class="wgh-slider-item__trigger" for="slide-2"
                                            title="Show product 2"></label>
                                    </div>
                                </div>
                                <div class="wgh-slider-item">
                                    <div class="wgh-slider-item__inner">
                                        <figure class="wgh-slider-item-figure"><img
                                                class="wgh-slider-item-figure__image" src="{{ asset('img/1.png') }}"
                                                alt="The 5th Exotic" />
                                            <figcaption class="wgh-slider-item-figure__caption"><a href="#">Coloración de cabello</a><span>Servicio</span></figcaption>
                                        </figure>
                                        <label class="wgh-slider-item__trigger" for="slide-3"
                                            title="Show product 3"></label>
                                    </div>
                                </div>
                                <div class="wgh-slider-item">
                                    <div class="wgh-slider-item__inner">
                                        <figure class="wgh-slider-item-figure"><img
                                                class="wgh-slider-item-figure__image" src="{{ asset('img/4.png') }}"
                                                alt="The 5th Exotic" />
                                            <figcaption class="wgh-slider-item-figure__caption"><a href="#">Maquillaje</a><span>Servicio</span></figcaption>
                                        </figure>
                                        <label class="wgh-slider-item__trigger" for="slide-4"
                                            title="Show product 4"></label>
                                    </div>
                                </div>
                                <div class="wgh-slider-item">
                                    <div class="wgh-slider-item__inner">
                                        <figure class="wgh-slider-item-figure"><img
                                                class="wgh-slider-item-figure__image" src="{{ asset('img/5.png') }}"
                                                alt="RYSY - Traveler LP" />
                                            <figcaption class="wgh-slider-item-figure__caption"><a href="#">Lifting de pestañás</a><span>Servicio</span></figcaption>
                                        </figure>
                                        <label class="wgh-slider-item__trigger" for="slide-5"
                                            title="Show product 5"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- partial -->

        </section>

        <footer>
            <section class="ourCare">
                <h3>NUESTROS SERVICIOS</h3>
                <ul class="ourCareUl">
                    <li><a href="#">Peinados</a></li>
                    <li><a href="#">Coloración de cabello</a></li>
                    <li><a href="#">Extensiones</a></li>
                    <li><a href="#">Maquillaje</a></li>
                    <li><a href="#">Lifting de pestañás</a></li>
                </ul>
            </section>

            <section class="businessHours">
                <h3>HORARIO DE ATENCIÓN</h3>
                <p><span>Lunes</span> a <span>Sábado</span> con reserva previa</p>
             
            </section>

            <section id="contacto" class="contacto">
                <h3>CONTACTO</h3>
                <section>
                    <h5>Dirección</h5>
                    <p>Calle Capitaán ustarez al lado del Coelgio Juan Pablo II</p>
                </section>
                <section>
                    <h5>Teléfono</h5>
                    <p>73335551</p>
                </section>
                <section>
                    <h5>Correo electrónico</h5>
                    <p>yhamilka@gmail.com</p>
                </section>
            </section>
        </footer>
    </body>
</html>