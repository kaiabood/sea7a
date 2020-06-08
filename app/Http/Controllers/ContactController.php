<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class ContactController extends Controller
{

    public function index()
    {   
        return view('contacts.index')->with('contacts',Contact::all());                                
    }


    public function destroy($id)
    {

        $contacts=Contact::find($id);
        $contacts->delete($id);
        return redirect()->back();


    }


}
