<?php
namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    // Listar badges (Público)
    public function index()
    {
        $badges = Badge::orderBy('created_at', 'desc')->get()->map(function($badge) {
            return [
                'id' => $badge->id,
                'name' => $badge->name,
                'description' => $badge->description,
                'criteria' => $badge->criteria,
                'image' => $badge->image_url,
                'issuer' => $badge->issuer,
                '@context' => 'https://w3id.org/openbadges/v2',
                'type' => 'BadgeClass'
            ];
        });

        return response()->json(['success' => true, 'badges' => $badges]);
    }

    // Crear badge (Protegido con API Key)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'criteria' => 'required|string',
            'imageUrl' => 'nullable|url',
            'issuer' => 'nullable|string'
        ]);

        $imageUrl = $validated['imageUrl'] ?? "https://via.placeholder.com/200x200/4F46E5/FFFFFF?text=" . urlencode($validated['name']);

        $badge = Badge::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'criteria' => $validated['criteria'],
            'image_url' => $imageUrl,
            'issuer' => $validated['issuer'] ?? 'Eduhive',
        ]);

        // Formato de respuesta igual a tu create.php actual
        $responseBadge = [
            'id' => $badge->id,
            'name' => $badge->name,
            'description' => $badge->description,
            'criteria' => $badge->criteria,
            'image' => $badge->image_url,
            '@context' => 'https://w3id.org/openbadges/v2',
            'type' => 'BadgeClass'
        ];

        return response()->json(['success' => true, 'badge' => $responseBadge]);
    }
}
