
    <div class="card">
        
            <div class="card-body" style="">

                <div class="card-title" style="">
                    <h6 class="panel-title txt-light-dark-blue">
                        <a href="#">
                            <i class="zmdi zmdi-assignment mr-5"></i>
                            Tasks
                        </a>
                    </h6>
                </div>

                <table class="table table-hover mb-0 small">
                    @if (count($assignments)==0)
                    <tr>
                        <td class="text-center pa-5">No tasks assigned to you</td>
                    </tr>
                    @else
                    <tbody>
                        @foreach ($assignments as $idx => $item)
                            <tr>
                                <td class="pa-5"><a href="{{ route('wf.request-display',$item->id) }}">{!! $item->work_item->title !!}</td>
                                <td class="pa-5">{!! $item->getAssignmentDateDurationString() !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>

    </div>
