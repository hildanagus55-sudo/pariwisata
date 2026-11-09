<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Newsletter::latest();

        if ($search) {
            $query->where('email', 'like', "%{$search}%");
        }

        $newsletters = $query->paginate(20)->withQueryString();
        $totalSubscribers = Newsletter::count();

        return view('admin.newsletters.index', compact('newsletters', 'search', 'totalSubscribers'));
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $email = $newsletter->email;
        $newsletter->delete();

        return back()->with('success', 'Email ' . $email . ' berhasil dihapus dari daftar warta.');
    }
}
