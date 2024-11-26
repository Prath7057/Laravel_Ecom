@extends('admin')

@push('styles')
<style>
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
        box-sizing: border-box;
        padding: 4px;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css" rel="stylesheet">
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#itemsTable').DataTable({
            paging: true,                       // Enable pagination
            searching: true,                    // Enable global search
            ordering: true,                     // Enable column sorting
            info: true,                         // Show table info
            lengthMenu: [
                [10, 25, 50, -1],               // Options for number of rows to show
                [10, 25, 50, "All"]            // Text displayed in the dropdown
            ],
            language: {
                lengthMenu: "Show _MENU_ entries", // Custom text for the length menu
                zeroRecords: "No matching records found"
            },
        });

        // Apply individual column search
        table.columns().every(function() {
            var column = this;
            $('input', this.header()).on('keyup change', function() {
                var val = this.value;
                column.search(val ? val : '', true, false).draw();
            });
        });

        // Prevent sorting when clicking on input fields
        $('#itemsTable th input').on('click', function(e) {
            e.stopPropagation(); // Stop the click event from propagating to the <th> and triggering sorting
        });
    });
</script>
@endpush

@section('adminContent')
<div class="container">
    <div class="row justify-content-center">
        <h3 class="row justify-content-center">Items List</h3>

        <table id="itemsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Item Amount</th>
                    <th style="width:20%;">Item Desc</th>
                    <th>Item Collection</th>
                    <th>Actions</th>
                </tr>  
                <tr>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Item Name" /></td>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Item Category" /></td>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Item Amount" /></td>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Item Desc" /></td>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Item Collection" /></td>
                    <td style="margin: 0px;padding:0px;"><input type="text" class="column_search" placeholder="Search Actions" /></td>
                </tr> 
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td class="fix-width-row" style="width: 10%;">{{ $item->prod_name }}</td>
                    <td class="fix-width-row" style="width: 10%;">{{ $item->prod_category }}</td>
                    <td class="fix-width-row" style="width: 10%;">{{ $item->prod_amount }}</td>
                    <td class="fix-width-row" style="width: 30%;">{{ $item->prod_desc }}</td>
                    <td class="fix-width-row" style="width: 10%">{{ $item->prod_collection }}</td>
                    <td class="fix-width-row" style="width: 10%;">Actions</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.1/js/dataTables.bootstrap5.min.js"></script>
    </div>
</div>
@endsection
