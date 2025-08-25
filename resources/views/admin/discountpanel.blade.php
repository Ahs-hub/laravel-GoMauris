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
        <!-- Modified tour data -->
        <button @click="fetchToursToModify" class="btn btn-primary mb-3 me-2">
            <i class='bx bx-table'> </i>Tour
        </button>
        <!-- Modified tour data -->
        <button @click="fetchCarsToModify" class="btn btn-primary mb-3">
            <i class='bx bx-table'> </i>Car
        </button>


        <div v-if="modifiedmodaltour">
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0"><i class='bx bx-ship'></i> Manage Tours</h2>
                    <div class="btn-group" role="group">
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'table' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'table'"
                        >
                            <i class='bx bx-table'></i>
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'cards' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'cards'"
                        >
                            <i class='bx bx-grid-alt'></i>
                        </button>
                    </div>
                </div>

               <div v-if="viewMode === 'table'">
                    <!-- TABLE VIEW -->

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>Base Price (€)</th>
                                        <th>Promo Price (€)</th>
                                        <th>Group Price (€)</th>
                                        <th>Group Promo Price (€)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="tour in tourstomodify" :key="tour.id">
                                        <td>@{{ tour.id }}</td>
                                        <td>@{{ tour.name }}</td>
                                        <td>
                                            <span v-if="tour.is_active" class="badge bg-success">
                                                <i class="bx bx-check-circle"></i> Active
                                            </span>
                                            <span v-else class="badge bg-danger">
                                                <i class="bx bx-x-circle"></i> Inactive
                                            </span>
                                        </td>
                                        <td>€ @{{ parseFloat(tour.starting_price).toFixed(2) }}</td>
                                        <td>
                                            <span v-if="tour.starting_promotion_price" class="text-danger fw-bold">
                                                € @{{ parseFloat(tour.starting_promotion_price).toFixed(2) }}
                                            </span>
                                            <span v-else class="text-muted">—</span>
                                        </td>
                                        <td>
                                            <span v-if="tour.group_price">€ @{{ parseFloat(tour.group_price).toFixed(2) }}</span>
                                            <span v-else class="text-muted">—</span>
                                        </td>
                                        <td>
                                            <span v-if="tour.group_price_promotion_price">€ @{{ parseFloat(tour.group_price_promotion_price).toFixed(2) }}</span>
                                            <span v-else class="text-muted">—</span>
                                        </td>
                                        <td>

                                        <button @click="openEditModal( tour , 'editModaltour')" class="btn btn-sm btn-outline-primary">
                                            <i class='bx bx-edit'></i> Edit
                                        </button>
                                            <!-- <button @click="deleteTour(tour.id)" class="btn btn-sm btn-outline-danger">
                                                <i class='bx bx-trash'></i>
                                            </button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                
                        </div>
                    </div>

                </div>



                <div v-else>
                    <!-- CARD VIEW -->
                    <div class="row">
                        <div class="col-md-4 mb-3" v-for="tour in tourstomodify" :key="tour.id">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                            <h5 class="card-title">@{{ tour.name }}</h5>
                            <p>
                                <span v-if="tour.is_active" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Inactive</span>
                            </p>
                            <p><strong>Base Price:</strong> € @{{ parseFloat(tour.starting_price).toFixed(2) }}</p>
                            <p>
                                <strong>Promo:</strong>
                                <span v-if="tour.starting_promotion_price" class="text-danger fw-bold">
                                € @{{ parseFloat(tour.starting_promotion_price).toFixed(2) }}
                                </span>
                                <span v-else class="text-muted">—</span>
                            </p>
                            <p>
                                <strong>Group:</strong>
                                <span v-if="tour.group_price">€ @{{ parseFloat(tour.group_price).toFixed(2) }}</span>
                                <span v-else class="text-muted">—</span>
                            </p>
                            <button @click="openEditModal(tour, 'editModaltour')" class="btn btn-sm btn-outline-primary">
                                <i class='bx bx-edit'></i> Edit
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <!-- Car modified -->
        <div v-if="modifiedmodalcar">
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0"><i class='bx bx-ship'></i> Manage Cars</h2>
                    <div class="btn-group" role="group">
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'table' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'table'"
                        >
                            <i class='bx bx-table'></i>
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-sm" 
                            :class="viewMode === 'cards' ? 'btn-primary' : 'btn-outline-primary'"
                            @click="viewMode = 'cards'"
                        >
                            <i class='bx bx-grid-alt'></i>
                        </button>
                    </div>
                </div>

                <div v-if="viewMode === 'table'">
                    <!-- TABLE VIEW -->

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>Base Price (€)</th>
                                        <th>Promo Price (€)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="car in carstomodify" :key="car.id">
                                        <td>@{{ car.id }}</td>
                                        <td>@{{ car.name }}</td>
                                        <td>
                                            <span v-if="car.is_active" class="badge bg-success">
                                                <i class="bx bx-check-circle"></i> Active
                                            </span>
                                            <span v-else class="badge bg-danger">
                                                <i class="bx bx-x-circle"></i> Inactive
                                            </span>
                                        </td>
                                        <td>€ @{{ parseFloat(car.price_per_day).toFixed(2) }}</td>
                                        <td>
                                            <span v-if="car.promotion_price_per_day" class="text-danger fw-bold">
                                                € @{{ parseFloat(car.promotion_price_per_day).toFixed(2) }}
                                            </span>
                                            <span v-else class="text-muted">—</span>
                                        </td>

                                        <td>
                                        <button @click="openEditModal(car, 'editModalcar')" class="btn btn-sm btn-outline-primary">
                                            <i class='bx bx-edit'></i> Edit
                                        </button>
                                            <!-- <button @click="deleteTour(tour.id)" class="btn btn-sm btn-outline-danger">
                                                <i class='bx bx-trash'></i>
                                            </button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                
                        </div>
                    </div>

                </div>
                <div v-else>
                    <!-- CARD VIEW -->
                    <div class="row">
                        <div class="col-md-4 mb-3" v-for="car in carstomodify" :key="car.id">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                            <h5 class="card-title">@{{ car.name }}</h5>
                            <p>
                                <span v-if="car.is_active" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Inactive</span>
                            </p>
                            <p><strong>Base Price:</strong> € @{{ parseFloat(car.price_per_price).toFixed(2) }}</p>
                            <p>
                                <strong>Promo:</strong>
                                <span v-if="car.promotion_price_per_day" class="text-danger fw-bold">
                                € @{{ parseFloat(car.promotion_price_per_day).toFixed(2) }}
                                </span>
                                <span v-else class="text-muted">—</span>
                            </p>

                            <button @click="openEditModal(car, 'editModalcar')" class="btn btn-sm btn-outline-primary">
                                <i class='bx bx-edit'></i> Edit
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Edit Tour Modal -->
<div class="modal fade" tabindex="-1" ref="editModaltour">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bx bx-edit"></i> Edit Tour</h5>
        <button type="button" class="btn-close" @click="closeEditModal('editModaltour')"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <p class="form-control-plaintext">@{{ editItem.name }}</p>

            </div>

            <!-- Active toggle -->
            <div class="col-md-6">
            <label class="form-label">Status</label>
            <div class="mb-2">
                <span 
                class="badge" 
                :class="editItem.is_active ? 'bg-success' : 'bg-danger'">
                @{{ editItem.is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <select class="form-select" v-model="editItem.is_active">
                <option :value="1">Active</option>
                <option :value="0">Inactive</option>
            </select>
            </div>

            <!-- Base Price -->
            <div class="col-md-6">
              <label class="form-label">Base Price (€)</label>
              <input type="number" step="0.01" class="form-control" v-model="editItem.starting_price">
            </div>

            <!-- Group Price -->
            <div class="col-md-6">
              <label class="form-label">Group Price (€)</label>
              <input type="number" step="0.01" class="form-control" v-model="editItem.group_price">
            </div>

            <!-- Promo Price Fields -->
            <div class="col-md-6">
            <label class="form-label">Starting Promo Price (€)</label>
            <input type="number" step="0.01" class="form-control" v-model="editItem.starting_promotion_price">
            </div>

            <div class="col-md-6">
            <label class="form-label">Transfer Promo Price (€)</label>
            <input type="number" step="0.01" class="form-control" v-model="editItem.transfer_promotion_price">
            </div>

            <div class="col-md-6">
            <label class="form-label">Group Promo Price (€)</label>
            <input type="number" step="0.01" class="form-control" v-model="editItem.group_price_promotion_price">
            </div>



            <!-- Duration -->
            <!-- <div class="col-md-6">
              <label class="form-label">Duration (minutes)</label>
              <input type="number" class="form-control" v-model="editTour.duration_minutes">
            </div> -->

            <!-- Description -->
            <!-- <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="4" v-model="editTour.description"></textarea>
            </div> -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  v-if="!loadingform"  @click="closeEditModal('editModaltour')">Cancel</button>
            <button type="button" class="btn btn-primary" v-if="!loadingform" @click="updateModifyTour">
            <i class="bx bx-save"></i> Save Changes
            </button>
            <div class="spinner-border text-primary" v-if="loadingform" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Car Modal -->
<div class="modal fade" tabindex="-1" ref="editModalcar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bx bx-edit"></i> Edit Car</h5>
        <button type="button" class="btn-close" @click="closeEditModal('editModalcar')"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <p class="form-control-plaintext">@{{ editItem.name }}</p>

            </div>

            <!-- Active toggle -->
            <div class="col-md-6">
            <label class="form-label">Status</label>
            <div class="mb-2">
                <span 
                class="badge" 
                :class="editItem.is_active ? 'bg-success' : 'bg-danger'">
                @{{ editItem.is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <select class="form-select" v-model="editItem.is_active">
                <option :value="1">Active</option>
                <option :value="0">Inactive</option>
            </select>
            </div>

            <!-- Base Price -->
            <div class="col-md-6">
              <label class="form-label">Base Price (€)</label>
              <input type="number" step="0.01" class="form-control" v-model="editItem.price_per_day">
            </div>

            <!-- Group Price -->
            <div class="col-md-6">
              <label class="form-label">Promo Price (€)</label>
              <input type="number" step="0.01" class="form-control" v-model="editItem.promotion_price_per_day">
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  v-if="!loadingform"  @click="closeEditModal('editModalcar')">Cancel</button>
            <button type="button" class="btn btn-primary" v-if="!loadingform" @click="updateModifyCar">
            <i class="bx bx-save"></i> Save Changes
            </button>
            <div class="spinner-border text-primary" v-if="loadingform" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
      </div>
    </div>
  </div>
</div>


@endsection