<!doctype html>
<html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    </head>

    <body>
        <main class="main-content position-relative max-height-vh-100 bg-gray-200 h-100 border-radius-lg ">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
            <link rel="stylesheet" href="{{ asset('assets/css/ticket.css') }}">
            {{-- Start of Ticket Card  --}}
            <div class="content">
                <div class="ticket created-by-anniedotexe">
                    <div class="left">
                        {{-- Start of Ticket Image  --}}
                        <div class="image">
                            <p class="admit-one">
                                <span>bookmyticket.com</span>
                            </p>
                            <img src="{{ asset('storage/' . $ticket->event->image) }}"
                                style="max-height: 300px;,height:100%" alt="">
                            <div class="ticket-number">
                                <p>
                                    {{ $ticket->transaction_id }}
                                </p>
                            </div>
                        </div>
                        {{-- End of Ticket Image  --}}

                        {{-- Start of Ticket Info  --}}
                        <div class="ticket-info">
                            <p class="admit-one">
                                <span>bookmyticket.com</span>
                            </p>
                            <p class="date">
                                <span>{{ date('l', strtotime($ticket->event->date)) }}</span>
                                <span class="nov-10">{{ date('j F', strtotime($ticket->event->date)) }}</span>
                                <span>{{ date('Y', strtotime($ticket->event->date)) }}</span>
                            </p>
                            <div class="show-name">
                                <h1>{{ $ticket->event->name }}</h1>
                                <h6 class="about">{{ $ticket->event->about }}</h6>
                            </div>
                            <div class="time">
                                <p> {{ date('h:i A', strtotime($ticket->event->time)) }} </p>
                            </div>
                            <p class="location"><span>{{ $ticket->event->venue }}</span>
                            </p>
                        </div>
                    </div>
                    {{-- End of Ticket Info  --}}

                    {{-- Start of Ticket Purchase info  --}}
                    <div class="right">
                        <p class="admit-one">
                            <span>bookmyticket.com</span>
                        </p>
                        <div class="right-info-container">
                            <div class="show-name">
                                <h1>Purchase info</h1>
                            </div>
                            <div class="time">
                                <p> {{ date('d-m-Y', strtotime($ticket->created_at)) }} <span>
                                        {{ date('h:i A', strtotime($ticket->created_at)) }} </span>
                                </p>
                            </div>
                            <div class="barcode">
                                <img src="https://barcode.tec-it.com/barcode.ashx?data=010123456789012890TEC-IT%5CF8200https%3A%2F%2Fwww.tec-it.com&code=GS1QRCode&translate-esc=on&eclevel=L"
                                    alt="QR code">
                            </div>
                            <p class="ticket-number mt-3">
                                {{ $ticket->transaction_id }}
                            </p>
                        </div>
                        <div class="total-amount">
                            <p>Total Amount <span><b>₹{{ $ticket->total_price }}</b> </span></p>
                            <p>Quantity<span class="info mt-2"> <b>{{ $ticket->quantity }}</b></span></p>
                        </div>
                    </div>
                    {{-- End of Ticket Purchase info  --}}
                </div>
            </div>
            {{-- End of Ticket Card  --}}
        </main>
    </body>

</html>
