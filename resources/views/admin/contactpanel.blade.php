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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Contact Messages</h2>
                <p class="text-muted">Manage client inquiries and contact information</p>
            </div>
            <div>
                <button class="btn btn-primary me-2" @click="" aria-label="Export Contact Messages">
                    <i class='bx bx-download'></i> Export
                </button>
                <button class="btn btn-outline-primary" @click="" aria-label="Refresh Contact List">
                    <i class='bx bx-refresh'></i> Refresh
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-message-dots fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ statscontact.total }} </h3>
                        <small>Total Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-check-circle fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ statscontact.read }} </h3>
                        <small>Read Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-time fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ statscontact.unread }} </h3>
                        <small>Unread Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-calendar fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ statscontact.today }} </h3>
                        <small>Today's Messages</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class='bx bx-search'></i>
                            </span>
                            <input 
                                type="text" 
                                class="form-control search-box border-start-0" 
                                placeholder="Search contacts..."
                                v-model="searchQuery"
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" v-model="filterService">
                            <option value="">All Services</option>
                            <option value="Car Rental">Car Booking</option>
                            <option value="Taxi Booking">Taxi Booking</option>
                            <option value="Tour Booking">Tour Booking</option>
                            <option value="Custom Tour">Custom Booking</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" v-model="filterStatus">
                            <option value="">All Status</option>
                            <option value="unseen">Unread</option>
                            <option value="seen">Read</option>
                            <option value="reply">Reply</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100" @click="clearFilters">
                            <i class='bx bx-x'></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Contacts Table -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Contact Messages (@{{ statscontact.total }})</h5>
                    <div class="btn-group" role="group">
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'table' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'table'"
                        >
                            <i class='bx bx-table'></i>
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'cards' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'cards'"
                        >
                            <i class='bx bx-grid-alt'></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Table View Mode -->
                <div v-if="viewMode === 'table'" class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" @change="selectAll" v-model="allSelected">
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- card detail table -->
                        <tbody>
                            <tr v-for="(contact, index) in filteredContacts" :key="contact.id">
                                <td>
                                    <input type="checkbox" class="form-check-input" >
                                </td>
                                <td>
                                    <strong>@{{ contact.first_name }}</strong>
                                </td>
                                <td>@{{ contact.email }}</td>
                                <td>@{{ contact.phone }}</td>
                                <td>
                                    <span class="service-tag">@{{ contact.service }}</span>
                                </td>
                                <td>
                                    <span class="badge" :class="getStatusClass(contact.status)">
                                        @{{ contact.status }}
                                    </span>
                                </td>
                                <td>@{{ new Date(contact.created_at).toLocaleDateString() }}</td>
                                <td>
                                    <button class="btn btn-success btn-action btn-sm"  title="View">
                                        <i class='bx bx-show'></i>
                                    </button>
                                    <button 
                                           class="btn btn-primary btn-action btn-sm"  
                                           title="Mark as Read"
                                           @click="updateContactStatus(contact.id, contacts.indexOf(contact), 'seen')"
                                        >

                                            <i class='bx bx-check'></i>
                                    </button>

                                    <button 
                                           class="btn btn-warning btn-action btn-sm" 
                                           title="Reply"
                                           @click="updateContactStatus(contact.id, contacts.indexOf(contact) , 'reply')"
                                        >
                                            <i class='bx bx-reply'></i>
                                    </button>
                                    <button 
                                           class="btn btn-danger btn-action btn-sm" 
                                           title="Delete"
                                           @click="deleteContact(contact.id, contacts.indexOf(contact))"
                                        >
                                            <i class='bx bx-trash'></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <!-- card detail  table-->

                    </table>
                </div>

                <!-- Cards View -->
                <div v-else class="row g-3 p-3">
                    <div v-for="(contact, index) in filteredContacts" :key="contact.id" class="col-lg-6 col-xl-4">
                        <div class="card contact-card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2">
                                          @{{ contact.first_name.charAt(0) }}@{{ contact.last_name.charAt(0) }}
                                    </div>
                                    <strong><strong>@{{ contact.first_name }} @{{ contact.last_name }}</strong></strong>
                                </div>
                                <span class="badge" :class="getStatusClass(contact.status)">
                                          @{{ contact.status }}
                                </span>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <i class='bx bx-envelope me-1'></i>
                                    <small>@{{ contact.email }}</small>
                                </p>
                                <p class="mb-2">
                                    <i class='bx bx-phone me-1'></i>
                                    <small>@{{ contact.phone }}</small>
                                </p>
                                <p class="mb-2">
                                    <span class="service-tag">@{{ contact.service }}</span>
                                </p>
                                <p class="text-muted small mb-3">
                                    @{{ contact.message.substring(0, 100) }}...
                                </p>
                                <small class="text-muted">
                                    <i class='bx bx-time me-1'></i>
                                    @{{ new Date(contact.created_at).toLocaleDateString() }}
                                </small>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <button class="btn btn-success btn-action btn-sm" @click="viewContact(contact)">
                                    <i class='bx bx-show'></i>
                                </button>
                                <button class="btn btn-primary btn-action btn-sm" title="Mark as Read" @click="updateContactStatus(contact.id, contacts.indexOf(contact), 'seen')">
                                    <i class='bx bx-check'></i>
                                </button>
                                <button class="btn btn-warning btn-action btn-sm" title="Reply"  @click="updateContactStatus(contact.id, contacts.indexOf(contact), 'reply')">
                                    <i class='bx bx-reply'></i>
                                </button>
                                <button class="btn btn-danger btn-action btn-sm" title="Delete"  @click="deleteContact(contact.id,contacts.indexOf(contact))">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <!-- Contact Details Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="selectedContact">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Personal Information</h6>
                            <p><strong>Name:</strong> @{{ selectedContact.first_name }} @{{ selectedContact.last_name }}</p>
                            <p><strong>Email:</strong> @{{ selectedContact.email }}</p>
                            <p><strong>Phone:</strong> @{{ selectedContact.phone }}</p>
                            <p><strong>Service:</strong> @{{ selectedContact.service }}</p>
                            <p><strong>Date:</strong> @{{ formatDate(selectedContact.created_at) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Status</h6>
                            <span class="badge" :class="getStatusClass(selectedContact.status)">
                                @{{ selectedContact.status }}
                            </span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Message</h6>
                            <div class="border rounded p-3 bg-light">
                                @{{ selectedContact.message }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateContactStatus(contact.id, contacts.indexOf(selectedContact) , 'reply')">Reply</button>
                    <button type="button" class="btn btn-success" @click="updateContactStatus(contact.id, contacts.indexOf(contact), 'seen')">Mark as Read</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
