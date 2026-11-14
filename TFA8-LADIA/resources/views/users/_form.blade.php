@php($isEdit = isset($user))
@include('partials.validation-errors')
<div class="mb-3">
    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
    <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}"
           class="form-control @error('username') is-invalid @enderror" maxlength="100" required>
    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}"
           class="form-control @error('full_name') is-invalid @enderror" maxlength="255" required>
    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror" maxlength="255" required>
    <div class="form-text">Used to log in.</div>
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Password @unless($isEdit)<span class="text-danger">*</span>@endunless</label>
        <input type="password" id="password" name="password" autocomplete="new-password"
               class="form-control @error('password') is-invalid @enderror" @unless($isEdit) required @endunless>
        @if ($isEdit)<div class="form-text">Leave blank to keep the current password.</div>@endif
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="form-control">
    </div>
</div>
@if ($isEdit)
    <div class="mb-3">
        <label class="form-label">Profile Picture (optional)</label>
        <div class="mb-2">
            <img src="{{ $user->avatar_url }}" alt="Current avatar" class="avatar-preview">
            <div class="form-text">{{ $user->avatar ? 'Current prepared avatar' : 'No avatar uploaded yet' }}</div>
        </div>
        <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp"
               class="form-control @error('avatar') is-invalid @enderror">
        <div class="form-text">JPEG, PNG, or WebP. Maximum file size: 2 MB. The image is prepared as a 300 × 300 JPEG.</div>
        @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
@endif
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
