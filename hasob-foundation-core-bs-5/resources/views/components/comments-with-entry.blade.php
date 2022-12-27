@if (isset($commentable) && $commentable!=null)
    <div class="col-lg-12" style='padding-left:0px;'>
        <x-hasob-foundation-core::comment-entry :commentable-object="$commentable" />
        <br/>
        <x-hasob-foundation-core::comment-list :commentable-object="$commentable" />
    </div>
@endif