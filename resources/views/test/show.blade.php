@extends('template_backend.home')
@section('heading', $test->nama_test)
@section('page')
  <li class="breadcrumb-item active">Daftar Test</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
              <h4>Kerjakan dengan jujur!</h4>
            </h3>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body">
          <form action="{{ route('test.selesai', $test->id) }}" method="post">
          @csrf
            @foreach ($soal as $s)
              <div class="mb-3">
                  <h4>{{ $loop->iteration }}. {{ $s->pertanyaan }}</h4>
                  <input type="radio" name="jawaban_{{ $s->id }}" value="A"> A. {{ $s->pilihan_a }}<br>
                  <input type="radio" name="jawaban_{{ $s->id }}" value="B"> B. {{ $s->pilihan_b }}<br>
                  <input type="radio" name="jawaban_{{ $s->id }}" value="C"> C. {{ $s->pilihan_c }}<br>
                  <input type="radio" name="jawaban_{{ $s->id }}" value="D"> D. {{ $s->pilihan_d }}<br>
              </div>
            @endforeach
              <button type="submit" class="btn btn-primary">Selesai</button>
          </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
        
        $("#NilaiGuru").addClass("active");
        $("#liNilaiGuru").addClass("menu-open");
        $("#UlanganGuru").addClass("active");
    </script>
@endsection