<?php
namespace Hasob\FoundationCore\Traits;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\DisabledItem;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Disable
{
    public function is_disabled(){

        $disabled_count = DisabledItem::where('disable_id', $this->id)
                                        ->where('disable_type', self::class)
                                        ->where('is_disabled', true)
                                        ->count();

        $enabled_count = DisabledItem::where('disable_id', $this->id)
                                        ->where('disable_type', self::class)
                                        ->where('is_disabled', false)
                                        ->count();

        return ($enabled_count < $disabled_count);
    }

    public function is_enabled(){

        $disabled_count = DisabledItem::where('disable_id', $this->id)
                                        ->where('disable_type', self::class)
                                        ->where('is_disabled', true)
                                        ->count();

        $enabled_count = DisabledItem::where('disable_id', $this->id)
                                        ->where('disable_type', self::class)
                                        ->where('is_disabled', false)
                                        ->count();

        return ($enabled_count >= $disabled_count);
    }

    public function disable($comments, User $user = null){

        if ($user == null){
            $user = Auth()->user();
        }

        $disabledItem = new DisabledItem();
        $disabledItem->disable_id = $this->id;
        $disabledItem->disable_type = self::class;
        $disabledItem->is_disabled = true;
        $disabledItem->disable_reason = $comments;
        $disabledItem->disabled_at = Carbon::now();
        $disabledItem->disabling_user_id = $user->id;
        $disabledItem->organization_id = $user->organization_id;
        $disabledItem->save();
    }

    public function enable($comments, User $user = null){
        if ($user == null){
            $user = Auth()->user();
        }

        $disabledItem = new DisabledItem();
        $disabledItem->disable_id = $this->id;
        $disabledItem->disable_type = self::class;
        $disabledItem->is_disabled = false;
        $disabledItem->disable_reason = $comments;
        $disabledItem->disabled_at = Carbon::now();
        $disabledItem->disabling_user_id = $user->id;
        $disabledItem->organization_id = $user->organization_id;
        $disabledItem->save();
    }
}
