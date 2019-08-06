<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function confirmUser($id){
        $updatedContact = Contact::whereId($id)->update([
            'confirmed' => true
        ]);

        return response()->json($updatedContact, 200);
    }

    public function index()
    {
        $contacts = Contact::whereUserId(Auth::id())->get();

        return response()->json($contacts, 200);
    }

    public function create()
    {
        return view('contact/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:contacts',
        ]);
        
        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('contact');
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $updatedContact = Contact::whereId($id)->update([
                'name' => $request->name,
                'phone' => $request->phone
            ]);
            return response()->json(Contact::whereId($id)->get(), 200);
        }
    
        catch (Exception $e) {
            return response()->json($e->getMessage(), 201);
        }

    }

    public function destroy($id)
    {
        try 
        {
            return response()->json(Contact::whereId($id)->delete(), 200);
        }
    
        catch (Exception $e) {
            return response()->json($e->getMessage(), 201);
        }
    
    }
}
