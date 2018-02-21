@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="title">
                        <h4>Contact List
                            <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;"><i class="fa fa-plus"></i>Add Contact</a>
                        </h4>

                    </div>
                </div>
                <div class="panel-body">
                    <table id="contact-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('contact.form')
@endsection
@push('script')
    <script type="text/javascript">
        var table = $('#contact-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.contact') }}",
                      columns: [
                        { data: 'id' , name: 'id'},
                        { data: 'name' , name: 'name' },
                        { data: 'email' , name: 'email'},
                        { data: 'photo' , name: 'show_photo'},
                        { data: 'action' , name: 'action' , orderable : false, searchable:false }
                      ]
                    });
        function addForm() {
        	save_method = 'add';
        	$('input[name=_method]').val('POST');
        	$('#modal-form').modal('show');
	        $('#modal-form form')[0].reset();
        	$('#modal-title').text('Add Contact');
        }
        
        function editForm(id) {
          save_method = 'edit';
          $('input[name=_method]').val('PATCH');
          $('#modal-form form')[0].reset();

          $.ajax({
            url : "{{ url('contact') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success : function (data) {
              $('#modal-form').modal('show');
              $('.modal-title').text('Edit Contact');

              $('#id').val(data.id);
              $('#name').val(data.name);
              $('#email').val(data.email);
            },
            error : function () {
              alert('nothing data');
            }
          });
        }

        function showData(id){
	        $('#modal-form form')[0].reset();
	        $.ajax({
                url : "{{ url('contact') }}" + '/' + id,
                type: 'GET',
                dataType: 'JSON',
                success : function (data) {
	                $('#modal-form').modal('show');
	                $('.modal-title').text('Details ' + data.name);

	                $('#title').val(data.name);
	                $('#author').val(data.email);
	                $('#submit').hide();
                },
                error : function () {
                  alert('Data Not found!');
                }
            });
        }

        function deleteData(id){
        	var csrf_token = $('meta[name="csrf-token"]').attr('content');

	        swal({
		        title:'Are you sure?',
		        text : "You want be able to revert this!",
		        type : "warning",
		        showCancelButton : true,
		        confirmButtonColor: '#3085d6',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Yes, delete it!'
	        }).then( function () {
                $.ajax({
                    url: "{{ url('contact') }}" + '/' + id,
                    type:"POST",
                    data : {'_method' : 'DELETE','_token':csrf_token},
	                dataType: "JSON",
                    success: function (data) {
                        table.ajax.reload();
	                    swal({
		                    title:'Success!',
		                    text : "Data has been deleted",
		                    type : "success",
                            timer: '1500'
	                    });
                    },
                    error: function () {
                        swal({
	                        title:'Opps!',
	                        text : "You want be able to revert this!",
	                        type : "warning",
                            timer: '1500'
                        });
                    }
                });
            });
        }

        $(function () {
          $('#modal-form form').validator().on('submit',function (e) {
            if(!e.isDefaultPrevented()){
            	var id = $('#id').val();
            	if(save_method =='add') url = "{{url('contact')}}";
            	else url = "{{ url('contact') . '/' }}" + id;

            	$.ajax({
                  url : url,
                  type: 'POST',
//                  data: $('#modal-form form').serialize(),
                  data : new FormData($('#modal-form form')[0]),
                  contentType : false,
                  prosesData : false,
                  dataType : 'JSON',
                  success : function ($data) {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
	                  swal({
		                  title:'Success!',
		                  text : "Data has been saved",
		                  type : "success",
		                  timer: '1500'
	                  });
                  },
                  error : function () {
                    alert('Oops ! something error !');
                  }
                });
            	return false;
            }
          });
        });
    </script>
@endpush