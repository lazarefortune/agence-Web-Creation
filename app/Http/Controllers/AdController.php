<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAd;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdController extends Controller
{
    use RegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = DB::table('ads')->count();

        $ads = DB::table('ads')->orderBy('created_at', 'desc')->paginate(5);
        return view('monboncoin.ads', compact('ads','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monboncoin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAd  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAd $request)
    {
        $validated = $request->validated();

        if (!Auth::check()) {
            $request->validate([
                'name' => 'required|max:100',
                'contact' => 'required|unique:users|max:100',
                'email' => 'required|unique:users|email|',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);

            $user = User::create([
                'name' => $request['name'],
                'contact' => $request['contact'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $role = Role::select('id')->where('name', 'utilisateur')->first();

            $user->roles()->attach($role);

            $this->guard()->login($user);
        }

        $ad = new Ad();
        $ad->title = $validated['title'];
        $ad->description = $validated['description'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->user_id = auth()->user()->id;
        $ad->save();

        return redirect()->route('monboncoin.ads.index')->with('success', 'Votre annonce a bien été ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::findOrFail($id);


        return view('monboncoin.ad', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ad = Ad::findOrFail($id);

        return view('monboncoin.edit', compact('ad'));

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
        //
        $ad = Ad::findOrFail($id);

        // $validated = $request->validated();

        $validator = Validator::make($request->all(), [
          'title' => ['required', 'string', 'unique:ads,title,'.$ad->title.',title', 'max:150'],
          'description' => ['required', 'string'],
          'price' => ['required', 'numeric'],
          'localisation' => ['required'],
        ]);


        if ($validator->fails()) {
            return redirect()
                        ->route('monboncoin.ads.edit', ['id' => $ad->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $ad->update($request->all());

        return redirect()->route('monboncoin.ads.show', [$ad]);

        // ->with('success', 'Votre annonce a bien été mise à jour.')

        // return view('monboncoin.ad', compact('ad'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Ad::destroy($id);

        flash("Votre annonce a bien été supprimée.")->error();

        // return redirect()->route('monboncoin.ads.index')->with('success', 'Votre annonce a bien été supprimée.');

        return redirect()->route('monboncoin.my-ads');
    }
}
