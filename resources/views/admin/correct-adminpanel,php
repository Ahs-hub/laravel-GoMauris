@extends('layouts.adminlayout')

@section('content')

<style>
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }
    .calendar-cell {
        height: 60px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 8px;
        text-align: center;
        position: relative;
        cursor: pointer;
        transition: background 0.2s;
    }
    .calendar-cell:hover {
        background: #f8f9fa;
    }
    .calendar-cell.blocked-day {
        background-color: #dc3545;
        color: #fff;
    }
    .dot-indicator {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 10px;
        height: 10px;
        background-color: #fff;
        border: 2px solid red;
        border-radius: 50%;
    }
    .empty-cell {
        background-color: transparent;
        border: none;
        cursor: default;
    }
    @media (max-width: 768px) {
        .day-text{
            font-size:12px;
        }
    }
</style>

<div id="app">
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
                            @click="day.date && toggleBlock(day.date)"
                        >
                            <span v-if="day.date">@{{ day.day }}</span>
                            <div v-if="isBlocked(day.date)" class="dot-indicator"></div>
                        </div>
                    </div>




                </div>
            </div>

            <!-- Blocked Date Table -->
            <div class="card shadow-sm mt-4">
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
            </div>
        </div>
    </div>
</div>

<!-- Vue + Axios -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            tours: [],
            selectedTour: '',
            blockedDates: [],
            currentDate: new Date(),
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            loading: false,
        };
    },
    computed: {
        calendarDays() {
            const days = [];
            const year = this.currentDate.getFullYear();
            const month = this.currentDate.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysInMonth = lastDay.getDate();

            // Add blanks before the first day
            for (let i = 0; i < firstDay.getDay(); i++) {
                days.push({ date: null, day: null });
            }

            // Fill actual calendar days
            for (let day = 1; day <= daysInMonth; day++) {
                // Manually construct the date string
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                days.push({ date: dateStr, day });
            }

            return days;
        },
        currentMonthYear() {
            return this.currentDate.toLocaleDateString('en-US', {
                month: 'long',
                year: 'numeric'
            });
        }
    },
    methods: {
        fetchTours() {
            this.loading = true;
            axios.get('/api/tours')
                .then(res => this.tours = res.data)
                .catch(err => console.error(err))
                .finally(() => this.loading = false);
        },
        loadBlockedDates() {
            if (!this.selectedTour) return;
            this.loading = true;
            axios.get(`/admin/tours/blocked-dates/${this.selectedTour}`)
                .then(res => this.blockedDates = res.data.blocked_dates || [])
                .catch(err => {
                    console.error(err);
                    this.blockedDates = [];
                })
                .finally(() => this.loading = false);
        },
        isBlocked(date) {
            return this.blockedDates.includes(date);
        },
        async toggleBlock(date) {
            if (!date) return;
            const isCurrentlyBlocked = this.isBlocked(date);
            const action = isCurrentlyBlocked ? 'unblock' : 'block';
            const confirmMsg = `Are you sure you want to ${action} the date ${date}?`;

            if (!confirm(confirmMsg)) return;

            this.loading = true;

            if (isCurrentlyBlocked) {
                this.blockedDates = this.blockedDates.filter(d => d !== date);
            } else {
                this.blockedDates.push(date);
            }

            try {
                await axios.post('/admin/tours/block-dates', {
                    tour_id: this.selectedTour,
                    blocked_dates: this.blockedDates
                });
            } catch (error) {
                alert("Something went wrong while saving.");
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
        nextMonth() {
            this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
        },
        previousMonth() {
            this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
        },
        formatDate(dateStr) {
            const date = new Date(dateStr + 'T00:00:00'); // force midnight
            return date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric' 
            });
        },
        getSelectedTourName() {
            const selected = this.tours.find(t => t.id == this.selectedTour);
            return selected ? selected.name : '';
        }
    },
    mounted() {
        this.fetchTours();
    },
    watch: {
        selectedTour() {
            this.loadBlockedDates();
        }
    }
}).mount('#app');
</script>
@endsection
