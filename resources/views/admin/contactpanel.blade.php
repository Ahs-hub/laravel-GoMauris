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
                <button class="btn btn-primary me-2" @click="exportContacts" aria-label="Export Contact Messages">
                    <i class='bx bx-download'></i> Export
                </button>
                <button class="btn btn-outline-primary" @click=" refreshData" aria-label="Refresh Contact List">
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
                        <h3 class="mb-1"> @{{ stats.contact.total }}</h3>
                        <small>Total Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-check-circle fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.contact.read }} </h3>
                        <small>Read Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-time fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.contact.unread }} </h3>
                        <small>Unread Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-calendar fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.contact.today }} </h3>
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
                    <h5 class="mb-0">Contact Messages (@{{ stats.contact.total }})</h5>
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
                                <th>Contact</th>
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
                                    <span 
                                        style="position:absolute;"
                                        class="badge bg-primary notification-badge ms-2"
                                        v-if="isnewitem(contact.id, 'ContactBooking')">
                                        New
                                    </span>
                                    <input type="checkbox" class="form-check-input" >
                                </td>
                                <td>
                                    <strong>@{{ contact.first_name }}</strong>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class='bx bx-envelope me-1'></i>@{{ contact.email }}</div>
                                        <div><i class='bx bx-phone me-1'></i>@{{ contact.phone }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="service-tag">@{{ contact.service }}</span>
                                </td>
                                <td>
                                    <!-- <span class="badge" :class="getStatusClass(contact.status)">
                                        @{{ contact.status }}
                                    </span> -->
                                    <select 
                                        class="form-select form-select-sm" 
                                        v-model="contact.status" 
                                        @change="updateStatus('contacts', contact.id, contacts.indexOf(contact), contact.status)">
                                        <option value="unseen">unseen</option>
                                        <option value="seen">seen</option>
                                        <option value="reply">reply</option>
                                    </select>
                                </td>
                                <td>@{{ new Date(contact.created_at).toLocaleDateString() }}</td>
                                <td>
                                    <button class="btn btn-success btn-action btn-sm"  title="View"  @click="viewItem(contact, 'contactModal')">
                                        <i class='bx bx-show'></i>
                                    </button>
                                    <!-- <button 
                                           class="btn btn-primary btn-action btn-sm"  
                                           title="Mark as Read"
                                           @click="updateStatus('contacts', contact.id, contacts.indexOf(contact), 'seen')"
                                        >

                                            <i class='bx bx-check'></i>
                                    </button> -->

                                    <button class="btn btn-primary btn-action btn-sm" @click="addComment(contact, 'commentModal')" style="position:relative;" title="Add Comment">
                                            <i class='bx bx-note'></i>
                                            <span 
                                                v-if="contact.admin_comment" 
                                                class="d-inline-block ms-1 rounded-circle bg-warning" 
                                                title="Has comment" 
                                                style="width: 10px; height: 10px; position:absolute; top:1px; right:1px;">
                                            </span>
                                    </button>

      
                               
                                    <button 
                                           class="btn btn-warning btn-action btn-sm" 
                                           title="Reply"
                                           @click="viewItem(contact, 'replyModal')"
                                        >
                                            <i class='bx bx-reply'></i>
                                    </button>
                                    <button 
                                           class="btn btn-danger btn-action btn-sm" 
                                           title="Delete"
                                           @click="deleteItem('contacts', contact.id,contacts.indexOf(contact))"
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
                                        <span 
                                            style="position:absolute;"
                                            class="badge bg-primary notification-badge ms-2"
                                            v-if="isnewitem(contact.id, 'ContactBooking')">
                                            New
                                        </span>
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
                                <small v-if="contact.admin_comment" class="badge bg-warning text-dark ms-1" title="Has comment">
                                    <i class='bx bx-message-square-detail'></i> Has comment
                                </small>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <button class="btn btn-success btn-action btn-sm" @click="viewItem(contact, 'contactModal')">
                                    <i class='bx bx-show'></i>
                                </button>
                                <button class="btn btn-primary btn-action btn-sm" title="Mark as Read" @click="updateStatus('contacts', contact.id, contacts.indexOf(contact), 'seen')">
                                    <i class='bx bx-check'></i>
                                </button>
                                <button class="btn btn-warning btn-action btn-sm" title="Reply"   @click="viewItem(contact, 'replyModal')">
                                    <i class='bx bx-reply'></i>
                                </button>
                                <button class="btn btn-primary btn-action btn-sm" @click="addComment(contact, 'commentModal')">
                                    <i class='bx bx-note'></i>
                                </button>
                                <button class="btn btn-danger btn-action btn-sm" title="Delete"  @click="deleteItem('contacts', contact.id,contacts.indexOf(contact))">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Loading Spinner -->
                <div v-if="loadingpage" class="text-center my-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
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
                <div class="modal-body" v-if="selectedItem">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Personal Information</h6>
                            <p><strong>Name:</strong> @{{ selectedItem.first_name }} @{{ selectedItem.last_name }}</p>
                            <p><strong>Email:</strong> @{{ selectedItem.email }}</p>
                            <p><strong>Phone:</strong> @{{ selectedItem.phone }}</p>
                            <p><strong>Service:</strong> @{{ selectedItem.service }}</p>
                            <p><strong>Date:</strong> @{{ new Date(selectedItem.created_at).toLocaleDateString() }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Status</h6>
                            <span class="badge" :class="getStatusClass(selectedItem.status)">
                                @{{ selectedItem.status }}
                            </span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Customer Message</h6>
                            <div class="border rounded p-3 bg-light">
                                 @{{ selectedItem.message }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Admin Comments</h6>
                            <textarea 
                                class="form-control" 
                                rows="4" 
                                placeholder="Add internal notes or comments..."
                                v-model="tempComment"
                            ></textarea>
                            <small class="text-muted">These comments are for internal use only and won't be visible to customers.</small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveComment('contacts')" v-if="!loadingform">Save Comment</button>

                    <div class="spinner-border text-primary" v-if="loadingform" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    <button type="button" class="btn btn-primary"  @click="viewItem(selectedItem, 'replyModal')">Reply</button>
                    <button type="button" class="btn btn-success" @click="updateStatus('contacts', selectedItem.id, contacts.indexOf(selectedItem), 'seen')">Mark as Read</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="commentItem">
                    <div class="mb-3">
                        <label class="form-label">Customer: <strong>@{{ commentItem.first_name }} @{{ commentItem.last_name }}</strong></label>
                        <p class="text-muted small">@{{ commentItem.service }} inquiry</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Comment</label>
                        <textarea 
                            class="form-control" 
                            rows="5" 
                            placeholder="Add internal notes, follow-up actions, or any relevant information..."
                            v-model="tempComment"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="saveComment('contacts')" v-if="!loadingform">Save Comment</button>
                    <div class="spinner-border text-primary" v-if="loadingform" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Methods Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">
                        <i class='bx bx-user-voice'></i> Contact Client
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Choose your preferred method to contact the client:</p>
                    
                    <div class="row" v-if="selectedItem">
                        <div class="col-md-6 mb-3">
                            <a :href="'https://wa.me/' + selectedItem.phone" target="_blank" class="contact-option whatsapp">
                                <div class="text-center">
                                    <i class='bx bxl-whatsapp'></i>
                                    <div class="contact-title">WhatsApp</div>
                                    <p class="contact-subtitle">Send message instantly</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <a :href="'sms:' + selectedItem.phone" class="contact-option sms">
                                <div class="text-center">
                                    <i class='bx bx-message-dots'></i>
                                    <div class="contact-title">SMS</div>
                                    <p class="contact-subtitle">Send text message</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <a :href="'tel:' + selectedItem.phone" class="contact-option phone">
                                <div class="text-center">
                                    <i class='bx bx-phone-call'></i>
                                    <div class="contact-title">Phone Call</div>
                                    <p class="contact-subtitle">@{{ selectedItem.phone }}</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <a :href="'mailto:' + selectedItem.email" class="contact-option email">
                                <div class="text-center">
                                    <i class='bx bx-envelope'></i>
                                    <div class="contact-title">Email</div>
                                    <p class="contact-subtitle">Send email message</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x'></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
