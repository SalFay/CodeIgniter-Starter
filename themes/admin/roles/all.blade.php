@extends('master')
@section('title','Manage Roles')
@section('heading','Manage User Roles')
@section('sub-heading','')

@section('content')
    <div class="box" id="listing-module">
        <div class="box-header with-border">
            <h3 class="box-title">User Roles</h3>

            <div class="btn-group btn-group-xs pull-right">
                <button type="button" class="btn btn-success btn-xs" id="add-new" data-show-edit>
                    <i class="fa fa-plus" aria-hidden="true"></i> New Role
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('roles.add')
@endsection
@include('partials.data-tables')
@push('head')

@endpush

@push('footer')
    <script>
      var table = $('#table').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
          'url': "{{site_url('roles/all_ajax')}}",
          'type': 'POST',
        },
        columns: [
          {data: 'r.id'},
          {data: 'r.name'},
          {data: '$.actions'},
        ],
      });

      $(document).ready(function() {
        $('#add-new').on('click', function() {
          $('#form_action').val('add');
          $('#submit').val('Add Role');
          $('#edit-form').attr('action', function() {
            return $(this).attr('data-action');
          });
          $('#edit-module').find('.box-title').html('Add Role');
          //SalFay.toggleDivs('#role-edit', '#role-overview');
        });
        $('#cancel,#roles-all').on('click', function() {
          //SalFay.toggleDivs('#role-overview', '#role-edit');
          $('#name').val('');
          $('#notifications').empty();
        });

        // Submit Form
        $('#edit-form').on('submit', function(e) {
          e.preventDefault();
          var action = $('#form_action').val();
          if (action === 'add') {
            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: $(this).serialize(),
              dataType: 'JSON',
              success: function(res) {
                $('#notifications').html(res.message);
                if (res.status === 'ok') {
                  table.api().ajax.reload();
                  SalFay.toggleDivs('#listing-module', '#edit-module');
                  $('#name').val('');
                }
              },
            });
          }
          else if (action === 'edit') {
            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: $(this).serialize(),
              dataType: 'JSON',
              success: function(res) {
                $('#notifications').html(res.message);
                if (res.status === 'ok') {
                  table.api().ajax.reload();
                  SalFay.toggleDivs('#listing-module', '#edit-module');
                  $('#name').val('');
                }
              },
            });
          }
        });
      });

      $('body').on('click', '[data-action="edit"]', function(e) {
        e.preventDefault();
        var el = $(this);
        $('#form_action').val('edit');
        $.ajax({
          url: $(this).attr('href'),
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
            if (data.status === 'ok') {
              var role = data.role;
              $('#edit-module').find('.box-title').html('Edit Role - ' + role.name);
              $('#edit-form').attr('action', el.attr('href'));
              $('#submit').val('Update Role');
              $('#name').val(role.name);
              SalFay.toggleDivs('#edit-module', '#listing-module');
            }
            else {
              $('#notifications').html(data.message);
            }
          },
        });
      }).on('click', '[data-action="delete"]', function(e) {
        e.preventDefault();
        var el = $(this);
        alertify.confirm('Are you sure you want to delete this Role?', function() {
          $.ajax({
            url: el.attr('href'),
            dataType: 'JSON',
            success: function(res) {
              $('#notifications').html(res.message);
              table.api().ajax.reload();
            },
          });
        }, function() {

        });
      });
    </script>
@endpush
