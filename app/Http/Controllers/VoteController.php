<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Website;

class VoteController extends Controller
{
    public function store(Request $request, $websiteId)
    {
        $user = $request->user();
        $vote = Vote::firstOrCreate([
            'user_id' => $user->id,
            'website_id' > $websiteId
        ]);

        return response()->json($vote, 201);

    }

    public function destroy(Request $request, $websiteId)
    {
        $user = $request->user();

        $vote = Vote::where('user_id', $user->id)
                    ->where('website_id', $websiteId)
                    ->firstOrFail();

        $vote->delete();

        return response()->json(null, 204);

    }
}
