<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function store(Request $request){
        $cleanData =  request()->validate([
            'city'=>['required'],
            ''=>['required'],
            'intro'=>['required'],
            'category_id'=>['required',Rule::exists('categories','id')],
            'description'=>['required']
        ]);

        $path = request()->file('photo')->store('/images');
        $cleanData['photo'] = $path;

        $cleanData['user_id'] = auth()->id();
        Blog::create($cleanData);

       return redirect('/');
    }
}
