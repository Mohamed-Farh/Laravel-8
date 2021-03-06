@extends('layouts.auth_admin_app')

@section('title', 'Edit Social Media')

@section('content')

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Social Media {{ $social->type }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.socials.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Social Media</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.socials.update', $social->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="Facebook" {{ old('type', $social->type) == "Facebook" ? 'selected' : null }}>Facebook</option>
                            <option value="YouTube" {{ old('type', $social->type) == "YouTube" ? 'selected' : null }}>YouTube</option>
                            <option value="Instagram" {{ old('type', $social->type) == "Instagram" ? 'selected' : null }}>Instagram</option>
                            <option value="Twitter" {{ old('type', $social->type) == "Twitter" ? 'selected' : null }}>Twitter</option>
                            <option value="LinkedIn" {{ old('type', $social->type) == "LinkedIn" ? 'selected' : null }}>LinkedIn</option>
                            <option value="GitHub" {{ old('type', $social->type) == "GitHub" ? 'selected' : null }}>GitHub</option>
                            <option value="Google" {{ old('type', $social->type) == "Google" ? 'selected' : null }}>Google</option>
                            <option value="Stack Overflow" {{ old('type', $social->type) == "Stack Overflow" ? 'selected' : null }}>Stack Overflow</option>
                            <option value="Reddit" {{ old('type', $social->type) == "Reddit" ? 'selected' : null }}>Reddit</option>
                            <option value="Pinterest" {{ old('type', $social->type) == "Pinterest" ? 'selected' : null }}>Pinterest</option>
                            <option value="Vkontakte" {{ old('type', $social->type) == "Vkontakte" ? 'selected' : null }}>Vkontakte</option>
                            <option value="Slack" {{ old('type', $social->type) == "Slack" ? 'selected' : null }}>Slack</option>
                            <option value="Dribbble" {{ old('type', $social->type) == "Dribbble" ? 'selected' : null }}>Dribbble</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="status">Social Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $social->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $social->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="url" name="link" value="{{ old('link', $social->link) }}" class="form-control">
                            @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4 text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Update Social Media</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

