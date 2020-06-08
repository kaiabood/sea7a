<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Post;
use  Validator;
use Illuminate\Validation\Rule;

class PostController extends BaseController
{
//to show all posts
public function index()
{
    
    $post =Post::all();
    return $this->sendResponse($post->toArray(), 'post read succesfully');
}



public function resturants()
{
    $post =Post::all()->where("category",'مطاعم');
    return $this->sendResponse($post->toArray(), 'post resturants read succesfully');
}


public function hotels()
{
    
    $post =Post::all()->where("category",'فنادق');
    return $this->sendResponse($post->toArray(), 'post hotels read succesfully');
}

public function cafes()
{
    
    $post =Post::all()->where("category",'مقاهي');
    return $this->sendResponse($post->toArray(), 'post cafes read succesfully');
}

public function historic()
{
    
    $post =Post::all()->where("category",'اماكن-اثرية');
    return $this->sendResponse($post->toArray(), 'post historical places read succesfully');
}


public function malls()
{
    
    $post =Post::all()->where("category",'مراكز-تسوق');
    return $this->sendResponse($post->toArray(), 'post shoping malls read succesfully');
}

public function entertainment()
{
    
    $post =Post::all()->where("category",'اماكن-ترفيهيةومائية');
    return $this->sendResponse($post->toArray(), 'post places of entertainment read succesfully');
}




//to show 1 Post as we got id
public function show($id)
{
  
    $post =Post::all()->find($id);
    if (   is_null($post)   ) {
        # code...
        return $this->sendError(  'post not found ! ');
    }
    return $this->sendResponse($post->toArray(), 'post read succesfully');

}

public function store(Request $request)
{
    $x=['مطاعم', 'مقاهي','اماكن-ترفيهيةومائية','اماكن-اثرية','مراكز-تسوق','فنادق','اماكن-دينية' ];

    $input = $request->all();
    $validator =    Validator::make($input, [
        'category' => ['required','max:255' ,Rule::in($x) ] ,
        'name' => 'required|max:255',
        'city' => 'required|max:255',
        'contente' => 'required',
        'phone_number' => 'nullable|digits:11|numeric',
        'time' =>'nullable|max:255',
        'map' =>'required',
        'image' => "required|image"
    ] ,[
        'category.in'=> 'ليست ضمن الاحتمالات المطلوبة الا و هي : مطاعم و اماكن-ترفيهيةومائية و اماكن-اثرية و مراكز-تسوق و فنادق و اماكن-دينية و مقاهي ' ,
        'category.required'=>         'الفئة مطلوبة' ,
        'category.max'=>              'الفئة تجاوز الحد الاقصى للاحرف 255' ,
        'name.required'=>             'الاسم مطلوب' ,
        'name.max'=>                  'الاسم تجاوز الحد الاقصى للاحرف 255' ,
        'city.required'=>             'الحي مطلوب' ,
        'city.max'=>                  'الحي تجاوز الحد الاقصى للاحرف 255' ,
        'phone_number.numeric'=>      'رقم الهاتف يجب ان يكون ارقام فقط' ,
        'phone_number.digits'=>          'رقم الهاتف يجب ان يكون مكون من 11 ارقام' ,
        'contente.required'=>         'المحتوى مطلوب' ,
        'image.required'=>            ' الصورة مطلوبة' ,
        'image.image'=>               ' صورة المنشور يجب ان تكون على شكل صورة' ,
        'time.max'=>                  'الوقت تجاوز الحد الاقصى للاحرف 255'  ,
        'map.required'=>                  'الخريطة مطلوبة' 



        ]);

    if ($validator -> fails()) {
   
        return $this->sendError('error validation', $validator->errors());
    }
$image = $request->image;
$image_new_name = time().$image->getClientOriginalName();
$image->move('uploads/posts',$image_new_name);

    $post = Post::create([
        'category'         =>$request->category,
           'name'          =>$request->name,
           'city'          =>$request->city,
           'contente'      =>$request->contente,
           'phone_number'  =>$request->phone_number,
           'time'          =>$request->time,
           'map'          =>$request->map,
           'image'         =>'uploads/posts/'.$image_new_name
        
    ]);
    return $this->sendResponse($post->toArray(), 'post  created succesfully');
    
}

 

// delete Post 
public function destroy(Post $post)
{
 
    $post->delete();

    return $this->sendResponse($post->toArray(), 'post  deleted succesfully');
    
}

public function see($id)
{
    $post =Post::find($id);
   
    return response()->download(public_path($post->image));
    
}



}
