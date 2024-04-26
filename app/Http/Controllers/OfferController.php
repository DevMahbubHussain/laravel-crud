<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferStoreRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Http\Request;
use App\Policies\OfferPolicy;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();
        return view('offers.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferStoreRequest $request, OfferService $offerService)
    {
        // authorization check
        //  $this->authorize('create', Offer::class);
        // data validation

        // merge author data 

        //save data 
        // $offer = Offer::create($data);
        // $offer->categories()->sync($request->get('categories'));
        // $offer->locations()->sync($request->get('locations'));
        // $this->authorize('create', Offer::class);

        // $offerService->store($request->validated());
        // return redirect()->back();


        if (Gate::allows('create', Offer::class)) {
            // Authorization passed
            $offerService->store($request->validated());
            return redirect()->back()->with(['success' => 'offer created']);
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
