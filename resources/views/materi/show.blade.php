@extends('template_backend.home')
@section('heading')
Data Materi {{ $kelas->nama_kelas }}
@endsection

@section('page')
<li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">{{ $kelas->nama_kelas }}</li>
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('guru.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah materi
                </button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Buat Soal
                </button>
            </h3>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body">
        @if($materi)
        <!-- Tampilkan detail materi di sini -->
        @foreach($materi as $m)
                <div class="card card-outline card-info p-4">
                    <h1 class="self-center">{{$m->judul}}</h1>
                    <div class="video-wrapper">{!! $m->link_video !!}</div>
                    <h3>{{$m->link_materi}}</h3>
                    <h3>{{$m->judul}}</h3>
                    <h3>{{$m->materi_baca}}</h3>
                    
                    <hr />
                </div>
                @endforeach
        @else
        <h1>Belum ada materi yang diberikan.</h1>
        @endif

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
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
                        <label for="nama_kelas">Kelas</label>
                        <input type="text" id="nama_Kelas" name="nama_kelas" class="form-control @error('judul') is-invalid @enderror" value="{{ $kelas->nama_kelas }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Materi</label>
                        <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="link_video">Link Materi Video</label>
                        <input type="text" id="link_video" name="link_video" class="form-control @error('link_video') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="link_materi">Link Materi Baca</label>
                        <input type="text" id="link_materi" name="link_materi" class="form-control @error('link_materi') is-invalid @enderror">
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
        $("#Elearning").addClass("active");
    </script>
@endsection