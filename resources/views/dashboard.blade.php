<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/card.css') }}">
        <section class="h-100 h-custom ">
            <div class="container-fluid py-4 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                            <div class="full-background"
                                style="background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );">
                            </div>
                            <div class="card-body text-start p-4 w-100">
                                <h3 class="text-white mb-2">Book. Click. Enjoy 🔥</h3>
                                <p class="mb-4 font-weight-semibold">
                                    Check all the Events and choose the best.
                                </p>

                                <a href="{{ route('userticket') }}">
                                    <button type="button"
                                        class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0 p-2">
                                        <span class="btn-inner--icon me-2">
                                            <i class="fa-solid fa-store"></i>
                                        </span>
                                        <span class="btn-inner--text">Your Order</span>
                                    </button>
                                </a>
                                <img src="{{ asset('event.png') }}" alt="Event"
                                    class="position-absolute top-0 end-1 w-28 mb-0 max-width-250  d-sm-block d-none" />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container ">
                    <div class="row">

                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-3 g-4">

                                @foreach ($tickets as $ticket)
                                    <div class="col ">
                                        <a href="/ticketinfo/{{ $ticket->id }}">
                                            <div class="card h-100">
                                                @if ($ticket->image)
                                                    <img src="{{ asset('storage/' . $ticket->image) }}"
                                                        class="card-img-top" alt="Ticket Images" />
                                                @else
                                                    <div class="card-img-top">No Image Available!</div>
                                                @endif

                                                <div class="card-body">
                                                    <a class="card-action" href="{{ route('cart') }}"><i
                                                            class="fa-solid fa-cart-shopping"></i></a>
                                                    <div class="card-heading">
                                                        {{ $ticket->name }}
                                                    </div>
                                                    <div class="card-text">
                                                        {{ $ticket->venue }}
                                                    </div>
                                                    <div class="card-text ">
                                                        {{ $ticket->date }}
                                                    </div>
                                                    <div class="card-text">
                                                        {{ $ticket->price }}₹
                                                    </div>
                                                    <a href="#" class="card-button"> Purchase</a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <x-app.footer />
    </main>

</x-app-layout>
