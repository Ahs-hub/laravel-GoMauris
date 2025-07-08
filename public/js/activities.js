const { createApp } = Vue;

createApp({
    data() {
        return {
            activities: [
                {
                    id: 1,
                    name: "Catamaran Cruise",
                    selectedMonth: this.getCurrentMonth(),
                    blockedDates: [],
                    calendar: []
                },
                {
                    id: 2,
                    name: "South Tour Mauritius",
                    selectedMonth: this.getCurrentMonth(),
                    blockedDates: [],
                    calendar: []
                },
                {
                    id: 3,
                    name: "Hiking Adventure",
                    selectedMonth: this.getCurrentMonth(),
                    blockedDates: [],
                    calendar: []
                }
            ]
        }
    },
    mounted() {
        this.activities.forEach(activity => {
            this.generateCalendar(activity);
        });
    },
    methods: {
        getCurrentMonth() {
            const now = new Date();
            return `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;
        },
        generateCalendar(activity) {
            const [year, month] = activity.selectedMonth.split("-");
            const firstDay = new Date(year, month - 1, 1);
            const lastDay = new Date(year, month, 0);
            const days = [];

            for (let i = 1; i <= lastDay.getDate(); i++) {
                const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                days.push({
                    day: i,
                    date: dateStr
                });
            }

            activity.calendar = days;
        },
        toggleBlock(activity, date) {
            const index = activity.blockedDates.indexOf(date);
            if (index === -1) {
                activity.blockedDates.push(date);
            } else {
                activity.blockedDates.splice(index, 1);
            }
            // TODO: Send AJAX request to backend to save blocked dates
        },
        isBlocked(activity, date) {
            return activity.blockedDates.includes(date);
        }
    }
}).mount('#app');