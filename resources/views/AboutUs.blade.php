<!doctype html>
<html lang="en">

    <head>
        <title>About Us</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Exo+2:700');

            * {
                margin: 0 auto;
                padding: 0;
            }

            body {
                background: url("https://t4.ftcdn.net/jpg/02/38/09/01/360_F_238090138_Eej9cRVqoAyV75YGOjhRGvuQYNTwOjCT.jpg");
                background-color: #212121;
                background-blend-mode: overlay;
                background-position: center;
                background-size: cover;
                text-align: center;
            }

            h1 {
                color: whitesmoke;
                font-family: 'Exo 2', sans-serif;
                font-size: 46px;
                font-weight: 900;
                text-transform: uppercase;
            }

            p {
                max-width: 1200px;
                min-height: 150px;
                padding: 0;
                color: whitesmoke;
                font-family: OpenSans;
                font-size: 20px;
                font-weight: 300;
                line-height: 30px;
            }

            .square {
                height: 60px;
                width: 60px;
                border: 1px dashed white;
                margin: 0 0 0 55px;
                /*   padding: 1px; resize squares */
                background-color: rgba(255, 255, 255, 0.2);
                display: inline-block;
                transform: rotateZ(44deg);
            }

            .square:hover {
                background-color: rgba(27, 182, 239, 0.2);
                transition: ease 0.2s;
                cursor: pointer;
            }

            .square .icons {
                position: absolute;
                transform: rotateZ(-44deg);
                margin: 20px 0 0px 21px;
            }

            .fa-square-facebook,
            .fa-linkedin,
            .fa-envelope,
            .fa-instagram,
            .fa-dribbble {
                width: 11px;
                height: 22px;
                color: white;
                font-family: FontAwesome;
                font-size: 23px;
                font-weight: 400;
                text-transform: uppercase;
            }

            .square:hover .fa-square-facebook {
                color: rgba(59, 89, 152, 1)
            }

            .square:hover .fa-linkedin {
                color: rgb(63, 80, 207)
            }

            .square:hover .fa-envelope {
                color: rgb(211, 68, 68)
            }

            .square:hover .fa-instagram {
                color: rgba(229, 45, 39, 1)
            }

            .logo {
                margin: 1em;
                position: fixed;
                bottom: -72px;
                z-index: 99999999999;
                right: 0;
            }

            svg {}

            .pen {
                fill: black;
                animation: rotateInDownLeft 3s forwards;
            }

            .all {
                animation: rotateOut 3s forwards;
            }

            @keyframes rotateInDownLeft {
                from {
                    transform-origin: left bottom;
                    transform: rotate3d(0, 0, 0, 0deg);
                    opacity: 1;
                }

                to {
                    -webkit-transform-origin: left bottom;
                    transform-origin: left bottom;
                    transform: ;
                    transform: translateX(850px) translateY(-83px) rotate3d(0, 0, 1, -60deg);
                    opacity: 1;
                }
            }

            @keyframes rotateOut {
                from {
                    -webkit-transform-origin: center;
                    transform-origin: center;
                    opacity: 1;
                }

                to {
                    -webkit-transform-origin: center;
                    transform-origin: center;
                    -webkit-transform: rotate3d(0, 0, 1, 90deg);
                    transform: rotate3d(0, 0, 1, 90deg);
                    opacity: 1;
                }
            }
        </style>
    </head>

    <body>
        <h1>
            ABOUT US
            <br>
            <img src="https://image.ibb.co/nk616F/Layer_1_copy_21.png" width="47" height="11" align="center">
        </h1>
        <article>
            <p>
                At BookMyTickets.com, we're passionate about bringing people together through unforgettable live
                experiences. Whether you're a music enthusiast, a sports fanatic, or a theater buff, we're here to make
                sure you never miss out on the events that matter to you. Our platform is your gateway to a world of
                entertainment, where you can discover, book, and manage tickets for a diverse array of events, all in
                one place.
            </p>
            <p>
                What sets us apart is our commitment to providing a seamless and secure ticketing experience. We
                understand that buying tickets online can sometimes be a daunting task, which is why we've made it our
                mission to simplify the process for you. With our user-friendly interface, you can easily browse
                upcoming events, compare ticket prices, and select the seats that best suit your preferences. And with
                our secure payment gateway, you can book your tickets with confidence, knowing that your personal and
                financial information is always protected.
            </p>
            <p>
                But BookMyTickets.com is more than just a ticketing platform - we're a community of event-goers who
                share a love for live entertainment. Join us today and become part of our growing community. Whether
                you're attending a concert with friends, cheering on your favorite team, or exploring new cultural
                experiences, we're here to help you create memories that will last a lifetime.
            </p>

        </article>
        <div class="social_icons">
            <div class="square">
                <div class="icons pb-5 ps-4">
                    <i class="fa-brands fa-square-facebook fa-xl text-light"></i>
                </div>
            </div>
            <div class="square">
                <div class="icons pb-5 ps-4">
                    <i class="fa-brands fa-linkedin fa-xl text-light"></i>
                </div>
            </div>
            <div class="square">
                <div class="icons pb-5 ps-4">
                    <i class="fa-regular fa-envelope fa-xl text-light"></i>
                </div>
            </div>
            <div class="square">
                <div class="icons pb-5 ps-4">
                    <i class="fa-brands fa-instagram fa-xl text-light"></i>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    </body>

</html>
