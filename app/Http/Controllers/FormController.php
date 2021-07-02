<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use Inertia\Inertia;
use Mockery\Matcher\Type;


class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('forms')->get();
        return Inertia::render('App', ['data' => $data]);
    }

    public function citylist()
    {
        $city = DB::table('cities')->get();

        return $city;
    }

    public function distlist($id)
    {
        $dist = DB::table('districts')->where('city_id', $id)->get();
        // dd($dist);
        return $dist;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function edituser($id)
    // {
    //     $userid=DB::table('forms')->where('id',$id)->first();

    //     echo $userid;
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('forms')->where('id', $id)->first();
        return Inertia::render('Form', ['user' => $user])->with(['message' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Form $form)
    {
        $data = Form::find($id);
        $request->validate([
            // 'fname' => ['required','max:20'],
            // 'lname' => ['required'],
            // 'balance' => ['required','min:10','max:1000'],
            // 'password' => ['required'],
            // 'phone' => ['required',Rule::phone()->country(['US', 'BE'])],
            // 'phone' => ['required','min:11','numeric'],
            // 'birth_day'=>['required'],
            // 'natification'=>['required'],
            // 'city_name'=>['required'],
        ]);
        $data->fname = $request->input('fname');
        $data->lname = $request->input('lname');
        $data->balance = $request->input('balance');
        $data->password = $request->input('password');
        $data->phone = $request->input('phone');
        $data->birth_day = $request->input('birth_day');
        $data->city_name = $request->input('city_name');
        $data->district_name = $request->input('district_name');
        $data->natification = $request->input('natification');

        // $data->p_image = $request->input('p_image');

        $data->save();


        return Inertia::render('Form', ['user' => $data]);
    }

    public function imageUpload(Request $request, $id, Form $form)
    {
        $photo = Form::find($id);
        if ($request->file('p_image') != null) {
            $photo->p_image = Storage::putFile('public', $request->file('p_image'));
        }
        // dd($photo);
        $photo->save();

        return $photo;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
