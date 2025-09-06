<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMauris Admin Panel</title>
    <!-- Add icon -->
    <link rel="icon" type="image/png" href="{{ secure_asset('favicon.png') }}">

    {{-- CSS Libraries --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">

    {{-- Custom Styles (optional to extract into separate file) --}}

    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/adminpanel.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/adminpanel.css') }}">
    @endif

    <!-- for location map -->
    <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />
   <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    
    <!-- Vue + Axios -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>
<body >
    <div id="app">
        {{-- sound notification --}}
        <audio id="notificationSound" src="/sounds/notification.mp3" preload="auto"></audio>

        {{-- Sidebar --}}
        <div class="sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h4>Admin Panel</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home"></i> Dashboard</a></li>

                <li>
                    <a href="{{ route('admin.tourpanel') }}"><i class="bx bx-calendar"></i>
                        Tour Booking
                        <span 
                            v-if="newnotifications.tour.count > 0"
                            class="badge bg-primary notification-badge ms-2">
                            New @{{ newnotifications.tour.count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.custompanel') }}"><i class="bx bx-calendar"></i>
                        CustomBooking
                        <span 
                            v-if="newnotifications.custom.count  > 0"
                            class="badge bg-primary notification-badge ms-2">
                            New @{{ newnotifications.custom.count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.carrentalpanel') }}"><i class="bx bx-car"></i>
                        Car Booking
                        <span 
                            v-if="newnotifications.car.count  > 0"
                            class="badge bg-primary notification-badge ms-2">
                            New @{{ newnotifications.car.count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.taxipanel') }}"><i class="bx bx-car"></i>
                       Taxi Booking
                       <span 
                            v-if="newnotifications.taxi.count  > 0"
                            class="badge bg-primary notification-badge ms-2">
                            New @{{ newnotifications.taxi.count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.contactpanel') }}"><i class='bx bx-phone'></i>
                        Contact
                        <span 
                            v-if="newnotifications.contact.count  > 0"
                            class="badge bg-primary notification-badge ms-2">
                            New @{{ newnotifications.contact.count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.discountpanel') }}">
                       <i class='bx bx-cog'></i>
                        Manage
                    </a>
                </li>

                <li><a href="{{ route('admin.notificationpanel') }}"><i class='bx bx-bell'></i> Notification</a></li>
                <li><a href="{{ route('admin.deletepanel') }}"><i class="bx bx-cog"></i> Settings</a></li>
                

                <!-- <li><a href="/admin/bookings"><i class="bx bx-calendar"></i> Bookings</a></li> -->
                <!-- <li><a href="/admin/vehicles"><i class="bx bx-car"></i> Vehicles</a></li> -->
                <!-- <li><a href="/admin/tours"><i class="bx bx-map"></i> Tours</a></li> -->
                <!-- <li><a href="/admin/calendar"><i class="bx bx-calendar-check"></i> Availability</a></li> -->
               

                <!-- <li><a href="/admin/customers"><i class="bx bx-user"></i> Customers</a></li> -->
                <!-- <li><a href="/admin/payments"><i class="bx bx-credit-card"></i> Payments</a></li>
                <li><a href="/admin/reports"><i class="bx bx-bar-chart"></i> Reports</a></li>
                <li><a href="/admin/settings"><i class="bx bx-cog"></i> Settings</a></li> -->
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="main-content"  >
            {{-- Topbar --}}
            <nav class="navbar d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary d-md-none" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                        <i class="bx bx-menu"></i>
                    </button>
                    <span class="ms-3 fw-bold fs-5 text-dark">Admin Panel</span>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-user-circle"></i> Admin
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.profilepanel') }}"><i class="bx bx-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.deletepanel') }}"><i class="bx bx-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" @click.prevent="logout">
                                    <i class="bx bx-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- Notification Update --}}
            <div style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                <div v-if="newNotificationOnly > 0 && !notificationDismissed">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        🔔 @{{ newNotificationOnly }} new notification(s) received.
                        <button type="button" class="btn-close" @click="dismissNotification"></button>
                        <p>Refresh the page to view changes.</p>
                    </div>
                </div>
            </div>
            
            

            {{-- Page Content --}}
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    {{-- JS Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    selectAll: false,

                    showTourBook: true, // default to tourblock showing
                    newNotifications: 0,          // latest count from the server
                    notificationDismissed: false, // true after user closes the alert
                    playNotification: 0,


                    modifiedmodaltour: false,
                    modifiedmodalcar: false,
                    editItem: {},      // Currently editing tour,car

                    //new notification receive  count,id
                    newnotifications: {
                        tour: {
                            count: 0,
                            ids: [], // Use a valid key like 'ids'
                            related_id: []
                        },
                        car: {
                            count: 0,
                            ids: [],
                            related_id: []
                        },
                        taxi: {
                            count: 0,
                            ids: [],
                            related_id: []
                        },
                        contact: {
                            count: 0,
                            ids: [],
                            related_id: []
                        },
                        custom: {
                            count: 0,
                            ids: [],
                            related_id: []
                            
                        }
                    },

                    //save setting(social link,phone,email)
                    admin: [],

                    //notification page
                    notifications: [], // All notifications
                    activeFilter: 'all', // Could be: 'all', 'ContactBooking', 'CarBooking', 'TaxiBooking', etc.
                    showToast: false,
                    toastMessage: '',
                  //  unreadCount: 0, // Used in badge
                    
                  
                    optiontours: [],
                    bookselectedTour: '',
                  //  tours: [],
                  //  selectedTour: '',
                    blockedDates: [],
                    currentDate: new Date(),
                    weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                    //view the tour to modidified(price promotion)
                    tourstomodify: [],
                    carstomodify: [],

                    loading: false,
                    loadingpage: false,
                    loadingform: false,


                    //search book date
                    bookingsForSelectedDate: [],
                    selectedDate: '',

 
                    stats: {
                        contact: { total: 0, read: 0, unread: 0, today: 0 },
                        carrental: { total: 0, proceed: 0, reserve: 0, today: 0 },
                        custom: { total: 0, proceed: 0, reserve: 0, today: 0 },
                        taxi: { total: 0, proceed: 0, reserve: 0, cancel: 0 },
                        tour: { total: 0, confirmed: 0, pending: 0, cancelled: 0 }
                    },

                    //Search Contact
                    searchQuery: '',
                    filterService: '',
                    filterCarType: '',
                    filterPayment: '',
                    filterDate: '',
                    filterMonth: '', // 👈 NEW

                    filterDateCreateAt: '',
                    filterMonthCreateAt: '',

                    filterStatus: '',
                    viewMode: 'table',
                    currentPage: 1,
                    itemsPerPage: 10,
                    selectedContacts: [],
                    allSelected: false,
                    selectedContact: null,
                    showAdvanced: false,   // Advance Search

                    commentItem: null,
                    tempComment: '',

                    selectedItem: null,

                    //map location
                    mapInstance: null,
                    pickupMarker: null,
                    returnMarker: null,
                    
                    // page contact,tour,taxi ect
                    contacts: [],
                    taxi: [],
                    custom:[],
                    tours: [],
                    carrentals: [],
  
                    //Make it stop searching when fetching
                    page: {
                        contacts: 1,
                        taxi: 1,
                        tours: 1,
                        custom: 1,
                        carrentals: 1
                    },
                    hasMore: {
                        contacts: true,
                        taxi: true,
                        tours: true,
                        custom: true,
                        carrentals: true
                    },

                    deleteTables: [
                        { value: 'custom_booking', label: 'Custom Booking', icon: 'bx bx-calendar-event' },
                        { value: 'tour_booking', label: 'Tour Booking', icon: 'bx bx-map' },
                        { value: 'car_rental', label: 'Car Rental Booking', icon: 'bx bx-car' },
                        { value: 'contact', label: 'Contact Form Messages', icon: 'bx bx-user-voice' },
                        { value: 'taxi_booking', label: 'Taxi Booking', icon: 'bx bx-taxi' }
                    ],
                    deleteStatuses: ['confirmed', 'cancelled', 'pending','completed'],
                    deleteAges: [
                        { value: '6months', label: 'Older than 6 Months' },
                        { value: '1year', label: 'Older than 1 Year' },
                        { value: '2years', label: 'Older than 2 Years' },
                        { value: '5years', label: 'Older than 5 Years' }
                    ],
                    deleteSelectedTables: [],
                    deleteStatus: '',
                    deleteAge: '',
                    deleteAdminPassword: '',
                    //See amount to be deleted
                    previewCount: 0,
                    previewPerTable: {}, // 👈 new

                    //Size memory
                    usage: {
                        database: '',
                        used_mb: 0,
                        limit_mb: 0,
                        remaining_mb: 0
                    }

                };
            },
            created() {
                // Load from localStorage on page load
                this.previousNotificationCount = parseInt(localStorage.getItem('notificationCount')) || 0;
                this.notificationDismissed = localStorage.getItem('notificationDismissed') === 'true';
                this.playNotification = parseInt(localStorage.getItem('playNotification')) || 0;
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
                },

                newNotificationOnly() {
                    const stored = parseInt(localStorage.getItem('notificationCount')) || 0;
                    return Math.max(this.newNotifications - stored, 0);
                },

                //Tours filtering
                filteredTours() {
                    return this.getFilteredData(this.tours, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        payment_status: this.filterPayment,
                        tour_date: this.filterDate,
                        item_month: this.filterMonth, // 👈 NEW
                        created_at: this.filterDateCreateAt,
                        createat_month:this.filterMonthCreateAt
                    }, ['first_name', 'last_name', 'email', 'phone','tour_type','tour_date']); // 👈 searchable
                },

                //Contact filtering
                filteredContacts() {
                    return this.getFilteredData(this.contacts, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        service: this.filterService,
                        created_at: this.filterDateCreateAt,
                        createat_month:this.filterMonthCreateAt
                    }, ['first_name', 'last_name', 'email', 'phone']);
                },

                //Rentals filtering
                filteredRentals() {
                    return this.getFilteredData(this.carrentals, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        car_name: this.filterCarType, // 👈 added
                        payment_status: this.filterPayment,
                        pickup_date: this.filterDate,
                        item_month: this.filterMonth, // 👈 NEW
                        created_at: this.filterDateCreateAt,
                        createat_month:this.filterMonthCreateAt
                    }, ['first_name', 'last_name', 'email', 'phone', 'car_name']); // 👈 searchable
                },

                //Taxi filtering
                filteredTaxis() {            
                  return this.getFilteredData(this.taxi, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        payment_status: this.filterPayment,
                        date: this.filterDate,
                        item_month: this.filterMonth, // 👈 NEW
                        created_at: this.filterDateCreateAt,
                        createat_month:this.filterMonthCreateAt
                    }, ['name','email', 'phone','pickup','destination','date']); // 👈 searchable
                },

                //Custom filtering
                filteredCustom() {            
                  return this.getFilteredData(this.custom, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        payment_status: this.filterPayment,
                        tour_date: this.filterDate,
                        item_month: this.filterMonth, // 👈 NEW
                        created_at: this.filterDateCreateAt,
                        createat_month:this.filterMonthCreateAt
                    }, ['full_name','email', 'phone','preferred_tour','date']); // 👈 searchable
                },


                paginatedContacts() {
                    return this.paginate(this.filteredContacts, this.currentPage, this.itemsPerPage);
                },

                //Notification filter 
                filteredNotifications() {
                    let filtered = this.notifications;

                    if (this.activeFilter === 'tour') {
                        return filtered.filter(n => n.type === 'TourBooking');
                    }

                    if (this.activeFilter === 'car') {
                        return filtered.filter(n => n.type === 'CarBooking');
                    }

                    if (this.activeFilter === 'taxi') {
                        return filtered.filter(n => n.type === 'TaxiBooking');
                    }

                    if (this.activeFilter === 'contact') {
                        return filtered.filter(n => n.type === 'ContactBooking');
                    }

                    if (this.activeFilter === 'custombook') {
                        return filtered.filter(n => n.type === 'CustomBooking');
                    }

                    return filtered;
                },

                //For checking space 
                usagePercent() {
                    if (!this.usage.limit_mb) return 0;
                    return ((this.usage.used_mb / this.usage.limit_mb) * 100).toFixed(2);
                }
                
            },
            methods: {
                //Globally for exporting database
                exportToCSV(dataArray, fields, filenamePrefix = 'export') {
                    if (!dataArray || !fields || dataArray.length === 0) {
                        alert("No data to export.");
                        return;
                    }

                    // Build CSV header from fields
                    const headers = fields.map(f => f.label).join(",") + "\n";

                    // Build CSV rows
                    const rows = dataArray.map(item => {
                        return fields.map(f => `"${item[f.key] ?? ''}"`).join(",");
                    }).join("\n");

                    const csvContent = "data:text/csv;charset=utf-8," + headers + rows;
                    const encodedUri = encodeURI(csvContent);
                    const link = document.createElement("a");
                    link.setAttribute("href", encodedUri);

                    // Filename like tour_bookings_2025-08-02.csv
                    const date = new Date().toISOString().split('T')[0];
                    link.setAttribute("download", `${filenamePrefix}_${date}.csv`);

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },

                playNotificationSound() {
                    const audio = document.getElementById('notificationSound');
                    if (audio) {
                    audio.play().catch(err => {
                        console.warn('Audio play failed:', err);
                    });
                    }
                },
 
                //confirmed tour date
                fetchTours() {
                    this.loading = true;
                    axios.get('/api/optiontours', { withCredentials: true })
                        .then(res => this.optiontours = res.data)
                        .catch(err => console.error(err))
                        .finally(() => this.loading = false);
                },
                loadBlockedDates() {
                    if (!this.bookselectedTour) {
                        console.log("No tour selected. bookselectedTour =", this.bookselectedTour);
                        return;
                    }

                    console.log("Fetching blocked dates for tour ID:", this.bookselectedTour);

                    this.loading = true;

                    axios.get(`/api/admin/optiontours/blockedd-dates/${this.bookselectedTour}`, { withCredentials: true })
                        .then(res => {
                            console.log('Blocked Dates API response:', res.data);
                            this.blockedDates = res.data.blocked_dates || [];
                        })
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
                        await axios.post('/api/admin/optiontours/block-dates', {
                            tour_id: this.bookselectedTour,
                            blocked_dates: this.blockedDates
                        },
                        { withCredentials: true } 

                        );
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
                    const selected = this.optiontours.find(t => t.id == this.bookselectedTour);
                    return selected ? selected.name : '';
                },
                //-----------------

                /** Poll the server for the unseen-notification count */
                async checkNotifications() {
                    try {
                        const res = await axios.get('/api/admin/notifications-count', { withCredentials: true });
                        const { count } = res.data;

                        const storedCount = parseInt(localStorage.getItem('notificationCount')) || 0;

                        if (count > storedCount) {
                            this.notificationDismissed = false;
                            localStorage.removeItem('notificationDismissed');

                            // Only play sound if count increased
                            if (count > this.playNotification) {
                                this.playNotificationSound();
                            }

                            this.playNotification = count;
                            localStorage.setItem('playNotification', count.toString());

                            const newCount = count - storedCount;

                            // 🔁 Fetch the new notifications
                            this.fetchNewNotifications(newCount, count);
                        }

                        // Always update the stored count
                        localStorage.setItem('notificationCount', count.toString());

                        this.newNotifications = count;
                    } catch (error) {
                        console.error("Failed to fetch notifications:", error);
                    }
                },

                async fetchNewNotifications(limit, totalCount) {
                    try {
                        const res = await axios.get(`/api/admin/notifications/latest`, {
                            params: { limit }, // axios way to add ?limit=...
                            withCredentials: true
                        });

                        const { data } = res.data;

                        // Reset object
                        this.newnotifications = {
                            tour: { count: 0, ids: [], related_id: [] },
                            car: { count: 0, ids: [], related_id: [] },
                            taxi: { count: 0, ids: [], related_id: [] },
                            contact: { count: 0, ids: [], related_id: [] },
                            custom: { count: 0, ids: [], related_id: [] }
                        };

                        // Mapping from type string to internal key
                        const typeMap = {
                            TourBooking: 'tour',
                            CustomBooking: 'custom',
                            TaxiBooking: 'taxi',
                            CarBooking: 'car',
                            ContactBooking: 'contact'
                        };

                        // Group and count by normalized type
                        data.forEach(({ id, type, related_id }) => {
                            const key = typeMap[type]; // e.g., "tour"

                            if (key && this.newnotifications[key]) {
                                this.newnotifications[key].count++;
                                this.newnotifications[key].ids.push(id);
                                this.newnotifications[key].related_id.push(related_id);
                            } else {
                                console.warn('[fetchNewNotifications] Unknown type or unmapped key:', type);
                            }
                        });

                    } catch (error) {
                        console.error('[fetchNewNotifications] Error:', error);
                    }
                },

                /** Close button logic */
                dismissNotification() {
                    this.notificationDismissed = true;
                    localStorage.setItem('notificationDismissed', 'true');
                    // Mark the latest count as “seen”
                    localStorage.setItem('notificationCount', this.newNotifications.toString());
                    
                    //  No notifiication sound
                    localStorage.setItem('playNotification', this.newNotifications.toString());
                },


                //#region load contact,tour,taxi ect
                    loadStats(type) {
                        this.loading = true;

                        fetch(`/api/admin/${type}-stats`, { credentials: 'include' })
                            .then(res => res.json())
                            .then(data => {
                                this.stats[type] = data;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    },
                    

                    async loadPaginatedData(endpoint, targetArray) {
                        // Prevent double loading or extra calls
                        if (this.loadingpage || !this.hasMore[targetArray]) return;

                        this.loadingpage = true;

                        try {
                            const res = await axios.get(endpoint, {
                                params: { page: this.page[targetArray] },
                                withCredentials: true
                            });

                            const data = res.data;

                            // Push new records into array
                            this[targetArray].push(...data.data);

                            // Update pagination state
                            this.page[targetArray]++;
                            this.hasMore[targetArray] = data.current_page < data.last_page;

                        } catch (error) {
                            console.error(`[loadPaginatedData] Error fetching ${targetArray}:`, error);
                        } finally {
                            this.loadingpage = false;
                        }
                    },

                    handleScroll(endpoint, targetArray) {
                        const bottomOfWindow =
                            window.innerHeight + window.scrollY >= document.body.offsetHeight - 200;

                        if (bottomOfWindow) {
                            this.loadPaginatedData(endpoint, targetArray);
                        }
                    },

                    getStatusClass(status) {
                        switch (status) {
                            case 'unseen': return 'bg-warning text-dark';
                            case 'pending': return 'bg-warning text-dark';
                            case 'seen': return 'bg-info';
                            case 'confirmed': return 'bg-success';
                            case 'completed': return 'bg-success';
                            case 'cancelled': return 'bg-danger';
                            case 'paid': return 'bg-success';
                            case 'unpaid': return 'bg-warning text-dark';
                            case 'replied': return 'bg-success';
                            default: return 'bg-secondary';
                        }
                    },

                    async deleteItem(type, id, index) {
                        if (!confirm("Are you sure you want to delete this item?")) return;

                        this.loading = true;

                        try {
                            await axios.delete(`/api/${type}/${id}`, {
                                withCredentials: true, // include Sanctum session cookie
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                }
                            });

                            // Remove the item locally
                            this[type].splice(index, 1);

                        } catch (error) {
                            console.error('[deleteItem] Error:', error);
                            alert('An error occurred while deleting the item.');
                        } finally {
                            this.loading = false;
                        }
                    },

                    async updateStatus(type, id, index, status) {
                        console.log('Updating status for item:', id, 'new status:', status, 'index:', index);
                        this.loading = true;
                        this.loadingform = true;

                        try {
                            await axios.put(`/api/${type}/${id}/update-status`, 
                                { status }, // request body
                                { withCredentials: true } // include Sanctum session cookie
                            );

                            // Update local state
                            this[type][index].status = status;

                        } catch (error) {
                            console.error('[updateStatus] Error:', error);
                            alert('Failed to update status.');
                        } finally {
                            this.loading = false;
                            this.loadingform = false;
                        }
                    },

                    //Update all field
                    async updateItem(type, id, index, updatedData) {
                        this.loading = true;
                        this.loadingform = true;

                        console.log('🟡 [updateItem] Sending update for:', {
                            type,
                            id,
                            index,
                            updatedData
                        });

                        try {
                            const { data } = await axios.put(
                                `/api/${type}/${id}/update-data`,
                                updatedData,
                                { withCredentials: true } // include Sanctum session cookie
                            );

                            // Replace local object with updated one
                            this[type][index] = data;

                        } catch (error) {
                            console.error('[updateItem] Error:', error);
                            alert('Failed to update item.');
                        } finally {
                            this.loading = false;
                            this.loadingform = false;

                            console.log('🔵 [updateItem] Done loading');
                        }
                    },


                    viewItem(item, modalId) {
                        this.selectedItem = item;
                        const modal = new bootstrap.Modal(document.getElementById(modalId));
                        modal.show();
                    },

                    getFilteredData(data, filters = {}, searchFields = []) {
                        return data.filter(item => {
                            const query = (filters.searchQuery || '').toLowerCase();

                            const matchesSearch =
                                query === '' ||
                                searchFields.some(field =>
                                    item[field] && item[field].toLowerCase().includes(query)
                                );

                            const matchesStatus =
                                !filters.status || item.status === filters.status;

                            const matchesService =
                                !filters.service || item.service === filters.service;
                            
                            const matchesCarType =
                                !filters.car_name || item.car_name === filters.car_name; // 👈 NEW

                            const matchesPaymentType =
                                !filters.payment_status || item.payment_status === filters.payment_status; // 👈 NEW
                            
                            // ✅ Date filtering (works for both tour_date and date)
                            const matchesDate =
                                (!filters.tour_date && !filters.pickup_date && !filters.date ) ||
                                (filters.tour_date && item.tour_date === filters.tour_date) ||
                                (filters.pickup_date && item.pickup_date.slice(0, 10) === filters.pickup_date) ||
                                (filters.date && item.date.slice(0, 10) === filters.date);

                            // ✅ Month filtering (works for both tour_date and date)
                            const matchesMonth =
                                !filters.item_month ||
                                (item.tour_date && item.tour_date.slice(0, 7) === filters.item_month) ||
                                (item.pickup_date && item.pickup_date.slice(0, 7) === filters.item_month)||
                                (item.date && item.date.slice(0, 7) === filters.item_month);
                            
                            const matchesCreateAtDate =
                                !filters.created_at || (item.created_at && item.created_at.slice(0, 10) === filters.created_at);

                            // Month match (YYYY-MM)
                            const matchesCreateAtMonth =
                                !filters.createat_month || (item.created_at && item.created_at.slice(0, 7) === filters.createat_month);


                            return matchesSearch && matchesStatus && matchesService &&
                                   matchesCarType && matchesPaymentType && matchesDate &&
                                   matchesMonth && matchesCreateAtDate && matchesCreateAtMonth;
                        });
                    },

                    paginate(data, currentPage, itemsPerPage) {
                        const start = (currentPage - 1) * itemsPerPage;
                        return data.slice(start, start + itemsPerPage);
                    },
                   
                    addComment(item, modalId) {
                        this.commentItem = item;
                        this.tempComment = item.admin_comment || '';
                        const modal = new bootstrap.Modal(document.getElementById(modalId));
                        modal.show();
                    },

                    async saveComment(model) {
                        if (!this.commentItem) return;

                        this.loadingform = true;

                        try {
                            await axios.put(
                                `/api/${model}/${this.commentItem.id}/update-comment`,
                                { admin_comment: this.tempComment },
                                { withCredentials: true } // include Sanctum session cookie
                            );

                            // Update local state
                            this.commentItem.admin_comment = this.tempComment;

                            // Close modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('commentModal'));
                            modal.hide();

                            alert('Comment saved successfully!');

                        } catch (error) {
                            console.error('[saveComment] Error:', error);
                            alert('Failed to save comment.');
                        } finally {
                            this.loadingform = false;
                        }
                    },

                    clearFilters() {
                        this.searchQuery = '';
                        this.filterService = '';
                        this.filterStatus = '';
                        this.filterCarType = '';
                        this.filterPayment = '';
                        this.filterDate = '';
                        this.filterMonth ='';
                        this.filterDateCreateAt = '',
                        this.filterMonthCreateAt = ''
                    },

                    refreshData() {
                        window.location.reload();
                    },

                    formatPhone(phone) {
                        if (!phone) return '';
                        // Remove all spaces and leading +
                        const formatted = phone.replace(/\s+/g, '').replace(/^\+/, '');
                        console.log('Formatted phone:', formatted); // -> 23054757697
                        return formatted;
                    },

                //#endregion load contact,tour,taxi ect
                
                //#region load notification
                    async fetchNotifications() {
                        this.loading = true;

                        try {
                            const res = await axios.get('/api/admin/notifications', { withCredentials: true });

                            this.notifications = res.data;
                            this.unreadCount = res.data.filter(n => !n.seen).length;

                        } catch (error) {
                            console.error('[fetchNotifications] Error:', error);
                        } finally {
                            this.loading = false;
                        }
                    },

                    async deleteNotification(id) {
                        if (!confirm("Are you sure you want to delete this notification?")) return;

                        this.loading = true;

                        try {
                            await axios.delete(`/api/admin/notifications/${id}`, { withCredentials: true });

                            // Remove locally
                            this.notifications = this.notifications.filter(n => n.id !== id);

                            this.toastMessage = 'Notification deleted';
                            this.showToast = true;

                        } catch (error) {
                            console.error('[deleteNotification] Error:', error);
                            alert('Failed to delete notification.');
                        } finally {
                            this.loading = false;
                        }
                    },

                    async clearAllNotifications() {
                        if (!confirm("Clear all notifications?")) return;

                        this.loading = true;

                        try {
                            await axios.delete('/api/admin/notifications/clear-all', { withCredentials: true });

                            // Clear local state and storage
                            this.notifications = [];
                            localStorage.removeItem('notificationCount');
                            localStorage.removeItem('notificationDismissed');
                            localStorage.removeItem('playNotification');

                            this.toastMessage = 'All notifications cleared';
                            this.showToast = true;

                        } catch (error) {
                            console.error('[clearAllNotifications] Error:', error);
                            alert('Failed to clear notifications.');
                        } finally {
                            this.loading = false;
                        }
                    },


                    getNotificationTitle(type) {
                        switch(type) {
                            case 'TourBooking': return 'New Tour Booking';
                            case 'CarBooking': return 'New Car Booking';
                            case 'TaxiBooking': return 'New Taxi Request';
                            case 'ContactBooking': return 'New Contact Request';
                            case 'CustomBooking': return 'New Custom Request';
                            default: return 'Notification';
                        }
                    },
                    getNotificationMessage(notification) {
                        if (notification.type === 'TourBooking') {
                            return `Booking #${notification.related_id} just arrived.`;
                        } else if (notification.type === 'CarBooking') {
                            return `Car Booking #${notification.related_id} is pending.`;
                        } else if (notification.type === 'TaxiBooking') {
                            return `Taxi request received (ID: ${notification.related_id}).`;
                        } else if (notification.type === 'ContactBooking') {
                            return `Contact request received (ID: ${notification.related_id}).`;
                        } else if (notification.type === 'CustomBooking') {
                            return `Custom request received (ID: ${notification.related_id}).`;
                        } else {
                            return 'You have a new notification.';
                        }
                    },
                    getNotificationIcon(type) {
                        switch (type) {
                            case 'TourBooking': return 'bx bx-map';
                            case 'CustomBooking': return 'bx bx-map';
                            case 'CarBooking': return 'bx bx-car';
                            case 'TaxiBooking': return 'bx bx-car';
                            case 'ContactBooking': return 'bx bx-phone';
                            default: return 'bx bx-bell';
                        }
                    },
                    getNotificationClass(type) {
                        switch (type) {
                            case 'TourBooking': return 'bg-primary text-white';
                            case 'CustomBooking': return 'bg-primary text-white';
                            case 'CarBooking': return 'bg-success text-white';
                            case 'ContactBooking': return 'bg-success text-white';
                            case 'TaxiBooking': return 'bg-warning text-dark';
                            default: return 'bg-secondary text-white';
                        }
                    },

                    //check if notification is new         
                    isNewNotification(notification) {
                        const typeMap = {
                        TourBooking: 'tours',
                        CustomBooking: 'custom',
                        TaxiBooking: 'taxi',
                        CarBooking: 'car',
                        ContactBooking: 'contact'
                        };

                        const key = typeMap[notification.type];
                        if (!key || !this.newnotifications[key]) return false;

                        return this.newnotifications[key].ids.includes(notification.id);
                    },

                    isnewitem(item, itemtype) {
                        // Map contactbook types to newnotifications keys
                        const typeMap = {
                            TourBooking: 'tours',
                            CarBooking: 'car',
                            TaxiBooking: 'taxi',
                            ContactBooking: 'contact',
                            Custombooking: 'custom'
                        };

                        const key = typeMap[itemtype];

                     //   console.log('[isnewitem] item:', item);
                     //    console.log('[isnewitem] itemtype:', itemtype);
                     //    console.log('[isnewitem] resolved key:', key);

                        if (!key || !this.newnotifications[key]) {
                     //        console.warn(`[isnewitem] Invalid key or missing notification data for key:`, key);
                            return false;
                        }

                     //   console.log('[isnewitem] related_id array:', this.newnotifications[key].related_id);
                        const exists = this.newnotifications[key].related_id.includes(item);
                      //  console.log('[isnewitem] Exists in related_id:', exists);

                        return exists;
                    },

                //#endregion load notification


                //search book date
                async selectDate(date) {
                    if (!date || !this.bookselectedTour) return;

                    this.selectedDate = date;
                    this.loading = true;

                    try {
                        const res = await axios.get(
                            `/api/admin/optiontours/bookings/${this.bookselectedTour}/${date}`,
                            { withCredentials: true } // ensure session cookie is sent
                        );

                        this.bookingsForSelectedDate = res.data;

                    } catch (error) {
                        console.error('[selectDate] Error fetching bookings:', error);
                        this.bookingsForSelectedDate = [];
                    } finally {
                        this.loading = false;
                    }
                },

                //open map for car booking
                openMapModal() {
                    // Show Bootstrap modal (use your method to open it)
                    const modalEl = this.$refs.mapModal;
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    // Initialize map after modal is shown and DOM is ready
                    this.$nextTick(() => {
                        setTimeout(() => {
                        this.initOrUpdateMap();
                        }, 300);  // slight delay to ensure modal shown properly
                    });
                },
                initOrUpdateMap() {
                    const pickupLat = parseFloat(this.selectedItem.pickup_latitude);
                    const pickupLng = parseFloat(this.selectedItem.pickup_longitude);
                    // For return location, prefer return_* if present, else fallback to destination_*
                    const returnLat = parseFloat(
                        this.selectedItem.return_latitude ?? this.selectedItem.destination_latitude
                    );
                    const returnLng = parseFloat(
                        this.selectedItem.return_longitude ?? this.selectedItem.destination_longitude
                    );

                    console.log("Pickup Lat:", pickupLat, "Pickup Lng:", pickupLng);
                    console.log("Return Lat:", returnLat, "Return Lng:", returnLng);

                    if (!this.mapInstance) {
                        // Create map
                        this.mapInstance = L.map('map').setView([pickupLat, pickupLng], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        }).addTo(this.mapInstance);

                        // Add markers
                        this.pickupMarker = L.marker([pickupLat, pickupLng]).addTo(this.mapInstance)
                        .bindPopup('<b>Pickup Location</b>');

                        this.returnMarker = L.marker([returnLat, returnLng]).addTo(this.mapInstance)
                        .bindPopup('<b>Return Location</b>');

                        // Fit map to markers
                        const group = L.featureGroup([this.pickupMarker, this.returnMarker]);
                        this.mapInstance.fitBounds(group.getBounds());

                    } else {
                        // Update marker positions
                        this.pickupMarker.setLatLng([pickupLat, pickupLng]);
                        this.returnMarker.setLatLng([returnLat, returnLng]);

                        // Fit map to markers
                        const group = L.featureGroup([this.pickupMarker, this.returnMarker]);
                        this.mapInstance.fitBounds(group.getBounds());
                    }
                },



                //Export contact
                exportContacts() {
                    this.exportToCSV(this.filteredContacts, [
                        { label: "First Name", key: "first_name" },
                        { label: "Last Name", key: "last_name" },
                        { label: "Email", key: "email" },
                        { label: "Phone", key: "phone" },
                        { label: "Service Type", key: "service" },
                        { label: "Inquiry Details", key: "message" },
                        { label: "Status", key: "status" },
                        { label: "Priority", key: "priority" },
                        { label: "Admin Comment", key: "admin_comment" },
                        { label: "Date Received", key: "created_at" }
                    ], 'GoMauris_Contact');
                },


                //#region    for deletion of data
                    resetDeleteForm() {
                        this.deleteSelectedTables = [];
                        this.deleteStatus = '';
                        this.deleteAge = '';
                        this.deleteAdminPassword = '';
                    },
                    async showPasswordModal() {
                        this.previewCount = 0;
                        this.previewPerTable = {};
                        this.loadingform = true;

                        try {
                            const res = await axios.post(
                                '/admin/delete-preview',
                                {
                                    tables: this.deleteSelectedTables,
                                    status: this.deleteStatus,
                                    age: this.deleteAge
                                },
                                { withCredentials: true } // automatically sends session cookie
                            );

                            const data = res.data;

                            if (data.success) {
                                this.previewCount = data.total || 0;
                                this.previewPerTable = data.perTable || {};
                            } else {
                                alert(data.message || 'Unable to fetch preview data.');
                            }

                        } catch (err) {
                            console.error('[showPasswordModal] Preview fetch failed:', err);
                            alert('Failed to fetch preview counts. Try again.');
                        } finally {
                            this.loadingform = false;
                        }

                        const modal = new bootstrap.Modal(document.getElementById('passwordModal'));
                        modal.show();
                    },


                    async confirmDelete() {
                        this.loadingform = true;

                        try {
                            const res = await axios.post(
                                '/delete-data',
                                {
                                    tables: this.deleteSelectedTables,
                                    status: this.deleteStatus,
                                    age: this.deleteAge,
                                    password: this.deleteAdminPassword
                                },
                                { withCredentials: true } // include Sanctum session cookie
                            );

                            const data = res.data;

                            if (data.success) {
                                alert('Data deleted successfully!');
                                this.resetDeleteForm();
                                const modal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
                                modal.hide();
                            } else {
                                alert(data.message || 'Password incorrect or deletion failed.');
                            }

                        } catch (error) {
                            console.error('[confirmDelete] Error:', error);
                            alert('Error processing deletion.');
                        } finally {
                            this.loadingform = false;
                        }
                    },

                //#endregion for deletion of data
                async logout() {
                    if (!confirm("Do you want to log out?")) return;

                    this.loading = true;

                    try {
                        await axios.post(
                            "/admin/logout",
                            {},
                            { withCredentials: true } // include Sanctum session cookie
                        );

                        window.location.href = "/admin/secure-Df678pK3/login";

                    } catch (error) {
                        console.error("[logout] Logout failed:", error);
                        alert("Logout failed. Please try again.");
                    } finally {
                        this.loading = false;
                    }
                },


                //Fetch size memory
                async fetchUsage() {
                    try {
                        const res = await axios.get('/api/db-usage', { withCredentials: true });
                        this.usage = res.data;
                    } catch (err) {
                        console.error('[fetchUsage] Error fetching DB usage:', err);
                        this.usage = { database: 'Error', used_mb: 0, limit_mb: 0, remaining_mb: 0 };
                    }
                },

                //#region Modified tour,car (promotion price ..ect)
                    async fetchToursToModify() {
                        this.loading = true;

                        try {
                            const res = await axios.get("{{ route('admin.tours.json') }}", { withCredentials: true });
                            this.tourstomodify = res.data;
                            this.modifiedmodalcar = false;
                            this.modifiedmodaltour = true; // show the table
                        } catch (err) {
                            console.error('[fetchToursToModify] Error fetching tours:', err);
                        } finally {
                            this.loading = false;
                        }
                    },

                    async fetchCarsToModify() {
                        this.loading = true;

                        try {
                            const res = await axios.get("{{ route('admin.cars.json') }}", { withCredentials: true });
                            this.carstomodify = res.data;
                            this.modifiedmodaltour = false;
                            this.modifiedmodalcar = true; // show the table
                        } catch (err) {
                            console.error('[fetchCarsToModify] Error fetching cars:', err);
                        } finally {
                            this.loading = false;
                        }
                    },


                    openEditModal(item, modalRef) {
                       this.editItem = { ...item }; // or rename to editItem if shared
                       new bootstrap.Modal(this.$refs[modalRef]).show();
                    },
                    
                    closeEditModal(modalRef) {
                        bootstrap.Modal.getInstance(this.$refs[modalRef]).hide();
                    },


                //    openEditModal(tour) {
                 //       this.editTour = {...tour}; // clone so we don’t edit directly
                  //      new bootstrap.Modal(this.$refs.editModal).show();
                 //   },

                 //   openEditModal(car) {
                  //      this.editTour = {...car}; // clone so we don’t edit directly
                 //       new bootstrap.Modal(this.$refs.editModalcar).show();
                 //   },

                //    closeEditModal() {
                 //       bootstrap.Modal.getInstance(this.$refs.editModal).hide();
                 //   },
                 async updateModifyTour() {
                    this.loadingform = true;

                    try {
                        const res = await axios.put(
                            `/admin/tours/${this.editItem.id}`,
                            this.editItem,
                            { withCredentials: true } // include Sanctum session cookie
                        );

                        const index = this.tourstomodify.findIndex(t => t.id === this.editItem.id);
                        if (index !== -1) this.tourstomodify[index] = res.data;

                        this.closeEditModal('editModal');
                        alert('Tour updated successfully!');

                    } catch (err) {
                        console.error('[updateModifyTour] Error updating tour:', err);
                        alert('Failed to update tour.');
                    } finally {
                        this.loadingform = false;
                    }
                },

                async updateModifyCar() {
                    this.loadingform = true;

                    try {
                        const res = await axios.put(
                            `/admin/cars/${this.editItem.id}`,
                            this.editItem,
                            { withCredentials: true } // include Sanctum session cookie
                        );

                        const index = this.carstomodify.findIndex(c => c.id === this.editItem.id);
                        if (index !== -1) this.carstomodify[index] = res.data;

                        this.closeEditModal('editModalcar');
                        alert('Car updated successfully!');

                    } catch (err) {
                        console.error('[updateModifyCar] Error updating car:', err);
                        alert('Failed to update car.');
                    } finally {
                        this.loadingform = false;
                    }
                },

                //#endregion Modified tour,car (promotion price ..ect)

                async fetchAdminSetting() {
                    this.loading = true;

                    try {
                        const res = await axios.get('/admin/settings/json', { withCredentials: true });
                        console.log('[fetchAdminSetting] Full response:', res);
                        console.log('[fetchAdminSetting] Data only:', res.data);
                        this.admin = res.data;
                    } catch (err) {
                        console.error('[fetchAdminSetting] Error fetching settings:', err);
                        // fallback defaults
                        this.admin = {
                            contact_email: '',
                            whatsapp: '',
                            twitter: '',
                            facebook: '',
                            instagram: '',
                        };
                    } finally {
                        this.loading = false;
                    }
                },
                
                async saveSettings() {
                    this.loadingform = true;

                    try {
                        const res = await axios.post(
                            '{{ route("admin.settings.update") }}',
                            this.admin,
                            { withCredentials: true } // include Sanctum session cookie
                        );

                        alert(res.data.message);
                        this.admin = res.data.admin;
                    } catch (err) {
                        console.error('[saveSettings] Error saving settings:', err);
                        alert('Failed to save settings.');
                    } finally {
                        this.loadingform = false;
                    }
                },


                handleSubmitpassword(e) {
                    this.loading = true;
                    e.target.submit(); // actually submit the form after enabling spinner
                },

            },
            mounted() {

                const path = window.location.pathname;
                const mediaQuery = window.matchMedia("(max-width: 768px)");


                // Initial check
                if (mediaQuery.matches) {
                    this.viewMode = 'cards';
                }


                if (path.includes('/admin/contactpanel')) {
                    this.currentTab = 'contact';
                    this.loadStats('contact');
                    this.loadPaginatedData('/api/contacts', 'contacts');
                    window.addEventListener('scroll', () => this.handleScroll('/api/contacts', 'contacts'));

                } else if (path.includes('/admin/booktour')) {
                    this.fetchTours();

                    this.currentTab = 'tour';
                    this.loadStats('tour');
                     this.loadPaginatedData('/api/tours', 'tours');
                     window.addEventListener('scroll', () => this.handleScroll('/api/tours', 'tours'));
               
                }else if (path.includes('/admin/carrentalpanel')) {
                    this.currentTab = 'carrental';
                    this.loadStats('carrental');
                    this.loadPaginatedData('/api/carrentals', 'carrentals');
                    window.addEventListener('scroll', () => this.handleScroll('/api/carrentals', 'carrentals'));
                    
                }else if (path.includes('/admin/taxipanel')) {
                    this.currentTab = 'taxi';
                    this.loadStats('taxi');
                    this.loadPaginatedData('/api/taxi', 'taxi');
                    window.addEventListener('scroll', () => this.handleScroll('/api/taxi', 'taxi'));
                    
                }else if (path.includes('/admin/custompanel')) {
                    this.currentTab = 'custom';
                    this.loadStats('custom');
                    this.loadPaginatedData('/api/custom', 'custom');
                    window.addEventListener('scroll', () => this.handleScroll('/api/taxi', 'taxi'));
                    
                }else if (path.includes('/admin/profilepanel')) {
                    this.fetchAdminSetting();
                }else if (path.includes('/admin/deletepanel')) {
                    this.fetchUsage();//Space used
                }else if (window.location.pathname.includes('/admin/notificationpanel')) {
                    this.fetchNotifications();
                }


                // Load dismissal state on start-up
                this.notificationDismissed = localStorage.getItem('notificationDismissed') === 'true';

                // First check immediately, then every 30 s
                this.checkNotifications();
                this.timer = setInterval(this.checkNotifications, 30_000);

            },
            beforeUnmount() {
                clearInterval(this.timer);
            },
            watch: {
                bookselectedTour() {
                    this.loadBlockedDates();
                }
            }
        }).mount('#app');
    </script>


    @stack('scripts')
</body>
</html>
