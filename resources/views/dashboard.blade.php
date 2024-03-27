<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/card.css') }}">

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
            <div class="container" style="margin-top:50px;">
                <div class="row">

                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-3 g-4">

                            @for ($i = 1; $i < 10; $i++)
                                <div class="col">
                                    <a href="{{ route('ticketinfo') }}">
                                        <div class="card h-100">
                                            <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp"
                                                class="card-img-top" alt="Hollywood Sign on The Hill" />
                                            <div class="card-body">
                                                <a class="card-action" href="{{ route('cart') }}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <div class="card-heading">
                                                    stand up Comedy
                                                </div>
                                                <div class="card-text">
                                                    Discription
                                                </div>
                                                <div class="card-text">
                                                    $67,400
                                                </div>
                                                <a href="#" class="card-button"> Purchase</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
