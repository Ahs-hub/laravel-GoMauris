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
                    @{{ newNotificationOnly }} new
                    </span>
                </h2>
                <p class="text-muted">Clear notification after view to save storage </p>
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
                        @click="activeFilter = 'all'" 
                        :class="['nav-link', { active: activeFilter === 'all' }]">
                        All
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'tour'" 
                        :class="['nav-link', { active: activeFilter === 'tour' }]">
                        Tour Bookings
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'custombook'" 
                        :class="['nav-link', { active: activeFilter === 'custombook' }]">
                        Custom Bookings
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
            <li class="nav-item" role="presentation">
                <button 
                        @click="activeFilter = 'contact'" 
                        :class="['nav-link', { active: activeFilter === 'contact' }]">
                        Contact Bookings
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
                                                v-if="isNewNotification(notification)" 
                                                class="badge bg-primary notification-badge ms-2">
                                                New
                                            </span>
                                        </h6>
                                        <p class="card-text text-muted mb-1">
                                            @{{ getNotificationMessage(notification) }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            @{{ new Date(notification.created_at).toLocaleString() }}
                                        </small>
                                    </div>
                                    <!-- Trash Bin Button -->
                                    <button 
                                        @click="deleteNotification(notification.id)"
                                        class="btn btn-link text-danger p-1"
                                        title="Delete Notification">
                                        <i class="bx bx-trash"></i>
                                    </button>
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
