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
    public function index(Request $request, OfferService $offerService)
    {
        if (Gate::allows('viewAny', Offer::class)) {
            // Authorization passed
            // $offers = Offer::paginate(5);
            $categories = Category::orderBy('title')->get();
            $locations = Location::orderBy('title')->get();
            $offers = $offerService->get($request->query());
            // $offers = Offer::with(['author', 'categories', 'locations'])->paginate(5);
            return view('offers.index', compact('offers', 'categories', 'locations'));
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
    }

    public function myOffers(Request $request, OfferService $offerService)
    {
        if (Gate::allows('viewMy', Offer::class)) {
            $categories = Category::orderBy('title')->get();
            $locations = Location::orderBy('title')->get();
            $offers = $offerService->getMine($request->query());
            return view('offers.index', compact('offers', 'categories', 'locations'));
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
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
            $offerService->store(
                $request->validated(),
                $request->hasFile('image') ? $request->file('image') : null
            );
            return redirect()->back()->with(['success' => 'offer created']);
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $offer->load(['author', 'categories', 'locations']);
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        if (Gate::allows('update', $offer)) {
            $categories = Category::orderBy('title')->get();
            $locations = Location::orderBy('title')->get();
            return view('offers.edit', compact('offer', 'categories', 'locations'));
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferStoreRequest $request, Offer $offer, OfferService $offerService)
    {
        if (Gate::allows('update', $offer)) {
            // Authorization passed
            $offerService->update(
                $offer,
                $request->validated(),
                $request->hasFile('image') ? $request->file('image') : null

            );
            return redirect()->back()->with(['success' => 'offer updated']);
        } else {
            // Authorization failed
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer, OfferService $offerService)
    {
        $offerService->destroy($offer);
        return response('Offer deleted');
    }
}
