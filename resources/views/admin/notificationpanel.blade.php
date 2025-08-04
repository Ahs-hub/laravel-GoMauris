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
                <h2 class="mb-0">
                    <i class="fas fa-bell me-2"></i>
                    Notifications
                    <span  class="badge bg-warning text-dark ms-2">
                         unreadCount  new
                    </span>
                </h2>
                <p class="text-muted">Manage client inquiries and contact information</p>
            </div>
            <div>
                <button class="btn btn-outline-primary" @click="clearAllNotifications">
                    <i class='bx bx-trash'></i>
                    Clear All
                </button>
            </div>
        </div>
        <!-- Filter Tabs -->
        <ul class="nav nav-pills mb-4" role="tablist">

            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'tour'" 
                        :class="['nav-link', { active: activeFilter === 'tour' }]">
                        Tour Bookings
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'car'" 
                        :class="['nav-link', { active: activeFilter === 'car' }]">
                        Car Rentals
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'taxi'" 
                        :class="['nav-link', { active: activeFilter === 'taxi' }]">
                        Taxi Bookings
                </button>
            </li>
        </ul>

        <!-- Notifications List -->
        <div v-if="filteredNotifications.length > 0" class="row">
            <div class="col-12">
                <div 
                    v-for="notification in filteredNotifications" 
                    :key="notification.id"
                    :class="['card notification-item mb-3', notification.seen ? 'seen' : 'unseen']">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div :class="['notification-icon', getNotificationClass(notification.type)]">
                                    <i :class="getNotificationIcon(notification.type)"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title mb-1">
                                            @{{ getNotificationTitle(notification.type) }}
                                            <span 
                                                v-if="!notification.seen" 
                                                class="badge bg-primary notification-badge ms-2">
                                                New
                                            </span>
                                        </h6>
                                        <p class="card-text text-muted mb-1">
                                            @{{ getNotificationMessage(notification) }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            @{{ formatDate(notification.created_at) }}
                                        </small>
                                    </div>
                                    <div class="dropdown">
                                        <button 
                                            class="btn btn-link text-muted p-1" 
                                            type="button" 
                                            :id="'dropdown-' + notification.id"
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li v-if="!notification.seen">
                                                <button 
                                                    @click="markAsRead(notification)"
                                                    class="dropdown-item">
                                                    <i class="fas fa-check me-2"></i>
                                                    Mark as Read
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button 
                                                    @click="deleteNotification(notification.id)"
                                                    class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="empty-state">
            <i class="fas fa-bell-slash"></i>
            <h4>No notifications found</h4>
            {{-- <p class="mb-0">
                {{ activeFilter === 'all' ? 'You have no notifications at the moment.' : `No ${activeFilter} notifications found.` }}
            </p> --}}
        </div>

    </div>


    <!-- Toast Container for Feedback -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div 
            v-if="showToast"
            class="toast show" 
            role="alert" 
            aria-live="assertive" 
            aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Success</strong>
                <button 
                    @click="showToast = false"
                    type="button" 
                    class="btn-close" 
                    aria-label="Close"></button>
            </div>
            <div class="toast-body">
             {{--   {{ toastMessage }}   --}}
            </div>
        </div>
    </div>

</div>

@endsection
