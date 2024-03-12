@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 style="margin:0; position: inherit;" class="title text-center">{{$meta_title}}</h2>
        <div class="product-image-wrapper" style="border: none;">
            @foreach($post as $key => $p)
                <div class="single-products" style="margin:10px 0px; padding: 2px">
                    {!! $p->post_content !!}
                                      
                </div>
                <div class="clearfix" ></div>
            @endforeach
        </div>
</div><!--features_items-->
  <h2 style="margin:0; position: inherit;" class="title text-center">BÀI VIẾT LIÊN QUAN</h2>
  <ul class="post_relate">
    @foreach($related as $key => $post_relate)
      <li>
          <a href="{{URL::to('/bai-viet/'.$post_relate->post_slug)}}">
              {{$post_relate->post_name}}
          </a>
      </li>
      @endforeach
  </ul>
<style type="text/css">
    ul.post_relate li {
        list-style-type: disc;
        font-size: 16px;
        padding: 6px;
    }
    ul.post_relate li a {
        color: #000;
    }
    ul.post_relate li a:hover {
        color: #FE980F;
    }
    .mucluc h1 {
        font-size: 20px;
        color: brown;
    }
    .tieude ul li {
        padding: 2px;
        font-size: 16px;
    }
    .tieude ul li a {
        color: #000;
    }
    .tieude ul li a:hover {
        color: FE980F;
    }
    .tieude ul li {
        list-style-type: decimal-leading-zero;
    }
</style>
@endsection