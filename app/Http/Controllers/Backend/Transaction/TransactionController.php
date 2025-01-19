<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use App\Models\AditionalMember;
use App\Models\RoomCost;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionIndex()
    {
        $users = User::with('transactions')->get();
        // dd($users    );
        return view('backend.transaction.store', compact('users'));
    }



    public function transactionStore(Request $request)
    {

        $storeTransport = new Transaction();
        $storeTransport->additional_cost_user = $request->additional_cost_user;
        $storeTransport->auth_user = Auth::user()->name;
        $storeTransport->user_id = Auth::user()->id;
        $storeTransport->transaction_category = $request->transaction_category;
        $storeTransport->transaction_description = $request->transaction_description;
        $storeTransport->add_amount = $request->add_amount;
        $storeTransport->cost_amount = $request->cost_amount;
        $storeTransport->save();
    }


    public function viewtransaction()
    {
        $transactions = Transaction::get();

        // dd($transactions);
        $totalAdd = Transaction::sum('add_amount');
        $totalCost = Transaction::sum('cost_amount');
        $costStatus = $totalAdd - $totalCost;
        return view('frontend.transaction.allTransaction', compact('transactions', 'totalAdd', 'totalCost', 'costStatus'));
    }








    
    
    


    
    // public function individualCost()
    // {
    //     $authUser = Auth::user();
    //     $isAdminView = !$authUser->id;
    
    //     if ($authUser->status == 1 || $isAdminView) {
    //         $users = User::with('transactions', 'additinalMembers')->get();
    //     } else {
    //         $users = User::with('transactions', 'additinalMembers')
    //             ->where('id', $authUser->id)
    //             ->get();
    //     }
    
    //     $totalUsers = count(User::get());
    
    //     $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();
    
    //     $foodTransactions = Transaction::where('transaction_category', 'food')->get();
    //     $transportTransactions = Transaction::where('transaction_category', 'transportation')->get();
    //     $otherTransactions = Transaction::where('transaction_category', 'others')->get();
    //     $officeTransactions = Transaction::where('transaction_category', 'office')->get();
    
    //     $foodTotal = $foodTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $transportTotal = $transportTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $otherTotal = $otherTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $officeTotal = $officeTransactions->sum('add_amount');
    
    //     $distributedFoodCost = ($totalUsers > 0) ? round($foodTotal / $totalUsers) : 0;
    //     $distributedTransportCost = ($totalUsers > 0) ? round($transportTotal / $totalUsers) : 0;
    //     $distributedOtherCost = ($totalUsers > 0) ? round($otherTotal / $totalUsers) : 0;
    //     $distributedOfficeAddAmount = ($totalUsers > 0) ? round($officeTotal / $totalUsers) : 0;
    
    //     foreach ($users as $user) {
    //         $user->foodCost = $distributedFoodCost;
    //         $user->transportCost = $distributedTransportCost;
    //         $user->otherCost = $distributedOtherCost;
    
    //         $additionalFood = $foodTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalTransport = $transportTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalOther = $otherTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    
    //         $user->foodCost += $additionalFood;
    //         $user->transportCost += $additionalTransport;
    //         $user->otherCost += $additionalOther;
    
    //         $user->totalAdditionalTshirtCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->m_size + $member->l_size + $member->xl_size + $member->xxl_size) * ($individualRoomCost->t_shirt_price ?? 0);
    //         });
    
    //         $user->totalAdditionalRoomCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
    //                    ($member->couple_room * ($individualRoomCost->couple_room_cost ?? 0));
    //         });
    //     }
    
    //     return view('backend.individualCost.individual', compact(
    //         'users',
    //         'distributedFoodCost',
    //         'distributedTransportCost',
    //         'distributedOtherCost',
    //         'distributedOfficeAddAmount',
    //         'individualRoomCost',
    //         'isAdminView'
    //     ));
    // }
    



    // public function individualCost()
    // {
    //     $authUser = Auth::user();
    //     $isAdminView = !$authUser->id;

    //     if ($authUser->status == 1 || $isAdminView) {
    //         $users = User::with('transactions', 'additinalMembers')->get();
    //     } else {
    //         $users = User::with('transactions', 'additinalMembers')
    //             ->where('id', $authUser->id)
    //             ->get();
    //     }

    //     $totalUsers = count(User::get());

    //     $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();

    //     $foodTransactions = Transaction::where('transaction_category', 'food')->get();
    //     $transportTransactions = Transaction::where('transaction_category', 'transportation')->get();
    //     $otherTransactions = Transaction::where('transaction_category', 'others')->get();
    //     $officeTransactions = Transaction::where('transaction_category', 'office')->get();
    //     $paidTransactions = Transaction::where('transaction_category', 'paid')->get();  // Get paid transactions

    //     // Calculate totals for each category
    //     $foodTotal = $foodTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $transportTotal = $transportTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $otherTotal = $otherTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $officeTotal = $officeTransactions->sum('add_amount');

    //     // Calculate distributed costs
    //     $distributedFoodCost = ($totalUsers > 0) ? round($foodTotal / $totalUsers) : 0;
    //     $distributedTransportCost = ($totalUsers > 0) ? round($transportTotal / $totalUsers) : 0;
    //     $distributedOtherCost = ($totalUsers > 0) ? round($otherTotal / $totalUsers) : 0;
    //     $distributedOfficeAddAmount = ($totalUsers > 0) ? round($officeTotal / $totalUsers) : 0;

    //     // Add paid amount for each user
    //     foreach ($users as $user) {
    //         $user->foodCost = $distributedFoodCost;
    //         $user->transportCost = $distributedTransportCost;
    //         $user->otherCost = $distributedOtherCost;

    //         // Add any additional costs for the user
    //         $additionalFood = $foodTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalTransport = $transportTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalOther = $otherTransactions->where('additional_cost_user', $user->id)->sum('add_amount');

    //         $user->foodCost += $additionalFood;
    //         $user->transportCost += $additionalTransport;
    //         $user->otherCost += $additionalOther;

    //         // Add additional t-shirt and room costs for each user
    //         $user->totalAdditionalTshirtCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->m_size + $member->l_size + $member->xl_size + $member->xxl_size) * ($individualRoomCost->t_shirt_price ?? 0);
    //         });

    //         $user->totalAdditionalRoomCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
    //                 ($member->couple_room * ($individualRoomCost->couple_room_cost ?? 0));
    //         });

    //         // Calculate the paid amount for the user by summing all "paid" transactions
    //         $paidAmount = $paidTransactions->where('user_id', $user->id)->sum('add_amount');
    //         $user->add_amount = $paidAmount;  // Update the paid amount for the user
    //     }

    //     return view('backend.individualCost.individual', compact(
    //         'users',
    //         'distributedFoodCost',
    //         'distributedTransportCost',
    //         'distributedOtherCost',
    //         'distributedOfficeAddAmount',
    //         'individualRoomCost',
    //         'isAdminView'
    //     ));
    // }




    // public function individualCost()
    // {
    //     $authUser = Auth::user();
    //     $isAdminView = !$authUser->id;
    
    //     if ($authUser->status == 1 || $isAdminView) {
    //         $users = User::with('transactions', 'additinalMembers')->get();
    //     } else {
    //         $users = User::with('transactions', 'additinalMembers')
    //             ->where('id', $authUser->id)
    //             ->get();
    //     }
    
    //     $totalUsers = count(User::get());
    
    //     $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();
    
    //     $foodTransactions = Transaction::where('transaction_category', 'food')->get();
    //     $transportTransactions = Transaction::where('transaction_category', 'transportation')->get();
    //     $otherTransactions = Transaction::where('transaction_category', 'others')->get();
    //     $officeTransactions = Transaction::where('transaction_category', 'office')->get();
    //     $paidTransactions = Transaction::where('transaction_category', 'paid')->get();  // Get paid transactions
    
    //     // Calculate totals for each category
    //     $foodTotal = $foodTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $transportTotal = $transportTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $otherTotal = $otherTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $officeTotal = $officeTransactions->sum('add_amount');
    
    //     // Calculate distributed costs
    //     $distributedFoodCost = ($totalUsers > 0) ? round($foodTotal / $totalUsers) : 0;
    //     $distributedTransportCost = ($totalUsers > 0) ? round($transportTotal / $totalUsers) : 0;
    //     $distributedOtherCost = ($totalUsers > 0) ? round($otherTotal / $totalUsers) : 0;
    //     $distributedOfficeAddAmount = ($totalUsers > 0) ? round($officeTotal / $totalUsers) : 0;
    
    //     // Add paid amount for each user (based on additional_cost_user)
    //     foreach ($users as $user) {
    //         $user->foodCost = $distributedFoodCost;
    //         $user->transportCost = $distributedTransportCost;
    //         $user->otherCost = $distributedOtherCost;
    
    //         // Add any additional costs for the user
    //         $additionalFood = $foodTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalTransport = $transportTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalOther = $otherTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    
    //         $user->foodCost += $additionalFood;
    //         $user->transportCost += $additionalTransport;
    //         $user->otherCost += $additionalOther;
    
    //         // Add additional t-shirt and room costs for each user
    //         $user->totalAdditionalTshirtCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->m_size + $member->l_size + $member->xl_size + $member->xxl_size) * ($individualRoomCost->t_shirt_price ?? 0);
    //         });
    
    //         $user->totalAdditionalRoomCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
    //                 ($member->couple_room * ($individualRoomCost->couple_room_cost ?? 0));
    //         });
    
    //         // Add paid amount for each user based on additional_cost_user
    //         $paidAmount = $paidTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $user->add_amount = $paidAmount;  // Update the paid amount for the user
    //     }
    
    //     return view('backend.individualCost.individual', compact(
    //         'users',
    //         'distributedFoodCost',
    //         'distributedTransportCost',
    //         'distributedOtherCost',
    //         'distributedOfficeAddAmount',
    //         'individualRoomCost',
    //         'isAdminView'
    //     ));
    // }
    


    // public function individualCost()
    // {
    //     $authUser = Auth::user();
    //     $isAdminView = !$authUser->id;

    //     if ($authUser->status == 1 || $isAdminView) {
    //         $users = User::with('transactions', 'additinalMembers')->get();
    //     } else {
    //         $users = User::with('transactions', 'additinalMembers')
    //             ->where('id', $authUser->id)
    //             ->get();
    //     }

    //     $totalUsers = count(User::get());

    //     $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();

    //     // Calculate totals for each category
    //     $foodTransactions = Transaction::where('transaction_category', 'food')->get();
    //     $transportTransactions = Transaction::where('transaction_category', 'transportation')->get();
    //     $otherTransactions = Transaction::where('transaction_category', 'others')->get();
    //     $officeTransactions = Transaction::where('transaction_category', 'office')->get();
    //     $paidTransactions = Transaction::where('transaction_category', 'paid')->get();  // Get paid transactions

    //     // Calculate totals for each category
    //     $foodTotal = $foodTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $transportTotal = $transportTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $otherTotal = $otherTransactions->whereNull('additional_cost_user')->sum('add_amount');
    //     $officeTotal = $officeTransactions->sum('add_amount');

    //     // Calculate distributed costs
    //     $distributedFoodCost = ($totalUsers > 0) ? round($foodTotal / $totalUsers) : 0;
    //     $distributedTransportCost = ($totalUsers > 0) ? round($transportTotal / $totalUsers) : 0;
    //     $distributedOtherCost = ($totalUsers > 0) ? round($otherTotal / $totalUsers) : 0;
    //     $distributedOfficeAddAmount = ($totalUsers > 0) ? round($officeTotal / $totalUsers) : 0;

    //     // Add paid amount for each user (based on additional_cost_user)
    //     foreach ($users as $user) {
    //         // Add individual cost distributions
    //         $user->foodCost = $distributedFoodCost;
    //         $user->transportCost = $distributedTransportCost;
    //         $user->otherCost = $distributedOtherCost;

    //         // Add any additional costs for the user
    //         $additionalFood = $foodTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalTransport = $transportTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $additionalOther = $otherTransactions->where('additional_cost_user', $user->id)->sum('add_amount');

    //         $user->foodCost += $additionalFood;
    //         $user->transportCost += $additionalTransport;
    //         $user->otherCost += $additionalOther;

    //         // Add additional t-shirt and room costs for each user
    //         $user->totalAdditionalTshirtCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->m_size + $member->l_size + $member->xl_size + $member->xxl_size) * ($individualRoomCost->t_shirt_price ?? 0);
    //         });

    //         // Add main user T-shirt cost here
    //         $user->userTshirtCost = ($individualRoomCost->t_shirt_price ?? 0);

    //         $user->totalAdditionalRoomCost = $user->additinalMembers->sum(function ($member) use ($individualRoomCost) {
    //             return ($member->single_room * ($individualRoomCost->single_room_cost ?? 0)) +
    //                 ($member->couple_room * ($individualRoomCost->couple_room_cost ?? 0));
    //         });

    //         // Add paid amount for each user based on additional_cost_user
    //         $paidAmount = $paidTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
    //         $user->add_amount = $paidAmount;  // Update the paid amount for the user
    //     }

    //     return view('backend.individualCost.individual', compact(
    //         'users',
    //         'distributedFoodCost',
    //         'distributedTransportCost',
    //         'distributedOtherCost',
    //         'distributedOfficeAddAmount',
    //         'individualRoomCost',
    //         'isAdminView'
    //     ));
    // }









    public function individualCost()
{
    $authUser = Auth::user();
    $isAdminView = !$authUser->id;

    if ($authUser->status == 1 || $isAdminView) {
        $users = User::get(); // Get all users instead of eager loading relationships
    } else {
        $users = User::where('id', $authUser->id)->get(); // Only get the authenticated user's data
    }

    $totalUsers = count(User::get());

    // Fetch room cost and T-shirt price
    $individualRoomCost = RoomCost::select('id', 'single_room_cost', 'couple_room_cost', 't_shirt_price')->first();

    // Calculate totals for each category
    $foodTransactions = Transaction::where('transaction_category', 'food')->get();
    $transportTransactions = Transaction::where('transaction_category', 'transportation')->get();
    $otherTransactions = Transaction::where('transaction_category', 'others')->get();
    $officeTransactions = Transaction::where('transaction_category', 'office')->get();
    $paidTransactions = Transaction::where('transaction_category', 'paid')->get();  // Get paid transactions

    // Calculate totals for each category
    $foodTotal = $foodTransactions->whereNull('additional_cost_user')->sum('add_amount');
    $transportTotal = $transportTransactions->whereNull('additional_cost_user')->sum('add_amount');
    $otherTotal = $otherTransactions->whereNull('additional_cost_user')->sum('add_amount');
    $officeTotal = $officeTransactions->sum('add_amount');

    // Calculate distributed costs
    $distributedFoodCost = ($totalUsers > 0) ? round($foodTotal / $totalUsers) : 0;
    $distributedTransportCost = ($totalUsers > 0) ? round($transportTotal / $totalUsers) : 0;
    $distributedOtherCost = ($totalUsers > 0) ? round($otherTotal / $totalUsers) : 0;
    $distributedOfficeAddAmount = ($totalUsers > 0) ? round($officeTotal / $totalUsers) : 0;

    // Add paid amount for each user (based on additional_cost_user)
    foreach ($users as $user) {
        // Add individual cost distributions
        $user->foodCost = $distributedFoodCost;
        $user->transportCost = $distributedTransportCost;
        $user->otherCost = $distributedOtherCost;

        // Add any additional costs for the user
        $additionalFood = $foodTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
        $additionalTransport = $transportTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
        $additionalOther = $otherTransactions->where('additional_cost_user', $user->id)->sum('add_amount');

        $user->foodCost += $additionalFood;
        $user->transportCost += $additionalTransport;
        $user->otherCost += $additionalOther;

        // Calculate additional T-shirt cost for the user (if any additional members exist)
        $user->totalAdditionalTshirtCost = ($user->additional_members) * ($individualRoomCost->t_shirt_price ?? 0);

        // Add main user T-shirt cost here
        $user->userTshirtCost = ($individualRoomCost->t_shirt_price ?? 0);

        // Calculate additional room costs based on the number of additional members
        $user->totalAdditionalRoomCost = ($user->additional_members) * (($individualRoomCost->single_room_cost ?? 0) + ($individualRoomCost->couple_room_cost ?? 0));

        // Add paid amount for each user based on additional_cost_user
        $paidAmount = $paidTransactions->where('additional_cost_user', $user->id)->sum('add_amount');
        $user->add_amount = $paidAmount;  // Update the paid amount for the user

        // Add guest costs: Food, Transport, Other (If there are additional members)
        $user->guestFoodCost = ($user->additional_members) * $distributedFoodCost;
        $user->guestTransportCost = ($user->additional_members) * $distributedTransportCost;
        $user->guestOtherCost = ($user->additional_members) * $distributedOtherCost;
    }

    return view('backend.individualCost.individual', compact(
        'users',
        'distributedFoodCost',
        'distributedTransportCost',
        'distributedOtherCost',
        'distributedOfficeAddAmount',
        'individualRoomCost',
        'isAdminView'
    ));
}

    



    



    //* INDIVIDUAL DETAILS 
    public function individualDetails($id){
        // Fetch the user with their transactions and additionalMembers
        $user = User::with('transactions', 'additinalMembers')->find($id);
    
        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User  not found.');
        }
    
        // Initialize sums for each t-shirt size
        $totalM = 0;
        $totalL = 0;
        $totalXL = 0;
        $totalXXL = 0;
    
        // Check if additionalMembers exists and is not null
        if ($user->additinalMembers) {
            // Calculate the total sum for each t-shirt size
            $totalM = $user->additinalMembers->sum('m_size');
            $totalL = $user->additinalMembers->sum('l_size');
            $totalXL = $user->additinalMembers->sum('xl_size');
            $totalXXL = $user->additinalMembers->sum('xxl_size');
        }
    
        // Calculate the total t-shirt size
        $totalTShirt = $totalM + $totalL + $totalXL + $totalXXL;
    
        // Pass the user and t-shirt sums to the view
        return view('backend.individualCost.individualDetails', compact('user', 'totalM', 'totalL', 'totalXL', 'totalXXL', 'totalTShirt'));
    }









   
    //* EDIT INDIVIDUAL DATA
    public function editIndividualDetails($id)
    {
        // Fetch the transaction to be edited with its associated user
        $editTransaction = Transaction::with('users')->find($id);

        // Fetch all users to populate the dropdown
        $users = User::all();

        // Pass the data to the view
        return view('backend.transaction.editTransaction', compact('editTransaction', 'users'));
    }

    //**UPDATE TRANSACTION  */
    public function updateIndividualDetails(Request $request, $id){
        // dd($request->all());
        $updateTransaction = Transaction::find($id);
        $updateTransaction->additional_cost_user = $request->additional_cost_user;
        $updateTransaction->auth_user = Auth::user()->name;
        $updateTransaction->user_id = Auth::user()->id;
        $updateTransaction->transaction_category = $request->transaction_category;
        $updateTransaction->transaction_description = $request->transaction_description;
        $updateTransaction->add_amount = $request->add_amount;
        $updateTransaction->cost_amount = $request->cost_amount;
        $updateTransaction->save();
    }
}
