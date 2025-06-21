@extends('layouts.app')
@section('content')
<style>
    .extra-field-container {
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
    
    .main-content {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 40px 50px;
        margin-top: 20px;
    }
    
    .form-control {
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.5;
        background-color: #fff;
        color: #2c3e50;
        transition: all 0.3s ease;
        width: 100%;
        height: auto;
        min-height: 45px;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background-color: #fff;
        color: #2c3e50;
    }
    
    .form-control:hover {
        border-color: #bdc3c7;
    }
    
    select.form-control {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px 12px;
        padding-right: 40px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        color: #2c3e50;
        background-color: #fff;
    }
    
    select.form-control option {
        color: #2c3e50;
        background-color: #fff;
        padding: 8px 12px;
    }
    
    select.form-control:focus {
        color: #2c3e50;
        background-color: #fff;
    }
    
    /* Fix for select dropdown visibility */
    select.form-control:not([multiple]) {
        background-color: #fff !important;
        color: #2c3e50 !important;
    }
    
    select.form-control option:checked {
        background-color: #667eea;
        color: white;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 8px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    }
    
    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        margin-top: 20px;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
    
    .single-field {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        padding: 25px 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    
    .single-field:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }
    
    .form-group {
        margin-bottom: 0 !important;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
    }
    
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
        letter-spacing: 0.5px;
        white-space: nowrap;
        min-height: 20px;
    }
    
    /* Ensure all columns have same height */
    .single-field .col-lg-1,
    .single-field .col-lg-2,
    .single-field .col-lg-3,
    .single-field .col-lg-4 {
        display: flex;
        align-items: flex-start;
        min-height: 80px;
    }
    
    /* Fix drag handle alignment */
    .single-field .col-lg-1 {
        justify-content: center;
        align-items: center;
        min-height: 80px;
    }
    
    /* Ensure form groups fill their containers */
    .single-field .form-group {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    
    .actionBx {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: stretch;
        gap: 8px;
        padding-top: 25px;
        min-height: 80px;
    }
    
    .sortable li {
        list-style: none;
        margin-bottom: 15px;
    }
    
    .ui-state-default {
        background: transparent !important;
        border: none !important;
    }
    
    .drag-handle {
        background: #667eea;
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: move;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    
    .drag-handle:hover {
        background: #5a67d8;
        transform: scale(1.1);
    }
    
    .field-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .field-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .field-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
    
    .notif-box {
        margin-bottom: 20px;
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
    
    @media (max-width: 768px) {
        .main-content {
            padding: 25px 20px;
            margin: 0 10px;
        }
        
        .single-field {
            padding: 20px 15px;
        }
        
        .actionBx {
            flex-direction: row;
            gap: 5px;
        }
        
        .btn-save, .btn-delete {
            font-size: 11px;
            padding: 6px 12px;
        }
        
        .extra-field-container {
            padding: 10px 0;
        }
    }
</style>

<div class="extra-field-container">
    <div class="container">
        <div class="row justify-content-center">
            @include('left_bar')
            <div class="col-md-9">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-heading">⚙️ Extra Mail Fields</div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="main-content">
                            <div class="field-header">
                                <h3>Manage Additional Form Fields</h3>
                                <p>Add, edit, and organize extra fields for your email forms</p>
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="notif-box"></div>
                            </div>
                            
                            <div class="row">
                                <ul id="field" class="sortable col-lg-12" style="list-style: none; padding: 0;">
                                    @if(count($data) > 0)
                                        @foreach($data as $row)
                                        <li class="ui-state-default">
                                            <div class="single-field row" data-id="{{ $row->id }}">
                                                <div class="col-lg-1" style="display: flex; align-items: center; justify-content: center;">
                                                    <div class="drag-handle">
                                                        <i class="fa fa-arrows"></i>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4 form-group">
                                                    <label for="field_name">Field Name</label>
                                                    <input id="field_name" name="field_name" type="text" placeholder="Enter field name..." value="{{ $row->field_name }}" class="form-control input-md">
                                                </div>
                                                
                                                <div class="col-lg-2 form-group">
                                                    <label for="field1_type">Middle Column</label>
                                                    <select class="form-control" name="field1_type" id="field1_type">
                                                        <option @if($row->field1_type == 'null') selected="selected" @endif value="null">None</option>
                                                        <option @if($row->field1_type == 'text') selected="selected" @endif value="text">Text</option>
                                                        <option @if($row->field1_type == 'number') selected="selected" @endif value="number">Number</option>
                                                        <option @if($row->field1_type == 'radio') selected="selected" @endif value="radio">Yes-No Field</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-2 form-group">
                                                    <label for="field_type">Right Column</label>
                                                    <select class="form-control" name="field_type" id="field_type">
                                                        <option @if($row->field_type == 'text') selected="selected" @endif value="text">Text</option>
                                                        <option @if($row->field_type == 'number') selected="selected" @endif value="number">Number</option>
                                                        <option @if($row->field_type == 'radio') selected="selected" @endif value="radio">Yes-No Field</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group actionBx col-lg-3">
                                                    <button data-id="{{ $row->id }}" class="saveBtn btn-save">
                                                        <i class="fa fa-save"></i> Save
                                                    </button>
                                                    <button type="edit" class="remove-me btn-delete" data-id="{{ $row->id }}">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @else
                                        <li class="ui-state-default">                        
                                            <div class="single-field row">
                                                <div class="col-lg-1" style="display: flex; align-items: center; justify-content: center;">
                                                    <div class="drag-handle">
                                                        <i class="fa fa-arrows"></i>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4 form-group">
                                                    <label for="field_name">Field Name</label>
                                                    <input id="field_name" name="field_name" type="text" placeholder="Enter field name..." class="form-control input-md">
                                                </div>

                                                <div class="col-lg-2 form-group">
                                                    <label for="field1_type">Middle Column</label>
                                                    <select class="form-control" name="field1_type" id="field1_type">
                                                        <option value="null">None</option>
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="radio">Yes-No Field</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-2 form-group">
                                                    <label for="field_type">Right Column</label>
                                                    <select class="form-control" name="field_type" id="field_type">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="radio">Yes-No Field</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group actionBx col-lg-3">
                                                    <button data-id="0" class="saveBtn btn-save">
                                                        <i class="fa fa-save"></i> Save
                                                    </button>
                                                    <button type="add" class="remove-me btn-delete">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                
                                <div class="form-group text-center">
                                    <button id="add-more" name="add-more" class="btn-add">
                                        <i class="fa fa-plus"></i> Add New Field
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
   var _token = "{{ Session::token() }}";
   $(document).ready(function () {

      $( ".sortable" ).sortable({
         update: function() {
            sort_field();
         },
      });

      function sort_field() {
         var arr = [];
         $('.single-field').each(function(){
            var id = $(this).data('id');
            if(id != "undefined"){
               arr.push(id);
            }
         });
         if(arr.length > 0){
            $.ajax({
              type: "POST",
              url: "{{ url('sorted-extra-field-frm') }}",
              data: {
                  'arr': arr,
                  "_token": "{{ csrf_token() }}",
              },
              
              cache: false,
              success: function(data) {
                  var data = JSON.parse(data);
                  if (data.status == 0) {
                      $('.notif-box').html(data.message);
                  } else {
                      if (data.status == 1) {
                          $(_this).closest('.single-field').find('.actionBx').remove();
                          $('.notif-box').html(data.message);
                      } else {
                          $('.notif-box').html(data.message);
                      }
                  }
              }
            });
         }
      }
       $("#add-more").click(function(e){
           e.preventDefault();
           var field_html='<li class="ui-state-default"><div class="single-field row"><div class="col-lg-1" style="vertical-align: middle;text-align: center;margin-top: 35px;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><div class="col-lg-4 form-group"><label for="field_name">Field Name</label><input id="field_name" name="field_name" type="text" placeholder="" class="form-control input-md"></div><div class=" col-lg-2 form-group"><label for="action_name1">Field Type</label><select class="form-control" name="field1_type" id="field1_type"><option value="null" ></option><option value="text" >Text</option><option value="number" >Number</option><option value="radio">Yes-No field</option></select></div><div class=" col-lg-2 form-group"><label for="action_name">Field Type</label><select class="form-control" name="field_type" id="field_type"><option value="text" >Text</option><option value="number" >Number</option><option value="radio">Yes-No field</option></select></div><div class="form-group actionBx col-lg-3"><button data-id ="0" class="saveBtn btn-save"><i class="fa fa-save"></i> Save</button><button type="add" class="remove-me btn-delete"><i class="fa fa-trash"></i> Delete</button></div></div></li>';
            $('#field').append(field_html);
       });


      $('body').on('click', '.remove-me', function(e){
         e.preventDefault();
         var _this = this;
         var type = $(this).attr('type');
         if(type == 'add'){
            $(this).closest('.single-field').remove();
         }else{
            var id =  $(this).data('id');
            if(confirm('Are you sure?')){
                $.ajax({
                 type: "POST",
                 url: "{{ url('delete-extra-field-frm') }}",
                 data: {
                  "_token": "{{ csrf_token() }}",
                   'id' : id
                 },
                 cache: false,
                 success: function(data){
                  var data = JSON.parse(data);
                  if(data.status == 0){
                     $('.notif-box').html(data.message);
                  }else{
                      $(_this).closest('.single-field').remove();
                     $('.notif-box').html(data.message);
                  }
                 }
               });
            }

         }
      });

      $('body').on('click', '.saveBtn', function(e){
         e.preventDefault();
         var _this = this;
         var field_name = $(this).closest('.single-field').find('#field_name').val();
         var field_type = $(this).closest('.single-field').find('#field_type').val();
         var field1_type = $(this).closest('.single-field').find('#field1_type').val();
         var id =  $(this).data('id');
         $.ajax({
           type: "POST",
           url: "{{ url('save-extra-field-frm') }}",
           data: {
            'field_name' :field_name,
            'field_type' : field_type,
            'field1_type' : field1_type,
			"_token": "{{ csrf_token() }}",
             'id' : id
           },
           cache: false,
           success: function(data){
            var data = JSON.parse(data);
            if(data.status == 0){
               $('.notif-box').html(data.message);
            }else{
               if(data.status == 1){
                  $(_this).closest('.single-field').find('.actionBx').remove();
                  $('.notif-box').html(data.message);
               }else{
                  $('.notif-box').html(data.message);
               }
            }
           }
         });
      })
   });
</script>
@endsection
@section('customcss')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection