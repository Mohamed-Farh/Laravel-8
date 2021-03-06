@extends('layouts.auth_admin_app')

@section('title', 'Edit City')

@section('content')

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit City {{ $city->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Cities</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.cities.update', $city->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">City Name</label>
                            <input type="text" name="name" value="{{ old('name', $city->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="state_id">State Name</label>
                        <select name="state_id" class="form-control">
                            <option value="">---</option>
                            @forelse ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id', $city->state_id) == $state->id ? 'selected' : null }}>{{ $state->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="status">City Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $city->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $city->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4 text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Update City</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

