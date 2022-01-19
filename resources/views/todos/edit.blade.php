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
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $todo->name }}" required  autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="deadline_at" class="col-md-4 col-form-label text-md-end">{{ __('Deadline') }}</label>

                                <div class="col-md-6">
                                    <input id="deadline_at" type="datetime-local" class="form-control @error('deadline_at') is-invalid @enderror" name="deadline_at" value="{{ substr(\Carbon\Carbon::parse($todo->deadline_at)->toIso8601String(), 0, 16) }}" required  autocomplete="deadline_at">
                                    @error('deadline_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
