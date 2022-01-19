@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todos') }}
                    <a href="{{ route('todos.create') }}" class="btn btn-success btn-sm float-end">New Todo</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Todo Name</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($todos as $todo)
                                <tr class="@if($todo->deadline_at < \Carbon\Carbon::now()->tz('Europe/Istanbul')) table-danger @endif">
                                    <th scope="row">{{ $todo->id }}</th>
                                    <td>{{ $todo->name }}</td>
                                    <td>{{ $todo->deadline_at }}</td>
                                    <td>
                                        @if(!$todo->completed)
                                            <form method="post" class="d-inline-block" action="{{ route('todos.complete', [$todo->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-info btn-sm">Complete</button>
                                            </form>
                                        @else
                                            <button disabled class="btn btn-info btn-sm">Complete</button>
                                        @endif
                                        <a href="{{ route('todos.edit', [$todo->id]) }}" class="btn btn-success btn-sm">Edit</a>

                                        <form method="post" class="d-inline-block" action="{{ route('todos.destroy', [$todo->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($todos->count() == 0)
                            <p class="text-danger">Not found todo.</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
