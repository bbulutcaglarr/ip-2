<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\NotificationSetting;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'email' => 'E-posta veya şifre hatalı.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',

        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $user->profile()->create([
            'address' => $request->address,
            'phone' => $request->phone,
            'country' => $request->country,
        ]);


        Auth::login($user);


        NotificationSetting::create([
            'user_id' => $user->id,
            'email_notifications' => true,
            'sms_notifications' => false,
            'push_notifications' => true,
        ]);


        return redirect()->route('notifications.index')->with('success', 'Kayıt başarıyla tamamlandı!');

    }

    public function showRegistrationForm()
    {

        $countries = $this->getEuropeanCountries();
        return view('auth.register', compact('countries'));
    }

    public function getEuropeanCountries()
    {
        return [
            'Almanya' => 'Germany',
            'Arnavutluk' => 'Albania',
            'Avusturya' => 'Austria',
            'Belçika' => 'Belgium',
            'Bosna-Hersek' => 'Bosnia and Herzegovina',
            'Bulgaristan' => 'Bulgaria',
            'Hırvatistan' => 'Croatia',
            'Çek Cumhuriyeti' => 'Czech Republic',
            'Danimarka' => 'Denmark',
            'Estonya' => 'Estonia',
            'Finlandiya' => 'Finland',
            'Fransa' => 'France',
            'Yunanistan' => 'Greece',
            'Macaristan' => 'Hungary',
            'İzlanda' => 'Iceland',
            'Irlanda' => 'Ireland',
            'İtalya' => 'Italy',
            'Karadağ' => 'Montenegro',
            'Hollanda' => 'Netherlands',
            'Polonya' => 'Poland',
            'Portekiz' => 'Portugal',
            'Romanya' => 'Romania',
            'Sırbistan' => 'Serbia',
            'Slovakya' => 'Slovakia',
            'Slovenya' => 'Slovenia',
            'İspanya' => 'Spain',
            'İsveç' => 'Sweden',
            'İsviçre' => 'Switzerland',
            'Birleşik Krallık' => 'United Kingdom',
            'Ukrayna' => 'Ukraine',
            'Türkiye' => 'Turkey',
        ];
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

