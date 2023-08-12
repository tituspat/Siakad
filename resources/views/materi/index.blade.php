@extends('template_backend.home')
@section('heading', 'Materi Kelas')
@section('page')
  <li class="breadcrumb-item active">Materi</li>
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
                        <th>Nama Kelas</th>
                        <th>Lihat Materi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_kelas }}</td>
                            <td>
                                <a href="{{ route('materi.show', Crypt::encrypt($data->id)) }}"  class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Details</a>
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
        $("#Pengumuman").addClass("active");
    </script>
@endsection