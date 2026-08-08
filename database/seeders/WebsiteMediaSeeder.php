<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteMediaSeeder extends Seeder
{
    public function run()
    {
        $allWebsites = Website::all();

        foreach ($allWebsites as $site) {
            $imgPath = null;

            if ($site->type === 'Top_Banner') {
                $imgPath = 'public/images/hero-solar.jpg';
            } elseif ($site->type === 'About_Us') {
                $imgPath = 'public/images/about-main.jpg';
            } elseif ($site->type === 'Our_Vision' || $site->type === 'Our_Mission') {
                $imgPath = 'public/images/about-teaser.jpg';
            } elseif ($site->type === 'Why_Choose_Us') {
                $imgPath = 'public/images/team-install.jpg';
            } elseif ($site->type === 'Products') {
                if (str_contains($site->heading, 'Panel')) {
                    $imgPath = 'public/images/product-panel.jpg';
                } elseif (str_contains($site->heading, 'Inverter')) {
                    $imgPath = 'public/images/product-inverter.jpg';
                } else {
                    $imgPath = 'public/images/product-battery.jpg';
                }
            } elseif ($site->type === 'Solar_Solutions') {
                if (str_contains($site->heading, 'On-Grid')) {
                    $imgPath = 'public/images/solution-ongrid.jpg';
                } elseif (str_contains($site->heading, 'Off-Grid')) {
                    $imgPath = 'public/images/solution-offgrid.jpg';
                } else {
                    $imgPath = 'public/images/solution-hybrid.jpg';
                }
            } elseif ($site->type === 'Solar_Plans') {
                if (str_contains($site->heading, 'Small')) {
                    $imgPath = 'public/images/plan-starter.jpg';
                } elseif (str_contains($site->heading, 'Family')) {
                    $imgPath = 'public/images/plan-family.jpg';
                } else {
                    $imgPath = 'public/images/plan-business.jpg';
                }
            } elseif ($site->type === 'Services' || $site->type === 'Process_Steps') {
                if (str_contains($site->heading, 'Survey') || str_contains($site->heading, 'Design')) {
                    $imgPath = 'public/images/team-design.jpg';
                } elseif (str_contains($site->heading, 'Install') || str_contains($site->heading, 'AMC')) {
                    $imgPath = 'public/images/team-install.jpg';
                } elseif (str_contains($site->heading, 'Support')) {
                    $imgPath = 'public/images/team-support.jpg';
                } else {
                    $imgPath = 'public/images/team-subsidy.jpg';
                }
            } elseif ($site->type === 'AMC_Plans' || $site->type === 'Subsidy_Slabs' || $site->type === 'PM_Surya_Ghar') {
                $imgPath = 'public/images/hero-solar.jpg';
            }

            if ($imgPath && file_exists(base_path($imgPath))) {
                try {
                    $site->clearMediaCollection('avatar');
                    $site->addMedia(base_path($imgPath))
                        ->preservingOriginal()
                        ->toMediaCollection('avatar');
                } catch (\Exception $e) {
                    // ignore
                }
            }
        }
    }
}
