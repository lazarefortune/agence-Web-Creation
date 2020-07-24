<?php

namespace App\Http\Controllers;
use App\User;
use App\Streaming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use PDF;
class StreamingController extends Controller
{
    //
    protected $contact;



    public function login(Request $request){

      // $login = $request->login;
      //
      // $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'contact';
      //
      // request()->merge([$fieldType => $login]);
      $this->contact = $this->findUsername();


      // $this->validateLogin($request);
      $request->validate([
          $this->username() => 'required|string',
          'password' => 'required|string',
      ]);


      $credentials = $request->only( $this->username() , 'password');

      // dd($credentials);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('streaming.index');
        }else{
          // return redirect()
          //             ->back();
          return back()->withInput()-> withErrors([
            'login' => 'Indisponible'
          ]);
      }

    }

    public function register(Request $request){

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

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('streaming.index');
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // public function username()
    // {
    //     return 'email';
    // }

    public function username()
    {
        return $this->contact;
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'contact';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }



    public function store_netflix($id_forfait){

      $forfait = DB::table('forfait')->where('id', $id_forfait)->first();

      // $test = new Streaming;
      // $val = $test->affiche($id_forfait);


      $stream = Streaming::create([
          'forfait_name' => $forfait->name,
          'user_id' => (auth()->user()->id),
          'forfait_type' => $forfait->type,
          'forfait_price' => $forfait->price,
          'forfait_statut' => 'Non payé',
          // 'forfait_end' => Carbon::now()->addMonth(),
      ]);

      flash("Votre forfait a bien été ajouté. Procédez au paiement")->success();

      return redirect()->route('streaming.account');

    }

    public function account()
    {
      // $streams = Streaming::latest()->paginate(10);
      $streams = (auth()->user())->streamings()->paginate(10);

      return view('streaming.account', compact('streams'));
    }

    public function deleteForfait($id_forfait)
    {
      // dd($id_forfait);
      Streaming::destroy($id_forfait);

      flash("Votre forfait a bien été supprimé.")->error();

      return redirect()->route('streaming.account');
    }

    public function payment(Streaming $stream)
    {
      if ($stream->forfait_statut != "Non payé") {
        return abort(401);
      }
      return view('streaming.payment', compact('stream'));
    }

    /* Preuve du paiement
        Avec blocage de l'accès à la vue dans le cas ou le statut du forfait est différent de "Non payé"
    */
    public function payment_proof(Streaming $stream)
    {
      if ($stream->forfait_statut != "Non payé") {
        return abort(401);
      }
      return view('streaming.payment_proof', compact('stream'));
    }

    // Enregistrement de la preuve du paiement
    public function payment_proof_store(Streaming $stream, Request $request)
    {
      if ($stream->forfait_statut != "Non payé") {
        return abort(401);
      }
      // dd($request->file('proof'));

          // dump($request->file('proof')->getClientOriginalName());
          // dump($request->file('proof'));
          // $request->proof->move($destinationPath, $fileName);

          $request->validate([
              'proof' => 'required|image',
          ]);

          $file = $request->file('proof');
          // dd($file);
          //Display File Name
          // echo 'File Name: '.$file->getClientOriginalName();
          // echo '<br>';

          //Display File Extension
          // echo 'File Extension: '.$file->getClientOriginalExtension();
          // echo '<br>';

          //Display File Real Path
          // echo 'File Real Path: '.$file->getRealPath();
          // echo '<br>';

          //Display File Size
          // echo 'File Size: '.$file->getSize();
          // echo '<br>';

          $path = $file->store('proofs', 'public');

          $stream->forfait_statut = "En cours de validation";
          $stream->path_proof = $path;
          $stream->save();

          return view('streaming.payment_success', compact('stream'));


    }

    public function index()
    {
      $forfaits = DB::table('forfait')->where('name', 'Netflix')->get();
      return view('streaming.index', compact('forfaits'));
    }

    public function getFacturePdf(Streaming $stream)
    {
        $date = Carbon::now();
        // L'instance PDF avec la vue resources/views/posts/show.blade.php
        $pdf = PDF::loadView('streaming.facture', compact('stream', 'date'));

        // Lancement du téléchargement du fichier PDF
        return $pdf->download(\Str::slug('Facture '.$stream->id.' '.$stream->user->name.' '.$stream->created_at, '-').".pdf");
        // return $pdf->stream();
    }




}
