@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Wallet History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Wallet History</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Wallet History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Transaction Type</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Amount</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Final Amount</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">TXN Detail</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">TXN Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Date Time</th></tr>
                  </thead>
<?php  //echo "<pre>akmakm===";  print_r($walletData); //die; ?>
                  <tbody>	 @php $i=1;  @endphp 
                  @foreach($walletData as  $d) 
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td><?php echo $d->transaction_type; ?> </td>
                    <td>{{$d->amount}} </td>
                    <td><?php echo $d->final_amount; ?> </td>
                    <td><?php echo $d->txn_detail; ?> <br /> <b><?php echo $d->funded_type; ?></b></td>
                     <td> <?php echo $d->txn_number; ?> </td>
                     <td><?php echo $d->date_time; ?> </td>
                  </tr>  @php $i++; @endphp
                  	
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Transaction Type</th><th rowspan="1" colspan="1">Amount</th><th rowspan="1" colspan="1">Final Amount</th><th rowspan="1" colspan="1"> TXN Detail</th><th rowspan="1" colspan="1">TXN Number</th><th rowspan="1" colspan="1">Date Time</th></tr>
                  </tfoot>
                </table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  
@include('admin.footer')
 