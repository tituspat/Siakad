@extends('template_backend.home')
@section('heading')
  Data User @foreach ($role as $d => $data) {{ $d }} @endforeach
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
  @foreach ($role as $d => $data)
    <li class="breadcrumb-item active">{{ $d }}</li>
  @endforeach
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('user.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                @foreach ($role as $d => $data)
                  @if ($d == 'Guru')
                    <th>No Id Card</th>
                  @elseif ($d == 'Siswa')
                    <th>No Induk Siswa</th>
                  @else
                      
                  @endif
                @endforeach
                {{-- <th>Tanggal Register</th> --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @if ($user->count() > 0)
            @foreach ($user as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-capitalize">{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                @if ($data->role == 'Siswa')
                  @if ($data->no_induk)
                  <td>{{ $data->no_induk }}</td>
                  @else 
                  <td>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-confirm-siswa-modal-lg">
                        <i class="nav-icon"></i> &nbsp; Konfirmasi
                    </button></td>
                  @endif
                @elseif ($data->role == 'Guru')
                  <td>{{ $data->id_card }}</td>
                @else
                @endif
                {{-- <td>{{ $data->created_at->format('l, d F Y') }}</td> --}}
                <td>
                  <form action="{{ route('user.destroy', $data->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Silahkan Buat Akun Terlebih Dahulu!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-confirm-siswa-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_induk">Nomor Induk</label>
                        <input type="text" id="no_induk" name="no_induk" onkeypress="return inputAngka(event)" class="form-control @error('no_induk') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" id="nama_siswa" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir">Tempat Lahir</label>
                        <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="foto">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                                <label class="custom-file-label" for="foto">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telp">Nomor Telpon/HP</label>
                        <input type="text" id="telp" name="telp" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="id_spp">SPP</label>
                        <select id="id_spp" name="id_spp" class="select2bs4 form-control @error('spp_id') is-invalid @enderror text-black">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($SPP as $data)
                                <option value="{{ $data->id }}">{{ $data->nominal }}</option>
                            @endforeach
                        </select>
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
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endsection