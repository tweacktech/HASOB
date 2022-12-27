<?php

namespace Hasob\FoundationCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Hasob\FoundationCore\Events\LedgerItemCreatedEvent;
use Hasob\FoundationCore\Events\LedgerItemUpdatedEvent;
use Hasob\FoundationCore\Events\LedgerItemDeletedEvent;


use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\Attachable;
use Hasob\FoundationCore\Traits\Commentable;
use Hasob\FoundationCore\Traits\Socialable;
use Hasob\FoundationCore\Traits\Taggable;
use Hasob\FoundationCore\Traits\Disable;
use Hasob\FoundationCore\Traits\Artifactable;

class LedgerItem extends Model
{
    use SoftDeletes;
    use Attachable;
    use Artifactable;
    use GuidId;

    public $table = 'fc_ledger_items';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'name',
        'description',
        'entry_amount',
        'entry_type',
        'referenced_item_id',
        'referenced_item_controller_class',
        'referenced_item_controller_method',
        'referenced_item_route_name',
        'ledger_id',
        'entry_user_id',
        'organization_id'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'entry_amount' => 'double',
        'entry_type' => 'string',
        'referenced_item_id' => 'string',
        'referenced_item_controller_class' => 'string',
        'referenced_item_controller_method' => 'string',
        'referenced_item_route_name' => 'string',
        'ledger_id' => 'string',
        'entry_user_id' => 'string',
        'organization_id' => 'string'
    ];

    

    public function ledger(){
        return $this->hasOne(Ledger::class,'id','ledger_id');
    }

    public function entry_user(){
        return $this->hasOne(User::class,'id','entry_user_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

            
    public function save(array $options = []){

        $exists = $this->exists;
        parent::save($options);

        if ($exists){
            LedgerItemUpdatedEvent::dispatch($this);
        } else {
            LedgerItemCreatedEvent::dispatch($this);
        }

    }

    public function delete(){
        parent::delete();
        LedgerItemDeletedEvent::dispatch($this);
    }
    
    
}
