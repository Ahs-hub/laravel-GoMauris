@extends('layouts.adminlayout')

@section('content')
<div class="d-flex justify-content-start gap-2 mt-5s" style="margin-top:50px;">
    <button 
        class="btn btn-secondary me-2" 
        @click="showTourBook = true"
        :class="{ active: showTourBook }"
    >
        Show Tour Book
    </button>

    <button 
        class="btn btn-secondary" 
        @click="showTourBook = false"
        :class="{ active: !showTourBook }"
    >
        Confirmed
    </button>
</div>

<!-- Loading Overlay -->
<div v-if="loading" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50" style="z-index: 1050;">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>


<div v-if="showTourBook">

    <div class="container my-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Tour Booking</h2>
                <p class="text-muted">Manage Tour Booking</p>
            </div>
            <div>
                <!-- <button class="btn btn-primary me-2" @click="exportContacts" aria-label="Export Car Rental Messages">
                    <i class='bx bx-download'></i> Export
                </button> -->

                <button class="btn btn-outline-primary" @click=" refreshData" aria-label="Refresh Taxi Booking List">
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
                        <h3 class="mb-1"> @{{ stats.tour.total }}</h3>
                        <small>Total Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-check-circle fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.tour.reserve }} </h3>
                        <small>Confirmed</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-time fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.tour.proceed }} </h3>
                        <small>Pending</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-calendar fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.tour.today }} </h3>
                        <small>Today's Messages</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <!-- Search -->
                    <div class="col-md-4">
                        <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class='bx bx-search'></i>
                        </span>
                        <input 
                            type="text" 
                            class="form-control search-box border-start-0" 
                            placeholder="Search custom..."
                            v-model="searchQuery"
                        >
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="col-md-3">
                        <select class="form-select" v-model="filterPayment">
                        <option value="">All Payment</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">UnPaid</option>
                        <option value="refund">Refund</option>
                        </select>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-3">
                        <select class="form-select" v-model="filterStatus">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                        </select>
                    </div>

                    <!-- Clear & Advanced -->
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-outline-secondary flex-fill" @click="clearFilters">
                        <i class='bx bx-x'></i> Clear
                        </button>
                        <button 
                        class="btn btn-outline-primary flex-fill"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#advancedFilters"
                        >
                        <i class="bx bx-filter-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Advanced Filters -->
                <div class="collapse mt-4" id="advancedFilters">
                    <div class="row g-3">
                        <!-- Book Date -->
                        <div class="col-md-2 text-end fw-bold">Book Date:</div>
                        <div class="col-md-3">
                        <input type="date" class="form-control" v-model="filterDate">
                        </div>
                        <div class="col-md-3">
                        <input type="month" class="form-control"  placeholder="Find Month ex: 2025-06" v-model="filterMonth">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <!-- Created At -->
                        <div class="col-md-2 text-end fw-bold">Created At:</div>
                        <div class="col-md-3">
                        <input type="date" class="form-control" v-model="filterDateCreateAt">
                        </div>
                        <div class="col-md-3">
                        <input type="month" class="form-control"  placeholder="Find Month ex: 2025-06" v-model="filterMonthCreateAt">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tours Table -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tours Booking (@{{ stats.tour.total }})</h5>
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
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Tour</th>
                                <th>Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Create at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- card detail table -->
                        <tbody>
                            <tr  v-for="(tourb, index) in   filteredTours" :key="tourb.id">
                                <td>
                                    <!-- <span 
                                        style="position:absolute;"
                                        class="badge bg-primary notification-badge ms-2"
                                        v-if="isnewitem( rental.id, 'CarBooking')">
                                        New
                                    </span> -->
                                    <input type="checkbox" class="form-check-input" >
                                </td>
                                <td>
                                    <strong>@{{  tourb.full_name }}</strong>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class='bx bx-envelope me-1'></i>@{{  tourb.email }}</div>
                                        <div><i class='bx bx-phone me-1'></i>@{{  tourb.phone }}</div>
                                    </div>
                                </td>
     
                                <td>
                                    <div class="small">
                                        <div>@{{  tourb.tour_type }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div>@{{ new Date(tourb.tour_date).toLocaleDateString() }}</div>
                                    </div>
                                </td>
                                <td>
                                    <select 
                                        class="vertical-align: middle;" 
                                        v-model="tourb.payment_status" 
                                        @change="updateItem('tours', tourb.id, tours.indexOf(tourb), { payment_status: tourb.payment_status })"
                                    >
                                        <option value="paid">paid</option>
                                        <option value="unpaid">unpaid</option>
                                        <option value="refund">refund</option>
                                    </select>
                                </td>
                                <td>
                                    <!-- <span class="badge" :class="getStatusClass(carrentals.status)">
                                        @{{ carrentals.status }}
                                    </span> -->
                                    <select 
                                        class="vertical-align: middle;" 
                                        v-model="tourb.status" 
                                        @change="updateItem('tours', tourb.id, tours.indexOf(tourb), { status: tourb.status })"
                                        >
                                        <option value="pending">pending</option>
                                        <option value="confirmed">confirmed</option>
                                        <option value="cancelled">cancelled</option>
                                        <option value="completed">completed</option>
                                    </select>
                                </td>
                                <td>@{{ new Date(tourb.created_at).toLocaleDateString() }}</td>
                                <td>
                                    <button class="btn btn-success btn-action btn-sm"  title="View"  @click="viewItem(tourb, 'itemModal')">
                                        <i class='bx bx-show'></i>
                                    </button>
                                    <!-- <button 
                                           class="btn btn-primary btn-action btn-sm"  
                                           title="Mark as Read"
                                           @click="updateStatus('contacts', contact.id, contacts.indexOf(contact), 'seen')"
                                        >

                                            <i class='bx bx-check'></i>
                                    </button> -->

                                    <!--Add admin comment -->
                                    <button class="btn btn-primary btn-action btn-sm" @click="addComment( tourb, 'commentModal')" style="position:relative;" title="Add Comment">
                                            <i class='bx bx-note'></i>
                                            <span 
                                                v-if="tourb.admin_comment" 
                                                class="d-inline-block ms-1 rounded-circle bg-warning" 
                                                title="Has comment" 
                                                style="width: 10px; height: 10px; position:absolute; top:1px; right:1px;">
                                            </span>
                                    </button>

      
                               
                                    <button 
                                           class="btn btn-warning btn-action btn-sm" 
                                           title="Reply"
                                           @click="viewItem(tourb, 'replyModal')"
                                          
                                        >
                                            <i class='bx bx-reply'></i>
                                    </button>
                                    <button 
                                           class="btn btn-danger btn-action btn-sm" 
                                           title="Delete"
                                           @click="deleteItem('tours',  tourb.id, tours.indexOf( tourb))"
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
                    <div v-for="(tourb, index) in   filteredTours" :key="tourb.id" class="col-lg-6 col-xl-4">
                        <div class="card contact-card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2">
                                        <span 
                                            style="position:absolute;"
                                            class="badge bg-primary notification-badge ms-2"
                                            v-if="isnewitem( tourb.id, 'TourBooking')">
                                            New
                                        </span>
                                    
                                    </div>
                                    <strong><strong>@{{ tourb.full_name }}</strong></strong>
                                </div>
                                <span class="badge" :class="getStatusClass(tourb.status)">
                                          @{{ tourb.status }}
                                </span>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <i class='bx bx-envelope me-1'></i>
                                    <small>@{{ tourb.email }}</small>
                                </p>
                                <p class="mb-2">
                                    <i class='bx bx-phone me-1'></i>
                                    <small>@{{ tourb.phone }}</small>
                                </p>
                                <!-- <p class="mb-2">
                                    <i class='bx bx-car me-1'></i>
                                    <small>@{{ taxis.car_name }}</small>
                                </p> -->
                                <p class="mb-2">
                                    <i class='bx bx-calendar me-1'></i>
                                    <small>@{{ new Date(tourb.tour_date).toLocaleDateString() }}</small>
                                </p>

                                <p class="mb-2">
                                    <i class='bx bx-map me-1'></i>
                                    <div>@{{ tourb.tour_type }}</div>
                                </p>
                                <p class="text-muted small mb-3">
                                    <!-- @{{ taxis.message.substring(0, 100) }}... -->
                                </p>
                                <small class="text-muted">
                                    <i class='bx bx-time me-1'></i>
                                    @{{ new Date(tourb.created_at).toLocaleDateString() }}
                                </small>
                                <p class="badge" :class="getStatusClass(tourb.payment_status)">
                                          @{{ tourb.payment_status }}
                                </p>
                                <small v-if="tourb.admin_comment" class="badge bg-warning text-dark ms-1" title="Has comment">
                                    <i class='bx bx-message-square-detail'></i> Has comment
                                </small>
                            </div>
                            <div class="card-footer bg-white text-center">
                                <button class="btn btn-success btn-action btn-sm" @click="viewItem(tourb, 'itemModal')">
                                    <i class='bx bx-show'></i>
                                </button>
                                <button class="btn btn-primary btn-action btn-sm" title="Mark as Confirmed" @click="updateItem('tours', tourb.id, tours.indexOf(tourb), { status: 'confirmed' })">
                                    <i class='bx bx-check'></i>
                                </button>
                                <button class="btn btn-warning btn-action btn-sm" title="Reply"  @click="viewItem(tourb, 'replyModal')">
                                    <i class='bx bx-reply'></i>
                                </button>
                                <button class="btn btn-primary btn-action btn-sm" @click="addComment(tourb, 'commentModal')">
                                    <i class='bx bx-note'></i>
                                </button>
                                <button class="btn btn-danger btn-action btn-sm" title="Delete"  @click="deleteItem('tours',tourb.id, tours.indexOf(tourb))">
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

    <!-- custom Details Modal -->
    <div class="modal fade custom-modal-a" id="itemModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-car"></i>
                        Custom Booking Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="selectedItem">
                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-lg-6 col-md-12">
                            <div class="info-section">
                                <h6>
                                    <i class="fas fa-user"></i>
                                    Personal Information
                                </h6>
                                <div class="info-item">
                                    <span class="info-label">Full Name</span>
                                    <span class="info-value">@{{ selectedItem.full_name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email</span>
                                    <span class="info-value">@{{ selectedItem.email }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Country</span>
                                    <span class="info-value">@{{ selectedItem.country }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Phone</span>
                                    <span class="info-value">@{{ selectedItem.phone }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Hotel Name</span>
                                    <span class="info-value">@{{ selectedItem.hotel_name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Room Number</span>
                                    <span class="info-value">@{{ selectedItem.room_number }}</span>
                                </div>
                              
                            </div>
                        </div>
                        
                        <!-- Tour & Accomation Information -->
                        <div class="col-lg-6 col-md-12">
                            <div class="info-section">
                                <h6>
                                    <i class="fas fa-calendar-alt"></i>
                                    Tour Information
                                </h6>
                                <div class="info-item">
                                    <span class="info-label">Date</span>
                                    <span class="info-value">@{{ new Date(selectedItem.tour_date).toLocaleDateString() }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Tour type</span>
                                    <span class="info-value">@{{ selectedItem.tour_type }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Adults</span>
                                    <span class="info-value">@{{ selectedItem.adults}}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Children</span>
                                    <span class="info-value">@{{ selectedItem.children}}</span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Created</span>
                                    <span class="info-value">@{{ new Date(selectedItem.created_at).toLocaleDateString() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Locations & Services -->
                        <div class="col-lg-6 col-md-12">
                            <div class="info-section">
                                <h6>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Other
                                </h6>
                                <div class="info-item">
                                    <span class="info-label">Transport required?</span>
                                    <span class="info-value">@{{ selectedItem.transport_required}}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Lunch non Veg</span>
                                    <span class="info-value">@{{ selectedItem.lunch_non_veg}}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Lunch Veg</span>
                                    <span class="info-value">@{{ selectedItem.lunch_veg}}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status & Payment -->
                        <div class="col-lg-6 col-md-12">
                            <div class="status-section">
                                <h6>
                                    <i class="fas fa-info-circle"></i>
                                    Status & Payment
                                </h6>
                                <div class="info-item">
                                    <span class="info-label">Rental Status</span>
                                    <span class="badge" :class="getStatusClass(selectedItem.status)">
                                        @{{ selectedItem.status }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Payment Status</span>
                                    <span class="badge" :class="getStatusClass(selectedItem.payment_status)">
                                        @{{ selectedItem.payment_status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Request -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-comments me-1"></i> Special Request
                        </label>
                        <div class="p-3 border rounded bg-light">
                            <span v-if="selectedItem.special_requests" class="text-dark">
                                @{{ selectedItem.special_requests}}
                            </span>
                            <span v-else class="text-muted fst-italic">
                                No special request provided.
                            </span>
                        </div>
                    </div>

                    <!-- Admin Comments -->
                    <div class="comment-section">
                        <h6>
                            <i class="fas fa-comments"></i>
                            Admin Comments
                        </h6>
                        <textarea 
                            class="form-control" 
                            rows="4" 
                            placeholder="Add internal notes or comments..."
                            v-model="tempComment"
                        ></textarea>
                        <small class="text-muted mt-2 d-block">
                            <i class="fas fa-lock"></i>
                            These comments are for internal use only and won't be visible to customers.
                        </small>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center flex-wrap">
                    <div class="status-controls">
                        <div v-if="selectedItem && !loadingform">
                            <label class="form-label small text-muted mb-1">Update Status:</label>
                            <select 
                                class="form-select form-select-sm" 
                                v-model="selectedItem.status" 
                                @change="updateItem('tours', selectedItem.id, tours.indexOf(selectedItem), { status: selectedItem.status })">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        
                        <div v-if="selectedItem && !loadingform">
                            <label class="form-label small text-muted mb-1">Payment Status:</label>
                            <select 
                                class="form-select form-select-sm" 
                                v-model="selectedItem.payment_status" 
                                @change="updateItem('tours', selectedItem.id, tours.indexOf(selectedItem), { payment_status: selectedItem.payment_status })"
                            >
                                <option value="paid">Paid</option>
                                <option value="unpaid">UnPaid</option>
                                <option value="refund">Refund</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 align-items-center">
                        <button type="button" class="btn btn-outline-primary" @click="updateItem('tours', commentItem.id, tours.indexOf(commentItem), { admin_comment: tempComment })" v-if="!loadingform">
                            <i class="fas fa-save"></i>
                            Save Comment
                        </button>
                        
                        <button type="button" class="btn btn-primary"  @click="viewItem(selectedItem, 'replyModal')" v-if="!loadingform">
                            <i class="fas fa-reply"></i>
                            Reply
                        </button>
                        
                        <div class="spinner-border text-primary" v-if="loadingform" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Comment Modal -->
    <div class="modal fade" id="commentModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="commentItem">
                    <div class="mb-3">
                        <label class="form-label">Customer: <strong>@{{ commentItem.full_name }}</strong></label>
                        <!-- <p class="text-muted small">@{{ commentItem.service }} inquiry</p> -->
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
                    <button type="button" class="btn btn-primary" @click="updateItem('custom', commentItem.id, custom.indexOf(commentItem), { admin_comment: tempComment })" v-if="!loadingform">Save Comment</button>
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
                            <a :href="'https://wa.me/' + formatPhone(selectedItem.phone)" target="_blank" class="contact-option whatsapp">
                                <div class="text-center">
                                    <i class='bx bxl-whatsapp'></i>
                                    <div class="contact-title">WhatsApp</div>
                                    <p class="contact-subtitle">Send message instantly</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <a :href="'sms:' + formatPhone(selectedItem.phone)" class="contact-option sms">
                                <div class="text-center">
                                    <i class='bx bx-message-dots'></i>
                                    <div class="contact-title">SMS</div>
                                    <p class="contact-subtitle">Send text message</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <a :href="'tel:' + formatPhone(selectedItem.phone)" class="contact-option phone">
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

<!-- See block tour in date -->

<div v-else>
    <div class="container my-5">
        <h2 class="mb-4">Block Tour Dates</h2>

        <div class="mb-4">
            <label for="tourSelect" class="form-label fw-bold">Select a Tour:</label>
            <select id="tourSelect" class="form-select" v-model="bookselectedTour" @change="loadBlockedDates">
                <option value="">-- Select Tour --</option>
                <option v-for="tour in optiontours" :key="tour.id" :value="tour.id">@{{ tour.name }}</option>
            </select>
        </div>

        <div v-if="bookselectedTour">
            <!-- Calendar View -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Calendar - @{{ getSelectedTourName() }} ( @{{ currentMonthYear }} )
                    </h5>
                    <div>
                        <button class="btn btn-outline-primary btn-sm me-2" @click="previousMonth">
                            <i class="bx bx-chevron-left"></i>
                        </button>
                        <button class="btn btn-outline-primary btn-sm" @click="nextMonth">
                            <i class="bx bx-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row fw-bold text-center text-muted mb-2">
                        <div class="col day-text" v-for="day in weekDays" :key="day">@{{ day }}</div>
                    </div>

                    <div class="calendar-grid mb-3">
                        <div 
                            v-for="(day, index) in calendarDays" 
                            :key="index"
                            :class="[
                                'calendar-cell',
                                {
                                    'empty-cell': !day.date,
                                    'blocked-day': isBlocked(day.date)
                                }
                            ]"
                            @click="selectDate(day.date)"
                          
                        >
                            <span v-if="day.date">@{{ day.day }}</span>
                       <!-- ✅ Only show the edit icon if day.date exists -->
                        <div 
                        v-if="day.date"
                        class="edit-icon-date"
                        role="button"
                        tabindex="0"
                        @click="toggleBlock(day.date)"
                        >
                        <i class='bx bx-edit'></i>
                        </div>
                           
                            <!-- <div v-if="isBlocked(day.date)" class="dot-indicator"></div> -->
                        </div>
                    </div>




                </div>
            </div>

            <!-- Blocked Date Table -->
        <!-- <div class="card shadow-sm mt-4">
                <div class="card-header bg-danger text-white">
                    <i class="bx bx-block me-2"></i> Blocked Dates for @{{ getSelectedTourName() }}
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 200px;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(date, index) in blockedDates" :key="index">
                                <td>@{{ formatDate(date) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="blockedDates.length === 0" class="text-muted">No blocked dates available.</div>
                </div>
            </div> -->

            <div class="card shadow-sm mt-4" v-if="bookingsForSelectedDate.length > 0">
                <div class="card-header bg-info text-white">
                    <i class="bx bx-user me-2"></i> Bookings for @{{ formatDate(selectedDate) }}
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Adults</th>
                                <th>Children</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(booking, index) in bookingsForSelectedDate" :key="index">
                                <td>@{{ booking.full_name }}</td>
                                <td>@{{ booking.adults }}</td>
                                <td>@{{ booking.children }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-else-if="selectedDate" class="mt-3 text-muted">
                No bookings found for @{{ formatDate(selectedDate) }}.
            </div>


        </div>
    </div>
</div>



@endsection
