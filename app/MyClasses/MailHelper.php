<?php

namespace App\MyClasses;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailHelper
{
    /**
     * Dynamically override Laravel's SMTP mailer configuration using database settings.
     */
    public static function configureMail()
    {
        $setting = Setting::where('id', 1)->first();
        if ($setting && !empty($setting->mail_host)) {
            $encryption = $setting->mail_encryption;
            if ($encryption === 'none' || empty($encryption)) {
                $encryption = null;
            }

            Config::set('mail.default', $setting->mail_mailer ?? 'smtp');
            
            Config::set('mail.mailers.smtp.transport', $setting->mail_mailer ?? 'smtp');
            Config::set('mail.mailers.smtp.host', $setting->mail_host);
            Config::set('mail.mailers.smtp.port', (int)($setting->mail_port ?? 587));
            Config::set('mail.mailers.smtp.encryption', $encryption);
            Config::set('mail.mailers.smtp.username', $setting->mail_username);
            Config::set('mail.mailers.smtp.password', $setting->mail_password); // Decrypted automatically by model accessor
            
            Config::set('mail.from.address', $setting->mail_from_address);
            Config::set('mail.from.name', $setting->mail_from_name);

            // Reset Laravel's MailManager instance to force loading the new configuration
            if (app()->resolved('mail.manager')) {
                app()->make('mail.manager')->forgetMailers();
            }
        }
    }

    /**
     * Send a Blade-rendered HTML email dynamically using stored configuration.
     *
     * @param string $to Recipient email address
     * @param string $subject Subject of the email
     * @param string $view Blade view name (e.g. 'emails.otp')
     * @param array $data View data variables
     * @return bool True if successfully sent, false otherwise
     */
    public static function sendMail($to, $subject, $view, $data = [])
    {
        if (empty($to)) {
            return false;
        }

        $setting = Setting::where('id', 1)->first();
        if ($setting && !$setting->mail_status) {
            Log::info("Email notification to {$to} skipped because mail_status is disabled.");
            return true;
        }

        self::configureMail();

        try {
            Mail::send($view, $data, function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            });
            return true;
        } catch (\Throwable $e) {
            Log::error("Failed to send email to {$to}. Error: " . $e->getMessage() . " | Trace: " . $e->getTraceAsString());
            return false;
        }
    }
}
