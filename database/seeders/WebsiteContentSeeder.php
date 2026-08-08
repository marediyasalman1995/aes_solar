<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;
use App\Models\Setting;

class WebsiteContentSeeder extends Seeder
{
    public function run()
    {
        // 1. Global Settings
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'address' => 'Shop No. 4 & 5, Fortune Plaza, Baner Road, Pune, Maharashtra 411045',
                'mobile' => '9876543210',
                'mobile_2' => '0202567890',
                'mobile_3' => '9822100101',
                'email' => 'contact@aesenergy.in',
                'email_2' => 'support@aesenergy.in',
                'facebook' => 'https://facebook.com/aesenergy',
                'twitter' => 'https://twitter.com/aesenergy',
                'linkdin' => 'https://linkedin.com/company/aesenergy',
                'youtube' => 'https://youtube.com/@aesenergy',
                'instagram' => 'https://instagram.com/aesenergy',
                'telegram' => 'https://t.me/aesenergy',
                'footer_text' => 'Rooftop solar, done properly — from site survey to subsidy to twenty-five years of support.',
                'meta_title' => 'AES Energy — Solar for Every Rooftop in India | PM Surya Ghar Subsidy',
                'meta_description' => 'Turnkey rooftop solar solutions for homes, societies, and commercial buildings. Get up to ₹78,000 subsidy under PM Surya Ghar.',
                'meta_keyword' => 'AES Energy, rooftop solar, PM Surya Ghar, solar panel installation, solar subsidy',
            ]
        );

        // Reset website sections to ensure clean synchronization
        Website::truncate();

        $allSections = [
            // Top Banner & General
            [
                'type' => 'Top_Banner',
                'heading' => 'Zero electricity bills with rooftop solar.',
                'sub_heading' => 'Turn your terrace into a 25-year personal power plant. Direct government subsidy up to ₹78,000 under PM Surya Ghar Yojana.',
                'description' => 'Free site survey, end-to-end DISCOM net-metering liaisoning, Tier-1 Mono PERC & TOPCon panels, and guaranteed generation maintenance.',
            ],
            [
                'type' => 'About_Us',
                'heading' => 'Engineers first, energy company second.',
                'sub_heading' => 'Since 2015, AES Energy has been building rooftop solar systems engineered for Indian roofs, Indian weather, and Indian electricity bills.',
                'description' => 'From one rooftop in Pune to a nationwide network of 4,200+ residential and commercial power plants. We operate our own in-house installation crews and dedicated subsidy desk.',
            ],
            [
                'type' => 'Our_Vision',
                'heading' => 'A solar panel on every rooftop across India.',
                'sub_heading' => 'Decentralized, green, clean energy for every household.',
                'description' => 'Making clean solar power accessible, affordable, and hassle-free for every Indian homeowner, contributing to India’s Net Zero 2070 carbon goals.',
            ],
            [
                'type' => 'Our_Mission',
                'heading' => 'Deliver 100 MW of rooftop solar by 2030.',
                'sub_heading' => 'Quality engineering, Tier-1 components, and transparent subsidies.',
                'description' => 'Ensuring maximum electricity generation, fastest payback period (3.2 years), and highest lifetime savings for our customers.',
            ],
            [
                'type' => 'Why_Choose_Us',
                'heading' => 'Why Indian Homeowners Trust AES Energy',
                'sub_heading' => 'End-to-End Engineering, Procurement & Commissioning',
                'description' => 'Tier-1 DCR Bifacial Panels, Hot-Dip Galvanized structures tested up to 160 km/h wind loads, 100% subsidy paperwork handling, and 24x7 AES One digital monitoring.',
            ],
            [
                'type' => 'Stats',
                'heading' => 'Proven Track Record Across India',
                'sub_heading' => 'Key Milestones & Achievements',
                'description' => '4,200+ Rooftops Powered | 18.5 MW+ Capacity Installed | ₹18 Cr+ Subsidies Processed | 22,000+ Tons CO₂ Offset Annually.',
            ],
            [
                'type' => 'PM_Surya_Ghar',
                'heading' => 'PM Surya Ghar: Muft Bijli Yojana',
                'sub_heading' => 'Government Subsidies Up to ₹78,000 credited directly into your bank account.',
                'description' => 'Direct Benefit Transfer (DBT) scheme by the Government of India. AES Energy handles 100% of portal registration, technical feasibility approvals (TFA), and joint inspection.',
            ],

            // Products (Hardware)
            [
                'type' => 'Products',
                'heading' => 'Mono PERC Panels',
                'sub_heading' => '21.8% Module Efficiency · 25-Year Warranty',
                'description' => 'Up to 21.8% module efficiency with 25-year linear output warranty. Built for Indian heat and dust conditions.',
            ],
            [
                'type' => 'Products',
                'heading' => 'Smart Hybrid Inverters',
                'sub_heading' => '97.5% Efficiency · 10-Year Warranty',
                'description' => 'App-based monitoring with automatic grid/battery switching and remote diagnostics.',
            ],
            [
                'type' => 'Products',
                'heading' => 'Lithium Battery Banks',
                'sub_heading' => '6000+ Cycles · 10-Year Warranty',
                'description' => 'Modular storage that scales as your household load grows, with 10-year performance warranty.',
            ],

            // Solar Solutions
            [
                'type' => 'Solar_Solutions',
                'heading' => 'On-Grid Rooftop Solar',
                'sub_heading' => 'Most Popular · 4–5 Years Payback',
                'description' => 'Feed excess power back to the grid and net-meter your bill down to near zero. Lowest upfront cost, fastest payback.',
            ],
            [
                'type' => 'Solar_Solutions',
                'heading' => 'Off-Grid + Battery Storage',
                'sub_heading' => 'Backup Ready · 6–8 Years Payback',
                'description' => 'Stay powered through outages with battery backup sized to your critical loads — ideal for frequent-outage areas.',
            ],
            [
                'type' => 'Solar_Solutions',
                'heading' => 'Hybrid Commercial Systems',
                'sub_heading' => 'For Businesses & Societies · 5–6 Years Payback',
                'description' => 'Grid-tied with battery buffer for factories, offices and housing societies with high daytime loads.',
            ],

            // Solar Plans
            [
                'type' => 'Solar_Plans',
                'heading' => 'Small Home Plan',
                'sub_heading' => '3 kW · Starter',
                'description' => 'Covers bills up to ₹2,500/month. ₹1,68,000 all-inclusive with ₹78,000 subsidy applied. Tier-1 Mono PERC panels with 5-year free maintenance.',
            ],
            [
                'type' => 'Solar_Plans',
                'heading' => 'Family Home Plan',
                'sub_heading' => '5 kW · Popular',
                'description' => 'Covers bills up to ₹5,500/month. ₹2,65,000 all-inclusive with ₹78,000 subsidy applied. High-efficiency TOPCon panels with smart hybrid inverter.',
            ],
            [
                'type' => 'Solar_Plans',
                'heading' => 'Villa & Society Plan',
                'sub_heading' => '10 kW · Max Yield',
                'description' => 'Covers bills ₹10,000+/month. ₹4,90,000 with 3-phase hybrid inverter, priority 24×7 support, and maximum power generation.',
            ],

            // Services
            [
                'type' => 'Services',
                'heading' => 'AMC & Maintenance',
                'sub_heading' => 'Scheduled cleaning & health checks',
                'description' => 'Scheduled module washing, thermographic health audits, and electrical wiring inspection.',
            ],
            [
                'type' => 'Services',
                'heading' => '24×7 Support Desk',
                'sub_heading' => 'Raise & track service requests',
                'description' => 'Dedicated customer support with ticket tracking on AES One and on-site engineer visits.',
            ],
            [
                'type' => 'Services',
                'heading' => 'Performance Monitoring',
                'sub_heading' => 'Real-time generation tracking',
                'description' => 'Smart IoT monitoring showing daily kWh output, monthly bill savings, and carbon offset.',
            ],
            [
                'type' => 'Services',
                'heading' => 'Subsidy & Net-Metering',
                'sub_heading' => 'End-to-end documentation help',
                'description' => 'Turnkey liaisoning for DISCOM meter testing, bi-directional net-meter sync, and DBT subsidy release.',
            ],

            // AMC Plans
            [
                'type' => 'AMC_Plans',
                'heading' => 'Basic Care',
                'sub_heading' => '₹1,999 / year',
                'description' => '2 scheduled cleaning visits/year, annual health check, and email support.',
            ],
            [
                'type' => 'AMC_Plans',
                'heading' => 'Standard Protection',
                'sub_heading' => '₹3,499 / year',
                'description' => '4 scheduled cleaning visits/year, priority phone support, and free minor repairs.',
            ],
            [
                'type' => 'AMC_Plans',
                'heading' => 'Premium Peace of Mind',
                'sub_heading' => '₹5,999 / year',
                'description' => '6 cleaning visits/year, 24×7 priority support, and free replacement parts & labour.',
            ],

            // Process Steps
            [
                'type' => 'Process_Steps',
                'heading' => 'Free Site Survey',
                'sub_heading' => 'Step 1',
                'description' => 'Our engineering team studies your roof structure, shadow profile, and electricity load.',
            ],
            [
                'type' => 'Process_Steps',
                'heading' => 'Design & Quotation',
                'sub_heading' => 'Step 2',
                'description' => 'Custom CAD solar layout with transparent pricing and upfront subsidy calculation.',
            ],
            [
                'type' => 'Process_Steps',
                'heading' => 'Turnkey Installation',
                'sub_heading' => 'Step 3',
                'description' => 'In-house certified technicians install panels, inverters, structure, and earthing in 2–4 days.',
            ],
            [
                'type' => 'Process_Steps',
                'heading' => 'Subsidy & Net-Metering',
                'sub_heading' => 'Step 4',
                'description' => 'We handle DISCOM net-meter installation and government portal subsidy release end-to-end.',
            ],

            // Subsidy Slabs
            [
                'type' => 'Subsidy_Slabs',
                'heading' => 'Up to 2 kW Capacity',
                'sub_heading' => '₹30,000 per kW',
                'description' => 'Direct government DBT subsidy of ₹30,000 per kW (₹60,000 for 2 kW systems).',
            ],
            [
                'type' => 'Subsidy_Slabs',
                'heading' => '2 to 3 kW Capacity',
                'sub_heading' => '₹18,000 additional',
                'description' => 'Additional ₹18,000 subsidy for the 3rd kW, totaling ₹78,000 for 3 kW systems.',
            ],
            [
                'type' => 'Subsidy_Slabs',
                'heading' => 'Above 3 kW Capacity',
                'sub_heading' => '₹78,000 maximum',
                'description' => 'Subsidy is capped at ₹78,000 for residential rooftop consumers under PM Surya Ghar.',
            ],

            // Customer Reviews
            [
                'type' => 'Reviews',
                'heading' => 'Priya Nair',
                'sub_heading' => 'Pune, 5kW Rooftop System',
                'description' => 'Our bill dropped from ₹4,200 to almost zero within the first month. The team handled the subsidy paperwork end to end without any hassle.',
            ],
            [
                'type' => 'Reviews',
                'heading' => 'Amit Verma',
                'sub_heading' => 'Nashik, 3kW System',
                'description' => 'Installation was done in two days flat, and the AES One app lets me track generation in real time. Great after-sales support too.',
            ],
            [
                'type' => 'Reviews',
                'heading' => 'Sneha Iyer',
                'sub_heading' => 'Mumbai, 10kW Commercial System',
                'description' => 'Referred two neighbours after seeing my own savings — the AES Reward Wallet is a nice bonus on top of the electricity savings.',
            ],
        ];

        foreach ($allSections as $sec) {
            Website::create($sec);
        }
    }
}
