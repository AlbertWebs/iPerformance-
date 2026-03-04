<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    protected $fillable = [
        'terms_content',
        'privacy_content',
    ];

    /**
     * Get the singleton legal pages (first row).
     */
    public static function current(): self
    {
        $legal = static::first();
        if ($legal) {
            return $legal;
        }
        return new static([
            'terms_content' => self::defaultTermsContent(),
            'privacy_content' => self::defaultPrivacyContent(),
        ]);
    }

    protected static function defaultTermsContent(): string
    {
        return '<h2>Terms and Conditions</h2>
<p>Welcome to iPerformance Africa. By registering and using our services, you agree to these terms.</p>
<h3>1. Acceptance</h3>
<p>By creating an account, you accept these Terms and Conditions and our Privacy Policy.</p>
<h3>2. Use of Services</h3>
<p>You agree to use our workshops, training, and certification services only for lawful purposes and in accordance with these terms.</p>
<h3>3. Account</h3>
<p>You are responsible for keeping your login details secure and for all activity under your account.</p>
<h3>4. Changes</h3>
<p>We may update these terms from time to time. Continued use of the site after changes constitutes acceptance.</p>
<h3>5. Contact</h3>
<p>For questions about these terms, please contact us via the contact page.</p>';
    }

    protected static function defaultPrivacyContent(): string
    {
        return '<h2>Privacy Policy</h2>
<p>iPerformance Africa respects your privacy. This policy describes how we collect, use, and protect your information.</p>
<h3>1. Information We Collect</h3>
<p>We collect information you provide when registering (name, email, phone, organization details) and when you use our services (e.g. bookings, certificates).</p>
<h3>2. How We Use It</h3>
<p>We use your information to provide services, send relevant communications, issue certificates, and improve our offerings.</p>
<h3>3. Data Security</h3>
<p>We take reasonable measures to protect your personal data from unauthorized access or disclosure.</p>
<h3>4. Sharing</h3>
<p>We do not sell your data. We may share information with service providers necessary to operate our business (e.g. payment processing), subject to confidentiality.</p>
<h3>5. Your Rights</h3>
<p>You may request access to or correction of your personal data by contacting us.</p>
<h3>6. Updates</h3>
<p>We may update this Privacy Policy from time to time. The current version will be posted on this page.</p>';
    }
}
