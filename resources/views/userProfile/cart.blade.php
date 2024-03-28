<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <section class="h-100 h-custom bg-gray-200">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="col-lg-7 ">
                                        <h5 class="mb-3"><a href="{{ route('dashboard') }}"
                                                style="text-decoration: none" class="text-body">
                                                <i class="fas fa-long-arrow-alt-left me-2">
                                                </i>Continue shopping</a>
                                        </h5>
                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-4  ">
                                            <div>
                                                <p class="mb-1">Shopping cart</p>
                                                <p class="mb-0">You have 4 items in your cart</p>
                                            </div>

                                        </div>

                                        @for ($i = 0; $i < 4; $i++)
                                            <div class="card mb-3 bg-gray-200" id="zoomin">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div>
                                                                <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp"
                                                                    class="img-fluid rounded-3" alt="Shopping item"
                                                                    style="width: 80px;">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h5>Stand Up Comedy</h5>
                                                                <p class="small mb-0"> <span
                                                                        class="me-2">Ahemdabad</span>
                                                                    <span class="me-2">15/06/2003</span> <span
                                                                        class="me-2">08:30 PM</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center ">
                                                            <div style="width: 50px;" class="me-2">
                                                                <div class="quantity-selector d-flex">
                                                                    <a href="#" class="me-2"
                                                                        onclick="updateQuantity('decrease')">
                                                                        <i class="fa fa-minus fa-sm text-dark"></i>
                                                                    </a>
                                                                    <span id="quantity" class="quantity ">1</span>
                                                                    <a href="#" class="ms-2"
                                                                        onclick="updateQuantity('increase')">
                                                                        <i class="fa fa-plus fa-sm text-dark"></i>

                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div style="width: 80px;">
                                                                <h5 class="mb-0">$900</h5>
                                                            </div>
                                                            <a href="#!">
                                                                <i class="fa-solid fa-trash-can text-dark"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor



                                    </div>
                                    <div class="col-lg-5">

                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Card details</h5>
                                                    @if (auth()->user()->pfp)
                                                        <img src="{{ url('storage/' . auth()->user()->pfp) }}"
                                                            alt="Profile Photo"
                                                            class="w-15 h-15 object-fit-cover border-radius-lg shadow-sm"
                                                            id="preview">
                                                    @else
                                                        <img src="{{ asset('profileimg.png') }}"
                                                            alt="Default Profile Photo"
                                                            class="w-15 h-15 object-fit-cover border-radius-lg shadow-sm"
                                                            id="preview">
                                                    @endif
                                                </div>

                                                <p class="small mb-2">Card type</p>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-paypal fa-2x"></i></a>

                                                <form class="mt-4">
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeName" class="form-control "
                                                            siez="17" placeholder="Cardholder's Name" />
                                                        <label class="form-label" for="typeName">Cardholder's
                                                            Name</label>
                                                    </div>

                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeText" class="form-control "
                                                            siez="17" placeholder="1234 5678 9012 3457"
                                                            minlength="19" maxlength="19" />
                                                        <label class="form-label" for="typeText">Card Number</label>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="text" id="typeExp"
                                                                    class="form-control " placeholder="MM/YYYY"
                                                                    size="7" id="exp" minlength="7"
                                                                    maxlength="7" />
                                                                <label class="form-label"
                                                                    for="typeExp">Expiration</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="password" id="typeText"
                                                                    class="form-control"
                                                                    placeholder="&#9679;&#9679;&#9679;" size="1"
                                                                    minlength="3" maxlength="3" />
                                                                <label class="form-label" for="typeText">Cvv</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                                <hr class="my-4">
                                                <div class="bg-gray-300 p-2 rounded-5 mb-2 text-dark">

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Tickets</p>
                                                        <p class="mb-2">15</p>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Subtotal</p>
                                                        <p class="mb-2">₹1500</p>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-4">
                                                        <p class="mb-2">Total(Incl. taxes)</p>
                                                        <p class="mb-2">₹1500</p>
                                                    </div>
                                                </div>

                                                <button type="button"
                                                    class="btn btn-success bg-gradient btn-block btn-lg">
                                                    <div class="d-flex justify-content-between">
                                                        <span>₹1500</span>
                                                        <span>Checkout <i
                                                                class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        function updateQuantity(action) {
            let quantityElement = document.getElementById('quantity');
            let currentQuantity = parseInt(quantityElement.textContent);
            let newQuantity = action === 'increase' ? currentQuantity + 1 : currentQuantity - 1;
            if (newQuantity < 1) {
                return; // Prevent decreasing quantity below 1
            }
            quantityElement.textContent = newQuantity;

            // You can update the subtotal and other details here if needed
        }
    </script>
</x-app-layout>
