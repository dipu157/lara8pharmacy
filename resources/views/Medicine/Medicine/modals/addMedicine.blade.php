<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Medicine</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_Medicine_form">
          @csrf

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Medicine Name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shelf</label>
                            {!! Form::select('shelf_id',$shelf,null,array('id'=>'shelf_id','class'=>'form-control select2','name'=>'shelf_id')) !!}
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
                            <input type="text" id="batch_no" class="form-control" name="batch_no" placeholder="Batch No">
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
                              <input type="text" id="box_size" class="form-control" name="box_size" placeholder="Box Size" required>
                            </div>
                         </div>

                         <div class="col-md-6">
                          <div class="form-group">
                              <label>Box Price</label>
                              <input type="text" id="box_price" class="form-control" name="box_price" placeholder="Box Price" required>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>MRP</label>
                              <input type="text" class="form-control" id="mrp" name="mrp" placeholder="MRP">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Trade Price</label>
                              <input type="text" class="form-control" id="trade_price" name="trade_price" placeholder="Trade Price" required>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>VAT</label>
                              <input type="text" class="form-control" id="vat" name="vat" placeholder="VAT" value="0">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Purchase Discount</label>
                              <input type="text" class="form-control" id="p_discount" name="p_discount" placeholder="Purchase Discount" value="0">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Unit Purchase</label>
                              <input type="text" class="form-control" id="u_purchase" name="u_purchase" placeholder="Unit Purchase">
                            </div>
                         </div>

                         <div class="col-md-6">
                          <div class="form-group">
                              <label>Details</label>
                              <textarea class="form-control" cols="2" rows="2" name="details"></textarea>
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Side Effect</label>
                              <input type="text" class="form-control" id="side_effect" name="side_effect" placeholder="Side Effect">
                            </div>
                         </div>

                         <div class="col-md-6">
                            <div class="form-group">
                              <label>Short Stock</label>
                              <input type="number" class="form-control" id="short_stock" name="short_stock" placeholder="Short Stock Quantuty" required>
                            </div>
                         </div>

                         <div class="col-md-1"></div>

                         <div class="col-md-5">
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="favourite" id="favourite" value="1">
                                <label class="form-check-label" for="favourite">Favourite</label> <br>

                                <input type="checkbox" class="form-check-input" name="is_discount" id="is_discount" value="1">
                                <label class="form-check-label" for="is_discount">Is_Discount</label>
                            </div>
                         </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="add_Medicine_btn" class="btn btn-primary">Save</button>
            </div>
        </form>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

