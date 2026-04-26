<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Dashboard Kompas App</h3>
        <p>Monitoring data booking penampilan Kompas</p>
    </div>
</div>

<div class="row">

    <!-- Total Booking -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3">
                        <div class="numbers">
                            <p class="card-category">Total Booking</p>
                            <h4 class="card-title">{{ $totalBooking ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3">
                        <div class="numbers">
                            <p class="card-category">Pending</p>
                            <h4 class="card-title">{{ $pending ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disetujui -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3">
                        <div class="numbers">
                            <p class="card-category">Disetujui</p>
                            <h4 class="card-title">{{ $approved ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3">
                        <div class="numbers">
                            <p class="card-category">Ditolak</p>
                            <h4 class="card-title">{{ $rejected ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>