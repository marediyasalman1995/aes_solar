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
use App\Models\Setting;
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
        $website_sections = Website::all()->keyBy('type');
        $solar_plans = Website::where('type', 'Solar_Plans')->get();
        $solutions = Website::where('type', 'Solar_Solutions')->get();
        $products = Website::where('type', 'Products')->get();
        $services = Website::where('type', 'Services')->get();
        $reviews = Website::where('type', 'Reviews')->get();
        $faqs = Faq::take(6)->get();

        $seo = array(
            'meta_title' => GeneralHelperFunctions::getSetting('meta_title') ?? 'AES Energy — Solar for Every Rooftop in India',
            'meta_description' => GeneralHelperFunctions::getSetting('meta_description') ?? 'Turnkey rooftop solar solutions for homes, societies, and commercial buildings. Get up to ₹78,000 subsidy under PM Surya Ghar.',
            'meta_keyword' => GeneralHelperFunctions::getSetting('meta_keyword') ?? 'AES Energy, rooftop solar, solar subsidy, PM Surya Ghar',
        );

        return view('frontend.pages.home', compact('seo', 'website_sections', 'solar_plans', 'solutions', 'products', 'services', 'reviews', 'faqs'));
    }

    public function cmsDetail($slug)
    {
        $cms_detail = ContentManagement::where('slug', $slug)->first();

        if (!empty($cms_detail)) {
            $seo = array(
                'meta_title' => $cms_detail->meta_title ?? $cms_detail->title . ' — AES Energy',
                'meta_description' => $cms_detail->meta_description ?? '',
                'meta_keyword' => $cms_detail->meta_keyword ?? '',
            );
            return view('frontend.cms.index', compact('cms_detail', 'seo'));
        } else {
            return redirect()->route('home');
        }
    }

    public function faqs()
    {
        $faqs = Faq::all();
        $seo = array(
            'meta_title' => 'Frequently Asked Questions — AES Energy',
            'meta_description' => "Have questions about rooftop solar, PM Surya Ghar subsidy, or net-metering? Explore our FAQs.",
            'meta_keyword' => 'FAQ, frequently asked questions, solar help, subsidy questions',
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
            'pincode' => 'required|string|max:10',
            'city' => 'required|string',
            'type' => 'required|in:Customer,Dealer',
            'monthly_bill' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $save = new Inquiry();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->phone = $request->phone;
        $save->pincode = $request->pincode;
        $save->city = $request->city;
        $save->type = $request->type;
        $save->monthly_bill = $request->monthly_bill;
        $save->message = $request->message;
        $save->subject = "Website Inquiry: " . $request->type;
        $save->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Inquiry Submitted successfully! Our team will contact you shortly.');

        return Response::json([
            'message' => 'Inquiry Submitted successfully! Our team will contact you shortly.',
            'back_url' => route('contact'),
        ]);
    }

    public function contact()
    {
        $seo = array(
            'meta_title' => 'Contact Us — AES Energy',
            'meta_description' => "Let's design your rooftop solar plant. Book a free site survey in Pune, Mumbai, and Maharashtra.",
            'meta_keyword' => 'contact solar, solar site survey, AES Energy office Pune',
        );
        $setting = Setting::first();
        return view('frontend.pages.contact', compact('seo', 'setting'));
    }

    public function about_us()
    {
        $seo = array(
            'meta_title' => 'About Us — AES Energy',
            'meta_description' => "Engineers first, energy company second. Read our story and mission to solarize India.",
            'meta_keyword' => 'about solar company, solar engineering, AES Energy story',
        );
        $website_sections = Website::all()->keyBy('type');

        return view('frontend.pages.about', compact('seo', 'website_sections'));
    }

    public function products()
    {
        $seo = array(
            'meta_title' => 'Solar Products & Hardware — AES Energy',
            'meta_description' => 'Tier-1 Mono PERC & TOPCon panels, hybrid inverters, and smart Wi-Fi monitoring.',
            'meta_keyword' => 'solar panels, hybrid inverters, battery storage, DCR panels',
        );
        $website_sections = Website::all()->keyBy('type');
        $products = Website::where('type', 'Products')->get();
        return view('frontend.pages.products', compact('seo', 'website_sections', 'products'));
    }

    public function solutions()
    {
        $seo = array(
            'meta_title' => 'Solar Solutions — AES Energy',
            'meta_description' => 'On-grid, off-grid and hybrid rooftop solar solutions for homes, societies, and industries.',
            'meta_keyword' => 'on-grid solar, off-grid solar, hybrid solar, society solar',
        );
        $website_sections = Website::all()->keyBy('type');
        $solutions = Website::where('type', 'Solar_Solutions')->get();
        return view('frontend.pages.solutions', compact('seo', 'website_sections', 'solutions'));
    }

    public function services()
    {
        $seo = array(
            'meta_title' => 'Solar Services & AMC — AES Energy',
            'meta_description' => 'Turnkey solar installation, DISCOM liaisoning, robotic panel cleaning, and 24x7 AMC.',
            'meta_keyword' => 'solar cleaning, solar maintenance, solar AMC, net metering liaison',
        );
        $website_sections = Website::all()->keyBy('type');
        $services = Website::where('type', 'Services')->get();
        $amc_plans = Website::where('type', 'AMC_Plans')->get();
        $process_steps = Website::where('type', 'Process_Steps')->get();

        return view('frontend.pages.services', compact('seo', 'website_sections', 'services', 'amc_plans', 'process_steps'));
    }

    public function suryaghar()
    {
        $seo = array(
            'meta_title' => 'PM Surya Ghar: Muft Bijli Yojana — AES Energy',
            'meta_description' => 'Direct central government subsidy up to ₹78,000 for residential rooftop solar.',
            'meta_keyword' => 'pm surya ghar, solar subsidy, muft bijli yojana, national solar portal',
        );
        $website_sections = Website::all()->keyBy('type');
        $subsidy_slabs = Website::where('type', 'Subsidy_Slabs')->get();

        return view('frontend.pages.suryaghar', compact('seo', 'website_sections', 'subsidy_slabs'));
    }

    public function dealer()
    {
        $seo = array(
            'meta_title' => 'Solar Dealership & Franchise Program — AES Energy',
            'meta_description' => 'Partner with AES Energy and grow your solar business. Earn attractive dealer margins with empanelment support.',
            'meta_keyword' => 'solar dealership, solar franchise, solar partner program, GEDA empanelment',
        );
        $setting = Setting::first();
        $website_sections = Website::all()->keyBy('type');
        return view('frontend.pages.dealer', compact('seo', 'setting', 'website_sections'));
    }

    public function productDetail($slug)
    {
        $product = Website::where('type', 'Products')->where('slug', $slug)->firstOrFail();
        
        $seo = array(
            'meta_title' => $product->heading . ' — AES Energy',
            'meta_description' => $product->sub_heading ?? strip_tags($product->description),
            'meta_keyword' => 'solar products, ' . $product->heading,
        );
        
        $website_sections = Website::all()->keyBy('type');
        $related_products = Website::where('type', 'Products')->where('id', '!=', $product->id)->take(3)->get();
        
        return view('frontend.pages.product_detail', compact('seo', 'website_sections', 'product', 'related_products'));
    }
}
