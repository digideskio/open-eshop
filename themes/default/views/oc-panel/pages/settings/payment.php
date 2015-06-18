<?php defined('SYSPATH') or die('No direct script access.');?>

<?=Form::errors()?>
<div class="page-header">
    <h1><?=__('Payments Configuration')?></h1>
    <p class=""><?=__('List of payment configuration values. Replace input fields with new desired values.')?></p>
    <?if (Theme::get('premium')!=1):?>
        <p class="well"><span class="label label-info"><?=__('Heads Up!')?></span> 
            <?=sprintf(__('%s are only available with premium themes!'),sprintf('Authorize, Stripe, Paymill %s Bitpay',__('and'))).'<br/>'.__('Upgrade your Open eShop site to activate this feature.')?>
            <a class="btn btn-success pull-right" href="<?=Route::url('oc-panel',array('controller'=>'theme'))?>"><?=__('Browse Themes')?></a>
        </p>
    <?endif?>
</div>

<div class="row">
    <div class="col-md-8">
        <?= FORM::open(Route::url('oc-panel',array('controller'=>'settings', 'action'=>'payment')), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal">
                        <?foreach ($config as $c):?>
                            <?$forms[$c->config_key] = array('key'=>$c->config_key, 'value'=>$c->config_value)?>
                        <?endforeach?>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['thanks_page']['key'], __('Thanks page'), array('class'=>'col-md-4 control-label', 'for'=>$forms['thanks_page']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::select($forms['thanks_page']['key'], $pages, $forms['thanks_page']['value'], array( 
                                'class' => 'tips form-control', 
                                'id' => $forms['thanks_page']['key'], 
                                'data-content'=> __("Select which page you want to redirect the user after a successful payment, be sure to mention to check their paypal account for an email."),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>__("Thanks for payment page"),
                                ))?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <?= FORM::label($forms['alternative']['key'], __('Alternative Payment'), array('class'=>'col-md-4 control-label', 'for'=>$forms['alternative']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::select($forms['alternative']['key'], $pages, $forms['alternative']['value'], array( 
                                'class' => 'tips form-control', 
                                'id' => $forms['alternative']['key'], 
                                'data-content'=> __("A button with the page title appears next to other pay button, onclick model opens with description."),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>__("Alternative Payment"),
                                ))?> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Paypal</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <?= FORM::label($forms['paypal_account']['key'], __('Paypal account'), array('class'=>'col-md-4 control-label', 'for'=>$forms['paypal_account']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['paypal_account']['key'], $forms['paypal_account']['value'], array(
                                'placeholder' => "some@email.com", 
                                'class' => 'tips form-control', 
                                'id' => $forms['paypal_account']['key'],
                                'data-content'=> __("Paypal mail address"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>__("The paypal email address where the payments will be sent"), 
                                ))?> 
                            </div>
                        </div>
        
                        <div class="form-group">
                            <?= FORM::label($forms['sandbox']['key'], __('Sandbox'), array('class'=>'col-md-4 control-label', 'for'=>$forms['sandbox']['key']))?>
                            <div class="col-md-8">
                                <div class="onoffswitch">
                                    <?= FORM::hidden($forms['sandbox']['key'], 0);?>
                                    <?= FORM::checkbox($forms['sandbox']['key'], 1, (bool) $forms['sandbox']['value'], array(
                                    'placeholder' => "TRUE or FALSE", 
                                    'class' => 'onoffswitch-checkbox', 
                                    'id' => $forms['sandbox']['key'], 
                                    'data-content'=> '',
                                    'data-trigger'=>"hover",
                                    'data-placement'=>"right",
                                    'data-toggle'=>"popover",
                                    'data-original-title'=>'',                     
                                    ))?>
                                    <?= FORM::label($forms['sandbox']['key'], "<span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span>", array('class'=>'onoffswitch-label', 'for'=>$forms['sandbox']['key']))?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

                     <div class="panel panel-default">
            <div class="panel-heading">2checkout</div>
            <div class="panel-body">
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-md-8 col-md-offset-4">
                            <p><?=sprintf(__('To get paid via Credit card you need a %s account'),'2checkout')?>.</p>
                            <a class="btn btn-success" target="_blank" href="https://www.2checkout.com/referral?r=6008d8b2c2">
                                <i class="glyphicon glyphicon-pencil"></i> Register for free at 2checkout</a>
                    
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <?= FORM::label($forms['twocheckout_sandbox']['key'], __('Sandbox'), array('class'=>'control-label col-sm-4', 'for'=>$forms['twocheckout_sandbox']['key']))?>
                        <div class="col-sm-8">
                            <div class="onoffswitch">
                                <?= Form::checkbox($forms['twocheckout_sandbox']['key'], 1, (bool) $forms['twocheckout_sandbox']['value'], array(
                                'placeholder' => __("TRUE or FALSE"), 
                                'class' => 'onoffswitch-checkbox', 
                                'id' => $forms['twocheckout_sandbox']['key'],
                                'data-content'=> '',
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?>
                                <?= FORM::label($forms['twocheckout_sandbox']['key'], "<span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span>", array('class'=>'onoffswitch-label', 'for'=>$forms['authorize_sandbox']['key']))?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <?= FORM::label($forms['twocheckout_sid']['key'], __('Account Number'), array('class'=>'col-md-4 control-label', 'for'=>$forms['twocheckout_sid']['key']))?>
                        <div class="col-md-8">
                            <?= FORM::input($forms['twocheckout_sid']['key'], $forms['twocheckout_sid']['value'], array(
                            'placeholder' => "", 
                            'class' => 'tips form-control', 
                            'id' => $forms['twocheckout_sid']['key'],
                            'data-content'=> __('Account Number'),
                            'data-trigger'=>"hover",
                            'data-placement'=>"right",
                            'data-toggle'=>"popover",
                            'data-original-title'=>'', 
                            ))?> 
                        </div>
                    </div>

                    <div class="form-group">
                        <?= FORM::label($forms['twocheckout_secretword']['key'], __('Secret Word'), array('class'=>'col-md-4 control-label', 'for'=>$forms['twocheckout_secretword']['key']))?>
                        <div class="col-md-8">
                            <?= FORM::input($forms['twocheckout_secretword']['key'], $forms['twocheckout_secretword']['value'], array(
                            'placeholder' => "", 
                            'class' => 'tips form-control', 
                            'id' => $forms['twocheckout_secretword']['key'],
                            'data-content'=> __('Secret Word'),
                            'data-trigger'=>"hover",
                            'data-placement'=>"right",
                            'data-toggle'=>"popover",
                            'data-original-title'=>'', 
                            ))?> 
                        </div>
                    </div>


                </div>
            </div>
        </div>
        
            <div class="panel panel-default">
                <div class="panel-heading">Authorize.net</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4">
                                <p><?=sprintf(__('To get paid via Credit card you need a %s account'),'Authorize.net')?>. <?=__('You will need also a SSL certificate')?>, <a href="https://www.ssl.com/code/49" target="_blank"><?=__('buy your SSL certificate here')?></a>.</p>
                                <?=__('Register')?>
                                <a class="btn btn-success" target="_blank" href="http://reseller.authorize.net/application/signupnow/?id=AUAffiliate&rid=26776">
                                    </i> US/Canada</a>
                                <a class="btn btn-success" target="_blank" href="http://reseller.authorize.net/application/?id=5561123">
                                    UK/Europe</a>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['authorize_sandbox']['key'], __('Sandbox'), array('class'=>'control-label col-sm-4', 'for'=>$forms['authorize_sandbox']['key']))?>
                            <div class="col-sm-8">
                                <div class="onoffswitch">
                                    <?= Form::checkbox($forms['authorize_sandbox']['key'], 1, (bool) $forms['authorize_sandbox']['value'], array(
                                    'placeholder' => "TRUE or FALSE", 
                                    'class' => 'onoffswitch-checkbox', 
                                    'id' => $forms['authorize_sandbox']['key'],
                                    'data-content'=> '',
                                    'data-trigger'=>"hover",
                                    'data-placement'=>"right",
                                    'data-toggle'=>"popover",
                                    'data-original-title'=>'', 
                                    ))?>
                                    <?= FORM::label($forms['authorize_sandbox']['key'], "<span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span>", array('class'=>'onoffswitch-label', 'for'=>$forms['authorize_sandbox']['key']))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['authorize_login']['key'], __('Authorize API Login'), array('class'=>'col-md-4 control-label', 'for'=>$forms['authorize_login']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['authorize_login']['key'], $forms['authorize_login']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['authorize_login']['key'],
                                'data-content'=> __('Authorize API Login'),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['authorize_key']['key'], __('Authorize transaction Key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['authorize_key']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['authorize_key']['key'], $forms['authorize_key']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['authorize_key']['key'],
                                'data-content'=> __("Authorize transaction Key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Paymill</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4">
                                <p><?=sprintf(__('To get paid via Credit card you need a %s account'),'Paymill')?>. <?=__("It's free to register")?>. <?=sprintf(__('They charge %s of any sale'),'2.95%')?>.</p>
                                <a class="btn btn-success" target="_blank" href="https://app.paymill.com/en-en/auth/register?referrer=openclassifieds">
                                    <i class="glyphicon glyphicon-pencil"></i> <?=sprintf(__('Register for free at %s'),'Paymill')?></a>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['paymill_private']['key'], __('Paymill private key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['paymill_private']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['paymill_private']['key'], $forms['paymill_private']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['paymill_private']['key'],
                                'data-content'=> __("Paymill private key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
        
                        <div class="form-group">
                            <?= FORM::label($forms['paymill_public']['key'], __('Paymill public key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['paymill_public']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['paymill_public']['key'], $forms['paymill_public']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['paymill_public']['key'],
                                'data-content'=> __("Paymill public key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Stripe</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4">
                                <p><?=sprintf(__('To get paid via Credit card you need a %s account'),'Stripe')?>. <?=__("It's free to register")?>. <?=sprintf(__('They charge %s of any sale'),'2.95%')?>.</p>
                                <a class="btn btn-success" target="_blank" href="https://stripe.com">
                                    <i class="glyphicon glyphicon-pencil"></i> <?=sprintf(__('Register for free at %s'),'Stripe')?></a>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <?= FORM::label($forms['stripe_private']['key'], __('Stripe private key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['stripe_private']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['stripe_private']['key'], $forms['stripe_private']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['stripe_private']['key'],
                                'data-content'=> __("Stripe private key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <?= FORM::label($forms['stripe_public']['key'], __('Stripe public key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['stripe_public']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['stripe_public']['key'], $forms['stripe_public']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['stripe_public']['key'],
                                'data-content'=> __("Stripe public key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <?= FORM::label($forms['stripe_address']['key'], __('Requires address to pay for extra security'), array('class'=>'col-md-4 control-label', 'for'=>$forms['stripe_address']['key']))?>
                            <div class="col-md-8">
                                <div class="onoffswitch">
                                    <?= FORM::hidden($forms['stripe_address']['key'], 0);?>
                                    <?= FORM::checkbox($forms['stripe_address']['key'], 1, (bool) $forms['stripe_address']['value'], array(
                                    'placeholder' => "TRUE or FALSE", 
                                    'class' => 'onoffswitch-checkbox', 
                                    'id' => $forms['stripe_address']['key'], 
                                    'data-content'=> '',
                                    'data-trigger'=>"hover",
                                    'data-placement'=>"right",
                                    'data-toggle'=>"popover",
                                    'data-original-title'=>'',                     
                                    ))?>
                                    <?= FORM::label($forms['stripe_address']['key'], "<span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span>", array('class'=>'onoffswitch-label', 'for'=>$forms['stripe_address']['key']))?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Bitpay</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4">
                                <p><?=__('Accept bitcoins using Bitpay')?></p>
                                <a class="btn btn-success" target="_blank" href="https://bitpay.com">
                                    <i class="glyphicon glyphicon-pencil"></i> <?=sprintf(__('Register for free at %s'),'Bitpay')?></a>
                            </label>
                        </div>
                        <div class="form-group">
                            
                            <?= FORM::label($forms['bitpay_apikey']['key'], __('Bitpay api key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['bitpay_apikey']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['bitpay_apikey']['key'], $forms['bitpay_apikey']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['bitpay_apikey']['key'],
                                'data-content'=> __("Bitpay api key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Prevent Fraud</div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4">
                                <p><?=__('Help prevent card fraud with FraudLabsPro, for Stripe, Pymill and Authorize.')?></p>
                                <a class="btn btn-success" target="_blank" href="http://www.fraudlabspro.com/?ref=1429">
                                    <i class="glyphicon glyphicon-pencil"></i> <?=sprintf(__('Register for free at %s'),'FraudLabsPro')?></a>
                            </label>
                        </div>
                        <div class="form-group">
                            
                            <?= FORM::label($forms['fraudlabspro']['key'], __('FraudLabsPro api key'), array('class'=>'col-md-4 control-label', 'for'=>$forms['fraudlabspro']['key']))?>
                            <div class="col-md-8">
                                <?= FORM::input($forms['fraudlabspro']['key'], $forms['fraudlabspro']['value'], array(
                                'placeholder' => "", 
                                'class' => 'tips form-control', 
                                'id' => $forms['fraudlabspro']['key'],
                                'data-content'=> __("FraudLabsPro api key"),
                                'data-trigger'=>"hover",
                                'data-placement'=>"right",
                                'data-toggle'=>"popover",
                                'data-original-title'=>'', 
                                ))?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-sm-8 col-sm-offset-4">
                        <?= FORM::button('submit', __('Save'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'settings', 'action'=>'payment'))))?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>