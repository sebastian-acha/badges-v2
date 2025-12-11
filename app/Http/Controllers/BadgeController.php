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
            // Aceptamos archivo O url de texto
            'image_file' => 'nullable|image|max:2048', // Max 2MB
            'imageUrl' => 'nullable|url',
            'issuer' => 'nullable|string'
        ]);

        $finalImageUrl = "https://via.placeholder.com/200x200?text=" . urlencode($validated['name']);

        // 1. Prioridad: Si viene un archivo del editor (canvas)
        if ($request->hasFile('image_file')) {
            // Guarda en storage/app/public/badges
            $path = $request->file('image_file')->store('badges', 'public');
            // Genera la URL pública (ej: http://tusitio.test/storage/badges/nombre.png)
            $finalImageUrl = asset('storage/' . $path);
        } 
        // 2. Si no, usar la URL de texto si existe
        elseif (!empty($validated['imageUrl'])) {
            $finalImageUrl = $validated['imageUrl'];
        }

        $badge = Badge::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'criteria' => $validated['criteria'],
            'image_url' => $finalImageUrl,
            'issuer' => $validated['issuer'] ?? 'Eduhive',
        ]);

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
