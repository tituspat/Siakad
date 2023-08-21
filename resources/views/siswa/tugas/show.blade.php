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
                        <th>Nama Siswa</th>
                        <th>Pengumpulan</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jawaban as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tugas->judul_tugas }}</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td><a href="{{ asset('storage/' . $data->pdf_path) }}" download>Tugas {{ $data->judul_tugas }}</a></td>
                            <td>{{ $data->nilai }}</td>
                            <td>
                            <form action="{{ route('siswa.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('siswa.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                            </form>
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