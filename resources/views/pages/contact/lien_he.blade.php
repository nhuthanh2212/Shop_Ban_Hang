@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Liên Hệ </h2>
    <div class="row">
        @foreach($contact as $key => $conta)
        <div class="col-md-12">
            {!!$conta->info_contact!!}
                {!! $conta->info_fanpage!!}
            
        </div>       
        <div class="col-md-12">
            {!!$conta->info_map!!}
        </div>       
    </div>
       @endforeach                
</div><!--features_items-->
               
@endsection