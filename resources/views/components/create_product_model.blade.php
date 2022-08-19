<div class="modal product_create" id="product_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-signup modal-cproduct" role="document">
        <div class="modal-content">
            <form id="create_product" class="create_product">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h4 class="modal-title card-title prdouctModelTitle" style="text-align: left;">Add New Product
                            Cost</h4>
                        <h5 class="modal-title card-title">
                            <div class="input-group">
                                <input type="text" name="product_name" id="product_name" placeholder="Product Name..."
                                    class="form-control" required />
                                <span class="input-group-addon">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                            </div>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 ml-auto">
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="material-icons">euro</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title ">Costs till ready to sell</h4>
                                        <div class="input-group">
                                            <input type="number" name="costs_till_ready_to_sell"
                                                id="costs_till_ready_to_sell" placeholder="Units..."
                                                class="form-control" required />
                                            <span class="input-group-addon">
                                                <i class="material-icons">euro</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-info">
                                        <i class="material-icons">point_of_sale</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Payout per unit <sup>By Amazon</sup></h4>
                                        <div class="input-group">
                                            <input type="number" name="payout_per_unit_by" id="payout_per_unit_by"
                                                placeholder="€ Cost" class="form-control" required step="0.01" />
                                            <span class="input-group-addon">
                                                <i class="material-icons">euro</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-success">
                                        <i class="material-icons">sell</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title ">PPC cost per product lump</h4>
                                        <div class="input-group">
                                            <input type="number" name="ppc_cost_per_product" id="ppc_cost_per_product"
                                                placeholder="€ Cost" class="form-control" required step="0.01" />
                                            <span class="input-group-addon">
                                                <i class="material-icons">euro</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <div class="info info-horizontal">
                                    <div class="icon icon-danger">
                                        <i class="material-icons">aod</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title ">Deposit portion</h4>
                                        <div class="input-group">
                                            <input type="number" name="deposit_portion" id="deposit_portion"
                                                placeholder=" Deposit portion % " class="form-control" required
                                                max="100" min="0" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-warning">
                                        <i class="material-icons">timelapse</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title ">Deposit leadtime <sup>(week)</sup></h4>
                                        <div class="input-group">
                                            <input type="number" name="deposit_leadtime" id="deposit_leadtime"
                                                placeholder="Weeks..." class="form-control" required />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"
                                                    style="font-size: 24px;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-rose">
                                        <i class="material-icons">timeline</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Paying Delay Amazon <sup>(week)</sup></h4>
                                        <div class="input-group">
                                            <input type="number" name="payment_delay_amazon" id="payment_delay_amazon"
                                                placeholder="€ Cost" class="form-control" required value="4"/>
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <div class="info info-horizontal">
                                    <div class="icon icon-savings">
                                        <i class="material-icons">savings</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Final payment portion</h4>
                                        <div class="input-group">
                                            <input type="number" name="final_payment_portion" id="final_payment_portion"
                                                placeholder="Final payment portion % " class="form-control" required
                                                max="100" min="0" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-payments">
                                        <i class="material-icons">payments</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Final Paying leadtime <sup>(week)</sup></h4>
                                        <div class="input-group">
                                            <input type="text" name="final_payment_leadtime" id="final_payment_leadtime"
                                                placeholder="....Weeks" class="form-control" required />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"
                                                    style="font-size: 24px;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-account_balance">
                                        <i class="material-icons">account_balance</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title ">Selling Price</h4>
                                        <div class="input-group">
                                            <input type="text" id="selling_price_for_sales_tax" placeholder="€ Cost"
                                                class="form-control" required />
                                            <span class="input-group-addon">
                                                <i class="material-icons">euro</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  text-center pt-5">
                                <button type="submit"
                                    class="btn btn-primary col-md-6 btn-wd btn-lg productSubmit">Upload</button>
                            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
