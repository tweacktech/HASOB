<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class Ledger extends Model
{
    use SoftDeletes;
    use Artifactable;
    use GuidId;

    public $table = 'fc_ledgers';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'name',
        'code',
        'department_id',
        'ledgerable_id',
        'ledgerable_type',
        'creator_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'code' => 'string',
        'department_id' => 'string',
        'ledgerable_id' => 'string',
        'ledgerable_type' => 'string',
        'creator_user_id' => 'string',
        'organization_id' => 'string'
    ];

    public static function all_ledgers(Organization $org = null){

        $model = new Ledger();
        $query = $model->newQuery();

        if ($org!=null){
            $query->where('organization_id', $org->id);
        }

        return $query->get();
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function creator_user(){
        return $this->hasOne(User::class,'id','creator_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function items(){
        return $this->hasMany(LedgerItem::class);
    }

    public function item_count(){
        return LedgerItem::where('ledger_id', $this->id)->count('id');
    }

    public function balance(){

        $credits = LedgerItem::where('ledger_id', $this->id)
                                ->where('entry_type','credit')
                                ->sum('entry_amount');

        $debits = LedgerItem::where('ledger_id', $this->id)
                                ->where('entry_type','debit')
                                ->sum('entry_amount');

        return ($credits - $debits);
    }
    
}
