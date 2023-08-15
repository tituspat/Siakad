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
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bd-soal-modal-lg">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Buat Soal
                </button>
            </h3>
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
            <h3><a href="{{ route('test.show',  $test->id  ) }}">Ada Test!! Yuk Selesaikan!!<a></h3>
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
    <!-- Extra large modal for materi -->
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
                                    <input type="text" id="nama_Kelas" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ $kelas->nama_kelas }}" readonly>
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
                    
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra large modal for Soal -->
    <div class="modal fade bd-soal-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Materi ajar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('soal.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row soal">
                            <div class="col-md-12">
                                <div class="modal-header">
                                    <h4>Soal 1</h4>
                                </div>
                                <br/>
                                <div class="form-group" data-soal="1">
                                    <label for="kelas">Kelas: </label>
                                    <input type="text" id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" readonly value="{{$kelas->nama_kelas}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_test">Nama Test:</label>
                                    <input type="text" id="nama_test" name="nama_test" class="form-control @error('nama_test') is-invalid @enderror">
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="pertanyaan">Pertanyaan: </label>
                                    <input type="text" id="pertanyaan" name="soal[0][pertanyaan]" class="form-control @error('pertanyaan') is-invalid @enderror" required>
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="pilihan_a">Opsi A:</label>
                                    <input type="text" id="pilihan_a" name="soal[0][pilihan_a]" class="form-control @error('pilihan_a') is-invalid @enderror" required>
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="pilihan_b">Opsi B:</label>
                                    <input type="text" id="pilihan_b" name="soal[0][pilihan_b]" class="form-control @error('pilihan_b') is-invalid @enderror" required>
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="pilihan_c">Opsi C:</label>
                                    <input type="text" id="pilihan_c" name="soal[0][pilihan_c]" class="form-control @error('pilihan_c') is-invalid @enderror" required>
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="pilihan_d">Opsi D:</label>
                                    <input type="text" id="pilihan_d" name="soal[0][pilihan_d]" class="form-control @error('pilihan_d') is-invalid @enderror" required>
                                </div>
                                <div class="form-group" data-soal="1">
                                    <label for="jawaban_benar">Pilihan Opsi yang tepat:</label>
                                    <input type="text" id="jawaban_benar" name="soal[0][jawaban_benar]" class="form-control @error('jawaban_benar') is-invalid @enderror" required>
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                            <div>
                                <button type="button" class="btn btn-primary" id="tambahSoal"><i class="nav-icon fas fa-save"></i> &nbsp; Tambah Soal</button>
                                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                            </div>
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


        $(document).ready(function () {
        let soalCount = 0;

        $('#tambahSoal').click(function () {
            soalCount++;
            const formGroup = `
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-header">
                        <h4>Soal ${soalCount + 1}</h4>
                        <button type="button" class="hapusSoal" data-soal="${soalCount}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br/>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="pertanyaan">Pertanyaan: </label>
                        <input type="text" id="pertanyaan" name="soal[${soalCount}][pertanyaan]" class="form-control @error('pertanyaan') is-invalid @enderror" required>
                    </div>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="pilihan_a">Opsi A:</label>
                        <input type="text" id="pilihan_a" name="soal[${soalCount}][pilihan_a]" class="form-control @error('pilihan_a') is-invalid @enderror" required>
                    </div>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="pilihan_b">Opsi B:</label>
                        <input type="text" id="pilihan_b" name="soal[${soalCount}][pilihan_b]" class="form-control @error('pilihan_b') is-invalid @enderror" required>
                    </div>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="pilihan_c">Opsi C:</label>
                        <input type="text" id="pilihan_c" name="soal[${soalCount}][pilihan_c]" class="form-control @error('pilihan_c') is-invalid @enderror" required>
                    </div>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="pilihan_d">Opsi D:</label>
                        <input type="text" id="pilihan_d" name="soal[${soalCount}][pilihan_d]" class="form-control @error('pilihan_d') is-invalid @enderror" required>
                    </div>
                    <div class="form-group" data-soal="${soalCount}">
                        <label for="jawaban_benar">Pilihan Opsi yang tepat:</label>
                        <input type="text" id="jawaban_benar" name="soal[${soalCount}][jawaban_benar]" class="form-control @error('jawaban_benar') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
            `;

            $('.soal:last').after(formGroup);
        });
                $(document).on('click', '.hapusSoal', function () {
            const soalId = $(this).data('soal');
            $(`.soal[data-soal="${soalId}"]`).remove();
        });
    });
    </script>
@endsection