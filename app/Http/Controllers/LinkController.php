<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function shortenURL(Request $request)
    {
        $validatedData = $request->validate([
            'original_url' => 'required|string',
            'expires_on' => 'nullable|date',
        ]);

        $validatedData['short_url'] = $this->getUniqueCode();
        $this->link->create($validatedData);
        return redirect()->back()->with('success',route( 'short.link', $validatedData['short_url']));
    }

    public function shortLink(string $code) 
    {
        $link = $this->link->where('short_url', $code)->withTrashed()->firstorfail();  

        if($link->deleted_at) {
            return response('The url cannot be found.It is deleted',410);
        } elseif ($link->expires_on == null || Carbon::now() < Carbon::make($link->expires_on)) {
            $link->update(['counter' => $link->counter+1]);
            return redirect($link->original_url,302);  
        } else {
            return response('Link already expired');
        }
    }

    private function getUniqueCode(int $length = 5): ?string 
    {
        $data = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle(str_repeat($data, 5)), 0, $length);  
        $codeExists = $this->link->where('short_url',$code)->count();
        ($codeExists>0) ? $this->getUniqueCode() : null;
        return $code;
    }
}
