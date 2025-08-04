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

                <li><a href="{{ route('admin.tourpanel') }}"><i class="bx bx-calendar"></i>Tour Booking</a></li>

                <li><a href="/admin/calendar"><i class="bx bx-calendar"></i>Custom Booking</a></li>

                <li><a href="/admin/calendar"><i class="bx bx-car"></i>Car Booking</a></li>

                <li><a href="/admin/calendar"><i class="bx bx-car"></i>Taxi Booking</a></li>

                <li><a href="{{ route('admin.contactpanel') }}"><i class='bx bx-phone'></i>Contact</a></li>
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
                    newNotifications: 0,          // latest count from the server
                    notificationDismissed: false, // true after user closes the alert
                    playNotification: 0,

                    //notification page
                    notifications: [], // All notifications
                    activeFilter: 'unseen', // Could be: 'unseen', 'tour', 'car', 'taxi', etc.
                    showToast: false,
                    toastMessage: '',
                    unreadCount: 0, // Used in badge

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
                        taxi: { total: 0, proceed: 0, reserve: 0, cancel: 0 },
                        tour: { total: 0, confirmed: 0, pending: 0, cancelled: 0 }
                    },

                    //Search Contact
                    searchQuery: '',
                    filterService: '',
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

                    // page contact,tour,taxi ect
                    contacts: [],
                    taxi: [],
                    tours: [],

                    page: {
                        contacts: 1,
                        taxi: 1,
                        tours: 1,
                    },
                    hasMore: {
                        contacts: true,
                        taxi: true,
                        tours: true,
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
                paginatedContacts() {
                    return this.paginate(this.filteredContacts, this.currentPage, this.itemsPerPage);
                },

                //Notification filter 
                filteredNotifications() {
                    let filtered = this.notifications;

                    if (this.activeFilter === 'unseen') {
                        return filtered.filter(n => !n.seen);
                    }

                    if (this.activeFilter === 'tour') {
                        return filtered.filter(n => n.type === 'tour');
                    }

                    if (this.activeFilter === 'car') {
                        return filtered.filter(n => n.type === 'car');
                    }

                    if (this.activeFilter === 'taxi') {
                        return filtered.filter(n => n.type === 'taxi');
                    }

                    return filtered;
                }

                
            },
            methods: {
                //Globally for exporting
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
                        }

                        this.newNotifications = count;
                        })
                        .catch(console.error);
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

                        fetch(`/admin/${type}-stats`)
                            .then(res => res.json())
                            .then(data => {
                                this.stats[type] = data;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    },

                    loadPaginatedData(endpoint, targetArray) {
                        if (this.loadingpage || !this.hasMore[targetArray]) return;

                        this.loadingpage = true;

                        fetch(`${endpoint}?page=${this.page[targetArray]}`)
                            .then(res => res.json())
                            .then(data => {
                                this[targetArray].push(...data.data);
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
                            case 'seen': return 'bg-info';
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
                        this.loading = true;

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

                            return matchesSearch && matchesStatus && matchesService;
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

                    saveComment() {
                        if (this.commentItem) {

                            this.loadingform = true;

                            fetch(`/api/contacts/${this.commentItem.id}/update-comment`, {
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
                        });
                    },

                    clearAllNotifications() {
                        if (!confirm("Clear all notifications?")) return;

                        fetch('/api/admin/notifications/clear-all', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        }).then(() => {
                            this.notifications = [];
                            this.toastMessage = 'All notifications cleared';
                            this.showToast = true;
                        });
                    },

                    getNotificationTitle(type) {
                        switch(type) {
                            case 'TourBooking': return 'New Tour Booking';
                            case 'CarBooking': return 'New Car Booking';
                            case 'TaxiBooking': return 'New Taxi Request';
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
                        } else {
                            return 'You have a new notification.';
                        }
                    },
                    getNotificationIcon(type) {
                        switch (type) {
                            case 'tour': return 'bx bx-map';
                            case 'car': return 'bx bx-car';
                            case 'taxi': return 'bx bx-taxi';
                            default: return 'bx bx-bell';
                        }
                    },
                    getNotificationClass(type) {
                        switch (type) {
                            case 'tour': return 'bg-primary text-white';
                            case 'car': return 'bg-success text-white';
                            case 'taxi': return 'bg-warning text-dark';
                            default: return 'bg-secondary text-white';
                        }
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

                if (path.includes('/admin/contactpanel')) {
                    this.currentTab = 'contact';
                    this.loadStats('contact');
                    this.loadPaginatedData('/api/contacts', 'contacts');
                    window.addEventListener('scroll', () => this.handleScroll('/api/contacts', 'contacts'));

                } else if (window.location.pathname.includes('/admin/booktour')) {
                    this.fetchTours();
                }else if (window.location.pathname.includes('/admin/notificationpanel')) {
                    this.fetchNotifications();
                }


                // Load dismissal state on start-up
                this.notificationDismissed = localStorage.getItem('notificationDismissed') === 'true';

                // First check immediately, then every 30 s
                this.checkNotifications();
                this.timer = setInterval(this.checkNotifications, 60_000);

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
