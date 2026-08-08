<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentManagement;

class CmsPageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'meta_title' => 'Privacy Policy — AES Energy',
                'meta_keyword' => 'privacy policy, solar privacy, AES energy data protection',
                'meta_description' => 'Read how AES Energy collects, safeguards, and respects your personal and rooftop information.',
                'active' => 1,
                'description' => '
                    <h2>1. Information We Collect</h2>
                    <p>At AES Energy, we respect your privacy. When you request a rooftop survey, register as a customer on the AES One portal, or submit a referral, we collect relevant contact information (name, mobile number, email, installation address, electricity consumer number, and electricity bill details).</p>

                    <h2>2. How We Use Your Data</h2>
                    <p>Your data is used strictly to:</p>
                    <ul>
                        <li>Design and optimize your solar plant capacity based on your roof space and DISCOM sanction load.</li>
                        <li>Submit your PM Surya Ghar subsidy application on the national portal.</li>
                        <li>Process net-metering synchronization with your local distribution utility (e.g. MSEDCL, TPDDL, etc.).</li>
                        <li>Track system performance, schedule maintenance visits, and credit referral rewards.</li>
                    </ul>

                    <h2>3. Data Security & Storage</h2>
                    <p>All sensitive information, including OTP authentication logs and engineering drawings, is encrypted using industry-grade SSL/TLS protocols. We never sell, rent, or trade your personal information with unauthorized third parties.</p>

                    <h2>4. Your Rights</h2>
                    <p>You can view, update, or request the deletion of your customer profile at any time through the AES One Dashboard or by contacting <a href="mailto:support@aesenergy.in">support@aesenergy.in</a>.</p>
                ',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'meta_title' => 'Terms & Conditions — AES Energy',
                'meta_keyword' => 'terms and conditions, solar installation terms, service agreement',
                'meta_description' => 'Standard terms and conditions governing rooftop solar EPC, subsidies, and maintenance services by AES Energy.',
                'active' => 1,
                'description' => '
                    <h2>1. Scope of Solar EPC Services</h2>
                    <p>AES Energy delivers turnkey rooftop solar engineering, procurement, installation, liaisoning with DISCOMs, and commissioning services across residential, housing society, and commercial properties.</p>

                    <h2>2. Site Feasibility & Structural Approval</h2>
                    <p>All installations are subject to a physical structural load assessment and shadow analysis. If the rooftop requires civil reinforcement or elevated HDG superstructures, customized fabrication quotes are provided prior to installation.</p>

                    <h2>3. Milestone Payments & Subsidy Processing</h2>
                    <p>Project milestones are clearly documented in your Installation Agreement. Direct Benefit Transfer (DBT) subsidies under the PM Surya Ghar Muft Bijli Yojana are disbursed directly into the customer’s bank account by the Ministry of New & Renewable Energy (MNRE) upon net-meter installation.</p>

                    <h2>4. Referral & Wallet Credit Terms</h2>
                    <p>Referral bonus credits are awarded exclusively to registered AES Energy customers upon successful installation and commissioning of the referred customer’s solar plant.</p>
                ',
            ],
            [
                'title' => 'Warranty & Performance Terms',
                'slug' => 'warranty-terms',
                'meta_title' => 'Solar Warranty & Performance Terms — AES Energy',
                'meta_keyword' => 'solar warranty, 25 year panel warranty, inverter guarantee',
                'meta_description' => 'Details on the 25-year solar module performance warranty, 5/10-year inverter warranty, and AES craftsmanship guarantees.',
                'active' => 1,
                'description' => '
                    <h2>1. 25-Year Tier-1 Module Warranty</h2>
                    <p>All Mono PERC and TOPCon Bifacial panels installed by AES Energy carry a manufacturer backed <strong>12-Year Product Warranty</strong> and a <strong>25-Year Linear Power Performance Warranty</strong> (guaranteeing ≥80% output at Year 25).</p>

                    <h2>2. Inverter & Storage Warranty</h2>
                    <p>String inverters and Hybrid solar inverters are covered under standard 5 to 10-year replacement warranties. Extended warranties up to 15 years can be purchased during checkout.</p>

                    <h2>3. AES Workmanship & Generation Assurance</h2>
                    <p>AES Energy provides 5 years of comprehensive installation craftsmanship warranty covering AC/DC cabling, earthing resistance, lightning arrestors, and mounting structure stability under wind loads up to 160 km/h.</p>
                ',
            ],
            [
                'title' => 'PM Surya Ghar Subsidy Guidelines',
                'slug' => 'subsidy-guidelines',
                'meta_title' => 'PM Surya Ghar Subsidy Scheme Guidelines — AES Energy',
                'meta_keyword' => 'PM Surya Ghar, solar subsidy guide, DBT solar scheme',
                'meta_description' => 'Complete guide on central government subsidies up to ₹78,000 under PM Surya Ghar Muft Bijli Yojana.',
                'active' => 1,
                'description' => '
                    <h2>1. Subsidy Slabs Overview</h2>
                    <p>Under the PM Surya Ghar: Muft Bijli Yojana scheme initiated by the Government of India:</p>
                    <ul>
                        <li><strong>1 kW System:</strong> ₹30,000 Central Subsidy</li>
                        <li><strong>2 kW System:</strong> ₹60,000 Central Subsidy</li>
                        <li><strong>3 kW to 10 kW System:</strong> ₹78,000 Maximum Central Subsidy</li>
                        <li><strong>Group Housing Societies (GHS/RWA):</strong> ₹18,000 per kW up to 500 kW capacity</li>
                    </ul>

                    <h2>2. Turnkey Liaisoning by AES Energy</h2>
                    <p>AES Energy handles 100% of the portal registration, technical feasibility approval (TFA), vendor selection, meter testing, inspection, and Joint Inspection Report (JIR) upload for seamless Direct Benefit Transfer into your Aadhaar-linked bank account.</p>
                ',
            ],
            [
                'title' => 'Net-Metering & Grid Interconnection',
                'slug' => 'net-metering-policy',
                'meta_title' => 'Net-Metering & Grid Interconnection — AES Energy',
                'meta_keyword' => 'net metering, bi directional meter, discom interconnection',
                'meta_description' => 'How net-metering exports surplus solar electricity to the grid and slashes your monthly utility electricity bill.',
                'active' => 1,
                'description' => '
                    <h2>1. How Net-Metering Works</h2>
                    <p>A bi-directional meter records units consumed from the grid as well as surplus solar units exported back to the DISCOM. At the end of each billing cycle, you are only billed for the net units consumed.</p>

                    <h2>2. Surplus Energy Banking</h2>
                    <p>Any surplus units generated during sunny peak hours are banked with your distribution utility and offset against night-time or monsoon consumption, rolling over until the end of the annual settlement cycle.</p>
                ',
            ],
        ];

        foreach ($pages as $data) {
            ContentManagement::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
