<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Participant;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('registration');
    }

    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        $participant = Participant::create($request->validated());

        return redirect()->route('registration.thank-you', $participant);
    }

    public function thankYou(Participant $participant): View
    {
        $token = (string) $participant->checkin_token;

        return view('thank-you', [
            'participant' => $participant,
            'checkinToken' => $token,
            'qrImageSrc' => $this->buildCheckinQrDataUri($token),
        ]);
    }

    private function buildCheckinQrDataUri(string $checkinToken): ?string
    {
        try {
            $builder = new Builder(
                writer: new PngWriter,
                writerOptions: [],
                validateResult: false,
                data: $checkinToken,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::Medium,
                size: 200,
                margin: 6,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );

            return $builder->build()->getDataUri();
        } catch (Throwable) {
            return null;
        }
    }
}
