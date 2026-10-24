<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:150',
        ]);

        $subscriber = Newsletter::firstOrCreate(
            ['email' => strtolower(trim($validated['email']))]
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Inspirasi wisata dan promo eksklusif telah kami jadwalkan ke ' . $subscriber->email,
            ]);
        }

        return back()->with('success', 'Terima kasih telah berlangganan newsletter NusantaraWander!');
    }
}
