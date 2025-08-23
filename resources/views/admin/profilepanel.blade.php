@extends('layouts.adminlayout')

@section('content')

<div>
    <!-- Loading Overlay -->
    <div v-if="loading" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50" style="z-index: 1050;">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div  class="container my-5">
        <!-- First Row: Profile + Account Settings -->
        <div class="row mb-4">
            <!-- Sidebar -->
            <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                <div class="mb-3">
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                        style="width:80px; height:80px; font-size:2rem;">
                    <i class="bx bx-user"></i>
                    </div>
                </div>
               <h4 class="fw-bold mb-1">Admin</h4>
   
                 <span class="badge rounded-pill">
                    active
                </span> 

                <div class="d-flex justify-content-center mt-3 gap-2">
                    <a href="#" class="btn btn-outline-success btn-sm"><i class="bx bxl-whatsapp"></i></a>
                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="bx bxl-instagram"></i></a>
                </div>
                </div>

                 <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="bx bx-envelope me-2 text-primary"></i>
                        <span>@{{ admin.contact_email }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="bx bxl-whatsapp me-2 text-success"></i>
                        <span>@{{ admin.whatsapp }}</span>
                    </li>
                </ul> 
            </div>
            </div>

            <!-- Account Settings -->
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white"><i class="bx bx-cog me-2"></i>Account Settings</div>
                    <div class="card-body">
                    <form @submit.prevent="saveSettings" >
                        <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" v-model="admin.contact_email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">WhatsApp (used as Phone)</label>
                            <div class="position-relative">
                                <span class="position-absolute top-50 translate-middle-y ms-2">
                                <i class="bx bxl-whatsapp text-success fs-5"></i>
                                </span>
                                <input type="text" class="form-control ps-5" v-model="admin.whatsapp">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" v-if="!loadingform">
                            <i class="bx bx-save me-1"></i>Save Changes
                        </button>
                        <div class="spinner-border text-primary" v-if="loadingform" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="row mb-4">
            <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><i class="bx bx-share-alt me-2"></i>Social Media Links</div>
                <div class="card-body">
                <form @submit.prevent="saveSettings">

                   <div class="mb-3">
                            <label class="form-label fw-semibold">Facebook</label>
                            <div class="position-relative">
                                <a :href="admin.facebook ? `https://facebook.com/${admin.facebook}` : '#'"  target="_blank" class="position-absolute top-50 translate-middle-y ms-2">
                                    <i class="bx bxl-facebook text-primary fs-5"></i>
                                </a>
                                <input type="text" class="form-control ps-5" v-model="admin.facebook" placeholder="Facebook URL">
                            </div>
                    </div>

                    <div class="mb-3">
                            <label class="form-label fw-semibold">Instagram</label>
                            <div class="position-relative">
                                <a :href="admin.instagram ? `https://instagram.com/${admin.instagram}` : '#'" target="_blank" class="position-absolute top-50 translate-middle-y ms-2">
                                     <i class="bx bxl-instagram text-danger fs-5"></i>
                                </a>
                                <input type="text" class="form-control ps-5" v-model="admin.instagram" placeholder="Instagram URL">
                            </div>
                    </div>

                    <button type="submit" class="btn btn-primary" v-if="!loadingform">
                    <i class="bx bx-link me-1"></i>Update Links
                    </button>
                    <div class="spinner-border text-primary" v-if="loadingform" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Security Settings -->
        <!-- <div class="row">
            <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><i class="bx bx-shield-quarter me-2"></i>Security Settings</div>
                <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                    <button class="btn btn-outline-secondary w-100">
                        <i class="bx bx-lock-alt me-1"></i>Change Password
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div> -->
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <i class="bx bx-shield-quarter me-2"></i> Security Settings
                </div>
                <div class="card-body">
                    <form @submit.prevent="handleSubmitpassword" action="{{ route('admin.password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                            @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        {{-- CAPTCHA --}}
                        <div class="mb-3">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @error('g-recaptcha-response') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary w-100" v-if="!loading">
                            <i class="bx bx-lock-alt me-1"></i> Update Password
                        </button>

                        <!-- Spinner -->
                        <div v-if="loading" class="text-center mt-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- success change password -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


</div>

@endsection
