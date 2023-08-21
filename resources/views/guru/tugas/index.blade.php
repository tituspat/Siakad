@extends('template_backend.home')
@section('heading', 'Tugas Kelas')
@section('page')
  <li class="breadcrumb-item active">Tugas Kelas</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
            </div>
            
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Judul Tugas</th>
                        <th>Lihat Tugas</th>
                        <th>Keterangan</th>
                        <th>Lihat Pengumpulan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->judul_tugas }}</td>
                            <td><a href="{{ asset('storage/' . $data->pdf_path) }}" download>{{ $data->judul_tugas }}</a></td>
                            <td>{{ $data->text }}</td>
                            <td>
                                <a href="{{ route('guru.tugas.show', $data->id) }}"  class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#Elearning").addClass("active");
    </script>
@endsection