@extends('layouts.adminlayout')

@section('content')
<div class="d-flex justify-content-start gap-2 mt-3">
    <button 
        class="btn btn-primary me-2" 
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



<div v-if="showTourBook">
     tour-block
</div>
<div v-else>
    <!-- Loading Overlay -->
    <div v-if="loading" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50" style="z-index: 1050;">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="mb-4">Block Tour Dates</h2>

        <div class="mb-4">
            <label for="tourSelect" class="form-label fw-bold">Select a Tour:</label>
            <select id="tourSelect" class="form-select" v-model="selectedTour" @change="loadBlockedDates">
                <option value="">-- Select Tour --</option>
                <option v-for="tour in tours" :key="tour.id" :value="tour.id">@{{ tour.name }}</option>
            </select>
        </div>

        <div v-if="selectedTour">
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
