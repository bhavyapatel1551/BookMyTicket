<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Event Management</h5>
                                    <p class="mb-0 text-sm">
                                        Here you can manage Events.
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('event.create') }}" class="btn btn-dark btn-primary">
                                        <i class="fas fa-user-plus me-2"></i> Add Event
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if ($events->isEmpty())
                                <p class="text-center p-5">No Events Available</p>
                            @else
                                <table class="table text-secondary text-center">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                ID</th>
                                            <th
                                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Name</th>
                                            <th
                                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Description</th>
                                            <th
                                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Date</th>
                                            <th
                                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td class="align-middle bg-transparent border-bottom">
                                                    {{ $event->id }}</td>
                                                <td class="align-middle bg-transparent border-bottom">
                                                    {{ $event->name }}</td>
                                                <td class="align-middle bg-transparent border-bottom">
                                                    <p>{{ $event->about }}</p>
                                                </td>
                                                <td class="align-middle bg-transparent border-bottom">
                                                    {{ $event->date }}</td>
                                                <td class="text-center align-middle bg-transparent border-bottom">
                                                    <a
                                                        href="/eventUpdate/{{ $event->id }}"class="text-secondary font-weight-bold  me-2">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <a href="" onclick="deleteEvent('{{ $event->id }}')"
                                                        class="text-secondary font-weight-bold  ">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>
