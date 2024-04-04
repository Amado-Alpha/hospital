@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CareLink</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif

<section class="content">
    <div class="container-fluid">
        <!-- Table for Available Nurses -->
        <div class="card">
            <div class="card-header" style="background-color: #007bff; color: white;">
                <h3 class="card-title" style="font-size: 22px; font-weight: bold;">Active Nurses</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="color: #007bff;">S/No</th>
                                <th style="color: #007bff;">Nurse ID</th>
                                <th style="color: #007bff;">Full Name</th>
                                <th style="color: #007bff;">Reporting Time</th>
                                <th style="color: #007bff;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nurseAttendance as $index => $attendance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nurseinfo->where('id', $attendance->nurse_id)->first()->nurse_number }}</td>
                                    <td>{{ $nurseinfo->where('id', $attendance->nurse_id)->first()->f_name }} {{ $nurseinfo->where('id', $attendance->nurse_id)->first()->l_name }}</td>
                                    <td>{{ $attendance->created_at->format('H:i') }}</td>
                                    <td>
                                        @if ($attendance->created_at == $attendance->updated_at)
                                            <span class="badge badge-success">Nurse Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Table for Available Nurses -->

        <!-- Stat box for Stats of Today -->
        <div class="row">
            <div class="col-md-5">
                <div class="card card-outline card-primary">
                    <div class="card-header" style="background-color: #007bff; color: white;">
                        <h3 class="card-title" style=" font-size: 20px; font-weight: bold;">Stats of Today : {{ $todayTime }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Available Nurses</th>
                                <td>{{ $nurseAttendance->count() }}</td>
                            </tr>
                            <tr>
                                <th>Total Requests</th>
                                <td>{{ $dayRequest }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Stat box for Stats of Today -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
