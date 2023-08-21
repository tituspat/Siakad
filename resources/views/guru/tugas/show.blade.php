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
                            <td><a href="{{ asset('storage/' . $data->pdf_path) }}" download>Tugas {{ $siswa->nama_siswa }}</a></td>
                            <td>{{ $data->nilai }}</td>
                            <td>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-tambah-tugas-modal-lg">
                                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Beri Nilai
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <!-- Extra large modal for Tugas -->
    <div class="modal fade bd-tambah-tugas-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.tugas.nilai', $data->id ) }}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="row soal">
                            <div class="col-md-12">
                                <div class="modal-header">
                                </div>
                                <br/>
                                <div class="form-group" data-soal="1">
                                    <label for="kelas">Kelas: </label>
                                    <input type="text" id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" readonly value="{{$kelas->nama_kelas}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Judul Tugas:</label>
                                    <input type="text" id="nama_siswa" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ $siswa->nama_siswa }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="text" id="nilai" name="nilai" class="form-control @error('nilai') is-invalid @enderror">
                                </div>
                                
                            </div>
                        </div>
                    
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#Elearning").addClass("active");
    </script>
@endsection