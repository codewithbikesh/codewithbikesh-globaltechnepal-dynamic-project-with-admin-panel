@extends('admin.layouts.app')
@section('content');
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner text-center">
                        <h3 class="{{ $teamMemberCount == 1 ? 'text-dark' : 'text-green' }}">{{ $teamMemberCount }}</h3>                      
                        <p>Total Team Member</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner text-center">
                        <h3 class="{{ $contactCount == 1 ? 'text-dark' : 'text-green' }}">{{ $contactCount }}</h3>
                        <p>Total Contact Us</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner text-center">
                        <h3 class="{{ $clientCount == 1 ? 'text-dark' : 'text-green' }}">{{ $clientCount }}</h3>
                        <p>Total Clients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>
        <!-- /.card -->
		</section>
		<!-- /.content -->
        @endsection

        @section('costomJs')
         <script> 
        // // JavaScript to dynamically update the badge
        // function updateNotificationBadge(count) {
        //     const badge = document.getElementById('notification-badge');
        //     if (count > 0) {
        //         badge.textContent = count;
        //         badge.style.display = 'inline'; // Show the badge
        //     } else {
        //         badge.style.display = 'none'; // Hide the badge
        //     }
        // }

        // // Example usage
        // const teamMemberCount = <?php echo json_encode($teamMemberCount); ?>; // php code is here 
        // updateNotificationBadge(teamMemberCount);
         </script>
        @endsection