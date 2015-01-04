<!-- ******Panel Section****** --> 
<section class="user-panel user-panel-listing section has-bg-color">
    <div class="container">
        <h2 class="title text-center"><i class="fa fa-shopping-cart"></i> <?=__('Checkout')?></h2>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="panel">
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong><?=core::config('general.site_name')?></strong>
                                <br>
                                <?=Kohana::$base_url?>
                                <?if (core::config('general.company_name')!=''):?>
                                <br>
                                <em><?=core::config('general.company_name')?></em>
                                <?endif?>
                                <?if (core::config('general.vat_number')!=''):?>
                                <br>
                                <em><?=core::config('general.vat_number')?></em>
                                <?endif?>
                                <br>
                                <em><?=__('Date')?>: <?= Date::format($order->created, core::config('general.date_format'))?></em>
                                <br>
                                <em><?=__('Order')?> #: <?=$order->id_order?></em>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong><?=$user->name?></strong>
                                <br>
                                <?=$user->email?>
                                <?if (strlen($order->VAT_number)>2):?>
                                <br>
                                <em><?=__('VAT')?> <?=$order->VAT_number?></em>
                                <?endif?>
                                <br>
                                <em><?=euvat::country_name($order->country)?>, <?=$order->city?></em>
                                <br>
                                <em><?=$order->address?>, <?=$order->postal_code?></em>
                            </address>
                            <a class="btn btn-warning btn-xs pull-right"  href="<?=Route::url('oc-panel', array('controller'=> 'profile','action'=>'edit'))?>?order_id=<?=$order->id_order?>#billing" >
                                <i class="fa fa-credit-card"></i> <?=__('Update details')?>
                            </a>
                        </div>
                    </div><!--//row-->
                    <div class="row">
                        <h3 class="text-center"><?=__('Summary')?></h3>
                        <div class="col-xs-12">
                            <table class="table table-striped table-user-panel" id="checkout-table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th><?=__('Product')?></th>
                                        <th></th>
                                        <th class="text-center"><?=__('Price')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-1" style="text-align: center"><?=$order->id_product?></td>
                                        <td class="col-md-7">
                                            <?=$product->title?> 
                                        </td>
                                        <td class="col-md-2">
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <?=i18n::format_currency($order->product->price, $order->currency)?>
                                        </td>
                                    </tr>
                                    <?if ($order->coupon->loaded()):?>
                                        <?$discount = ($order->coupon->discount_amount==0)?($order->product->price * $order->coupon->discount_percentage/100):$order->coupon->discount_amount;?>
                                        <tr>
                                            <td class="col-md-1" style="text-align: center">
                                                <?=$order->id_coupon?>
                                            </td>
                                            <td class="col-md-7">
                                                <?=__('Coupon')?> '<?=$order->coupon->name?>'
                                                <?=__('valid until')?> <?=Date::format($order->coupon->valid_date)?>.
                                            </td>
                                            <td class="col-md-2">
                                            </td>
                                            <td class="col-md-2 text-center text-danger">
                                                -<?=i18n::format_currency($discount, $order->currency)?>
                                            </td>
                                        </tr>  
                                    <?endif?>     

                                    <?if ($order->VAT > 0 OR (euvat::is_eu_country($order->country) 
                                                                AND core::config('general.eu_vat')==TRUE 
                                                                AND Date::mysql2unix($order->created) >= strtotime(euvat::$date_start))
                                            ):?>  
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><h4><strong><?=__('Sub Total')?>: </strong></h4></td>
                                            <td class="text-center">
                                                <h4>
                                                <?if (!$order->coupon->loaded()):?>
                                                    <?=i18n::format_currency($order->product->price, $order->currency)?>
                                                <?else:?>
                                                    <?=i18n::format_currency($order->product->price-$discount, $order->currency)?>
                                                <?endif?>
                                                </h4>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">
                                                <h4><?=__('VAT')?> <?=round($order->VAT,1)?>%</h4>
                                                <small>
                                                    <?=euvat::country_name($order->country)?>
                                                    <?=(euvat::is_eu_country($order->country) AND strlen($order->VAT_number)>2) ?'VIES':''?>
                                                </small>
                                            </td>
                                            <td class="text-center"><h4>
                                                <?if (!$order->coupon->loaded()):?>
                                                    <?=i18n::format_currency($order->VAT*$order->product->price/100, $order->currency)?>
                                                <?else:?>
                                                    <?=i18n::format_currency($order->VAT*($order->product->price-$discount)/100, $order->currency)?>
                                                <?endif?></h4>
                                            </td>
                                        </tr>            
                                    <?endif?>       
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><h2><strong><?=__('Total')?>: </strong></h2></td>
                                        <td class="text-center text-danger"><h2><strong><?=i18n::format_currency($order->amount, $order->currency)?></strong></h2></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--//col-*-->
                        <div class="col-xs-4">
                            <form class="form-inline"  method="post" action="<?=URL::current()?>">         
                                <?if ($order->coupon->loaded()):?>
                                    <?=Form::hidden('coupon_delete',$order->coupon->name)?>
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-minus"></span>
                                        <?=__('Delete coupon')?> '<?=$order->coupon->name?>'
                                    </button>
                                <?else:?>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="coupon" value="<?=Core::request('coupon')?>" placeholder="<?=__('Coupon Name')?>">          
                                    </div>
                                        <button type="submit" class="btn btn-primary"><?=__('Add')?></button>
                                <?endif?>       
                            </form>
                            <br>
                            <br>
                        </div><!--//col-*-->
                        <div class="col-xs-8 text-right">

                            <a class="btn btn-success btn-lg paypal-pay" href="<?=Route::url('default', array('controller'=> 'paypal','action'=>'pay' , 'id' => $order->id_order))?>">
                                <?=__('Pay with Paypal')?> <i class="fa fa-long-arrow-right"></i>
                            </a>
                            <br><br>

                            <?=StripeKO::button($order)?>
                            <?=Paymill::button($order)?>
                            <?=Bitpay::button($order)?>
                            <?=Controller_Authorize::form($order)?>
                            
                            <?=$order->alternative_pay_button()?>
                        </div><!--//col-*-->
                    </div><!--//row-->
                </div><!--//panel-->
            </div><!--//col-*-->
        </div><!--//row-->
    </div><!--//container-->        
</section><!--//user-panel-->