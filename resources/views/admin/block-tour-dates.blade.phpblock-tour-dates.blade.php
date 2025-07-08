<script>
    const toursFromLaravel = @json($tours);
</script>
<div id="app">
    <select v-model="selectedTourId" class="form-select">
        <option value="" disabled>Select a tour</option>
        <option v-for="tour in tours" :value="tour.id" :key="tour.id">{{ tour.name }}</option>
    </select>
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
const { createApp } = Vue;
createApp({
    data() {
        return {
            tours: toursFromLaravel,
            selectedTourId: ''
        };
    }
}).mount('#app');
</script>
