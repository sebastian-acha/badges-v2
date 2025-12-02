<?php
namespace App\Http\Controllers;

use App\Models\Assertion;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssertionController extends Controller
{
    // Emitir Badge (Protegido)
    public function store(Request $request)
    {
        $request->validate([
            'badgeId' => 'required|exists:badges,id',
            'recipient.email' => 'required|email',
            'recipient.name' => 'required|string',
            'evidence' => 'nullable|url'
        ]);

        $badge = Badge::find($request->badgeId);
        
        // Lógica de hash igual a tu issue.php
        $recipientHash = 'sha256$' . hash('sha256', $request->input('recipient.email'));
        $assertionId = 'urn:uuid:' . Str::uuid();

        $assertion = Assertion::create([
            'assertion_id' => $assertionId,
            'badge_id' => $badge->id,
            'recipient_name' => $request->input('recipient.name'),
            'recipient_email' => $request->input('recipient.email'),
            'recipient_hash' => $recipientHash,
            'issued_on' => now(),
            'evidence' => $request->input('evidence')
        ]);

        // Construir JSON de respuesta
        $responseAssertion = [
            'id' => $assertionId,
            'type' => 'Assertion',
            '@context' => 'https://w3id.org/openbadges/v2',
            'badge' => [
                'name' => $badge->name,
                'description' => $badge->description,
                'criteria' => $badge->criteria,
                'image' => $badge->image_url
            ],
            'recipient' => [
                'type' => 'email',
                'identity' => $recipientHash,
                'hashed' => true
            ],
            'recipientName' => $assertion->recipient_name,
            'issuedOn' => $assertion->issued_on->toIso8601String(),
            'verification' => [
                'type' => 'hosted',
                'url' => url('/api/assertions/' . $assertionId) 
            ]
        ];

        return response()->json(['success' => true, 'assertion' => $responseAssertion]);
    }

    // Obtener Assertion pública (get.php)
    public function show($assertionId)
    {
        // En tu código original pasabas ?id=... aquí usaremos la URL limpia
        $assertion = Assertion::with('badge')->where('assertion_id', $assertionId)->first();

        if (!$assertion) {
            return response()->json(['error' => 'Assertion no encontrada'], 404);
        }

        $response = [
            'id' => $assertion->assertion_id,
            'type' => 'Assertion',
            '@context' => 'https://w3id.org/openbadges/v2',
            'badge' => [
                'name' => $assertion->badge->name,
                'description' => $assertion->badge->description,
                'criteria' => $assertion->badge->criteria,
                'image' => $assertion->badge->image_url
            ],
            'recipient' => [
                'type' => 'email',
                'identity' => $assertion->recipient_hash,
                'hashed' => true
            ],
            'issuedOn' => $assertion->issued_on,
            'verification' => [
                'type' => 'hosted'
            ]
        ];

        if ($assertion->evidence) {
            $response['evidence'] = $assertion->evidence;
        }

        return response()->json($response);
    }
}