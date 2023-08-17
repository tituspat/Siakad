@extends('template_backend.home')
@section('heading', 'Nilai Siswa')
@section('page')
  <li class="breadcrumb-item active">Nilai Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>No Induk</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testResults as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['siswa']->nama_siswa }}</td>
                    <td>{{ $data['siswa']->no_induk }}</td>
                    <td>{{ $data['nilai'] }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
        window.location="{{ url('/') }}";
        });
    });
    $("#NilaiGuru").addClass("active");
    $("#liNilaiGuru").addClass("menu-open");
    $("#DesGuru").addClass("active");
</script>
@endsection