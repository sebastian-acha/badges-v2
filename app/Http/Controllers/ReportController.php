<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Assertion;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $badgeCount = Badge::count();
        $assertionCount = Assertion::count();
        $latestBadges = Badge::orderBy('created_at', 'desc')->take(5)->get();
        $latestAssertions = Assertion::with('badge')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.reports.index', compact('badgeCount', 'assertionCount', 'latestBadges', 'latestAssertions'));
    }
}
