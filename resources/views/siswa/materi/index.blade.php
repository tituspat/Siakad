@extends('template_backend.home')
@section('heading', 'Materi Kelas')
@section('page')
  <li class="breadcrumb-item active">Materi</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah materi
                    </button>
                </h3>
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
        <!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Materi ajar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('materi.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul">Judul Materi</label>
                        <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="link_video">Link Materi Video</label>
                        <input type="text" id="link_video" name="link_video" class="form-control @error('link_video') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="link_materi_baca">Link Materi Baca</label>
                        <input type="text" id="link_materi_baca" name=";ink_materi_baca" class="form-control @error('materi_baca') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="materi_baca">Materi Baca</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="materi_baca" class="custom-file-input @error('materi_baca') is-invalid @enderror" id="materi_baca">
                                <label class="custom-file-label" for="materi_baca">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text">Keterangan tambahan guru</label>
                        <input type="text" id="text" name="text" class="form-control @error('link_video') is-invalid @enderror">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
          </form>
      </div>
      </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $("#Pengumuman").addClass("active");
    </script>
@endsection