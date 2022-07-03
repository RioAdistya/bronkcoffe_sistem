<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
    use AuthenticatesUsers;
  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
 
    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'owner') {
                Alert::success('Login Berhasil!', 'Sebagai Owner')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
                return redirect()->route('home');
            }else if (auth()->user()->type == 'produksi') {
                Alert::success('Login Berhasil!', 'Sebagai Karyawan Produksi Kopi')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
                return redirect()->route('produksi.home');
            }else if (auth()->user()->type == 'kedai'){
                Alert::success('Login Berhasil!', 'Sebagai Karyawan Kedai Kopi')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
                return redirect()->route('kedai.home');
            }
        }else{
            Alert::warning('Login Gagal!', 'Email atau Password Salah! Harap ulangi kembali')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
            return redirect()->route('login');
        }
    }

    public function logout()
    {   
        Session::flush();
        auth()->logout();
        return redirect('/');
    }
}