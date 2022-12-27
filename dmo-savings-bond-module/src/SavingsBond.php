<?php
namespace DMO\SavingsBond;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;


class SavingsBond
{


    public function get_menu_map(){

        $current_user = Auth::user();
        if ($current_user != null){

            $organization = $current_user->organization;
            if (\FoundationCore::has_feature('savings-bond', $organization)){        
                
                $fc_menu = [];

                if ($current_user->hasAnyRole(['admin','dmo-admin'])){
                    $fc_menu['mnu_sb_dashboard'] = [
                        'id'=>'mnu_sb_dashboard',
                        'label'=>'SavingsBond',
                        'icon'=>'bx bx-unite',
                        'path'=> route('sb.dashboard'),
                        'route-selector'=>'sb/dashboard*',
                        'is-parent'=>true,
                        'children' => []
                    ];
                }

                if ($current_user->hasAnyRole(['admin','dmo-admin'])){
                    $fc_menu['mnu_sb_admin'] = [
                        'id'=>'mnu_sb_admin',
                        'label'=>'SavingsBond Admin',
                        'icon'=>'bx bx-grid-alt',
                        'path'=> '#',
                        'route-selector'=>'sb/results*',
                        'is-parent'=>true,
                        'children' => [

                            'mnu_sb_bond_offers' => [
                                'id'=>'mnu_sb_bond_offers',
                                'label'=>'Bond Offers',
                                'icon'=>'bx bx-right-arrow-alt',
                                'path'=> route('sb.offers.index'),
                                'route-selector'=>'sb/offers*',
                                'is-parent'=>false,
                                'children' => []
                            ],
                            'mnu_sb_investors' => [
                                'id'=>'mnu_sb_investors',
                                'label'=>'Investors',
                                'icon'=>'bx bx-right-arrow-alt',
                                'path'=> route('sb.investors.index'),
                                'route-selector'=>'sb/investors*',
                                'is-parent'=>false,
                                'children' => []
                            ],
                            'mnu_sb_brokers' => [
                                'id'=>'mnu_sb_brokers',
                                'label'=>'Brokers',
                                'icon'=>'bx bx-right-arrow-alt',
                                'path'=> route('sb.brokers.index'),
                                'route-selector'=>'sb/brokers*',
                                'is-parent'=>false,
                                'children' => []
                            ],
                            'mnu_sb_subscriptions' => [
                                'id'=>'mnu_sb_subscriptions',
                                'label'=>'Subscriptions',
                                'icon'=>'bx bx-right-arrow-alt',
                                'path'=> route('sb.subscriptions.index'),
                                'route-selector'=>'sb/subscriptions*',
                                'is-parent'=>false,
                                'children' => []
                            ]
                        ]
                    ];
                }

                return $fc_menu;
            }
        }
        return [];
    }

    public function api_routes(){

        Route::name('sb-api.')->prefix('sb-api')->group(function(){
            Route::resource('offers', \DMO\SavingsBond\Controllers\API\OfferAPIController::class);
            Route::resource('brokers', \DMO\SavingsBond\Controllers\API\BrokerAPIController::class);
            Route::resource('broker_staffs', \DMO\SavingsBond\Controllers\API\BrokerStaffAPIController::class);
            Route::resource('investors', \DMO\SavingsBond\Controllers\API\InvestorAPIController::class);
            Route::resource('bids', \DMO\SavingsBond\Controllers\API\BidAPIController::class);
            Route::resource('subscriptions', \DMO\SavingsBond\Controllers\API\SubscriptionAPIController::class);
        });
    }

    public function api_public_routes(){
    }

    public function public_routes(){
    }

    public function routes(){

        Route::name('sb.')->prefix('sb')->group(function(){

            Route::get('/dashboard', [\DMO\SavingsBond\Controllers\Dashboard\DashboardController::class, 'displayDashboard'])->name('dashboard');

            Route::resource('offers', \DMO\SavingsBond\Controllers\Models\OfferController::class);
            Route::resource('brokers', \DMO\SavingsBond\Controllers\Models\BrokerController::class);
            Route::resource('brokerStaffs', \DMO\SavingsBond\Controllers\Models\BrokerStaffController::class);
            Route::resource('investors', \DMO\SavingsBond\Controllers\Models\InvestorController::class);
            Route::resource('bids', \DMO\SavingsBond\Controllers\Models\BidController::class);
            Route::resource('subscriptions', \DMO\SavingsBond\Controllers\Models\SubscriptionController::class);

        });

    }


}