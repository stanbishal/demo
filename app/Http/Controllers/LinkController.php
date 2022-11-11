<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function shortenURL(Request $request)
    {
        $validatedData = $request->validate([
            'original_url' => 'required|string',
            'expires_on' => 'nullable|date'
        ]);

        $validatedData['short_url'] = $this->getUniqueCode();
        if(Auth::user())
        {
            $validatedData['user_id'] = Auth::user()->id;
        }
        Link::create($validatedData);

        return redirect()->back()->with('success',route('short.link',$validatedData['short_url']));

    }

    public function shortLink($code)
    {
        $data = Link::where('short_url', $code)->firstorfail();  
        
        if(Carbon::now()<Carbon::make($data->expires_on))
        {
            return redirect($data->original_url,302);  
        }
        else
        {
            return 'Link already expired';
        }
    }

    private function getUniqueCode($length=5)
    {
        $data = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle(str_repeat($data, 5)), 0, $length);
        
        $codeExists = Link::where('short_url',$code)->count();

        if($codeExists>0)
        {
            $this->getUniqueCode();
        }

        return $code;

    }
}
