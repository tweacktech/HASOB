@if ($socialable!=null)

    @php
        $socials = $socialable->socials();
    @endphp


    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-twitter me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-facebook-square me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-linkedin-square me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-youtube me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-instagram me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-pinterest me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-whatsapp me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-vimeo me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-reddit me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-digg me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-snapchat me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="input-group mb-3"> 
        <span class="input-group-text" id="basic-addon1"><i class="bx bxl-twitch me-0"></i></span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
        <button type="button" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    @push('page_css')
    @endpush

    @push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
    @endpush


@endif