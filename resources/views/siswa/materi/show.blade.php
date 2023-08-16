@extends('template_backend.home')
@section('heading')
Data Materi {{ $kelas->nama_kelas }}
@endsection

@section('page')
  <li class="breadcrumb-item active">{{ $kelas->nama_kelas }}</li>
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('guru.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body">
        @if($materi || $test)
        <!-- Tampilkan detail materi di sini -->
            @foreach($materi as $m)
                <div class="card card-outline card-info p-4">
                    <h1 class="self-center">{{$m->judul}}</h1>
                    <div class="video-wrapper">{!! $m->link_video !!}</div>
                    <h3>{{$m->link_materi}}</h3>
                    <h3>{{$m->judul}}</h3>
                    <h3>{{$m->materi_baca}}</h3>
                </div>
            @endforeach
            @if($test)
            <h3><a href="{{ route('test.mulai',  $test->id  ) }}">Ada Test!! Yuk Selesaikan!!<a></h3>
            @endif
        @else
        <h1>Belum ada materi yang diberikan.</h1>
        @endif

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataGuru").addClass("active");
    </script>
@endsection