<div class="nk-modal modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ion-android-close"></span>
                </button>

                <h4 class="mb-0">Search</h4>

                <div class="nk-gap-1"></div>
                <form action="{{route('search')}}" method="post" class="nk-form nk-form-style-1">
                    @csrf
                    <input type="text" value="" name="search" class="form-control" placeholder="Type something and press Enter" autofocus required>
                </form>
            </div>
        </div>
    </div>
</div>