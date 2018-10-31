<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>APA Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
        
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! session('message') !!}
                </div>
                <div class="col-md-6"><h2>Employees</h2></div>
                <div class="col-md-6 text-right"><a href="javascript:void(0)" data-toggle="modal" data-target="#addEmployee" class="btn btn-success">Add Employee</a></div>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Emp ID</th>
                                <th>Emp Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>DOB</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($employees->count() > 0)
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->employee_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->dob }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="editemployee" data-id="{{ $employee->id }}">Edit</a> | <a href="javascript:void(0)" class="delete" data-id="{{ $employee->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="6">No Data Available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal" id="addEmployee" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="AddForm" action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Employee Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text" class="form-control datepicker" value="{{ date('m/d/Y',strtotime('now')) }}" id="dob" name="dob">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="editEmployee" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="UpdateForm" action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Employee Name</label>
                                <input type="text" class="form-control" id="ename" name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="eemail" name="email">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="ephone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text" class="form-control datepicker" value="{{ date('m/d/Y',strtotime('now')) }}" id="edob" name="dob">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <input type="hidden" name="uid" id="uid" value="">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('.datepicker').datepicker();

    $(document).on('click','.delete',function(e){
        e.preventDefault();
        var eid = $(this).data('id');
        var r = confirm("Are you sure to delete the employee!");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: "{{ url('employees/delete') }}",
                data: {eid: eid},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) { 
                    if(data){
                        location.reload();
                    }else{
                        alert('Please try again');
                    }
                    
                }
            });
        } 
        return false;
        
    });

    $(document).on('click','.editemployee',function(e){
        e.preventDefault();
        var eid = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: "{{ url('employees/edit') }}",
            data: {eid: eid},
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) { 
                // alert(JSON.stringify(data));
                $('#ename').val(data.employee_name);
                $('#eemail').val(data.email);
                $('#ephone').val(data.phone);
                var mdate = data.dob;
                ldate = mdate.split('-');
                $('#edob').val(ldate[1]+'/'+ldate[2]+'/'+ldate[0]);
                $('#uid').val(data.id);
                $('#editEmployee').modal('show');
            }
        });
    });

    $(document).on('submit','#UpdateForm',function(e){
        e.preventDefault();
        var validation = false;
        $('.text-danger').remove();
        var name = $('#ename').val();
        var email = $('#eemail').val();
        var phone = $('#ephone').val();
        var dob = $('#edob').val();

        if($.trim(name) == ''){
            $('#ename').after('<span class="text-danger">Name is required</span>');
            validation = true;
        }

        if($.trim(email) == ''){
            $('#eemail').after('<span class="text-danger">Email is required</span>');
            validation = true;
        }

        if($.trim(phone) == ''){
            $('#ephone').after('<span class="text-danger">Phone is required</span>');
            validation = true;
        }

        if($.trim(dob) == ''){
            $('#edob').after('<span class="text-danger">Date of Birth is required</span>');
            validation = true;
        }

        if(validation == true){
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "{{ url('employees/update') }}",
            data: $('#UpdateForm').serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resultData) { 
                if(resultData){
                    location.reload();
                }else{
                    alert('Please try again');
                }
            }
        });

        
    });
    
    $(document).on('submit','#AddForm',function(e){
        e.preventDefault();
        var validation = false;
        $('.text-danger').remove();
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var dob = $('#dob').val();

        if($.trim(name) == ''){
            $('#name').after('<span class="text-danger">Name is required</span>');
            validation = true;
        }

        if($.trim(email) == ''){
            $('#email').after('<span class="text-danger">Email is required</span>');
            validation = true;
        }

        if($.trim(phone) == ''){
            $('#phone').after('<span class="text-danger">Phone is required</span>');
            validation = true;
        }

        if($.trim(dob) == ''){
            $('#dob').after('<span class="text-danger">Date of Birth is required</span>');
            validation = true;
        }

        if(validation == true){
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "{{ url('employees/add') }}",
            data: $('#AddForm').serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resultData) { 
                if(resultData){
                    location.reload();
                }else{
                    alert('Please try again');
                }
            }
        });

        
    });
});
</script>
    </body>
</html>
