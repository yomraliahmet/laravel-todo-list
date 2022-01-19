@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo ID: ') . $todo->id }}
                    <a href="{{ route('todos.index') }}" class="btn btn-primary btn-sm float-end">Todos</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todos.update', [$todo->id]) }}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $todo->name }}" required  autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="deadline_at" class="col-md-4 col-form-label text-md-end">{{ __('Deadline') }}</label>

                                <div class="col-md-6">
                                    <input id="deadline_at" disabled type="datetime-local" class="form-control @error('deadline_at') is-invalid @enderror" name="deadline_at" value="{{ substr(\Carbon\Carbon::parse($todo->deadline_at)->toIso8601String(), 0, 16) }}" required  autocomplete="deadline_at">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
