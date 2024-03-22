{{-- @php
use App\Models\User;
use App\Models\Ticket;

$user = User::find(auth()->id());
if (!$user || $user->role !== 'admin') {
    abort(403, 'Unauthorized access');
}

$users = User::where('parent_id', auth()->id())->get();
$tickets = Ticket::where('parent_id', auth()->id())->get();
@endphp --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!--     Fonts and icons     -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    <script>
        $(document).ready(function() {
            // Delete user
            $('.delete').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var tr = $(this).closest('tr');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete.php',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response == 'success') {
                                tr.remove();
                                alert('User deleted successfully');
                            } else {
                                alert('Failed to delete user');
                            }
                        }
                    });
                }
            });
            //delete tickets
            $('.delete-ticket').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var tr = $(this).closest('tr');
                if (confirm('Are you sure you want to delete this user?')){
                    $.ajax({
                        type: 'POST',
                        url: 'delete_ticket.php',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response == 'success') {
                                tr.remove();
                                alert('Ticket deleted successfully');
                            } else {
                                alert('This ticket has been purchased and cannot be deleted.');
                            }
                        }
                    });
                }
            });
        });
    </script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>welcome <b>User</b></h2>
                            <input type="text" class="form-control mt-3" placeholder="Search&hellip;">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" onclick="" class="btn btn-success">Add User</button>
                            <button type="button" onclick="" class="btn btn-secondary">Add Ticket</button>
                            <button type="button" onclick="" class="btn btn-danger">Logout</button>
                        </div>
                    </div>
                </div>
                <h3>Users Created By Me!</h3>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="edit"><i class="material-icons" title="Edit">&#xE254;</i></a>
                                <a href="#" class="delete" data-id="{{ $user->id }}"><i class="material-icons">&#xE872;</i></a>
                                @if ($user->role == 'admin')
                                <a href="{{ route('users.show', $user->id) }}" class="view-child"><i class="material-icons" title="View Child Users">&#xE8F4;</i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>

                <h3>Tickets Created By Me!</h3>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->price }}</td>
                            <td>
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="edit"><i class="material-icons" title="Edit">&#xE254;</i></a>
                                <a href="#" class="delete-ticket" data-id="{{ $ticket->id }}"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>

                {{-- <a href="{{ route('reset_password') }}" class="anc">Reset Password?</a> --}}
            </div>
        </div>
    </div>
</body>

</html>
