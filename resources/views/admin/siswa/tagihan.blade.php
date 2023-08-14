@extends('template_backend.home')
@section('heading', 'Data Tagihan Siswa')
@section('page')
  <li class="breadcrumb-item active">Data Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">
              <button type="button" class="btn btn-primary btn-sm" onclick="getCreateKelas()" data-toggle="modal" data-target="#form-kelas">
                  <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tagih Untuk Bulan ini
              </button>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_siswa }}</td>
                    <td>{{ $data->kelas->nama_kelas }}</td>
                    <td>{{ $data->spp->nominal }}</td>
                    <td>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

    
@endsection
@section('script')
  <script>
    function getCreateKelas(){
      $("#judul").text('Tambah Data Kelas');
      $('#id').val('');
      $('#form_nama').html(`
        <label for="nama_kelas">Nama Kelas</label>
        <input type='text' id="nama_kelas" onkeyup="this.value = this.value.toUpperCase()" name='nama_kelas' class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="{{ __('Nama Kelas') }}">
      `);
      $('#nama_kelas').val('');
      $('#guru_id').val('');
    }

    function getEditKelas(id){
      var parent = id;
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/kelas/edit/json') }}",
        success:function(result){
            // console.log(result);
          if(result){
            $.each(result,function(index, val){
              $("#judul").text('Edit Data Kelas ' + val.nama);
              $('#id').val(val.id);
              $('#form_nama').html('');
              $('#nama_kelas').val(val.nama);
              $('#guru_id').val(val.guru_id);
            });
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
    }

    function getSubsSiswa(id){
      var parent = id;
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/siswa/view/json') }}",
        success:function(result){
          // console.log(result);
          var siswa = "";
          if(result){
            $.each(result,function(index, val){
              $("#judul-siswa").text('View Data Siswa ' + val.kelas);
              siswa += "<tr>";
                siswa += "<td>"+val.no_induk+"</td>";
                siswa += "<td>"+val.nama_siswa+"</td>";
                siswa += "<td>"+val.jk+"</td>";
                siswa += "<td><img src='"+val.foto+"' width='100px'></td>";
              siswa+="</tr>";
            });
            $("#data-siswa").html(siswa);
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
      $("#link-siswa").attr("href", "https://siakad.didev.id/listsiswapdf/"+id);
    }
    
    function getSubsJadwal(id){
      var parent = id;
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/jadwal/view/json') }}",
        success:function(result){
          // console.log(result);
          var jadwal = "";
          if(result){
            $.each(result,function(index, val){
              $("#judul-jadwal").text('View Data Jadwal ' + val.kelas);
              jadwal += "<tr>";
                jadwal += "<td>"+val.hari+"</td>";
                jadwal += "<td>"+val.guru+"</td>";
                jadwal += "<td>"+val.jam_mulai+" - "+val.jam_selesai+"</td>";
              jadwal+="</tr>";
            });
            $("#data-jadwal").html(jadwal);
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
      $("#link-jadwal").attr("href", "https://siakad.didev.id/jadwalkelaspdf/"+id);
    }

    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#sppbulanansiswa").addClass("active");
  </script>
@endsection