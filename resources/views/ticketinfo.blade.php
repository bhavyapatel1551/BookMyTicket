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
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp"
                            class="card-img-top mx-auto d-block max-width-500" alt="Hollywood Sign on The Hill" />

                        <div class="card-body ms-5">
                            <h5 class="card-title  ">Event Name</h5>
                            <p class="card-text">Event description goes here. Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Date : March 25, 2024</li>
                                <li class="list-group-item">Time : 7:00 PM</li>
                                <li class="list-group-item">Venue : Example Venue</li>
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
