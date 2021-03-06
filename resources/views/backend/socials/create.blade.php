@extends('layouts.auth_admin_app')

@section('title', 'Create Social Media')

@section('content')

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Social Media</h6>
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

            <form action="{{ route('admin.socials.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="Facebook" {{ old('type') == "Facebook" ? 'selected' : null }}>Facebook</option>
                            <option value="YouTube" {{ old('type') == "YouTube" ? 'selected' : null }}>YouTube</option>
                            <option value="Instagram" {{ old('type') == "Instagram" ? 'selected' : null }}>Instagram</option>
                            <option value="Twitter" {{ old('type') == "Twitter" ? 'selected' : null }}>Twitter</option>
                            <option value="LinkedIn" {{ old('type') == "LinkedIn" ? 'selected' : null }}>LinkedIn</option>
                            <option value="GitHub" {{ old('type') == "GitHub" ? 'selected' : null }}>GitHub</option>
                            <option value="Google" {{ old('type') == "Google" ? 'selected' : null }}>Google</option>
                            <option value="Stack Overflow" {{ old('type') == "Stack Overflow" ? 'selected' : null }}>Stack Overflow</option>
                            <option value="Reddit" {{ old('type') == "Reddit" ? 'selected' : null }}>Reddit</option>
                            <option value="Pinterest" {{ old('type') == "Pinterest" ? 'selected' : null }}>Pinterest</option>
                            <option value="Vkontakte" {{ old('type') == "Vkontakte" ? 'selected' : null }}>Vkontakte</option>
                            <option value="Slack" {{ old('type') == "Slack" ? 'selected' : null }}>Slack</option>
                            <option value="Dribbble" {{ old('type') == "Dribbble" ? 'selected' : null }}>Dribbble</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="status">Social Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="url" name="link" value="{{ old('link') }}" class="form-control">
                            @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4 text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Add Social Media</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

