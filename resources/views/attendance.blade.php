@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nurses' Attendance</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Nurses' Attendance</li>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Attendance</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Nurse_ID</th>
                                <th>Full Name</th>
                                <th>Reporting Time</th>
                                <th>Leaving Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($nurseAttendance as $attendances)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $nurseinfo->where('id', $attendances->nurse_id)->first()->nurse_number }}</td>
                                    <td>
                                        {{ $nurseinfo->where('id', $attendances->nurse_id)->first()->f_name }}
                                        {{ $nurseinfo->where('id', $attendances->nurse_id)->first()->l_name }}
                                    </td>
                                    <td>{{ $attendances->created_at->format('l j' . ' , ' . 'h:i A') }}</td>
                                    @if ($attendances->created_at == $attendances->updated_at && !$attendances->created_at->isToday())
                                        <td><span class="badge badge-danger">Didn't sign out🤷🏻‍♀️🤷🏻‍♀️🤷🏻‍♀️</span></td>
                                    @elseif ($attendances->created_at == $attendances->updated_at)
                                        <td><span class="badge badge-success">On Duty 👏🏽💪</span></td>
                                    @else
                                        <td>{{ $attendances->updated_at->format('l j, h:i A') }}</td>
                                    @endif
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
