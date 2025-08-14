<?php

namespace App\Http\Controllers;

use App\Models\FaQ;
use App\Http\Requests\StoreFaQRequest;
use App\Http\Requests\UpdateFaQRequest;

class FaQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = FaQ::orderByDesc('order')->take(6)->get();
        return view('faq.index', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faq = null;
        return view('faq.create', compact('faq'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaQRequest $request)
    {
        $faq = FaQ::create($request->all());

        return redirect()->route('faq.index')->with('success','New FaQ successfuly added');
    }

    /**
     * Display the specified resource.
     */
    public function show(FaQ $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaQ $faq)
    {
        return view('faq.create', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaQRequest $request, FaQ $faq)
    {
        $faq->update($request->all());

        return redirect()->route('faq.index')->with('success','FaQ successfuly edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaQ $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')->with('success','FaQ successfuly removed');
    }
}
