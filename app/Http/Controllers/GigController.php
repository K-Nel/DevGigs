<?php

namespace App\Http\Controllers;

use App\Models\gig;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use function GuzzleHttp\Promise\all;

class GigController extends Controller
{
    public function index(){
        return view('gigs.index', [
            'gigs'=>gig::latest()->filter(request(['tag', 'search']))->paginate(8) 
        ]);
    }

    public function show(Gig $gig){
        return view('gigs.show',[
            'gig'=>$gig
        ]);
    }

    public function create(){
        return view('gigs.create');
    }

    public function store(){
        $creategigForm = request()->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('gigs', 'company')],
            'location' => 'required',
            'website' => ['required', 'url'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if (request()->hasFile('logo')) {
            $creategigForm['logo'] = request()->file('logo')->store('logos', 'public');
        }

        $creategigForm['user_id'] = auth()->id();

        gig::create($creategigForm);
        return redirect('/')->with('message', 'Gig Created Successfully!!!');
    }

    public function edit(Gig $gig){
        return view('gigs.edit', ['gig'=> $gig]);
    }

    public function update(Gig $gig){
        if ($gig->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action');
        }
        $updategigForm = request()->validate([
            'title' => 'required',
            'company' => 'required', 
            'location' => 'required',
            'website' => ['required', 'url'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if (request()->hasFile('logo')) {
            $updategigForm['logo'] = request()->file('logo')->store('logos', 'public');
        }

        $gig->update($updategigForm);
        return back()->with('message', 'Gig Updated Successfully!!!');
    }

    public function delete(Gig $gig){
        if ($gig->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action');
        }
        $gig-> delete();
        return back()->with('message', 'Gig Deleted Successfully!!!');
    }

    public function manage(){
        return view('gigs.manage', ['gigs' => auth()->user()->gigs()->get()]);
    }
}
