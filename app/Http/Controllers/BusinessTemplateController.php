<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessTemplateRequest;
use App\Models\Business;
use App\Models\BusinessTemplate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BusinessTemplateController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:Super Admin'),
        ];
    }


    public function previewDesign(string $viewKey)
{
    $availableViews = config(
        'business_templates.views',
        []
    );

    abort_unless(
        isset($availableViews[$viewKey]),
        404,
        'Selected HTML design was not found.'
    );

    $viewName = $availableViews[$viewKey]['view']
        ?? null;

    abort_unless(
        $viewName && view()->exists($viewName),
        404,
        'Template Blade file was not found.'
    );

    $business = new Business([
        'bussiness_name' => 'Demo Solar Energy',
        'tagline' => 'Powering a Cleaner Tomorrow',
        'description' => 'Professional solar solutions for homes, businesses and industries.',
        'business_category' => 'Solar Energy',
        'contact_person' => 'Demo Contact Person',
        'mobile_number' => '9876543210',
        'alternate_mobile' => '9123456780',
        'watsapp_url' => '9876543210',
        'email' => 'hello@example.com',
        'address' => 'Business Address, City, India',
        'opening_hours' => 'Monday–Saturday, 10 AM–7 PM',
        'gstin' => '09ABCDE1234F1Z5',
        'msme_number' => 'UDYAM-UP-00-0000000',
        'rating' => 4.8,
        'website_url' => 'https://example.com',
        'google_map_url' => 'https://maps.google.com',
        'fb_url' => 'https://facebook.com',
        'insta_url' => 'https://instagram.com',
        'linkden_url' => 'https://linkedin.com',
        'twiter_url' => 'https://x.com',
        'youtube_url' => 'https://youtube.com',
        'review_url' => 'https://google.com',
    ]);

    /*
     * URL query से live selected colors आएंगे।
     */
    $template = new BusinessTemplate([
        'name' => request(
            'name',
            'Template Preview'
        ),

        'view_key' => $viewKey,

        'layout' => request(
            'layout',
            'split'
        ),

        'card_style' => request(
            'card_style',
            'soft'
        ),

        'primary_color' => $this->validPreviewColor(
            request('primary_color'),
            '#047857'
        ),

        'secondary_color' => $this->validPreviewColor(
            request('secondary_color'),
            '#0f172a'
        ),

        'accent_color' => $this->validPreviewColor(
            request('accent_color'),
            '#f59e0b'
        ),

        'background_color' => $this->validPreviewColor(
            request('background_color'),
            '#ecfdf5'
        ),

        'is_active' => true,
    ]);

    $business->setRelation(
        'template',
        $template
    );

    $business->setRelation(
        'products',
        collect()
    );

    return view(
        $viewName,
        compact('business')
    )->with('previewMode', true);
}

private function validPreviewColor(
    ?string $color,
    string $fallback
): string {
    if (
        $color &&
        preg_match('/^#[0-9A-Fa-f]{6}$/', $color)
    ) {
        return $color;
    }

    return $fallback;
}


    public function index()
    {
        $templates = BusinessTemplate::query()
            ->withCount('businesses')
            ->latest()
            ->get();

        return view(
            'business-templates.index',
            compact('templates')
        );
    }

    public function create()
    {
        return view('business-templates.form', [
            'businessTemplate' => new BusinessTemplate(),
        ]);
    }

    public function edit(
        BusinessTemplate $businessTemplate
    ) {
        return view(
            'business-templates.form',
            compact('businessTemplate')
        );
    }

    public function store(
        BusinessTemplateRequest $request
    ) {
        $template = DB::transaction(
            function () use ($request) {
                $data = $this->data($request);

                if ($data['is_default']) {
                    BusinessTemplate::query()->update([
                        'is_default' => false,
                    ]);
                }

                return BusinessTemplate::create($data);
            }
        );

        return redirect()
            ->route(
                'business-templates.edit',
                $template
            )
            ->with(
                'success',
                'Template created successfully.'
            );
    }

    public function update(
        BusinessTemplateRequest $request,
        BusinessTemplate $businessTemplate
    ) {
        DB::transaction(
            function () use (
                $request,
                $businessTemplate
            ) {
                $data = $this->data($request);

                /*
                 * Current default template ko directly
                 * non-default नहीं होने देंगे।
                 */
                if (
                    $businessTemplate->is_default &&
                    !$data['is_default']
                ) {
                    $data['is_default'] = true;
                }

                if ($data['is_default']) {
                    BusinessTemplate::query()
                        ->where(
                            'id',
                            '!=',
                            $businessTemplate->id
                        )
                        ->update([
                            'is_default' => false,
                        ]);
                }

                $businessTemplate->update($data);
            }
        );

        return back()->with(
            'success',
            'Template updated successfully.'
        );
    }

    public function destroy(
        BusinessTemplate $businessTemplate
    ) {
        if ($businessTemplate->is_default) {
            return back()->with(
                'error',
                'Default template cannot be deleted. Make another template default first.'
            );
        }

        if ($businessTemplate->businesses()->exists()) {
            return back()->with(
                'error',
                'This template is currently being used by businesses. Change those businesses first.'
            );
        }

        $businessTemplate->delete();

        return back()->with(
            'success',
            'Template deleted successfully.'
        );
    }

    public function preview(
        BusinessTemplate $businessTemplate
    ) {
        $business = new Business([
            'bussiness_name' => 'Your Business Name',
            'tagline' => 'Your trusted business partner',
            'description' => 'This is a live preview of your reusable business profile template.',
            'business_category' => 'Business Services',
            'contact_person' => 'Contact Person',
            'mobile_number' => '9876543210',
            'alternate_mobile' => '9123456780',
            'watsapp_url' => '9876543210',
            'email' => 'hello@example.com',
            'address' => 'Business address, City, India',
            'opening_hours' => 'Mon–Sat, 10 AM–7 PM',
            'gstin' => '09ABCDE1234F1Z5',
            'msme_number' => 'UDYAM-UP-00-0000000',
            'rating' => 4.8,
            'website_url' => 'https://example.com',
            'google_map_url' => 'https://maps.google.com',
            'fb_url' => 'https://facebook.com',
            'insta_url' => 'https://instagram.com',
            'youtube_url' => 'https://youtube.com',
        ]);

        $business->setRelation(
            'template',
            $businessTemplate
        );

        /*
         * HTML templates me products relationship
         * check hone par error नहीं आएगा।
         */
        $business->setRelation(
            'products',
            collect()
        );

        $viewName = $this->resolveTemplateView(
            $businessTemplate
        );

        return view(
            $viewName,
            compact('business')
        )->with('previewMode', true);
    }


    private function data(
    BusinessTemplateRequest $request
): array {
    $data = $request->validated();

    $data['slug'] = Str::slug(
        $data['slug']
    );

    $data['view_key'] = filled(
        $request->input('view_key')
    )
        ? $request->input('view_key')
        : null;

    $data['is_active'] = $request->boolean(
        'is_active'
    );

    $data['is_default'] = $request->boolean(
        'is_default'
    );

    return $data;
}



private function resolveTemplateView(
    BusinessTemplate $template
): string {
    /*
     * Empty view_key = आपका पुराना qr_page template.
     */
    if (blank($template->view_key)) {
        return 'business.qr_page';
    }

    $viewName = config(
        'business_templates.views.'
            . $template->view_key
            . '.view'
    );

    if (
        blank($viewName) ||
        !view()->exists($viewName)
    ) {
        return 'business.qr_page';
    }

    return $viewName;
}

    private function dataOdls(
        BusinessTemplateRequest $request
    ): array {
        $data = $request->validated();

        $data['slug'] = Str::slug(
            $data['slug']
        );

        /*
         * Empty selection ko NULL save करेंगे।
         * NULL मतलब dynamic business.qr_page.
         */
        $data['view_key'] = filled(
            $request->input('view_key')
        )
            ? $request->input('view_key')
            : null;

        $data['is_active'] = $request->boolean(
            'is_active'
        );

        $data['is_default'] = $request->boolean(
            'is_default'
        );

        return $data;
    }

    private function resolveTemplateViewOld(
        BusinessTemplate $template
    ): string {
        /*
         * HTML design select नहीं किया गया तो
         * existing dynamic template खुलेगा।
         */
        if (blank($template->view_key)) {
            return 'business.qr_page';
        }

        $viewName = config(
            'business_templates.views.'
                . $template->view_key
                . '.view'
        );

        /*
         * गलत key/file होने पर भी application
         * dynamic template पर fallback करेगी।
         */
        if (
            !$viewName ||
            !view()->exists($viewName)
        ) {
            return 'business.qr_page';
        }

        return $viewName;
    }
}
