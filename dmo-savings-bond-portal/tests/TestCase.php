<?php

namespace Tests;


use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//use App\Models\User;
use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Laravel\Sanctum\Sanctum;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected $test_org;
    protected $test_user;
    protected $test_dept;
    protected $faker;
    protected function setUp(): void
    {
        parent::setUp();
        
        $test_org_id = Organization::create([
            'org' => 'app',
            'domain' => 'test',
            'full_url' => 'www.app.test',
            'subdomain' => 'sub',
            'is_local_default_organization' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ])->id;
        $test_org = Organization::find($test_org_id);

        $test_dept_id = Department::create([
            'key' => 'ict-admin',
            'long_name' => 'ICT Admin',
            'email' => 'ict-admin@app.com',
            'telephone' => '07085554141',
            'physical_location' => '2nd Floor, Room 20 - 28',
            'organization_id' => $test_org_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ])->id;
        $test_dept = Organization::find($test_dept_id);
                
        $test_admin_id = User::create([
            'email' => 'admin@app.com',
            'telephone' => '07063321200',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'organization_id' => $test_org_id,
            'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ])->id;
        $test_user = User::find($test_admin_id);

        Sanctum::actingAs(
            $test_user,
            ['*']
        );
    
    }


}
