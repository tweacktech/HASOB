<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Models\Rating;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Ratable
{
    public function ratings(){
        $ratings = Rating::where('ratable_id',$this->id)
                                    ->where('ratable_type',self::class)
                                    ->orderBy('created_at')
                                    ->get();
        return $ratings;
    }

    public function create_rating(User $user, $score, $description, $max_score=5){

        //create rating
        $rating = new Rating();
        $rating->creator_user_id = $user->id;
        $rating->organization_id = $user->organization_id;
        $rating->ratable_type = self::class;
        $rating->ratable_id = $this->id;
        $rating->max_score = $max_score;
        $rating->score = $score;
        $rating->save();

        return $rating;
    }
}
