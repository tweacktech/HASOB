<?php
namespace Hasob\FoundationCore\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Comment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;


trait Commentable
{
    
    public function get_comments(){
        return Comment::where('commentable_id',$this->id)
                        ->where('commentable_type',self::class)
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function create_comment(User $user, $comment_text, $parent_id=null){
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->parent_id = $parent_id;
        $comment->content = $comment_text;
        $comment->commentable_id = $this->id;
        $comment->commentable_type = self::class;
        $comment->organization_id = $user->organization_id;
        $comment->save();

        return $comment;
    }

    public function update_comment(User $user, $comment_text,$id,$parent_id=null){

        $comments = new Comment();
        $comment = $comments->find($id);
        $comment->user_id = $user->id;
        $comment->parent_id = $parent_id;
        $comment->content = $comment_text;
        $comment->commentable_id = $this->id;
        $comment->commentable_type = self::class;
        $comment->organization_id = $user->organization_id;
        $comment->save();

        return $comment;
    }
    
}
