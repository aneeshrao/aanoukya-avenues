<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteContentController extends Controller
{
    public function edit(): View
    {
        $content = SiteContent::mergedContent();

        return view('admin.site-content.edit', compact('content'));
    }

    public function update(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'content' => ['required', 'array'],
        ]);

        $incoming = is_array($payload['content'] ?? null) ? $payload['content'] : [];
        $merged = array_replace_recursive(SiteContent::defaultContent(), $incoming);

        $siteContent = SiteContent::current();
        $siteContent->update([
            'content' => $this->normalizeArray($merged),
        ]);

        return redirect()->route('admin.site-content.edit')->with('status', 'Site content updated.');
    }

    private function normalizeArray(array $value): array
    {
        $normalized = [];

        foreach ($value as $key => $item) {
            if (is_array($item)) {
                $processed = $this->normalizeArray($item);

                if (array_is_list($item)) {
                    $processed = array_values(array_filter($processed, static function ($entry): bool {
                        if (is_string($entry)) {
                            return $entry !== '';
                        }

                        if (is_array($entry)) {
                            foreach ($entry as $entryValue) {
                                if ($entryValue !== '' && $entryValue !== null) {
                                    return true;
                                }
                            }

                            return false;
                        }

                        return $entry !== null;
                    }));
                }

                $normalized[$key] = $processed;

                continue;
            }

            if (is_string($item)) {
                $normalized[$key] = trim($item);

                continue;
            }

            $normalized[$key] = $item;
        }

        return $normalized;
    }
}
