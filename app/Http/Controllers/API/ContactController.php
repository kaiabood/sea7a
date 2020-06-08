<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Contact;
use  Validator ;




class ContactController extends BaseController  
{

// public function index()
// {
//     # code...
//     $contacts = Contact::all();
//     return $this->sendResponse($contacts->toArray(), 'contacts read succesfully');
// }


public function store(Request $request)
{



    # code...
    $input = $request->all();
    $validator =    Validator::make($input, [
    'name'=> 'required|max:255',
    'email'=> 'required|max:255|email',
    'message'=> 'required',
    // 'subject'=> 'required|max:255' 
    ] ,[
        'name.max'=> 'الاسم تجاوز الحد الاقصى للاحرف 255 ' ,
        'name.required'=>         'الاسم مطلوبة' ,
        'email.max'=>              'البريدالاكتروني تجاوز الحد الاقصى للاحرف 255' ,
        'email.required'=>             'البريدالاكتروني مطلوب' ,
        'email.email'=>                  'البريدالالكتروني يجب ان يكون بصيغة بريدالكتروني' ,
        'message.required'=>             'المحتوى مطلوب' ,
        // 'subject.max'=>                  'الموضوع تجاوز الحد الاقصى للاحرف 255' ,
        // 'subject.required'=>      'الموضوع مطلوب' ,
        ] );

    if ($validator -> fails()) {
        # code...
        return $this->sendError('error validation', $validator->errors());
    }

    $contacts = Contact::create($input);
    return $this->sendResponse($contacts->toArray(), 'contacts  created succesfully');
    
}






// public function show($id)
// {
//     $contacts = Contact::find($id);
//     if (   is_null($contacts)   ) {
//         # code...
//         return $this->sendError(  'contacts not found ! ');
//     }
//     return $this->sendResponse($contacts->toArray(), 'contacts read succesfully');
    
// }



// update contacts 
// public function update(Request $request ,$id)
// {
//     $input = $request->all();
//     $validator =    Validator::make($input, [
//     'name'=> 'required|max:255',
//     'email'=> 'required|max:255|email',
//     'message'=> 'required',
//     'subject'=> 'required|max:255' 
//     ],
//     [
//         'name.max'=> 'الاسم تجاوز الحد الاقصى للاحرف 255 ' ,
//         'name.required'=>         'الاسم مطلوبة' ,
//         'email.max'=>              'البريدالاكتروني تجاوز الحد الاقصى للاحرف 255' ,
//         'email.required'=>             'البريدالاكتروني مطلوب' ,
//         'email.email'=>                  'البريدالالكتروني يجب ان يكون بصيغة بريدالكتروني' ,
//         'message.required'=>             'المحتوى مطلوب' ,
//         'subject.max'=>                  'الموضوع تجاوز الحد الاقصى للاحرف 255' ,
//         'subject.required'=>      'الموضوع مطلوب' ,
//         ] );
//     $contacts = Contact::find($id);
//     if ($validator -> fails()) {
//         # code...
//         return $this->sendError('error validation', $validator->errors());
//     }
//     $contacts->name =  $input['name'];
//     $contacts->email =  $input['email'];
//     $contacts->message =  $input['message'];
//     $contacts->subject =  $input['subject'];
//     $contacts->save();
//     return $this->sendResponse($contacts->toArray(), 'contacts  updated succesfully');
    
// }





// delete contacts 
// public function destroy($id)
// {
//     $contacts= Contact::find($id);
//     $contacts->delete();

//     return $this->sendResponse($contacts->toArray(), 'contacts  deleted succesfully');
    
// }

    
}