<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OTPHP\TOTP;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Facades\Session;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    public function showSetupForm()
    {
        $user = auth()->user();


        $totp = TOTP::create();

        $totp->setLabel($user->email);
        $totp->setIssuer('WSGMED');


        $user->google2fa_secret = $totp->getSecret();
        $user->save();


        $qrCodeUri = $totp->getProvisioningUri();


        $renderer = new ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUri);

        return view('2fa.setup', [
            'qrCode' => $qrCodeSvg,
            'secret' => $totp->getSecret(),
        ]);
    }
    
    public function completeSetup(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = auth()->user();
        $totp = TOTP::create($user->google2fa_secret);

        if ($totp->verify($request->input('otp'))) {

            $user->two_factor_confirmed_at = now();
            $user->save();

            return redirect()->route('profile.show');
        }

        return back()->withErrors(['otp' => 'Nieprawidłowy kod uwierzytelniający']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = auth()->user();
        $totp = TOTP::create($user->google2fa_secret);

        if ($totp->verify($request->input('otp'))) {
            Session::put('2fa_passed', true);
            return redirect()->intended();
        }

        return redirect()->back()->withErrors(['otp' => 'Invalid authentication code']);
    }

    public function showPrompt()
    {
        return view('2fa.2fa-prompt');
    }
}

