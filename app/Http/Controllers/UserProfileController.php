<?php

// app/Http/Controllers/UserProfileController.php
namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{

    public function show()
    {

        $profile = Auth::user()->profile;

        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;

        $countries = $this->getEuropeanCountries();

        return view('profile.edit', compact('profile', 'countries'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'country' => 'nullable|string|max:100',
        ]);

        $profile = Auth::user()->profile;

        if ($request->hasFile('profile_picture')) {
            // Yeni profil fotoğrafını yükleyelim
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            // Eski profil fotoğrafını silmek isterseniz (eğer var ise)
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }
            $profile->profile_picture = $path;
        }

        $profile->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'country' => $request->country,
        ]);

        return redirect()->route('profile.show')->with('success', 'Profil başarıyla güncellendi!');
    }
    public function showRegisterForm()
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


}

