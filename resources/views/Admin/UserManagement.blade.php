<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    {{-- <div class="alert alert-dark text-sm" role="alert">
                        <strong>Add, Edit, Delete features are not functional!</strong> This is a
                        <strong>PRO</strong> feature! Click <a href="#" target="_blank" class="text-bold">here</a>
                        to see the <strong>PRO</strong> product!
                    </div> --}}
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">User Management</h5>
                                    <p class="mb-0 text-sm">
                                        Here you can manage users.
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-dark btn-primary">
                                        <i class="fas fa-user-plus me-2"></i> Add Member
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
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Name</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Creation Date</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->id }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($user->pfp)
                                                        <img src="{{ url('storage/' . $user->pfp) }}"
                                                            class="rounded-circle mr-2" alt="Profile Photo"
                                                            style="height: 36px; width: 36px;">
                                                    @else
                                                        <img src="{{ asset('profileimg.png') }}"
                                                            class="rounded-circle mr-2" alt="Profile Photo"
                                                            style="height: 36px; width: 36px;">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->email }}
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->created_at }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                                    class="delete-user-link" data-id="{{ $user->id }}">
                                                    <i class="fa-solid fa-trash-can text-dark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
