<x-header title="Find Dream Jobs" />
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        <img src="assets/assets/images/avatar7.png" alt="avatar" class="rounded-circle img-fluid"
                            style="width: 150px;">
                        <h5 class="mt-3 pb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                                class="btn btn-primary">Change Profile Picture</button>
                        </div>
                    </div>
                </div>
                <x-list>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('account.updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="mb-4">
                                <label class="mb-2">Name*</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control"
                                    value="{{ $user->name ?? old('name') }}">
                                <x-form-error name="name" />
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Email*</label>
                                <input type="text" name="email" placeholder="Enter Email" class="form-control"
                                    value="{{ $user->email ?? old('email') }}">
                                <x-form-error name="email" />
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Designation*</label>
                                <input type="text" name="designation" placeholder="Designation" class="form-control"
                                    value="{{  $user->designation ?? old('designation') }}">
                                <x-form-error name="designation" />
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Mobile*</label>
                                <input type="text" name="mobile" placeholder="Mobile" class="form-control"
                                    value="{{ $user->mobile ?? old('mobile') }}">
                                <x-form-error name="mobile" />
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('account.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label class="mb-2">Old Password*</label>
                                <input type="password" name="old_password" placeholder="Old Password"
                                    class="form-control">
                                <x-form-error name="old_password" />
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">New Password*</label>
                                <input type="password" name="new_password" placeholder="New Password"
                                    class="form-control">
                                <x-form-error name="new_password" />
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Confirm Password*</label>
                                <input type="password" name="new_password_confirmation"
                                    placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.updateImage') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<x-footer>
    © 2026 xyz company, all right reserved
</x-footer>
