<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\Banner;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Category;







class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo

        $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
        $image_og = '';
        $meta_keywords ="Đồ Điện Tử, Điện Thoại, Lap Top, Tủ Lạnh, Máy Tính";
        $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();


        //end seo
        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
       
        $list_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->paginate(12);
        $cate_tabs = Category::where('category_parent','<>',0)->orderby('category_order','ASC')->get();
        return view('pages.home')->with(compact('cate', 'brand', 'list_product','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post','cate_tabs'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //tìm kiếm bằng data
    public function search(Request $request)
    {
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $keywords = $request->keywords_submit;
        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();


        // $meta_desc='';
        // $meta_keywords = '';
        // $meta_title = '';
        // $url_canonical = '';
        foreach($search_product as $key => $seo){
            $meta_desc = $seo->product_desc;

            $meta_keywords = $seo->product_name;
            $meta_title = $seo->product_name;
            $url_canonical = $request->url();
            $image_og = url('public/uploads/product/'.$seo->product_image);
        }

        return view('pages.product.search')->with(compact('cate', 'brand','search_product','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
        // return view('pages.product.search')->with('cate',$cate)->with('brand',$brand)->with('search_product',$search_product);
    }

    //tìm kiếm bằng ajax
    public function tim_kiem_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status', 1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output.='<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($product as $key => $val){
                $output.='
                    <li><a href="#">'.$val->product_name.'</a></li>
                ';
            }
            $output.='</ul>';
            echo $output;
        }
    }


    //danh mục sản phẩm
    public function show(Request $request,string $slug)
    {

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

         //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        
        $cate = Category::where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $cate_by_slug = Category::where('category_slug',$slug)->get();
        // foreach($cate_by_slug as $key => $cate){
        //     $category_id = $cate->category_id;
        // }

        // if(isset($_GET['sort_by'])){
        //     $sort_by = $_GET['sort_by'];
        //     if($sort_by=='giam_dan'){
        //         $category_by_id = Product::with('category')->where('category_id',$category_id)->orderby('product_price','DESC')->paginate(6)->appends(request()->query());
        //     }elseif($sort_by == 'tang_dan'){
        //         $category_by_id = Product::with('category')->where('category_id',$category_id)->orderby('product_price','ASC')->paginate(6)->appends(request()->query());
        //     }elseif($sort_by == 'kytu_za'){
        //         $category_by_id = Product::with('category')->where('category_id',$category_id)->orderby('product_name','DESC')->paginate(6)->appends(request()->query());
        //     }elseif($sort_by == 'kytu_az'){
        //         $category_by_id = Product::with('category')->where('category_id',$category_id)->orderby('product_name','ASC')->paginate(6)->appends(request()->query());
        //     }
        // }
        // else{
        //     $category_by_id = Product::with('category')->where('category_id',$category_id)->orderby('product_id','DESC')->paginate(6);
        // }

        $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_category.category_slug',$slug)->paginate(6);

        $category_name = DB::table('tbl_category')->where('tbl_category.category_slug',$slug)->limit(1)->get();
        
        foreach($category_name as $key => $seo){
            $meta_desc = $seo->category_desc;

            $meta_keywords = $seo->category_keyword;
            $meta_title = $seo->category_name;
            $url_canonical = $request->url();
            $image_og = '';
        }

        



        return view('pages.category.show_category')->with(compact('cate', 'brand', 'category_by_id', 'category_name', 'meta_desc', 'meta_title', 'meta_keywords', 'url_canonical', 'slider','image_og','cate_post'));

       
    }


    //tabs danh muc 
    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $product = Product::where('category_id',$data['cate_id'])->orderby('product_id','desc')->get();

        $product_count = $product->count();
        if($product_count > 0){
            $output.='<div class="tab-content">
                         <div class="tab-pane fade active in" id="tshirt" >';
            foreach($product as $key => $pro){
                $output.='
                            <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="'.url('public/uploads/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
                                                <h2>'.number_format($pro->product_price,0,',','.').'VND</h2>
                                                <p>'.$pro->product_name.'</p>
                                                <a href="'.url('/chi-tiet/'.$pro->product_slug).'" class="btn btn-default add-to-cart">Chi Tiết</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            
                ';
            }
            $output.='
                </div>
                    </div>';
        }else{
            $output.='
            <div class="tab-content">
                    <div class="tab-pane fade active in" id="tshirt" >
                                <div class="col-sm-12">
                                   <p style="color:red; text-align:center; font-weight: bold; font-size: 25px;" >DANH MỤC CHƯA CÓ SẢN PHẨM</p>
                                </div>
                              
                            </div> </div>
                ';
        }
        $output.='</div>';

        echo $output;
    }

    public function show_brand(Request $request,string $slug)
    {

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$slug)->paginate(6);
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$slug)->limit(1)->get();
       
        foreach($brand_name as $key => $seo){
            $meta_desc = $seo->brand_desc;

            $meta_keywords = $seo->brand_keyword;
            $meta_title = $seo->brand_name;
            $url_canonical = $request->url();
            $image_og = '';
        }

        

         return view('pages.brand.show_brand')->with(compact('cate', 'brand', 'brand_by_id','brand_name','meta_desc','meta_title','meta_keywords','url_canonical','slider', 'image_og','cate_post'));

        // return view('pages.brand.show_brand')->with('cate',$cate)->with('brand',$brand)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }

    //chi tiet san pham
    public function show_details_product(Request $request,string $slug){

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_slug',$slug)->get();

        foreach($details_product as $key => $seo){
            $meta_desc = $seo->product_desc;

            $meta_keywords = $seo->product_slug;
            $meta_title = $seo->product_name;
            $url_canonical = $request->url();
            $image_og = url('public/uploads/product/'.$seo->product_image);

            $category_id = $seo->category_id;
            $product_id = $seo->product_id;
            $product_cate = $seo->category_name;
            $cate_slug = $seo->category_slug;

        }

        //gallery
        $gallery = Gallery::where('product_id',$product_id)->orderby('gallery_id','desc')->get();

        $pro = Product::where('product_id',$product_id)->first();
        $pro->product_view = $pro->product_view + 1;
        $pro->save();
       
        $related_product = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_category.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$slug])->get();

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating= round($rating);
       

        return view('pages.product.show_details')->with(compact('cate', 'brand','details_product','related_product','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post','gallery','product_cate','cate_slug','rating'));
    }


    //tags
    public function tag( Request $request, $tag){
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $tag = str_replace("-"," ",$tag);


        $pro_tags = Product::where('product_status',1)->where('product_name','LIKE','%'.$tag.'%' )->orWhere('product_tags','LIKE','%'.$tag.'%')->orWhere('product_slug','LIKE','%'.$tag.'%')->get();
      

        
            $meta_desc = 'Tags Tìm Kiếm: '.$tag;

            $meta_keywords = 'Tags Tìm Kiếm: '.$tag;
            $meta_title = 'Tags Tìm Kiếm: '.$tag;
            $url_canonical = $request->url();
            $image_og = '';


        

      

        return view('pages.tags.tags')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post','tag','pro_tags'));
    }




    //bai viết Post
    public function show_cate_post($slug, Request $request){

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();



        $keywords = $request->keywords_submit;
        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $catepost = CategoryPost::where('cate_post_slug',$slug)->take(1)->get();
        


        // $meta_desc='';
        // $meta_keywords = '';
        // $meta_title = '';
        // $url_canonical = '';
        foreach($catepost as $key => $seo){
            $meta_desc = $seo->cate_post_desc;

            $meta_keywords = $seo->cate_post_slug;
            $meta_title = $seo->cate_post_name;
            $url_canonical = $request->url();
            $image_og = '';
            $cate_post_id = $seo->cate_post_id;
        }
        $post = Post::where('post_status',1)->where('cate_post_id',$cate_post_id)->paginate(5);
        return view('pages.post.cate_post')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post','post'));
         
    }

    public function post(Request $request,$slug){
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $keywords = $request->keywords_submit;
        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $cate_post = CategoryPost::where('cate_post_slug',$slug)->take(1)->get();
        $post = Post::where('post_status',1)->where('post_slug',$slug)->take(1)->get();


        // $meta_desc='';
        // $meta_keywords = '';
        // $meta_title = '';
        // $url_canonical = '';
        foreach($post as $key => $seo){
            $meta_desc = $seo->post_meta_desc;

            $meta_keywords = $seo->post_meta_keyword;
            $meta_title = $seo->post_name;
            $url_canonical = $request->url();
            $image_og = '';
            $cate_post_id = $seo->cate_post_id;
            $post_id = $seo->post_id;
        }
        $postt = Post::where('post_id',$post_id)->first();
        $postt->post_view = $postt->post_view + 1;
        $postt->save();
        $related = Post::where('post_status',1)->where('cate_post_id',$cate_post_id)->whereNotIn('post_slug',[$slug])->take(4)->get();
        return view('pages.post.post')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','post','cate_post','related'));
    }

    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery'] = '';
        foreach($gallery as $key => $gal){
            $output['product_gallery'].='<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'"></p>';
        }

        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').'<sup>đ</sup>';
        $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';

        $output['product_button'] = '<input type="button" value ="MUA NGAY" class="btn btn-primary btn-sm add-to-cart-quickview" data-id="'.$product->product_id.'" name="add-to-cart" id="buyQuickview" >';

        $output['product_value'] = '
            <input type="hidden"  value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
            <input type="hidden"  value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
            <input type="hidden"  value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
            <input type="hidden"  value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
            <input type="hidden"  value="1" class="cart_product_qty_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">

        ';

        echo json_encode($output);
    }


    //gửi bình luận
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->product_id = $product_id;
        $comment->comment_status = 0;

        $comment->comment_parent_comment = 0;
        $comment->save();


    }

    //load comment 
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',1)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.='
                <div class="row style_comment">
                    <div class="col-md-2">
                        
                            <img width="100%" class="img img-responsive img-thumbnail" src="'.url('public/frontend/images/icon1.png').'">
                    </div>
                    <div class="col-md-10">
                        <p style="color:green;">'.$comm->comment_name.'</p>
                        <p style="color:#000;">'.$comm->comment_date.'</p>
                        <p>'.$comm->comment.'</p>
                    </div>
                </div>
                <p></p>
                ';
                foreach($comment_rep as $key => $rep_comment){
                    if($rep_comment->comment_parent_comment == $comm->comment_id){
            $output.='<div class="row style_comment" style="margin:5px 40px; background: aquamarine;">
                    <div class="col-md-2">
                        
                            <img width="80%" class="img img-responsive img-thumbnail" src="'.url('public/frontend/images/logo.jpg').'">
                    </div>
                    <div class="col-md-10">
                        <p style="color:red;">Shop Điện Tử</p>
                        <p style="color:#000;">'.$rep_comment->comment_date.'</p>
                        <p>'.$rep_comment->comment.'</p>
                    </div>
                </div>
                <p></p>
            ';
                }
            }
            
        }
        echo $output;
    }


    //đánh giá sao
    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }




    //send emali
    public function send_email(){
        $name = 'John Doe';
        $body = 'Welcome to our website!';
        

       
        Mail::send('pages.send_email',compact('name','body'), function($email){
            $email->to('trannhuthanh221202@gmail.com','Tran Nhu Thanh');
        });
    }
}
