@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Contact List
                    <a onclick="#" class="btn btn-primary pull-right" style="margin-top: -8px">Add Contact</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="contact-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
    <script type="text/javascript">
        $('#contact-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('api.contact') }}",
          columns: [
            { data: 'id' , name: 'id'},
            { data: 'name' , name: 'name' },
            { data: 'email' , name: 'email'},
            { data: 'action' , name: 'action' , orderable : false, searchable:false }
          ]
        });

    </script>
@endpush