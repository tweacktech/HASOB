<?php

namespace Database\Seeders;

use Hash;
use Carbon\Carbon;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;


class FoundationCoreSeeder extends Seeder
{
    public function run()
    {

        //Create default organization
        $default_org_id = null;
        if (DB::table('fc_organizations')->count() == 0){
            $default_org_id = Organization::create([
                'org' => 'app',
                'domain' => 'test',
                'full_url' => 'www.app.test',
                'subdomain' => 'sub',
                'is_local_default_organization' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        }else{
            $default_org_id = DB::table('fc_organizations')->where('is_local_default_organization', true)->select('id')->first()->id;
        }

        //Create default permissions
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create roles and permissions
        $roleWithPermissions = [
            'principal-officer'     =>  [],
            'admin'                 =>  []
        ];

        foreach ($roleWithPermissions as $role=>$permissions) {

            try{
                $dbRole = Role::findByName($role);
            }catch(RoleDoesNotExist $e) {
                $dbRole = Role::create(['name'=>$role]);
            }

            foreach ($permissions as $permission){
                try{
                    $dbPerm = Permission::findByName($permission);
                }catch(PermissionDoesNotExist $e) {
                    $dbPerm = Permission::create(['name'=>$permission]);
                }
                $dbRole->givePermissionTo($permission);
            }
        }

        if (DB::table('fc_departments')->where('key', 'ict-admin')->count() == 0){
            $fc_department_id = Department::create([
                'key' => 'ict-admin',
                'long_name' => 'ICT Admin',
                'email' => 'ict-admin@app.com',
                'telephone' => '07085554141',
                'physical_location' => '2nd Floor, Room 20 - 28',
                'organization_id' => $default_org_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        }


        //Create user accounts
        if (DB::table('fc_users')->where('email', 'admin@app.com')->count() == 0){
            $platform_admin_id = User::create([
                'email' => 'admin@app.com',
                'telephone' => '07063321200',
                'password' => Hash::make('password'),
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'organization_id' => $default_org_id,
                'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        
            $usr = User::where('email','admin@app.com')->first();
            if ($usr != null){ $usr->assignRole('admin'); }
        }

        if (DB::table('fc_users')->where('email', 'admin2@app.com')->count() == 0){
            $platform_admin_id = User::create([
                'email' => 'admin2@app.com',
                'telephone' => '07053321200',
                'password' => Hash::make('password'),
                'first_name' => 'Admin2',
                'last_name' => 'Admin2',
                'organization_id' => $default_org_id,
                'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        
            $usr = User::where('email','admin2@app.com')->first();
            if ($usr != null){ $usr->assignRole('admin'); }
        }
        
        if (DB::table('fc_users')->where('email', 'executive@app.com')->count() == 0){
            $platform_admin_id = User::create([
                'email' => 'executive@app.com',
                'telephone' => '07033321200',
                'password' => Hash::make('password'),
                'first_name' => 'Executive',
                'last_name' => 'Officer',
                'organization_id' => $default_org_id,
                'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        
            $usr = User::where('email','executive@app.com')->first();
            if ($usr != null){ $usr->assignRole('principal-officer'); }
        }

        if (DB::table('fc_attachments')->where('label', 'Uploaded PDF Document')->count() == 0){
            $usr = User::where('email','admin@app.com')->first();
            $attachment_id = Attachment::create([
                'label' => 'Uploaded PDF Document',
                'path' => '/path/to/file.pdf',
                'path_type' => 'pdf',
                'file_number' => 1,
                'file_type' => 'local',
                'uploader_user_id' => $usr->id,
                'organization_id' => $default_org_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ])->id;
        }
    }
}