<x-app-layout>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid ">
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


                            <img src="{{ asset('createEvent.png') }}" alt="Event"
                                class="position-absolute top-0 end-1 w-28 mb-0 max-width-250  d-sm-block d-none" />

                        </div>
                    </div>
                </div>
            </div>
            <form action={{ route('create.event') }} method="POST">
                @csrf
                @method('PUT')

                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Create Your Event </h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Event Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        @error('name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Event Vanue</label>
                                        <input type="text" name="vanue" id="vanue" class="form-control">
                                        @error('vanue')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="location">Event Location</label>
                                        <input type="text" name="location" id="location" class="form-control">
                                        @error('location')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="price">Event Price</label>
                                        <input type="text" name="price" id="price" class="form-control">
                                        @error('price')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="event_date">Event Date</label>
                                        <input type="text" name="event_date" id="event_date" class="form-control">
                                        @error('event_date')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="event_time">Event Time</label>
                                        <input type="text" name="event_time" id="event_time" class="form-control">
                                        @error('event_time')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label for="event_image">Event Photo</label>
                                    <input type="file" name="event_image" id="event_image" class="form-control">
                                    @error('event_image')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row p-2">
                                    <label for="about">Event Description</label>
                                    <textarea name="about" id="about" rows="3" class="form-control"></textarea>
                                    @error('about')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="mt-3 mb-0 btn btn-outline-dark btn-sm float-end">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
        </div>
    </main>
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('#event_date').datepicker({
                showOtherMonths: true
            });

            // Initialize timepicker
            $('#event_time').timepicker({
                showMeridian: false,
                defaultTime: false
            });
        });
    </script>


</x-app-layout>
