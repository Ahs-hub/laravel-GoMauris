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
                <li><a href="/admin/calendar"><i class='bx bx-bell'></i> Notification</a></li>

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
                <div v-if="newNotifications > 0">
                    <div  class="alert alert-warning alert-dismissible fade show" role="alert">
                        🔔 @{{ newNotifications }} new notification(s) received.
                        <button type="button" class="btn-close" @click="dismissNotification"></button>
                        <a href="/admin/notifications/mark-seen" class="btn btn-sm ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh page">
                            <i class='bx bx-refresh'></i>
                        </a>
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
                    newNotifications: 0,

                    tours: [],
                    selectedTour: '',
                    blockedDates: [],
                    currentDate: new Date(),
                    weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    loading: false,


                    //search book date
                    bookingsForSelectedDate: [],
                    selectedDate: '',

                    statscontact: {
                        total: 0,
                        read: 0,
                        unread: 0,
                        today: 0
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

                    //loading page contact 
                    contacts: [],
                    page: 1,
                    hasMore: true

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
                },

                filteredContacts() {
                    return this.contacts.filter(contact => {
                    const query = this.searchQuery.toLowerCase();

                    const matchesSearch =
                        query === '' ||
                        (contact.first_name && contact.first_name.toLowerCase().includes(query)) ||
                        (contact.last_name && contact.last_name.toLowerCase().includes(query)) ||
                        (contact.email && contact.email.toLowerCase().includes(query)) ||
                        (contact.phone && contact.phone.includes(query));

                    const matchesService =
                        this.filterService === '' || contact.service === this.filterService;

                    const matchesStatus =
                        this.filterStatus === '' || contact.status === this.filterStatus;

                    return matchesSearch && matchesService && matchesStatus;
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
                },

                //Check notification
                checkNotifications() {
                    fetch('/api/admin/notifications-count')
                        .then(res => res.json())
                        .then(data => {
                            this.newNotifications = data.count;
                        })
                        .catch(console.error);
                },
                
                //#region load contact
                    loadStats() {
                        this.loading = true;
                        fetch('/admin/contact-stats')
                            .then(res => res.json())
                            .then(data => {
                                this.statscontact = data;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    },

                    loadContacts() {
                        if (this.loading || !this.hasMore) return;

                        this.loading = true;

                        fetch(`/api/contacts?page=${this.page}`)
                            .then(res => res.json())
                            .then(data => {
                                this.contacts.push(...data.data);
                                this.page++;
                                this.hasMore = data.current_page < data.last_page;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    },

                    handleScroll() {
                        let bottomOfWindow =
                            window.innerHeight + window.scrollY >= document.body.offsetHeight - 200;

                        if (bottomOfWindow) {
                            this.loadContacts();
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

                    deleteContact(id, index) {
                        this.loading = true;
                        if (!confirm("Are you sure you want to delete this contact?")) return;

                        fetch(`/api/contacts/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to delete contact');
                            // Remove from local list
                            this.contacts.splice(index, 1);
                        })
                        .catch(err => {
                            console.error(err);
                            alert('An error occurred while deleting the contact.');
                        })
                        .finally(() => {
                                this.loading = false;
                        });

                    },

                    updateContactStatus(id, index, status) {
                        this.loading = true;
                        fetch(`/api/contacts/${id}/update-status`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ status: status })
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to update contact status');
                            return res.json();
                        })
                        .then(() => {
                            this.contacts[index].status = status;
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Failed to update contact status.');
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                    },

                    viewContact(contact) {
                    this.selectedContact = contact;
                    const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                    modal.show();
                    },
                //#endregion load contact
                
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
                }


            },
            mounted() {

                if (window.location.pathname.includes('/admin/contactpanel')) {
                    this.loadStats();
                    this.loadContacts();
                    window.addEventListener('scroll', this.handleScroll);
                    
                } else if (window.location.pathname.includes('/admin/booktour')) {
                    this.fetchTours();
                }

                //check notification
                this.checkNotifications();
                setInterval(this.checkNotifications, 60000);

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
