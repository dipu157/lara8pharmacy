<div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Medicine</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_Medicine_form">
          @csrf
            <input type="hidden" id="medicine_id" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="med_name" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shelf</label>
                            {!! Form::select('shelf_id',$shelf,null,array('id'=>'shelf_id','class'=>'form-control','name'=>'shelf_id')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supplier</label>
                            {!! Form::select('supplier_id',$supplier,null,array('id'=>'supplier_id','class'=>'form-control','name'=>'supplier_id')) !!}
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Batch No</label>
                            <input type="text" id="batch_noid" class="form-control" name="batch_no" >
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Generic</label>
                            {!! Form::select('generic_id',$generic,null,array('id'=>'generic_id','class'=>'form-control','name'=>'generic_id')) !!}
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Strength</label>
                            {!! Form::select('strength_id',$strength,null,array('id'=>'strength_id','class'=>'form-control','name'=>'strength_id')) !!}
                        </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Medicine Type</label>
                              {!! Form::select('medicine_type_id',$medicine_type,null,array('id'=>'medicine_type_id','class'=>'form-control','name'=>'medicine_type_id')) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Box Size</label>
                              <input type="text" id="box_sizeid" class="form-control" name="box_size"  required>
                            </div>
                         </div>

                         <div class="col-md-6">
                          <div class="form-group">
                              <label>Box Price</label>
                              <input type="text" id="box_priceid" class="form-control" name="box_price" required>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>MRP</label>
                              <input type="text" class="form-control" id="mrpid" name="mrp" >
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Trade Price</label>
                              <input type="text" class="form-control" id="trade_priceid" name="trade_price" required>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>VAT</label>
                              <input type="text" class="form-control" id="vatid" name="vat">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Purchase Discount</label>
                              <input type="text" class="form-control" id="p_discountid" name="p_discount">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Unit Purchase</label>
                              <input type="text" class="form-control" id="u_purchaseid" name="u_purchase" >
                            </div>
                         </div>

                         <div class="col-md-6">
                          <div class="form-group">
                              <label>Details</label>
                              <textarea class="form-control" cols="2" rows="2" name="details" id="detailsid"></textarea>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Side Effect</label>
                              <input type="text" class="form-control" id="side_effectid" name="side_effect">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Short Stock</label>
                              <input type="number" class="form-control" id="short_stockid" name="short_stock" required>
                            </div>
                         </div>

                         <div class="col-md-1"></div>

                         <div class="col-md-5">
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="favourite" id="favouriteid" value="1">
                                <label class="form-check-label" for="favourite">Favourite</label> <br>

                                <input type="checkbox" class="form-check-input" name="is_discount" id="is_discountid" value="1">
                                <label class="form-check-label" for="is_discount">Is_Discount</label>
                            </div>
                         </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="edit_Medicine_btn" class="btn btn-primary">Update</button>
            </div>
        </form>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

