<?php

namespace App\Http\Controllers\Regions;
use App\Advert;
use App\Blog;
use App\User;
use App\UserAttributes;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{

    public function index()
    {


        $type_regions = session()->get('type_regions');

        if($type_regions['type'] = 'city')
        {
            $blog = Blog::latest()->where('active',1)->where('city',session()->get('regiones_id'))->get()->groupBy(function($date) {
                return $date->created_at->formatLocalized('%d %B %Y');
            });

            $companyes = UserAttributes::with('values')
                ->where('user_id','!=',2)
                ->where('user_id','!=',47)
                ->where('users_attributes.city',session()->get('regiones_id'))
                ->join('region', 'region.id', '=', 'users_attributes.region')
                ->join('city', 'city.id', '=', 'users_attributes.city')
                ->join('country', 'country.id', '=', 'users_attributes.country')
                ->select('users_attributes.*',DB::raw('(select count(*) from blog where user_id = users_attributes.user_id) as count_sub'),'region.name AS region_title','city.name as city_title')->orderBy('count_sub','DESC')->paginate(7);


        }
        else if($type_regions['type'] = 'region')
        {

            $blog = Blog::latest()->where('active',1)->where('region',session()->get('regiones_id'))->get()->groupBy(function($date) {
                return $date->created_at->formatLocalized('%d %B %Y');
            });

            $companyes = UserAttributes::with('values')
                ->where('user_id','!=',2)
                ->where('user_id','!=',47)
                ->where('users_attributes.city',session()->get('regiones_id'))
                ->join('region', 'region.id', '=', 'users_attributes.region')
                ->join('city', 'city.id', '=', 'users_attributes.city')
                ->join('country', 'country.id', '=', 'users_attributes.country')
                ->select('users_attributes.*',DB::raw('(select count(*) from blog where user_id = users_attributes.user_id) as count_sub'),'region.name AS region_title','city.name as city_title')->orderBy('count_sub','DESC')->paginate(7);

        }
        else if($type_regions['type'] = 'country')
        {
            $blog = Blog::latest()->where('active',1)->where('country',session()->get('regiones_id'))->get()->groupBy(function($date) {
                return $date->created_at->formatLocalized('%d %B %Y');
            });

            $companyes = UserAttributes::with('values')
                ->where('user_id','!=',2)
                ->where('user_id','!=',47)
                ->where('users_attributes.city',session()->get('regiones_id'))
                ->join('region', 'region.id', '=', 'users_attributes.region')
                ->join('city', 'city.id', '=', 'users_attributes.city')
                ->join('country', 'country.id', '=', 'users_attributes.country')
                ->select('users_attributes.*',DB::raw('(select count(*) from blog where user_id = users_attributes.user_id) as count_sub'),'region.name AS region_title','city.name as city_title')->orderBy('count_sub','DESC')->paginate(7);
        }


        #$company = DB::table('user')->where('count_sub','>',0)->get();




        return view('indexBlog')->with('blog',$blog)->with('company',$companyes);
    }


    public function postShow($account,$id)
    {
        $blogget = Blog::where('id','=',$id)->get();

        $user = Blog::where('id',$id)->get();

        $new = Advert::
        select('advert.*',
            'category.title AS categorytitle',
            'region.name AS region_title',
            'advert.show AS `show`',DB::raw("(select count(*) from advert where user_id = users.id) as count_sub"))
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('users','advert.user_id','=','users.id')
            ->join('users_attributes','users.id','=','users_attributes.user_id')
            ->where('users.id','=',$user[0]->user_id)->orderBy('updated_at','desc')->paginate(10);
        return view('postblog')->with('postblog',$blogget)->with('new',$new);
    }

    public function companyShow($account,$id)
    {
        $user = User::with('attributes')->where('id','=',$id)->get();
        $blogget = Blog::where('active',1)->where('user_id',$user[0]->id)->take(12)->get()->groupBy(function($date) {
            return $date->created_at->formatLocalized('%d %B %Y');
        });
        $new = Advert::
        select('advert.*',
            'category.title AS categorytitle',
            'region.name AS region_title',
            'advert.show AS `show`',DB::raw("(select count(*) from advert where user_id = users.id) as count_sub"))
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('users','advert.user_id','=','users.id')
            ->join('users_attributes','users.id','=','users_attributes.user_id')
            ->where('users.id','=',$id)->orderBy('updated_at','desc')->paginate(10);
        return view('companyblog')->with('postblog',$blogget)->with('new',$new)->with('user',$user);
    }


    public function showpage($account,Blog $blog)
    {


        if(Auth::guest()){
            return redirect('login');
        }
        else {
            $this->data['blog'] = $blog->getBlog();
            return view('lk.blog', $this->data);
        }
    }
    protected function add($account,Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

            'url'=>'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(Auth::guest()){
            return redirect('login');
        }
        else{


            $name = strip_tags($request['name'],'<br>');
            $content = strip_tags($request['content'],'<br>');
            $url = strip_tags($request['url'],'<br>');
            $user_id = Auth::user()->id;

            $blog = new Blog();

            if($request->file('file') != '')
            {
                $filename = str_random(6).'_'.$request->file('file')->getClientOriginalName();
                $Path = public_path( 'upload/'.$user_id.'/picture/picture/');
                $Path_load = 'upload/'.$user_id.'/picture/picture/';
                $request->file('file')->move($Path, $filename);
                $data = $request->except(['file']);
                $data['file'] = $Path_load.$filename;

            }
            else {
                $data['file'] = '';
            }

            $user = UserAttributes::where('user_id',$user_id)->get();

            $blog->name = $name;
            $blog->slug = str_slug($name);
            $blog->active = '0';
            $blog->user_id = $user_id;
            $blog->content = $content;
            $blog->region = $user[0]->region;
            $blog->city = $user[0]->city;
            $blog->country = $user[0]->country;
            $blog->url = $url;
            $blog->filename = $data['file'];
            $blog->save();

            $user = User::where('id','=',$user_id)->get();
            # DB::update("UPDATE users set count_blog='".$user[0]->count_blog."'+1 where id = ".$user_id);
            return Redirect::back();
        }
    }

    public function editGet($account,$id)
    {
        $blog = Blog::find($id);
        return view('edit.blogedit')->with('blog',$blog);
    }

    /**
     * @param $account
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function editPost($account, Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:50',

            'url'=>'required|max:200',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        #dd($request);

        $data = Blog::find($id);

        $user_id = Auth::user()->id;

        if($request->file('file') != '')
        {
            $filename = str_random(6).'_'.$request->file('file')->getClientOriginalName();
            $Path = public_path( 'upload/'.$user_id.'/blog/blog/');
            $Path_load = 'upload/'.$user_id.'/blog/blog/';
            $request->file('file')->move($Path, $filename);
            $request->except('file');
            $filenames = $Path_load . $filename;
            #dd($filename);
            unlink($data->filename);
        }
        else {

            $filenameeq = Blog::select('filename')->where('user_id', '=', $user_id)->where('id', '=', $id)->get();

            $filenames = $filenameeq[0]->filename;
        }

        #dd($data);

        $data->name = $request->name;
        $data->slug = str_slug($request->name);
        $data->content = $request->content;
        $data->url = $request->url;
        $data->filename = $filenames;

        $data->save();

        return redirect('/myblog');


    }

    protected function deletePost($account,$id)
    {
        $data = Blog::find($id);

        if (!empty($data->filename))
        {
            unlink($data->filename);
        }

        $data->delete();
    }
    public function showBlog($account,Blog $blog)
    {
        $this->data['blogitem'] = $blog->getBlogitem();

        return view('blog', $this->data);
    }
}
