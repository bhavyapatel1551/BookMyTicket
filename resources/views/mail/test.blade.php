<!doctype html>
<html lang="en">

    <head>
        <title>Event Ticket Booking</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    </head>

    <body
        style="
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      font-size: 14px;
    ">
        <div
            style="
        max-width: 680px;
        margin: 0 auto;
        padding: 45px 30px 60px;
        background: #f4f7ff;
        background-image: url(https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661497957196_595865/email-template-background-banner);
        background-repeat: no-repeat;
        background-size: 800px 452px;
        background-position: top center;
        font-size: 14px;
        color: #434343;
      ">
            <header>
                <table style="width: 100%;">
                    <tbody>
                        <tr style="height: 0;">
                            <td>
                                <img alt="" width="200px" src="{{ asset('ticket-white.png') }}"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAB5CAMAAAB4FGnoAAAAA3NCSVQICAjb4U/gAAAAS1BMVEVHcEz///////////////////8CAgL9/f3////////////////////////////////////////////////////////////////39/fHUpAxAAAAFnRSTlMAUtlfp2wN/bc7ifAxe+SYRc4nHMURYpUBvwAAFpZJREFUeJztnYmaqyoMgOuKFff9/Z/0EggIiEun9Yyda767TFtFlp8QQsDHQ0g2HBD6uOWvSnAEgCH+7WzecpZ0hwDIfzubt5wkz0PtP5Dfzuct50hPjgEwdL+d01vOkOfR9h+Guv/tzN7yYcmi+nDzwygQes1vZ/mWD0r1SuujOJIpo3+e81s+IgfNvx0AvGGgNwJfKR8BIOBGBLlniV8o7wEQ8CSUE2FKf6sYt/xUTADqcKRhGFIS1kPH/gj9IQwHP6RuAPJhpHTSfyLl7S38LjEBCB6kYF/W0yMYPPg5Hx4xSS1HobrZNX28EfguMQGIbADSIV4HIHKPECRsf604t7wqOxpgE4BV/9GY3L6Cb5E3NMCKAhDSZb9XpltekDc0gGkZLhF4bj64TaqTi6akb56B968edqLEbVZFn/bF/1wD7IcQ1FtNXAzk7HWFLEw6n5IJhqrk5GedKmnY+QUh08gK8mn76ucaoNgFYBj81Y4Hzz3ba9BqOflqAPTqPxeAFzSAd6D9mRQrCKTst/rDZVlI2VFpqH41AFVSkPGfAPCCBrAUwLpBQAPXc8PBjjGMjRGh79v+I0NEcQQA7dnuh855eS1X/dblvWzMJvS7PYtImtyX0QDmHJA+8lUCnOtECft+NL6ZBjJJwcQnP33bq1QfAYBdROSDQ9cFZBjl7+MrBADnZC4XpXMRWZeexEUiHmNnJUUu215GA4zWjd3grQcWLNeJFgA0o/vOdxcZuwMAtDrNxMGcYfC+YrpsdItBjYHi6eO270TGbV9GAxjtRVn+OtaI/l5ZlSw1wKMq53GEFmqJ4U1TMTwAwKONunlJw/HAuVy0fGn2uukrwUzJJtguqLRor6kBInYFAExo6O7Ig92RHQA8VEVz46CS3fI9f0F5BAAQ1VbT4ielncir1c9NZT8FQRKHMI+iPOefwvkaJuVmSvE/AeCHGoA8Gt7Fc06C00Ns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"
                                    height="30px" />
                            </td>
                            <td style="text-align: right;">
                                <span
                                    style="font-size: 16px; line-height: 30px; color: #ffffff;"><?php echo 'Date:-' . date('d-m-y'); ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </header>

            <main>
                <div
                    style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 115px;
            background: #ffffff;
            border-radius: 30px;
            text-align: center;
          ">
                    <div style="width: 100%; max-width: 489px; margin: 0 auto;">
                        <h1
                            style="
                margin: 0;
                font-size: 24px;
                font-weight: 500;
                color: #1f1f1f;
              ">
                            Your OTP
                        </h1>
                        <p
                            style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 500;
              ">
                            Hey {{ session('name') }},
                        </p>
                        <p
                            style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">
                            Thank you for choosing Our Event Ticket Booking System. Use the following OTP
                            to complete the procedure of regestration. OTP is
                            valid for
                            <span style="font-weight: 600; color: #1f1f1f;">5 minutes</span>.
                            Do not share this code with others, including bookmyticket.com employee.
                        </p>
                        <p
                            style="
                margin: 0;
                margin-top: 60px;
                font-size: 40px;
                font-weight: 600;
                letter-spacing: 25px;
                color: #ba3d4f;
              ">
                            {{ session('otp') }}
                        </p>
                    </div>
                </div>

                <p
                    style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #8c8c8c;
          ">
                    Need help? Ask at
                    <a href="mailto:archisketch@gmail.com"
                        style="color: #499fb6; text-decoration: none;">bookmyticketAdmin@gmail.com</a>
                    or visit our
                    <a href="" target="_blank" style="color: #499fb6; text-decoration: none;">Help Center</a>
                </p>
            </main>

            <footer
                style="
          width: 100%;
          max-width: 490px;
          margin: 20px auto 0;
          text-align: center;
          border-top: 1px solid #e6ebf1;
        ">
                <p
                    style="
            margin: 0;
            margin-top: 40px;
            font-size: 16px;
            font-weight: 600;
            color: #434343;
          ">
                    bookmyticket.com
                </p>
                <p style="margin: 0; margin-top: 8px; color: #434343;">
                    Address 208, Sola, Ahmedabad.
                </p>
                <div style="margin: 0; margin-top: 16px;">
                    <a href="" target="_blank" style="display: inline-block;">
                        <img width="36px" alt="Facebook"
                            src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661502815169_682499/email-template-icon-facebook" />
                    </a>
                    <a href="" target="_blank" style="display: inline-block; margin-left: 8px;">
                        <img width="36px" alt="Instagram"
                            src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661504218208_684135/email-template-icon-instagram" /></a>
                    <a href="" target="_blank" style="display: inline-block; margin-left: 8px;">
                        <img width="36px" alt="Twitter"
                            src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661503043040_372004/email-template-icon-twitter" />
                    </a>
                    <a href="" target="_blank" style="display: inline-block; margin-left: 8px;">
                        <img width="36px" alt="Youtube"
                            src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661503195931_210869/email-template-icon-youtube" /></a>
                </div>
                <p style="margin: 0; margin-top: 16px; color: #434343;">
                    Copyright © 2024 by bookmyticket.com, All rights reserved.
                </p>
            </footer>
        </div>
    </body>

</html>
