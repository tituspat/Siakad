@extends('template_backend.home')
@section('heading', 'SPP')
@section('page')
  <li class="breadcrumb-item active">SPP</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
            
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Jumlah Tagihan</th>
                <th>Status</th>
            </tr>
              </thead>
              <tbody>
              @foreach($tagihan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->jatuh_tempo }}</td>
                <td>Rp {{ number_format($item->spp->nominal) }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Rapot").addClass("active");
    </script>
@endsection