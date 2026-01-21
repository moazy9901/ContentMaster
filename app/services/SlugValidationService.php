<?php

namespace App\Services;
use Illuminate\Http\Request;

class SlugValidationService
{
    
     //Validate slug format and uniqueness for any model
    public static function validate(Request $request, string $modelClass)
    {
        $slug = $request->slug;
        $ignoreId = $request->article_id ?? $request->category_id ?? null;

        // 1 Validate format
        if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9\-_]*$/', $slug)) {
            return response()->json([
                'valid' => false,
                'message' => __('site.invalid_format')
            ]);
        }

        // 2 Check uniqueness
        $exists = $modelClass::where("slug", $slug)
            ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
            ->exists();

        if ($exists) {
            return response()->json([
                'valid' => false,
                'message' => __('site.taken')
            ]);
        }

        // 3 Valid slug
        return response()->json([
            'valid' => true,
            'message' => __('site.available')
        ]);
    }
}
