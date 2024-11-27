@extends('admin')

@push('styles')
<!-- DataTables and Bootstrap 5 Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* Table Basic Styling */
    table {
        table-layout: fixed;
        width: 100%;
    }

    .fix-width-row {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .column_search {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
    }

    /* Table Header Styling */
    th, td {
        text-align: left;
        vertical-align: middle;
        padding: 1px;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    /* Row Colors */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
        background-color: #fff;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Pagination Styling */
    .dataTables_wrapper .dataTables_paginate {
        text-align: center;
        margin-top: 20px;
    }

    /* Search box styling */
    .dataTables_filter input {
        width: 200px;
        margin: 0 auto;
        display: block;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Action Button */
    .action-btn {
        padding: 6px 12px;
        margin: 3px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    /* Table Responsiveness */
    .table-responsive {
        overflow-x: auto;
    }

    /* Equal height for rows */
    tbody tr {
        height: 30px; /* Fixed height for each row */
    }

    /* Prevents column overflow */
    td {
        word-wrap: break-word;
    }

    /* Ensure fixed header stays on top during scroll */
    .fixedHeader-floating {
        z-index: 1030 !important;
    }

</style>
@endpush

@push('scripts')
<!-- jQuery and DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>

<script>
    $(document).ready(function() {
    var table = $('#itemsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        language: {
            lengthMenu: "Show _MENU_ entries",
            zeroRecords: "No matching records found"
        },
        autoWidth: false,
        columnDefs: [
            { targets: '_all', className: 'fix-width-row' }
        ],
        order: [[0, 'desc']],  
        fixedHeader: true,    
    });
    table.columns().every(function() {
        var column = this;
        $('input', this.header()).on('keyup change', function() {
            var val = this.value;
            column.search(val ? val : '', true, false).draw();
        });
    });
    $('#itemsTable th input').on('keyup change', function(e) {
        e.stopPropagation(); 
    });
});

</script>
@endpush

@section('adminContent')
<div class="container-fluid">
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Items List</h3>
        <div class="table-responsive">
            <table id="itemsTable" class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color:rgb(179, 224, 243) !important;;">
                        <th style="width: 10%;" >Item Code</th>
                        <th style="width: 15%;" >Item Name</th>
                        <th style="width: 15%;" >Item Category</th>
                        <th style="width: 10%;" >Item Amount</th>
                        <th style="width: 25%;" >Item Desc</th>
                        <th style="width: 15%;" >Item Collection</th>
                        <th style="width: 5%;" >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td style="text-align:center!important;"><a style="color: rgb(56, 134, 212);text-decoration:underline !important;" href="{{route('updateItem',['prod_id' => $item->prod_id])}}">{{ $item->prod_code }}</a></td>
                        <td>{{ $item->prod_name }}</td>
                        <td>{{ $item->prod_category }}</td>
                        <td>{{ $item->prod_amount }}</td>
                        <td>{{ $item->prod_desc }}</td>
                        <td>{{ $item->prod_collection }}</td>
                        <td style="text-align:center!important;"> <a style="color: red;text-decoration:underline !important;">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
