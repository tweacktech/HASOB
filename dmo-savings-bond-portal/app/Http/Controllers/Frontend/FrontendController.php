<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


use App\Http\Controllers\Controller;

class FrontendController extends \Hasob\FoundationCore\Controllers\BaseController
{    


    public function displayHome(Organization $org, Request $request){

        $current_user = Auth()->user();

        return view('frontend.index')
                    ->with('organization', $org)
                    ->with('current_user', $current_user)
                    ->with('states_list', $this->statesList());
    }


}
