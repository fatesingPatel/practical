@extends('layouts.emp')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
    Hire Nations - Job Posts
@endsection
<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load DataTables -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

@section('content')
    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable" id="employeee-table">
                            <thead>
                                <tr>
                                    <th>
                                        <b>F</b>irst Name
                                    </th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#employeee-table').DataTable({
                "pageLength": 10,
                'responsive': true,
                "processing": true,
                "ordering": true,
                "bLengthChange": true,
                "serverSide": true,

                "ajax": {
                    "url": '{{ url('employers/data') }}',
                    "type": "post",
                    "data": function(d) {},
                },
                "aoColumns": [
                    // { "bSortable": false, "aTargets": [] },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": []
                }, ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                buttons: [
                    'pageLength'
                ]
            });

        });
    </script>
@endsection
