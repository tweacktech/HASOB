<?php

namespace Hasob\FoundationCore\Controllers;

use Carbon;
use Session;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

class SiteDisplayController extends BaseController
{

    public function index(Organization $org, Request $request, $id){

        return view('hasob-foundation-core::sites.index')
                ->with('sites', Site::all_sites($org));
    }

}
