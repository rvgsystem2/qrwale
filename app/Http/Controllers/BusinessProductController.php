<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessProductController extends Controller
{
   public function index(Business $business)
{
    $this->authorizeBusiness($business);

    $products = $business->products()
        ->orderBy('sort_order')
        ->orderByDesc('id')
        ->paginate(20);

    return view(
        'business_products.index',
        compact('business', 'products')
    );
}

    public function create(Business $business)
    {
        $this->authorizeBusiness($business);

        return view('business_products.form', [
            'business' => $business,
            'product' => new BusinessProduct(),
        ]);
    }

    public function store(Request $request, Business $business)
    {
        $this->authorizeBusiness($business);

        $data = $this->validateProduct($request);

        $data['business_id'] = $business->id;
        $data['is_active'] = $request->boolean('is_active');

        $data['image'] = $request->file('image')
            ->store('business-products', 'public');

        BusinessProduct::create($data);

        return redirect()
            ->route('business-products.index', $business)
            ->with('success', 'Product added successfully.');
    }

    public function edit(
        Business $business,
        BusinessProduct $product
    ) {
        $this->authorizeBusiness($business);
        $this->ensureProductBelongsToBusiness($business, $product);

        return view(
            'business_products.form',
            compact('business', 'product')
        );
    }

    public function update(
        Request $request,
        Business $business,
        BusinessProduct $product
    ) {
        $this->authorizeBusiness($business);
        $this->ensureProductBelongsToBusiness($business, $product);

        $data = $this->validateProduct(
            $request,
            imageRequired: false
        );

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);

            $data['image'] = $request->file('image')
                ->store('business-products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('business-products.index', $business)
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(
        Business $business,
        BusinessProduct $product
    ) {
        $this->authorizeBusiness($business);
        $this->ensureProductBelongsToBusiness($business, $product);

        Storage::disk('public')->delete($product->image);

        $product->delete();

        return back()->with(
            'success',
            'Product deleted successfully.'
        );
    }

    private function validateProduct(
        Request $request,
        bool $imageRequired = true
    ): array {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                $imageRequired ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'offer_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'button_text' => [
                'nullable',
                'string',
                'max:50',
            ],

            'button_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);
    }

    private function authorizeBusiness(Business $business): void
    {
        abort_unless(
            auth()->user()->hasRole('Super Admin') ||
            (int) $business->user_id === (int) auth()->id(),
            403
        );
    }

    private function ensureProductBelongsToBusiness(
        Business $business,
        BusinessProduct $product
    ): void {
        abort_unless(
            (int) $product->business_id === (int) $business->id,
            404
        );
    }
}
