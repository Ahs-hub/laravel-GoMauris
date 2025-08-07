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
                <h2 class="mb-1">Car Rental</h2>
                <p class="text-muted">Manage client rental</p>
            </div>
            <div>
                <!-- <button class="btn btn-primary me-2" @click="exportContacts" aria-label="Export Car Rental Messages">
                    <i class='bx bx-download'></i> Export
                </button> -->
                <button class="btn btn-outline-primary" @click=" refreshData" aria-label="Refresh Car Rental List">
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
                        <h3 class="mb-1"> @{{ stats.carrental.total }}</h3>
                        <small>Total Messages</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-check-circle fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.carrental.reserve }} </h3>
                        <small>Confirmed</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-time fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.carrental.proceed }} </h3>
                        <small>Pending</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stats-card text-center p-3">
                    <div class="card-body p-2">
                        <i class='bx bx-calendar fs-1 mb-2'></i>
                        <h3 class="mb-1"> @{{ stats.carrental.today }} </h3>
                        <small>Today's Messages</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <!-- <div class="card mb-4">
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
                                placeholder="Search rental..."
                                v-model="searchQuery"
                            >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select v-model="filterCarType" class="form-select">
                            <option value="">All Car Types</option>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Hatchback">Hatchback</option> -->
                            <!-- Populate dynamically if needed -->
                        <!-- </select>
                    </div> -->
                    <!-- type -->
                    <!-- <div class="col-md-3">
                        <select class="form-select" v-model="filterService">
                            <option value="">All Services</option>
                            <option value="Car Rental">Car Booking</option>
                            <option value="Taxi Booking">Taxi Booking</option>
                            <option value="Tour Booking">Tour Booking</option>
                            <option value="Custom Tour">Custom Booking</option>
                            <option value="Other">Other</option>
                        </select>
                    </div> -->
                   <!-- <div class="col-md-3">
                        <select class="form-select" v-model="filterStatus">
                            <option value="">All Status</option>
                            <option value="unseen">Unread</option>
                            <option value="seen">Read</option>
                        </select>
                    </div> -->
                      <!--<div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100" @click="clearFilters">
                            <i class='bx bx-x'></i> Clear
                        </button>
                    </div> -->
          <!--  </div>
            </div>
         </div> -->

        
       
         <!-- Rentals Table -->
        <!-- <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Rentals Messages (@{{ stats.carrental.total }})</h5>
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
            </div> -->

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
                                <th>Car</th>
                                <th>Pickup → Return</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- card detail table -->
                        <tbody>
                            <tr  v-for="(rental, index) in  filteredRentals" :key="rental.id">
                                <td>
                                    <!-- <span 
                                        style="position:absolute;"
                                        class="badge bg-primary notification-badge ms-2"
                                        v-if="isnewitem( rentals.id, 'ContactBooking')">
                                        New
                                    </span> -->
                                    <input type="checkbox" class="form-check-input" >
                                </td>
                                <td>
                                    <strong>@{{  rental.first_name }}</strong>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class='bx bx-envelope me-1'></i>@{{  rental.email }}</div>
                                        <div><i class='bx bx-phone me-1'></i>@{{  rental.phone }}</div>
                                    </div>
                                </td>
                                <td>
                                    @{{  rental.car_name}}
                                </td>
       
                                <td>
                                    <div class="small">
                                        <div>@{{  rental.pickup_date }}</div>
                                        <div>@{{  rental.return_date }}</div>
                                    </div>
                                </td>
                                <td>
                                    <select 
                                        class="vertical-align: middle;" 
                                        v-model="rental.payment_status" 
                                        @change="updateItem('carrentals', rental.id, carrentals.indexOf(rental), { payment_status: rental.payment_status })"
                                    >
                                        <option value="paid">paid</option>
                                        <option value="unpaid">unpaid</option>
                                    </select>
                                </td>
                                <td>
                                    <!-- <span class="badge" :class="getStatusClass(carrentals.status)">
                                        @{{ carrentals.status }}
                                    </span> -->
                                    <select 
                                        class="vertical-align: middle;" 
                                        v-model="rental.status" 
                                        @change="updateItem('carrentals', rental.id, carrentals.indexOf(rental), { status: rental.status })"
                                        >
                                        <option value="pending">pending</option>
                                        <option value="confirmed">confirmed</option>
                                        <option value="cancelled">cancelled</option>
                                    </select>
                                </td>
                                <td>@{{ new Date(rental.created_at).toLocaleDateString() }}</td>
                                <td>
                                    <button class="btn btn-success btn-action btn-sm"  title="View"  @click="viewItem(rental, 'itemModal')">
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
                                    <button class="btn btn-primary btn-action btn-sm" @click="addComment( rental, 'commentModal')" style="position:relative;" title="Add Comment">
                                            <i class='bx bx-note'></i>
                                            <span 
                                                v-if="rental.admin_comment" 
                                                class="d-inline-block ms-1 rounded-circle bg-warning" 
                                                title="Has comment" 
                                                style="width: 10px; height: 10px; position:absolute; top:1px; right:1px;">
                                            </span>
                                    </button>

      
                               
                                    <button 
                                           class="btn btn-warning btn-action btn-sm" 
                                           title="Reply"
                                          
                                        >
                                            <i class='bx bx-reply'></i>
                                    </button>
                                    <button 
                                           class="btn btn-danger btn-action btn-sm" 
                                           title="Delete"
                                           @click="deleteItem('carrentals',  rental.id, carrentals.indexOf( rental))"
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
                <!-- <div v-else class="row g-3 p-3">
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
                                <button class="btn btn-warning btn-action btn-sm" title="Reply"  @click="updateStatus('contacts', contact.id, contacts.indexOf(contact), 'reply')">
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
                </div> -->


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
    <div class="modal fade" id="itemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rental Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" v-if="selectedItem">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Personal Information</h6>
                            <p><strong>Name:</strong> @{{ selectedItem.first_name }} @{{ selectedItem.last_name }}</p>
                            <p><strong>Email:</strong> @{{ selectedItem.email }}</p>
                            <p><strong>Phone:</strong> @{{ selectedItem.phone }}</p>
                            <p><strong>Age:</strong> @{{ selectedItem.driver_age }}</p>
                            
                            <p><strong>Pickup Location:</strong> @{{ selectedItem.pickup_location }}</p>
                            <p><strong>Return Location:</strong> @{{ selectedItem.return_location}}</p>

                            <p><strong>Pickup Date:</strong> @{{ selectedItem.pickup_date }}</p>
                            <p><strong>Return Date:</strong> @{{ selectedItem.return_date }}</p>

                            <p><strong>Has Driver:</strong> @{{ selectedItem.has_driver }}</p>

                            <p><strong>Child Seat:</strong> @{{ selectedItem.child_seats }}</p>

                            <p><strong>Car Type:</strong> @{{ selectedItem.car_name }}</p>
                            <p><strong>Date:</strong> @{{ new Date(selectedItem.created_at).toLocaleDateString() }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Status</h6>
                            <span class="badge" :class="getStatusClass(selectedItem.status)">
                                @{{ selectedItem.status }}
                            </span>
                            <h6>Payment</h6>
                            <span class="badge" :class="getStatusClass(selectedItem.payment_status)">
                                @{{ selectedItem.payment_status }}
                            </span>
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
                   
                    <button type="button" class="btn btn-primary" @click="updateItem('carrentals', commentItem.id, carrentals.indexOf(commentItem), { admin_comment: tempComment })" v-if="!loadingform">Save Comment</button>

                    <div class="spinner-border text-primary" v-if="loadingform" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    <button type="button" class="btn btn-primary"  v-if="!loadingform" >Reply</button>

                    <div v-if="selectedItem  && !loadingform">
                        <select 
                                class="form-select form-select-sm" 
                                v-model="selectedItem.status" 
                                @change="updateStatus('carrentals',  selectedItem.id,  carrentals.indexOf(selectedItem),  selectedItem.status)">
                                <option value="pending">pending</option>
                                <option value="confirmed">confirmed</option>
                                <option value="cancelled">cancelled</option>
                        </select>
                    </div>
                   
                    <div v-if="selectedItem && !loadingform">
                        <select 
                            class="form-select form-select-sm" 
                            v-model="selectedItem.payment_status" 
                            @change="updateItem('carrentals', selectedItem.id, carrentals.indexOf(selectedItem), { payment_status: selectedItem.payment_status })"
                        >
                            <option value="paid">paid</option>
                            <option value="unpaid">unpaid</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
                        <label class="form-label">Customer: <strong>@{{ commentItem.first_name }} @{{ commentItem.last_name }}</strong></label>
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
                    <button type="button" class="btn btn-primary" @click="updateItem('carrentals', commentItem.id, carrentals.indexOf(commentItem), { admin_comment: tempComment })" v-if="!loadingform">Save Comment</button>
                    <div class="spinner-border text-primary" v-if="loadingform" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
