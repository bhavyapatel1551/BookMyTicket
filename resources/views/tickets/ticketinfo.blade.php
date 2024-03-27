<x-app-layout>
    <style>
        #buy {
            background-color: blue;
            color: white;
        }

        #buy:hover {
            background-color: green
        }
    </style>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card ">
                        @if ($ticket->image)
                            <img src="{{ asset('storage/' . $ticket->image) }}"
                                class="card-img-top mx-auto d-block max-width-500" alt="Ticket Image" />
                        @else
                            <div>
                                No Image Available
                            </div>
                        @endif

                        <div class="card-body ms-5">
                            <h5 class="card-title  ">{{ $ticket->name }}</h5>
                            <p class="card-text">{{ $ticket->about }}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Date : {{ $ticket->date }}</li>
                                <li class="list-group-item">Time : {{ $ticket->time }}</li>
                                <li class="list-group-item">Venue : {{ $ticket->ve }}</li>
                                <li class="list-group-item">Price : $50</li>
                            </ul>
                            <a href="#" class="btn btn-primary" id="buy">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/cart.js') }}"></script>
</x-app-layout>
