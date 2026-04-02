@extends('layouts.app')


@section('content')
<div class="container py-5">
    <div class="col-md-10 col-lg-8 mx-auto">

        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Users Beheer</h1>
            <p class="text-muted">Bekijk en beheer alle geregistreerde users</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm mb-1">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body { background: linear-gradient(135deg, #f0f4ff 0%, #d9e4ff 100%); font-family: 'Nunito', sans-serif; }
    .card { border-radius: 20px; }
    h1.display-5 { letter-spacing: 1px; }
    hr { border-top: 3px solid #0d6efd; width: 60px; }
    .table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.1); }
    .btn i { margin-right: 4px; }
</style>
@endsection