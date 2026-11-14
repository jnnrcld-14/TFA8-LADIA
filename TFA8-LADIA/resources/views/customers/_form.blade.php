@include('partials.validation-errors')
<div class="mb-3">
    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name ?? '') }}"
           class="form-control @error('full_name') is-invalid @enderror" maxlength="255" required>
    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
    <input type="email" id="email" name="email" value="{{ old('email', $customer->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror" maxlength="255" required>
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
