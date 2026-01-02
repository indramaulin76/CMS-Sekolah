<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if no secret key configured (development mode)
        if (empty(config('services.recaptcha.secret_key'))) {
            return;
        }

        if (empty($value)) {
            $fail('Verifikasi reCAPTCHA diperlukan.');
            return;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            return;
        }

        // Check score for v3
        $minScore = config('services.recaptcha.min_score', 0.5);
        if (isset($result['score']) && $result['score'] < $minScore) {
            $fail('Verifikasi keamanan gagal. Silakan coba lagi.');
        }
    }
}
