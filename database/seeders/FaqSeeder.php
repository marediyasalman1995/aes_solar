<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question_english' => 'How much subsidy do I get under the PM Surya Ghar Muft Bijli Yojana?',
                'answer_english' => 'Under PM Surya Ghar Muft Bijli Yojana, residential consumers receive direct bank transfer (DBT) subsidies: ₹30,000 for 1 kW, ₹60,000 for 2 kW, and a maximum of ₹78,000 for 3 kW and higher systems. AES Energy handles the complete registration and subsidy liaisoning on the national portal for you.',
            ],
            [
                'question_english' => 'How much roof area is required for a 3 kW or 5 kW solar system?',
                'answer_english' => 'As a rule of thumb, you need roughly 80–100 sq.ft of shadow-free rooftop area per 1 kW capacity. A standard 3 kW system requires about 250–300 sq.ft, while a 5 kW plant requires about 450–500 sq.ft.',
            ],
            [
                'question_english' => 'How does Net-Metering work with my local DISCOM electricity bill?',
                'answer_english' => 'A bi-directional net meter installed by your power distribution company (DISCOM) records both energy imported from the grid and excess solar units exported. At month-end, you only pay for the net units consumed. If you generate more than you consume, surplus credits roll over to subsequent billing months.',
            ],
            [
                'question_english' => 'What is the lifespan and warranty coverage of AES solar panels and inverters?',
                'answer_english' => 'All AES solar installations feature Tier-1 Mono PERC / TOPCon modules with a 25-Year Linear Power Performance Warranty and a 12-Year Product Warranty. Inverters carry 5 to 10-year replacement warranties, and AES Energy provides 5 full years of free workmanship and generation maintenance.',
            ],
            [
                'question_english' => 'Does solar power work during monsoon or cloudy days?',
                'answer_english' => 'Yes! Solar photovoltaic panels produce electricity from ambient daylight (diffused radiation), not direct heat. On rainy or heavily overcast days, generation is typically 25% to 40% of peak sunny output. The grid seamlessly supplies any additional power required without interruption.',
            ],
            [
                'question_english' => 'How does the AES Refer & Earn program work?',
                'answer_english' => 'Registered AES Energy customers receive a unique referral code on the AES One Dashboard. When your friends, relatives, or neighbors install a solar plant using your code or link, you earn an instant reward of ₹500 to ₹1,500 credited directly to your AES Reward Wallet, which can be withdrawn to your bank account anytime.',
            ],
            [
                'question_english' => 'How long does the complete solar installation process take?',
                'answer_english' => 'From initial site survey and engineering design to rooftop structure installation and DISCOM net-meter commissioning, the typical turnkey timeline is 10 to 18 business days.',
            ],
            [
                'question_english' => 'Can I monitor my solar plant generation on my phone?',
                'answer_english' => 'Yes! Every AES Energy plant is equipped with Wi-Fi / 4G smart data loggers. You can monitor live generation, daily kWh units, monthly savings, and CO₂ offset in real-time right inside your AES One Customer Dashboard.',
            ],
        ];

        foreach ($faqs as $data) {
            Faq::updateOrCreate(
                ['question_english' => $data['question_english']],
                $data
            );
        }
    }
}
