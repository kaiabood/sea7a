<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{


    // {{-- only these category can used --}} // 
    protected $categores=['مطاعم', 'مقاهي','اماكن-ترفيهيةومائية','اماكن-اثرية','مراكز-تسوق','فنادق'  ,' اماكن-دينية' ];
   
   
   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   


        return view('posts.index')->with('posts',Post::all())  ;                              
        // ->where("show",1)
    }


    // public function verify()
    // {   
    //     return view('posts.verify')->with('posts',Post::all()->where("show",0));                                
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


      return view('posts.create')->with('categores',$this->categores);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $this->validate($request,[

            'category' => ['required','max:255' ,Rule::in($this->categores) ] ,
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'contente' => 'required',
            'phone_number' => 'nullable|digits:11|numeric',
            'time' =>'nullable|max:255',
            'map' =>'required',
            'image' => "required|image"
        ],[
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
        
     $image = $request->image;
     $image_new_name = time().$image->getClientOriginalName();
     $image->move('uploads/posts',$image_new_name);
    

     
     $post=Post::create([
        'category'      =>$request->category,
        'name'          =>$request->name,
        'city'          =>$request->city,
        'contente'      =>$request->contente,
        'phone_number'  =>$request->phone_number,
        'time'          =>$request->time,
        'map'          =>$request->map,
        'image'         =>'uploads/posts/'.$image_new_name

        ]);
      
        return redirect()->back();
    }
    

    // public function ok( $id)
    // {
    //     $post=Post::find($id);
    //     $post->show = true;
    //     $post->save();
    //   return redirect()->back();

    // }



    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $post =  Post::find($id);
    return view('posts.edit')->with('post',$post)
                             ->with('categores',$this->categores);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        

        $post=Post::find($id);

     

        $this->validate($request,[

            'category' => ['required','max:255' ,Rule::in($this->categores) ] ,
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'contente' => 'required',
            'phone_number' => 'nullable|digits:11|numeric',
            'time' =>'nullable|max:255',
            'map' =>'required',
            'image' => "nullable|image"
        ],[
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
            'image.image'=>               ' صورة المنشور يجب ان تكون على شكل صورة' ,
            'time.max'=>                  'الوقت تجاوز الحد الاقصى للاحرف 255'  ,
            'map.required'=>                  'الخريطة مطلوبة' 

            ]);

        if ($request->hasFile('image') ) {
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads/posts',$image_new_name);

     $post->image = 'uploads/posts/'.$image_new_name;
        }
        $post->category = $request->category;
        $post->name = $request->name;
        $post->city = $request->city;
        $post->contente = $request->contente;
        $post->phone_number = $request->phone_number;
        $post->map = $request->map;
        $post->save();
      return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $posts=Post::find($id);
        $posts->delete($id);
        return redirect()->back();


    }




}
