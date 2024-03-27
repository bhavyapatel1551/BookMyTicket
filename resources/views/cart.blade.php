<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="container mt-5 p-3 rounded cart ">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="product-details mr-2 bg-grey-100">
                        <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span
                                class="ml-2">Continue Shopping</span></div>
                        <hr>
                        <h6 class="mb-0">Shopping cart</h6>

                        @for ($i = 1; $i < 3; $i++)
                            <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                <div class="d-flex flex-row"><img class="rounded" src="{{ asset('event.png') }}"
                                        width="40">
                                    <div class="ml-2"><span class="font-weight-bold d-block">Stand Up
                                            Comedy</span><span class="spec me-1">Ahemdabad</span> <span
                                            class="spec me-1">15/06/2003</span><span class="spec">08:30 PM</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-row  align-items-center"><span class="d-block">
                                        <div class="quantity-selector d-flex">
                                            <a href="#" class="me-2" onclick="updateQuantity('decrease')">
                                                <i class="fa fa-minus fa-sm text-dark"></i>
                                            </a>
                                            <span id="quantity" class="quantity ">1</span>
                                            <a href="#" class="ms-2" onclick="updateQuantity('increase')">
                                                <i class="fa fa-plus fa-sm text-dark"></i>
                                            </a>
                                        </div>
                                    </span><span class="d-block ml-5 font-weight-bold">$900</span>
                                    <a href="">

                                        <i class="fa fa-trash-o ml-3 text-black-50"></i>
                                    </a>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="payment-info">
                        <div class="d-flex justify-content-between align-items-center"><span>Card details</span>
                            @if (auth()->user()->pfp)
                                <img src="{{ url('storage/' . auth()->user()->pfp) }}" alt="Profile Photo"
                                    class="w-10 h-10 object-fit-cover border-radius-2xl shadow-sm" id="preview">
                            @else
                                <img src="{{ asset('profileimg.png') }}" alt="Default Profile Photo"
                                    class="w-10 h-10 object-fit-cover border-radius-2xl shadow-sm" id="preview">
                            @endif
                        </div><span class="type d-block mt-3 mb-1">Card type</span><label class="radio"> <input
                                type="radio" name="card" value="payment" checked> <span><img width="30"
                                    src="https://img.icons8.com/color/48/000000/mastercard.png" /></span> </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> <span><img
                                    width="30"
                                    src="https://cdn.iconscout.com/icon/premium/png-256-thumb/visa-buy-card-checkout-credit-income-online-payment-price-sale-shopping-33562.png" /></span>
                        </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> <span><img
                                    width="30"
                                    src="https://img.icons8.com/ultraviolet/48/000000/paypal.png" /></span>
                        </label>


                        <label class="radio"> <input type="radio" name="card" value="payment"> <span><img
                                    width="30"
                                    src="https://w7.pngwing.com/pngs/845/180/png-transparent-unified-payments-interface-bhim-national-payments-corporation-of-india-wallets-text-trademark-logo.png" /></span>
                        </label>
                        <div><label class="credit-card-label">Name on card</label><input type="text"
                                class="form-control credit-inputs" placeholder="Name"></div>
                        <div><label class="credit-card-label">Card number</label><input type="text"
                                class="form-control credit-inputs" placeholder="0000 0000 0000 0000"></div>
                        <div class="row">
                            <div class="col-md-6"><label class="credit-card-label">Date</label><input type="text"
                                    class="form-control credit-inputs" placeholder="12/24"></div>
                            <div class="col-md-6"><label class="credit-card-label">CVV</label><input type="text"
                                    class="form-control credit-inputs" placeholder="342"></div>
                        </div>
                        <hr class="line">
                        <div class="d-flex justify-content-between information">
                            <span>Subtotal</span><span>$3000.00</span>
                        </div>
                        <div class="d-flex justify-content-between information">
                            <span>Shipping</span><span>$20.00</span>
                        </div>
                        <div class="d-flex justify-content-between information"><span>Total(Incl.
                                taxes)</span><span>$3020.00</span></div>
                        <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button"
                            style="background-color:rgb(30, 152, 30)"><span>$3020.00</span><span>Checkout<i
                                    class="fa fa-long-arrow-right ml-1"></i></span></button>
                    </div>
                </div>
            </div>
        </div>
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
