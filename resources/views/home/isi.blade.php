@extends('template.master')

@section('content')
		<!-- Small Box (Stat card) -->
        <div class="card card-warning card-outline">
          <div class="card-header d-flex p-0">
            <marquee class="text-info">{{Tanggal::indo(date("Y-m-d H:i:s"))}}. <a id="jam"></a></marquee>
          </div><!-- /.card-header -->
        </div>

        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">File Data <strong class="text-black">{{$folder->nama_folder}}</strong></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama File</th>
                      <th>Tanggal Upload</th>
                      <th>Download</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $no = 1 @endphp

                  @foreach($files as $file)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$file->nama_data}}</td>
                      <td>{{$file->created_at}}</td>
                      <td><a href="{{asset('storage/Data/'.$folder->nama_folder.'/'.$file->file)}}"> Link </a></td>
                    </tr>
                  @endforeach  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection

@section('js')
@if(!empty($successMessage = \Illuminate\Support\Facades\Session::get('salah')))
    <script>
        $(function () {
            @if($successMessage)
                alert('{{ $successMessage }}');
            @endif
        });
    </script>
@endif

<script type="text/javascript">
     window.onload = function() { jam(); }

     function jam() {
      var e = document.getElementById('jam'),
      d = new Date(), h, m, s;
      h = d.getHours();
      m = set(d.getMinutes());
      s = set(d.getSeconds());

      e.innerHTML = h +':'+ m +':'+ s;

      setTimeout('jam()', 1000);
     }

     function set(e) {
      e = e < 10 ? '0'+ e : e;
      return e;
     }
    </script>
@stop