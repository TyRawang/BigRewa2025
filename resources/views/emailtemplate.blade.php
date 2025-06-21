@extends('layouts.app')

@section('content')

<style>
    .template-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .dashboard-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 30px;
    }
    
    .panel-heading {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 30px;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        border-radius: 12px 12px 0 0;
        margin: 0;
        border: none;
    }
    
    .panel-body {
        padding: 25px 30px !important;
    }
    
    .template-content {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 30px;
        margin-top: 20px;
    }
    
    .add-new-section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e1e8ed;
    }
    
    .btn-add-new {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-add-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .table-wrapper {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #2c3e50;
        font-weight: 600;
        padding: 15px 12px;
        text-align: center;
        border-top: none;
    }
    
    .table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        margin: 2px;
        font-weight: 500;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
    
    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        border: none;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }
    
    .pagination-wrapper {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e1e8ed;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
</style>

<home :user="user" inline-template>
    <div class="template-container">
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="panel panel-default dashboard-panel">
                        <div class="panel-heading">📧 Email Templates</div>
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if(session()->has('success_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif

                            @if(session()->has('error_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error_message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Template Content -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="template-content">
                        <div class="row">
                            <div class="col-md-12 form-group add-new-section">
                                <a href="{{ url('template/add') }}" class="btn btn-add-new float-right">
                                    <i class="fa fa-plus"></i> Add New Template
                                </a>
                            </div>
                        </div>
                        
                        <div class="table-wrapper">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Template</th>
                                        <th>Token</th>
                                        <th>Make Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) > 0)
                                    @foreach($data as $k => $row)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->email_template_token }}</td>
                                        <td>
                                          @if(!$row->user_id)
                                            @if($row->checkTemplateIsActive())
                                              <a href="{{ url('template/set_admin_default/'.$row->id) }}" class="btn btn-sm btn-primary make_primary_btn"><i class="fa fa-check"></i> Set Default</a>
                                              @else
                                               <span class="badge badge-success">Active</span>
                                            @endif
                                          @else
                                             @if($row->status == "Active")
                                                <span class="badge badge-success">Active</span>
                                              @else
                                              <a href="{{ url('template/set_default/'.$row->id) }}" class="btn btn-sm btn-primary make_primary_btn"><i class="fa fa-check"></i> Set Default</a>
                                              @endif
                                          @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('template/add/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                            @if($row->user_id)
                                            <a href="{{ url('template/delete/'.$row->id) }}" class="btn btn-sm btn-danger delete_btn"><i class="fa fa-trash"></i> Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            <div style="padding: 40px; color: #6c757d;">
                                                <i class="fa fa-inbox" style="font-size: 48px; margin-bottom: 15px;"></i>
                                                <h5>No Templates Found</h5>
                                                <p>Create your first email template to get started.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="row pagination-wrapper">
                            <div class="col-md-12 form-group">
                                {!! $data->render() !!}    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <div class="modal-body">

            ...

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <button type="button" class="btn btn-primary">Save changes</button>

          </div>

        </div>

      </div>

    </div>





<div id="dialog" title="Template Preview" style="display: none;">

  <p class="preview-temp"></p>

</div>

@endsection

@section('customcss')

<!-- <link rel="stylesheet" type="text/css" href="{{ url('plugins/bootstrap/css/bootstrap.css') }}"> -->

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <style type="text/css">

 .ui-widget-overlay{

    background-color: black;

    background-image: none;

    opacity: 0.9;

    z-index: 1040;    

}

 </style>

@endsection

@section('customscripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    $(function(){

        // $('#exampleModal').modal('show');

        $('body').on('click', '.delete_btn, .make_primary_btn', function(e){

            e.preventDefault();

            if (confirm("Are you sure ?")) {

                var delete_url = $(this).attr('href');

                window.location.href = delete_url;

            }

        });





        $( "#dialog" ).dialog({

          width: 900,

          autoOpen: false,

          // show: {

          //   effect: "blind",

          //   duration: 1000

          // },

          // hide: {

          //   effect: "blind",

          //   duration: 1000

          // }

        });



        $( function() {

            $('body').on('click', '.detailBtn', function(e){

                e.preventDefault();

                var detail = $(this).data('temp');

                $('.preview-temp').html(detail);

                $('#dialog').dialog( "open" );

                

            });



        });

        

    });

</script>



@endsection

