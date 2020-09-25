@extends('template.master')

@section('content')

          @php
          $a=array("indigo","navy","purple","orange","olive","success","gray","danger");
          @endphp
		<!-- Small Box (Stat card) -->
        <div class="card card-warning card-outline">
          <div class="card-header d-flex p-0">
            <marquee class="text-{{$a[rand(0,7)]}}">{{Tanggal::indo(date("Y-m-d H:i:s"))}}. <a id="jam"></a></marquee>
          </div><!-- /.card-header -->
        </div>

        <div class="row">

          

          @foreach($folder as $folder)


          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-{{$a[rand(0,7)]}}">
              <div class="inner">
                <h3>{{$folder->nama_folder}}</h3>

                <p>   </p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-open"></i>
              </div>
              <a href="/files/{{$folder->id}}" class="small-box-footer">
                Klik Disini <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        <!-- /.row -->
@endsection

@section('coba')
<marquee class="text-{{$a[rand(0,7)]}}">{{Tanggal::indo(date("Y-m-d H:i:s"))}}. <a id="jam"></a></marquee>
@stop

@section('js')
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