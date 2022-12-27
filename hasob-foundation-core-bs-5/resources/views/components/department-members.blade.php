<div class="row">
    <div class="col-lg-12">
        @if (count($department->members) > 0)
        <ul>
        @foreach($department->members as $idx=>$member)
            <li>{{ $member->full_name }}</li>
        @endforeach
        </ul>
        @else

        @endif
    </div>
</div>