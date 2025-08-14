@extends('layouts.adminlayout')

@section('content')

<div>
    <!-- Loading Overlay -->
    <div v-if="loading" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50" style="z-index: 1050;">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow border-0">
            <div class="card-header bg-danger text-white d-flex align-items-center">
                <i class='bx bx-trash me-2 fs-4'></i>
                <h5 class="mb-0">Data Deletion Settings</h5>
            </div>
            <div class="card-body">
                <!-- Warning -->
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class='bx bx-error-circle me-2 fs-5'></i>
                    <span><strong>Caution:</strong> Deleting data is permanent and cannot be undone!</span>
                </div>

                <!-- Step 1: Choose Tables -->
                <h6 class="mb-3">Select Tables to Delete Data From</h6>
                <div class="row g-3">
                    <div v-for="table in tables" :key="table.value" class="col-md-4">
                        <div class="form-check border rounded p-3">
                            <input class="form-check-input" type="checkbox" v-model="selectedTables" :value="table.value" :id="table.value">
                            <label class="form-check-label fw-semibold" :for="table.value">
                                <i :class="table.icon + ' me-1'"></i> {{ table.label }}
                            </label>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Step 2: Select Deletion Filters -->
                <h6 class="mb-3">Filter Data Before Deletion</h6>
                <div class="row g-3">
                    <!-- Status Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class='bx bx-check-circle me-1'></i> Status
                        </label>
                        <select class="form-select" v-model="status">
                            <option value="">-- Select Status --</option>
                            <option v-for="s in statuses" :key="s" :value="s">{{ s }}</option>
                        </select>
                    </div>

                    <!-- Age Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class='bx bx-time-five me-1'></i> Age of Data
                        </label>
                        <select class="form-select" v-model="age">
                            <option value="">-- Select Age --</option>
                            <option v-for="a in ages" :key="a.value" :value="a.value">{{ a.label }}</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!-- Step 3: Confirm & Delete -->
                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-secondary me-2" @click="resetForm">
                        <i class='bx bx-reset me-1'></i> Reset
                    </button>
                    <button class="btn btn-danger" @click="showPasswordModal">
                        <i class='bx bx-trash-alt me-1'></i> Delete Selected Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Password Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="bx bx-lock-alt me-2"></i>Confirm Admin Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please enter your admin password to confirm deletion.</p>
                        <input type="password" v-model="adminPassword" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" @click="confirmDeletion">Confirm & Delete</button>
                    </div>
                </div>
            </div>
        </div>
</div>




@endsection

