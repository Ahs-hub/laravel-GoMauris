<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMauris Admin Panel</title>

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
                    <a href="/admin/calendar"><i class="bx bx-calendar"></i>
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

                <li><a href="{{ route('admin.notificationpanel') }}"><i class='bx bx-bell'></i> Notification</a></li>

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
                            <li><a class="dropdown-item" href="#"><i class="bx bx-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bx bx-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bx bx-log-out"></i> Logout</a></li>
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
                    showTourBook: true, // default to tourblock showing
                    newNotifications: 0,          // latest count from the server
                    notificationDismissed: false, // true after user closes the alert
                    playNotification: 0,

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

                    //notification page
                    notifications: [], // All notifications
                    activeFilter: 'all', // Could be: 'all', 'ContactBooking', 'CarBooking', 'TaxiBooking', etc.
                    showToast: false,
                    toastMessage: '',
                  //  unreadCount: 0, // Used in badge

                    tours: [],
                    selectedTour: '',
                    blockedDates: [],
                    currentDate: new Date(),
                    weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                    loading: false,
                    loadingpage: false,
                    loadingform: false,


                    //search book date
                    bookingsForSelectedDate: [],
                    selectedDate: '',

 
                    stats: {
                        contact: { total: 0, read: 0, unread: 0, today: 0 },
                        carrental: { total: 0, proceed: 0, reserve: 0, today: 0 },
                        taxi: { total: 0, proceed: 0, reserve: 0, cancel: 0 },
                        tour: { total: 0, confirmed: 0, pending: 0, cancelled: 0 }
                    },

                    //Search Contact
                    searchQuery: '',
                    filterService: '',
                    filterCarType: '',
                    filterPayment: '',

                    filterStatus: '',
                    viewMode: 'table',
                    currentPage: 1,
                    itemsPerPage: 10,
                    selectedContacts: [],
                    allSelected: false,
                    selectedContact: null,

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
                    tours: [],
                    carrentals: [],

                    page: {
                        contacts: 1,
                        taxi: 1,
                        tours: 1,
                    },
                    hasMore: {
                        contacts: true,
                        taxi: true,
                        tours: true,
                        carrentals: true
                    },

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

                //Contact filtering
                filteredContacts() {
                    return this.getFilteredData(this.contacts, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        service: this.filterService
                    }, ['first_name', 'last_name', 'email', 'phone']);
                },

                //Contact filtering
                filteredRentals() {
                    return this.getFilteredData(this.carrentals, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        car_name: this.filterCarType, // 👈 added
                        payment_status: this.filterPayment
                    }, ['first_name', 'last_name', 'email', 'mobile', 'car_name']); // 👈 searchable
                },

                //Taxi filtering
                filteredTaxis() {            
                  return this.getFilteredData(this.taxi, {
                        searchQuery: this.searchQuery,
                        status: this.filterStatus,
                        payment_status: this.filterPayment
                    }, ['name','email', 'mobile','pickup','destination','date']); // 👈 searchable
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
                },

                /** Poll the server for the unseen-notification count */
                checkNotifications() {
                    fetch('/api/admin/notifications-count')
                        .then(r => r.json())
                        .then(({ count }) => {
                        const storedCount = parseInt(localStorage.getItem('notificationCount')) || 0;

                        // New batch detected ➜ reset dismissal flag + play sound once
                        if (count > storedCount) {
                            this.notificationDismissed = false;
                            localStorage.removeItem('notificationDismissed');
                            
                            // Only play sound if this is new increase
                            if (count > this.playNotification) {
                                this.playNotificationSound();
                            }

                            
                            this.playNotification = count;
                            localStorage.setItem('playNotification', this.playNotification.toString());


                            const newCount = count - storedCount;
                             
                            // 🔁 Call second function to fetch & update new notifications
                            this.fetchNewNotifications(newCount, count);

                        }else{
                            localStorage.setItem('notificationCount', String(count));

                        }

                        this.newNotifications = count;
                        })
                        .catch(console.error);
                },

                fetchNewNotifications(limit, totalCount) {
                    fetch(`/api/admin/notifications/latest?limit=${limit}`)
                        .then(res => res.json())
                        .then(({ data }) => {
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

                          //      console.log('[fetchNewNotifications] Notification received:', { id, type, related_id });
                         //       console.log('[fetchNewNotifications] Mapped key:', key);

                                if (key && this.newnotifications[key]) {
                                    this.newnotifications[key].count++;
                                    this.newnotifications[key].ids.push(id);
                                    this.newnotifications[key].related_id.push(related_id);

                                    // console.log(`[fetchNewNotifications] Updated ${key}:`, {
                                    //     count: this.newnotifications[key].count,
                                    //     ids: this.newnotifications[key].ids,
                                    //     related_ids: this.newnotifications[key].related_id
                                    // });
                                } else {
                                    console.warn('[fetchNewNotifications] Unknown type or unmapped key:', type);
                                }
                            });
                        })
                        .catch(error => {
                            console.error('[fetchNewNotifications] Error:', error);
                        });
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

                        fetch(`/api/admin/${type}-stats`)
                            .then(res => res.json())
                            .then(data => {
                                this.stats[type] = data;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    },

                    loadPaginatedData(endpoint, targetArray) {
                        

                        //Check that and comment
                        if (this.loadingpage || !this.hasMore[targetArray]) return;

                        this.loadingpage = true;

                        fetch(`${endpoint}?page=${this.page[targetArray]}`)
                            .then(res => res.json())
                            .then(data => {
                               // console.log(`[loadPaginatedData] Fetched page ${this.page[targetArray]} for ${targetArray}:`, data);
                                
                                this[targetArray].push(...data.data); //contacts[] , tours[],carrentals[]

                               // console.log(`[loadPaginatedData] Updated ${targetArray} array:`, this[targetArray]); // 👈 Debug this[targetArray]

                                this.page[targetArray]++;
                                this.hasMore[targetArray] = data.current_page < data.last_page;
                            })
                            .finally(() => {
                                this.loadingpage = false;
                            });
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
                            case 'cancelled': return 'bg-danger';
                            case 'paid': return 'bg-success';
                            case 'unpaid': return 'bg-warning text-dark';
                            case 'replied': return 'bg-success';
                            default: return 'bg-secondary';
                        }
                    },

                    deleteItem(type, id, index) {
                        if (!confirm("Are you sure you want to delete this item?")) return;

                        this.loading = true;

                        fetch(`/api/${type}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to delete item');
                            this[type].splice(index, 1);  // Remove from list
                        })
                        .catch(err => {
                            console.error(err);
                            alert('An error occurred while deleting the item.');
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                    },

                    updateStatus(type, id, index, status) {
                        console.log('Updating status for item:', id, 'new status:', status, 'index:', index);
                        this.loading = true;
                        this.loadingform = true;

                        fetch(`/api/${type}/${id}/update-status`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ status: status })
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to update status');
                            return res.json();
                        })
                        .then(() => {
                            this[type][index].status = status;  // example: this.taxiBookings[2].status
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Failed to update status.');
                        })
                        .finally(() => {
                            this.loading = false;
                            this.loadingform = false;
                        });
                    },

                    //Update all field
                    updateItem(type, id, index, updatedData) {
                        this.loading = true;
                        this.loadingform = true;

                        console.log('🟡 [updateItem] Sending update for:', {
                            type,
                            id,
                            index,
                            updatedData
                        });

                        fetch(`/api/${type}/${id}/update-data`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(updatedData)
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to update item');
                            return res.json();
                        })
                        .then(data => {
                            this[type][index] = data; // Replace with full updated object
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Failed to update item.');
                        })
                        .finally(() => {
                            this.loading = false;
                            this.loadingform = false;

                            console.log('🔵 [updateItem] Done loading');
                        });
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

                            return matchesSearch && matchesStatus && matchesService && matchesCarType && matchesPaymentType;
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

                    saveComment(model) {
                        if (this.commentItem) {

                            this.loadingform = true;

                            fetch(`/api/${model}/${this.commentItem.id}/update-comment`, {
                                method: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    admin_comment: this.tempComment
                                })
                            })
                            .then(res => {
                                if (!res.ok) throw new Error('Failed to save comment');
                                return res.json();
                            })
                            .then(() => {
                                this.commentItem.admin_comment = this.tempComment;

                                // Close modal
                                const modal = bootstrap.Modal.getInstance(document.getElementById('commentModal'));
                                modal.hide();

                                alert('Comment saved successfully!');
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Failed to save comment.');
                            })
                            .finally(() => {
                                this.loadingform = false;
                            });
                        }
                    },

                    clearFilters() {
                        this.searchQuery = '';
                        this.filterService = '';
                        this.filterStatus = '';
                        this.filterCarType = '';
                        this.filterPayment = '';
                    },

                    refreshData() {
                        window.location.reload();
                    },

                //#endregion load contact,tour,taxi ect
                
                //#region load notification
                    fetchNotifications() {
                        this.loading = true;
                        fetch('/api/admin/notifications') // ← You must create this API route in Laravel
                            .then(res => res.json())
                            .then(data => {
                                this.notifications = data;
                                this.unreadCount = data.filter(n => !n.seen).length;
                            })
                            .catch(console.error)
                            .finally(() => this.loading = false);
                    },
                    deleteNotification(id) {
                        if (!confirm("Are you sure you want to delete this notification?")) return;
                        this.loading = true;
                        fetch(`/api/admin/notifications/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        }).then(() => {
                            this.notifications = this.notifications.filter(n => n.id !== id);
                            this.toastMessage = 'Notification deleted';
                            this.showToast = true;
                        })
                        .finally(() => this.loading = false);
                    },

                    clearAllNotifications() {
                        if (!confirm("Clear all notifications?")) return;
                        this.loading = true;
                        fetch('/api/admin/notifications/clear-all', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        }).then(() => {
                            this.notifications = [];

                            // Remove stored notification data
                            localStorage.removeItem('notificationCount');
                            localStorage.removeItem('notificationDismissed');
                            localStorage.removeItem('playNotification');

                            this.toastMessage = 'All notifications cleared';

                            this.showToast = true;
                        })
                        .finally(() => this.loading = false);
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
                        TourBooking: 'tour',
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
                            TourBooking: 'tour',
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
                    if (!date || !this.selectedTour) return;

                    this.selectedDate = date;
                    this.loading = true;

                    try {
                        const res = await axios.get(`/admin/tours/bookings/${this.selectedTour}/${date}`);
                        this.bookingsForSelectedDate = res.data;
                    } catch (error) {
                        console.error(error);
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
                }


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

                } else if (window.location.pathname.includes('/admin/booktour')) {
                    this.fetchTours();
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
                selectedTour() {
                    this.loadBlockedDates();
                }
            }
        }).mount('#app');
    </script>


    @stack('scripts')
</body>
</html>
