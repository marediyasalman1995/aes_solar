<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin\UpdateUserPasswordRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\UserRepository;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Response;
use Throwable;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('permission:users.index')->only(['index',]);
        $this->middleware('permission:users.create')->only(['create','store']);
        $this->middleware('permission:users.edit')->only(['edit','update']);
        $this->middleware('permission:users.view')->only('show');
        $this->middleware('permission:users.delete')->only('destroy');
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new User.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created User in storage.
     * @param CreateUserRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        $user = User::create($request->validated());
        $user->syncRoles($request->input('role'));
        $user->markEmailAsVerified();
        $this->userRepository->updateOrCreate_avatar($user,$request);
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'User has been created successfully!');
        return Response::json(['message' => 'User has been created successfully.', 'back_url' => route('admin.users.index')]);

    }

    /**
     * Display the specified User.
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     * @param User $user
     * @param UpdateUserRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        DB::beginTransaction();
        $user->update($request->validated());
        $user = $user->fresh();
        $user->syncRoles($request->input('role'));
        $this->userRepository->updateOrCreate_avatar($user,$request);
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'User has been updated successfully!');
        return Response::json(['message' => 'User updated successfully.', 'back_url' => route('admin.users.index')]);
    }

    /**
     * Remove the specified User from storage.
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user->id);
        return Response::json(['message' => 'User deleted successfully']);
    }

    /**
     * Opens the change password page.
     * @param User $user
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function changePassword(User $user)
    {
        return view('admin.users.changePassword');
    }

    /**
     * Changes the User's Password
     * @param User $user
     * @param UpdateUserPasswordRequest $request
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function changePassword_process(User $user, UpdateUserPasswordRequest $request) {

        $user->update(['password' => $request->input('password')]);
        $user->save();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Password updated successfully!');
        return Response::json(['message' => 'Password updated successfully.', 'back_url' => route('admin.users.index')]);
    }

    public function dashboard(\Illuminate\Http\Request $request)
    {
        $totalCustomers = User::where('user_type', 'customer')->orWhereNull('user_type')->count();
        $totalSites = \App\Models\CustomerSite::count();
        $totalCapacity = (float)\App\Models\CustomerSite::sum('capacity_kw');
        $totalReferrals = \App\Models\Referral::count();
        $totalRewards = (float)\App\Models\WalletTransaction::where('type', 'Credit')->sum('amount');
        $openServiceRequests = \App\Models\ServiceRequest::whereIn('status', ['Pending', 'Scheduled', 'In Progress'])->count();
        $recentInquiries = \App\Models\Inquiry::orderBy('created_at', 'desc')->take(5)->get();
        $recentCustomers = User::where('user_type', 'customer')->orWhereNull('user_type')->withCount(['sites', 'referrals'])->orderBy('created_at', 'desc')->take(5)->get();

        // Environmental & Energy Analytics
        $monthlyGenUnits = round($totalCapacity * 4.2 * 30);
        $annualGenUnits = round($totalCapacity * 4.2 * 365);
        $co2SavedTons = round(($annualGenUnits * 0.82) / 1000, 1);
        $treesPlantedEquiv = round($co2SavedTons * 45);
        $estimatedMonthlySavings = round($monthlyGenUnits * 8.5);

        // Year options for the filter dropdown
        $dbYears = \App\Models\CustomerSite::selectRaw('YEAR(created_at) as yr')->distinct()->pluck('yr')->toArray();
        $currentYear = (int)date('Y');
        $years = array_unique(array_merge([$currentYear, $currentYear - 1], $dbYears));
        sort($years);
        $years = array_reverse($years);

        $filterYear = (int)$request->input('year', $currentYear);

        // Generate monthly Customer Plants/Sites registrations
        $monthlyRegistrations = [];
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRegistrations[] = \App\Models\CustomerSite::whereYear('created_at', $filterYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // Referral Pipeline Counts
        $referralStages = [
            'Lead' => \App\Models\Referral::where('stage', 'Lead')->count() ?: 1,
            'Survey Scheduled' => \App\Models\Referral::where('stage', 'Survey Scheduled')->count() ?: 1,
            'Installation' => \App\Models\Referral::where('stage', 'Installation')->count() ?: 1,
            'Commissioned' => \App\Models\Referral::where('stage', 'Commissioned')->count() ?: 1,
        ];

        return view('admin.dashboard.index', compact(
            'totalCustomers',
            'totalSites',
            'totalCapacity',
            'totalReferrals',
            'totalRewards',
            'openServiceRequests',
            'recentInquiries',
            'recentCustomers',
            'monthlyGenUnits',
            'annualGenUnits',
            'co2SavedTons',
            'treesPlantedEquiv',
            'estimatedMonthlySavings',
            'years',
            'filterYear',
            'monthNames',
            'monthlyRegistrations',
            'referralStages'
        ));
    }
}
