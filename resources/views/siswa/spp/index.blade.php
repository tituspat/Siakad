@extends('template_backend.home')
@section('heading', 'Data Kelas')
@section('page')
	<li class="breadcrumb-item active">SPP</li>
@endsection

@section('content')

	<div class="row">
      <div class="col-md-12">
			<div class="card">
			   <div class="card-body">
				   <div class="card-title">Data SPP</div>
                           
					<div class="table-responsive mb-3">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">TAHUN</th>
							      <th scope="col">NOMINAL</th>
                           <th scope="col">DIBUAT</th>
					   	      <th scope="col"></th>                                        
                        </tr>
                     </thead>
                     <tbody>
							@php 
						   	$i=1;
							@endphp
							@foreach($bills as $bill)
                        <tr>					    
                           <th scope="row">{{ $i }}</th>
                           <td>{{ $bill->amount }}</td>
							      <td>{{ $bill->jatuh_tempo }}</td>
                           <td>{{ $bill->status }}</td>			
                         </tr>
							@php
							$i++;
							@endphp
							@endforeach                                  
                     </tbody>
                  </table>
               </div>
				</div>
			</div>
		</div>
   </div>

@endsection

@section('sweet')

   function deleteData(id){
      Swal.fire({
               title: 'PERINGATAN!',
               text: "Yakin ingin menghapus data SPP?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
            }).then((result) => {
               if (result.value) {
                     $('#delete'+id).submit();
                  }
               })
   }
   
@endsection