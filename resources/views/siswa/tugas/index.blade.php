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
                        <th>Kumpul tugas</th>
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
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-tambah-tugas-modal-lg">
                                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Kumpul Tugas
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
                    <form action="{{ route('siswa.tugas.post', $data->id ) }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                    <label for="judul_tugas">Judul Tugas:</label>
                                    <input type="text" id="judul_tugas" name="judul_tugas" class="form-control @error('judul_tugas') is-invalid @enderror" value="{{ $data->judul_tugas }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="pdf_path">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="pdf_path" class="custom-file-input @error('pdf_path') is-invalid @enderror" id="pdf_path">
                                            <label class="custom-file-label" for="pdf_path">Choose file</label>
                                        </div>
                                    </div>
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