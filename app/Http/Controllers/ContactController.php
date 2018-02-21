<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use function MongoDB\BSON\toJSON;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\Datatables\Datatables;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact, Request $request)
    {
    //    $contact = Contact::all();
    //    if($request->ajax())
    //    {
    //        return Datatables::of($contact)->toJson();
    //    };
        return view('contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contact $contact)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email']
        ];

        return Contact::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Contact::find($id);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);

        return $contact;
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
        $contact = Contact::find($id);
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->update();


        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
    }

    public function apiContact()
    {
        $contact =  Contact::all();

        return datatables::of($contact)
            ->addColumn('action', function ($contact){
                return
                    '<a onclick="showData('.$contact->id.')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i>Show</a>' .
                    '<a onclick="editForm('.$contact->id.')" class="btn btn-primary btn-xs">
                    <i class="glyphicon glyphicon-edit"></i>Edit</a>'.
                    '<a onclick="deleteData('.$contact->id.')" class="btn btn-danger btn-xs">
                    <i class="glyphicon glyphicon-trash"></i>Delete</a>';
            })->make(true);
    }
}
