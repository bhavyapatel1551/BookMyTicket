<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
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
                                Create your own Evnets
                            </p>
                            <a href="" style="text-decoration: none;">
                                <button type="button"
                                    class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0">
                                    <span class="btn-inner--icon">

                                    </span>
                                    <span class="btn-inner--text">Event Statistics </span>
                                </button>
                            </a>
                            <img src="{{ asset('eventmanage.png') }}" alt="Event"
                                class="position-absolute top-0 end-1 w-30 mb-0 max-width-250 mt-0 d-sm-block d-none" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div
                            class="bg-gray-300 text-dark rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div
                            class="bg-gray-300 text-dark rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div
                            class="bg-gray-300 text-dark rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-hand-holding-dollar fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div
                            class="bg-gray-300 text-dark rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-file-invoice-dollar fa-beat-fade fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-items-center  table-bordered table-hover mb-0">
                            <thead class="bg-gray-400">
                                <tr class="text-dark">
                                    <th scope="col" class="align-middle text-center ">Date</th>
                                    <th scope="col" class="align-middle text-center ">Event</th>
                                    <th scope="col" class="align-middle text-center ">Customer</th>
                                    <th scope="col" class="align-middle text-center ">Amount</th>
                                    <th scope="col" class="align-middle text-center ">Quentity</th>
                                    <th scope="col" class="align-middle text-center ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td class="align-middle text-center ">01 Jan 2045</td>
                                        <td class="align-middle text-center ">Event Name</td>
                                        <td class="align-middle text-center ">Jhon Doe</td>
                                        <td class="align-middle text-center ">$123</td>
                                        <td class="align-middle text-center ">2</td>
                                        <td class="align-middle text-center "><a class="btn btn-sm btn-primary"
                                                href="">Details</a></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <x-app.footer />
        </div>
    </main>

</x-app-layout>
