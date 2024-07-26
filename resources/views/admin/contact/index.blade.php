@extends('admin.layouts.app')
@section('content');
	<!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Us</h1>
                </div>
                {{-- <div class="col-sm-6 text-right">
                    <a href="{{route('admin.client.create')}}" class="btn btn-primary">New Client</a>
                </div> --}}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message');
            <div class="card">
                <form action="" method="get">
                <div class="card-header">
                    <div class="card-title">
                        <button class="btn-default btn-sm" onclick="window.location.href='{{ route('admin.contact.index') }}'" type="button">Reset</button>
                    </div>
                     <div class="card-tools">
                         <div class="input-group input-group" style="width: 250px;">
                            <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control float-right" placeholder="Search">
                            
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <div class="card-body table-responsive p-0">								
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($contacts->isNotEmpty())
                            @php
                            $counter = 1; // Initialize a counter variable
                            @endphp
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $contact->name }}</td>  
                                <td>{{ $contact->email }}</td>  
                                <td>{{ $contact->subject }}</td>  
                                <td>{{ $contact->message }}</td>  
                                <td>
                                    <a href="{{ url('admin/contact/'.$contact->id.'/delete') }}" onclick=" return confirm('Are you sure you want to delete this item?')" class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    </a>
                                </td>
                                   
                               
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Records Not Found</td>
                            </tr>
                            @endif
                            
                        </tbody>
                    </table>										
                </div>
                <div class="card-footer clearfix">
                    {{$contacts->links()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

{{-- javascript code line from here  --}}
{{-- javascript code line from here  --}}
 @section('costomJs')
     
        @endsection