
<div class="row " style="max-width: 1350px; margin: 0 auto;">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=15">
            <div class="counters_panel margin-lados-10 waiting_validation">
                <div class="counters_label">{l s='Waiting validation'}</div>
                <div class="counters_value">{$counters['waiting_validation']}</div>
            </div>
            <div class="spacer-20"></div>
        </a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=10">
            <div class="counters_panel margin-lados-10 waiting_payment">
                <div class="counters_label">{l s='Waiting payment'}</div>
                <div class="counters_value">{$counters['waiting_payment']}</div>
            </div>
            <div class="spacer-20"></div>
        </a>
    </div> 
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=3">
            <div class="counters_panel margin-lados-10 preparation">
                <div class="counters_label">{l s='In preparation'}</div>
                <div class="counters_value">{$counters['processing']}</div>
            </div>
            <div class="spacer-20"></div>
        </a>
    </div> 
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=9">
            <div class="counters_panel margin-lados-10 backorder">
                <div class="counters_label">{l s='Backorder'}</div>
                <div class="counters_value">{$counters['backorders']}</div>
            </div>
            <div class="spacer-20"></div>
        </a>
    </div> 
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=4">
            <div class="counters_panel margin-lados-10 shipped">
                <div class="counters_label">{l s='Shipped'}</div>
                <div class="counters_value">{$counters['shipped']}</div>
            </div>
        </a>
    </div>    
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="/order-history?status=6">
            <div class="counters_panel margin-lados-10 canceled">
                <div class="counters_label">{l s='Canceled'}</div>
                <div class="counters_value">{$counters['canceled']}</div>
            </div>
        </a>
    </div> 
</div>


<style>
    .counters_panel{ text-align: center; text-transform: uppercase; font-size: 16px; border: 1px solid #888; cursor: pointer; border-radius: 3px; }
    .counters_label{ padding: 15px; font-weight: bolder; height: 80px; }
    .counters_value{ font-size: 80px; line-height: 30px; -webkit-text-stroke: 1px #888; height: 80px; }
    .waiting_validation{ color: #fff; background-color: #000; }
    .waiting_payment{ color: #fff; background-color: #4258a7; }
    .preparation{ color: #fff; background-color: #048dcd; }
    .backorder{ color: #fff; background-color: #f78e1f; }
    .canceled{ color: #fff; background-color: #e82025; }
    .shipped{ color: #fff; background-color: BlueViolet; }
    .margin-left-10{ margin-left: 10px; }
    .margin-right-10{ margin-right: 10px; }
    .margin-lados-10{ margin: 0 10px; }
</style>
