@extends('admin._layout.admin')


@section('PAGE_LEVEL_STYLES')
<style type="text/css">
    .dataTables_filter input {
        border:1px #aaa solid;
        padding:5px 7px;
        outline: none;
    }

    .dataTables_wrapper {
      width:100%;
      padding-left: 50px;
      padding-right: 50px;
    }
</style>
@endsection


@section('PAGE_START')
@endsection


@section('content')
<!-- Content -->
    <div id="content" style="background-color: #e3e3e3; padding-top: 40px;">
        <div class="container-fluid">
            <div class="row">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Account Number</th>
                            <th>Account Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($accounts) && count($accounts) > 0)
                        @foreach($accounts as $key => $account)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{$account['first_name']}}</td>
                            <td>{{$account['last_name']}}</td>
                            <td>{{$account['email']}}</td>
                            <td>{{$account['account_number']}}</td>
                            <td>{{$account['account_type']}}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        } );
    } );
</script>
@endsection


@section('PAGE_END')
@endsection