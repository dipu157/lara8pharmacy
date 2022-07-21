<div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width:1010px;margin-left: -100px">
            <div class="modal-header">
                <h2 style="text-align: center;">Purchase Review</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action='' method='post' class='form-horizontal' accept-charset='utf-8' id='ReviewForm'>
                @csrf
                <div class="modal-body" id="reviewDom">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" class="btn btn-info" id="FinalPrint" value="Save & Print">
                </div>
            </form>
        </div>
    </div>
</div>
