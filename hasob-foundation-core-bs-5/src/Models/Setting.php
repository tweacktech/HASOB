<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\OrganizationalConstraint;


class Setting extends Model
{
    use GuidId;
    use Attachable;
    use OrganizationalConstraint;
    
    use SoftDeletes;
    use HasFactory;

    public $table = 'fc_settings';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'organization_id',
        'key',
        'value',
        'owner_feature',
        'display_type',
        'display_ordinal',
        'display_name',
        'group_name',
        'model_type',
        'model_value',
        'allowed_editor_roles',
        'allowed_view_roles'
    ];

    protected $casts = [
        'display_ordinal' => 'integer',
        'display_name' => 'string',
        'display_type' => 'string',
        'allowed_editor_roles' => 'string',
        'allowed_view_roles' => 'string',
        'owner_feature' => 'string',
        'key' => 'string',
        'value' => 'string',
        'group_name' => 'string',
        'model_type' => 'string',
        'model_value' => 'string'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    
    public static function get($key, Organization $org = null){

        $model = new Setting();
        $query = $model->newQuery();
        $query->where('key', $key);

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }

        return $query->select('value')->first();
    }

    public static function set($key, $value, Organization $org = null){

        $model = new Setting();
        $query = $model->newQuery();
        $query->where('key', $key);

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }

        $item = $query->first();
        if ($item != null){
            $item->value = $value;
            $item->save();
        }
    }

    public static function all_groups(Organization $org = null){

        $model = new Setting();
        $query = $model->newQuery();

        if ($org!=null){
            $enabled_features = \FoundationCore::enabled_features($org);
            $query = $query->where(function($q) use ($enabled_features){
                $q->whereIn('owner_feature', $enabled_features);    
                $q->orWhere('owner_feature',"=",null);
            })->where('organization_id', $org->id);
        }

        $query->select('group_name');
        $query->orderBy('group_name','ASC');

        return array_unique($query->pluck('group_name')->toArray());
    }

    public static function all_settings(Organization $org = null){

        $model = new Setting();
        $query = $model->newQuery();

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }
        $query->orderBy('display_ordinal','ASC');

        return $query->get();
    }
    
}
