<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Artisan;
use App\Models\ContentManagement;
use App\Models\Faq;
use App\Models\NewsLetter;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Product;
use App\Models\Rashifal;
use App\Models\RashifalDetail;
use App\Models\RashifalDetailRashi;
use App\Models\Tag;
use App\Models\Video;
use App\Models\Website;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends AppBaseController
{


    public function index()
    {
        $Our_Vision = Website::where('type', 'Our_Vision')->get();

        $seo = array(
            'meta_title' => GeneralHelperFunctions::getSetting('meta_title') ?? 'AES Energy — Solar for Every Rooftop',
            'meta_description' => GeneralHelperFunctions::getSetting('meta_description') ?? '',
            'meta_keyword' => GeneralHelperFunctions::getSetting('meta_keyword') ?? '',
        );

        $return_data['seo'] = $seo;
        $return_data['Our_Vision'] = $Our_Vision;

        return view('frontend.pages.home', $return_data);
    }

    public function cmsDetail($slug)
    {
        $cms_detail = ContentManagement::where('slug', $slug)->first();

        if (!empty($cms_detail)) {
            $seo = array(
                'meta_title' => $cms_detail->meta_title ?? '',
                'meta_description' => $cms_detail->meta_description ?? '',
                'meta_keyword' => $cms_detail->meta_keyword ?? '',
            );
            return view('frontend.cms.index', compact('cms_detail', 'seo'));
        } else {
            return redirect()->back();
        }
    }

    public function faqs()
    {
        $faqs = Faq::all();
        $seo = array(
            'meta_title' => 'Frequently Asked Questions - AES Energy' ?? '',
            'meta_description' => "Have questions about rooftop solar? Explore our FAQ page." ?? '',
            'meta_keyword' => 'FAQ, frequently asked questions, solar help' ?? '',
        );
        return view('frontend.faqs.index', compact('faqs', 'seo'));
    }

    public function saveNewsLetter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $save = new NewsLetter();
        $save->email = $request->email;
        $save->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Thanks for subscribing! You will receive the latest updates.');

        return Response::json(['message' => 'Thanks for subscribing! You will receive the latest updates.',
            'back_url' => url()->previous(),
        ]);
    }

    public function saveInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'city' => 'required|string',
            'monthly_bill' => 'nullable|numeric',
            'message' => 'nullable|string',
        ]);

        $fullMessage = $request->message ?? '';
        $fullMessage .= "\n\nCity: " . $request->city;
        if ($request->filled('monthly_bill')) {
            $fullMessage .= "\nMonthly Bill: Rs. " . $request->monthly_bill;
        }

        $save = new Inquiry();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->phone = $request->phone;
        $save->subject = $request->subject;
        $save->message = $fullMessage;
        $save->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Inquiry Submitted successfully!');

        return Response::json([
            'message' => 'Inquiry Submitted successfully!',
            'back_url' => route('contact'),
        ]);
    }

    public function contact()
    {
        $seo = array(
            'meta_title' => 'Contact Us - AES Energy',
            'meta_description' => "Let's design your rooftop system. Get a free survey.",
            'meta_keyword' => 'contact, solar survey, solar Pune',
        );
        return view('frontend.pages.contact', compact('seo'));
    }

    public function about_us()
    {
        $seo = array(
            'meta_title' => 'About Us - AES Energy',
            'meta_description' => "Engineers first, energy company second. Read our story.",
            'meta_keyword' => 'about solar company, solar engineering',
        );
        $about_us = Website::where('type', 'About_Us')->first();
        $vision = Website::where('type', 'Our_Vision')->first();
        $missions = Website::where('type', 'Our_Mission')->first();

        return view('frontend.pages.about', compact('seo',
            'about_us',
            'vision',
            'missions',
        ));
    }

    public function products()
    {
        $seo = array(
            'meta_title' => 'Solar Products - AES Energy',
            'meta_description' => 'Tier-1 panels, hybrid inverters and smart monitoring systems.',
            'meta_keyword' => 'solar panels, hybrid inverters, battery storage',
        );
        return view('frontend.pages.products', compact('seo'));
    }

    public function solutions()
    {
        $seo = array(
            'meta_title' => 'Solar Solutions - AES Energy',
            'meta_description' => 'On-grid, off-grid and hybrid rooftop solar solutions.',
            'meta_keyword' => 'on-grid solar, off-grid solar, hybrid solar',
        );
        return view('frontend.pages.solutions', compact('seo'));
    }

    public function services()
    {
        $seo = array(
            'meta_title' => 'Solar Services & AMC - AES Energy',
            'meta_description' => 'Rooftop solar maintenance, cleaning plans and 24x7 support.',
            'meta_keyword' => 'solar cleaning, solar maintenance, solar support',
        );
        return view('frontend.pages.services', compact('seo'));
    }

    public function suryaghar()
    {
        $seo = array(
            'meta_title' => 'PM Surya Ghar Yojana - AES Energy',
            'meta_description' => 'Central government subsidy up to Rs. 78,000 for rooftop solar.',
            'meta_keyword' => 'pm surya ghar, solar subsidy, free electricity yojana',
        );
        return view('frontend.pages.suryaghar', compact('seo'));
    }





}
