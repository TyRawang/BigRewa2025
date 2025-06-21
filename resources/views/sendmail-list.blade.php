@extends('layouts.app')

@section('content')
<style>
    .sendmail-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .filter-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
        border: none;
    }
    
    .filter-header {
        color: #2c3e50;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .filter-header i {
        color: #667eea;
        font-size: 20px;
    }
    
    .filter-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .filter-group label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }
    
    .filter-input, .filter-select {
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    
    .filter-input:focus, .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    .price-range {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .price-range input {
        flex: 1;
    }
    
    .filter-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .filter-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .dashboard-panel {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .dashboard-panel .panel-body {
        padding: 20px;
    }
    
    .cont-bx {
        margin-top: 20px;
    }
    
    .cont-bx .box {
        background: #FFF;
        border: none;
        border-radius: 12px;
        padding: 25px 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid #667eea;
    }
    
    .cont-bx .box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    
    .cont-bx .box h2 {
        font-size: 18px;
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    
    .cont-bx .box h2 a {
        color: inherit;
        text-decoration: none;
    }
    
    .cont-bx .box h2 a:hover {
        color: #667eea;
    }
    
    .date-info {
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        color: #6c757d;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    .date-info i {
        margin-right: 5px;
        color: #667eea;
    }
    
    .customer-info {
        background: #e8f4fd;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid #667eea;
    }
    
    .customer-info h6 {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
        font-size: 14px;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin: 15px 0;
    }
    
    .detail-item {
        background: #f8f9fa;
        padding: 12px 15px;
        border-radius: 8px;
        border-left: 3px solid #28a745;
    }
    
    .detail-item p {
        margin: 0;
        font-size: 13px;
        color: #2c3e50;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 10px 0;
    }
    
    .status-sent { background: #e3f2fd; color: #1976d2; }
    .status-waiting { background: #fff3e0; color: #f57c00; }
    .status-accepted { background: #e8f5e8; color: #388e3c; }
    .status-rejected { background: #ffebee; color: #d32f2f; }
    .status-negotiate { background: #f3e5f5; color: #7b1fa2; }
    
    .view-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: 100%;
        justify-content: center;
    }
    
    .view-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .no-mail-message {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .no-mail-message h1 {
        color: #6c757d;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .pagination-wrapper {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-top: 30px;
    }
    
    .unread-bordered {
        border-left: 4px solid #dc3545 !important;
        background: #fff5f5;
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
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .price-range {
            flex-direction: column;
            align-items: stretch;
        }
        
        .sendmail-container {
            padding: 10px 0;
        }
        
        .filter-panel {
            margin: 0 10px 20px;
        }
    }
</style>

<home :user="user" inline-template>
    <div class="sendmail-container">
        <div class="container">
            <!-- Filter Section -->
            <div class="filter-panel">
                <form method="GET" action="{{ route('g-send-mail-search') }}">
                    <div class="filter-header">
                        <i class="fa fa-filter"></i>
                        Filter Emails
                    </div>
                    
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="id">Subject/Customer Name/Email:</label>
                            <input type="text" id="id" name="id" value="{{old('id')}}" class="filter-input" placeholder="Search by subject, name, or email...">
                        </div>
                        
                        <div class="filter-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="filter-select">
                                <option value="all" {{old('status') == 'all' ? "selected":""}}>All Status</option>
                                <option value="0" {{old('status') == '0' ? "selected":""}}>Sent</option>
                                <option value="2" {{old('status') == '2' ? "selected":""}}>Accepted</option>
                                <option value="3" {{old('status') == '3' ? "selected":""}}>Rejected</option>
                                <option value="1" {{old('status') == '1' ? "selected":""}}>Waiting</option>
                                <option value="4" {{old('status') == '4' ? "selected":""}}>Negotiate</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label>Price Range:</label>
                            <div class="price-range">
                                <input type="number" name="price-min" id="price-min" value="{{old('price-min')?old('price-min'):"0"}}" min="0" max="10000" class="filter-input" placeholder="Min">
                                <span>to</span>
                                <input type="number" name="price-max" id="price-max" value="{{old('price-max')?old('price-max'):"10000"}}" min="0" max="10000" class="filter-input" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="filter-submit">
                        <i class="fa fa-search"></i> Search
                    </button>
                </form>
            </div>

            <!-- Dashboard Messages -->
            @if (session('status') || session()->has('success_message') || session()->has('error_message'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="dashboard-panel">
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
            @endif

            <!-- Email List -->
            <div class="row cont-bx">
                @if(count($data) > 0)
                @foreach($data as $value)
                   <div class="col-sm-4">
                       <div class="box {{ $value->status == 1 ? 'unread-bordered' : '' }}">
                          <h2><a href="{{ url('g-sent-mail-details/'.$value->id) }}">{{ $value->subject }}</a></h2>
                          
                          <div class="date-info">
                              <i class="fa fa-calendar"></i>
                              {{ date('M d, Y', strtotime($value->created_at)) }}
                          </div>
                          
                          <div class="customer-info">
                              <h6>{{ $value->customerName . " (" .$value->customerEmail.")" }}</h6>
                          </div>
                       
                          <div class="details-grid">
                              <div class="detail-item">
                                  <p><strong>Weight:</strong> {{ $value->estimatedWeight }} lbs</p>
                              </div>
                              <div class="detail-item">
                                  <p><strong>Cost/lb:</strong> ${{ $value->costPerPound }}</p>
                              </div>
                              <div class="detail-item">
                                  <p><strong>Total:</strong> ${{ $value->total }}</p>
                              </div>
                              @if($value->status==2)
                              <div class="detail-item">
                                  <p><strong>Final:</strong> ${{ $value->final_amount }}</p>
                              </div>
                              @endif
                          </div>

                          <?php $status_classes = [0 => 'status-sent', 1 => 'status-waiting', 2 => 'status-accepted', 3 => 'status-rejected', 4 => 'status-negotiate']; ?>
                          <?php $status_arr = [0 => 'Sent', 1 => 'Waiting', 2 => 'Accepted', 3 => 'Rejected', 4 => 'Negotiate']; ?>
                          
                          <div class="status-badge {{ $status_classes[$value->status] }}">
                              {{ $status_arr[$value->status] }}
                          </div>
                                      
                          <div class="text-center" style="margin-top: 20px;">
                              <a class="view-btn" href="{{ url('g-sent-mail-details/'.$value->id) }}">
                                  <i class="fa fa-eye"></i> View Details
                              </a>
                          </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-sm-12">
                    <div class="no-mail-message">
                        <i class="fa fa-envelope-o" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                        <h1>No Emails Found</h1>
                        <p style="color: #6c757d;">Try adjusting your search filters or check back later.</p>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if(count($data) > 0)
            <div class="row">
                <div class="col-sm-12">
                    <div class="pagination-wrapper">
                        <div class="text-center">
                            {!! $data->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</home>
@endsection
