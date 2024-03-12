@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">{{$meta_title}}</h2>
        <div class="product-image-wrapper">
            @foreach($post as $key => $p)
                <div class="single-products" style="margin:10px 0px; padding: 2px">
                    <div class="text-center">
                        <a href="{{URL::to('/bai-viet/'.$p->post_slug)}}">
                            <img style="float: left; width: 30%; padding: 5px;" src="{{URL::to('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" />
                            <h4 style="color:#000; padding: 5px;">{{$p->post_name}}</h4>
                            <p>{!!$p->post_desc!!}</p>
                                                
                        </a>
                    </div>
                                      
                </div>
            @endforeach
        </div>
</div><!--features_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$post->links()!!}
    </ul>
@endsection