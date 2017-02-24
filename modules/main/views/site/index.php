<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
?>
<!-- search box -->
<div class="search-box-wrapper">
    <div class="search-box container">
        <ul class="search-tabs clearfix">
            <li class="active"><a href="#hotels-tab" data-toggle="tab">HOTELS</a></li>
            <li><a href="#flights-tab" data-toggle="tab">FLIGHTS</a></li>
            <li><a href="#flight-and-hotel-tab" data-toggle="tab">FLIGHT &amp; HOTELS</a></li>
            <li><a href="#cars-tab" data-toggle="tab">CARS</a></li>
            <li><a href="#cruises-tab" data-toggle="tab">CRUISES</a></li>
            <li><a href="#flight-status-tab" data-toggle="tab">FLIGHT STATUS</a></li>
            <li><a href="#online-checkin-tab" data-toggle="tab">ONLINE CHECK IN</a></li>
        </ul>
        <div class="visible-mobile">
            <ul id="mobile-search-tabs" class="search-tabs clearfix">
                <li class="active"><a href="#hotels-tab">HOTELS</a></li>
                <li><a href="#flights-tab">FLIGHTS</a></li>
                <li><a href="#flight-and-hotel-tab">FLIGHT &amp; HOTELS</a></li>
                <li><a href="#cars-tab">CARS</a></li>
                <li><a href="#cruises-tab">CRUISES</a></li>
                <li><a href="#flight-status-tab">FLIGHT STATUS</a></li>
                <li><a href="#online-checkin-tab">ONLINE CHECK IN</a></li>
            </ul>
        </div>

        <div class="search-tab-content">
            <div class="tab-pane fade active in" id="hotels-tab">
                <?php $form = ActiveForm::begin([
                    'id' => 'main-search-form',
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'options' => [
                            'tag' => false,
                        ],
                    ],
                ])?>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <h4 class="title">Where</h4>
                            <label>Your Destination</label>
                            <input type="text" name="MainSearchForm[destination]"  id="mainsearchform-destination" class="input-text full-width" value placeholder="enter a destination or hotel name"
                            aria-required="true" aria-invalid="true"/>
                            <div class="help-block"><?= $searchForm->errors['destination'] ? $searchForm->errors['destination'][0] : ''?></div>
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                            <h4 class="title">When</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Check In</label>
                                    <div class="datepicker-wrap">
                                       <input type="text" name="MainSearchForm[date_from]"  id="mainsearchform-date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                    <div class="help-block"><?= $searchForm->errors['date_from'] ? $searchForm->errors['date_from'][0] : ''?></div>
                                </div>
                                <div class="col-xs-6">
                                    <label>Check Out</label>
                                    <div class="datepicker-wrap">
                                       <input type="text" name="MainSearchForm[date_to]" id="mainsearchform-date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                    <div class="help-block"><?= $searchForm->errors['date_to'] ? $searchForm->errors['date_to'][0] : ''?></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <h4 class="title">Who</h4>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label>Rooms</label>
                                    <div class="selector">
                                        <select id="mainsearchform-rooms" name="MainSearchForm[rooms]" class="full-width">
                                            <option selected value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <label>Adults</label>
                                    <div class="selector">
                                        <select id="mainsearchform-adults" name="MainSearchForm[adults]" class="full-width">
                                            <option selected value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <label>Kids</label>
                                    <div class="selector">
                                        <select id="mainsearchform-kids" name="MainSearchForm[kids]" class="full-width">
                                            <option selected value="1">No kids</option>
                                            <option value="2">01</option>
                                            <option value="3">02</option>
                                            <option value="4">03</option>
                                            <option value="5">03</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-6 col-md-2 fixheight">
                            <label class="hidden-xs">&nbsp;</label>
                            <button type="submit" class="full-width icon-check animated" data-animation-type="bounce" data-animation-duration="1">SEARCH NOW</button>
                        </div>
                    </div>
                <?php ActiveForm::end()?>
            </div>
            <div class="tab-pane fade" id="flights-tab">
                <form action="flight-list-view.html" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Where</h4>
                            <div class="form-group">
                                <label>Leaving From</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                            <div class="form-group">
                                <label>Going To</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">When</h4>
                            <label>Departing On</label>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="datepicker-wrap">
                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">anytime</option>
                                            <option value="2">morning</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label>Arriving On</label>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="datepicker-wrap">
                                        <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">anytime</option>
                                            <option value="2">morning</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">Who</h4>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>Adults</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <label>Kids</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>Promo Code</label>
                                    <input type="text" class="input-text full-width" placeholder="type here" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>Infants</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 pull-right">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check">SERACH NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="flight-and-hotel-tab">
                <form action="flight-list-view.html" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Where</h4>
                            <div class="form-group">
                                <label>Leaving From</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                            <div class="form-group">
                                <label>Going To</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">When</h4>
                            <label>Departing On</label>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="datepicker-wrap">
                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">anytime</option>
                                            <option value="2">morning</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label>Arriving On</label>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="datepicker-wrap">
                                        <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">anytime</option>
                                            <option value="2">morning</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">Who</h4>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>Adults</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <label>Kids</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>Promo Code</label>
                                    <input type="text" class="input-text full-width" placeholder="type here" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>Rooms</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 pull-right">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check">SERACH NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="cars-tab">
                <form action="car-list-view.html" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Where</h4>
                            <div class="form-group">
                                <label>Pick Up</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                            <div class="form-group">
                                <label>Drop Off</label>
                                <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">When</h4>
                            <div class="form-group">
                                <label>Pick-Up Date / Time</label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="datepicker-wrap">
                                            <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="selector">
                                            <select class="full-width">
                                                <option value="1">anytime</option>
                                                <option value="2">morning</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Drop-Off Date / Time</label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="datepicker-wrap">
                                            <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="selector">
                                            <select class="full-width">
                                                <option value="1">anytime</option>
                                                <option value="2">morning</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">Who</h4>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>Adults</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <label>Kids</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>Promo Code</label>
                                    <input type="text" class="input-text full-width" placeholder="type here" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>Car Type</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="">select a car type</option>
                                            <option value="economy">Economy</option>
                                            <option value="compact">Compact</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check">SERACH NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="cruises-tab">
                <form action="cruise-list-view.html" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Where</h4>
                            <div class="form-group">
                                <label>Your Destination</label>
                                <input type="text" class="input-text full-width" placeholder="enter a destination or hotel name" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">When</h4>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>Departure Date</label>
                                    <div class="datepicker-wrap">
                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>Cruise Length</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="">select length</option>
                                            <option value="1">1-2 Nights</option>
                                            <option value="2">3-4 Nights</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4 class="title">Who</h4>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>Cruise Line</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option value="">select cruise line</option>
                                            <option>Azamara Club Cruises</option>
                                            <option>Carnival Cruise Lines</option>
                                            <option>Celebrity Cruises</option>
                                            <option>Costa Cruise Lines</option>
                                            <option>Cruise &amp; Maritime Voyages</option>
                                            <option>Crystal Cruises</option>
                                            <option>Cunard Line Ltd.</option>
                                            <option>Disney Cruise Line</option>
                                            <option>Holland America Line</option>
                                            <option>Hurtigruten Cruise Line</option>
                                            <option>MSC Cruises</option>
                                            <option>Norwegian Cruise Line</option>
                                            <option>Oceania Cruises</option>
                                            <option>Orion Expedition Cruises</option>
                                            <option>P&amp;O Cruises</option>
                                            <option>Paul Gauguin Cruises</option>
                                            <option>Peter Deilmann Cruises</option>
                                            <option>Princess Cruises</option>
                                            <option>Regent Seven Seas Cruises</option>
                                            <option>Royal Caribbean International</option>
                                            <option>Seabourn Cruise Line</option>
                                            <option>Silversea Cruises</option>
                                            <option>Star Clippers</option>
                                            <option>Swan Hellenic Cruises</option>
                                            <option>Thomson Cruises</option>
                                            <option>Viking River Cruises</option>
                                            <option>Windstar Cruises</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label>&nbsp;</label>
                                    <button class="icon-check full-width">SEARCH NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="flight-status-tab">
                <form action="flight-list-view.html" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title">Where</h4>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>Leaving From</label>
                                    <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                </div>
                                <div class="col-xs-6">
                                    <label>Going To</label>
                                    <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-md-2">
                            <h4 class="title">When</h4>
                            <div class="form-group">
                                <label>Departure Date</label>
                                <div class="datepicker-wrap">
                                    <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-md-2">
                            <h4 class="title">Who</h4>
                            <div class="form-group">
                                <label>Flight Number</label>
                                <input type="text" class="input-text full-width" placeholder="enter flight number" />
                            </div>
                        </div>
                        <div class="form-group col-md-2 fixheight">
                            <label class="hidden-xs">&nbsp;</label>
                            <button class="icon-check full-width">SEARCH NOW</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="online-checkin-tab">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title">Where</h4>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>Leaving From</label>
                                    <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                </div>
                                <div class="col-xs-6">
                                    <label>Going To</label>
                                    <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-md-2">
                            <h4 class="title">When</h4>
                            <div class="form-group">
                                <label>Departure Date</label>
                                <div class="datepicker-wrap">
                                    <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-md-2">
                            <h4 class="title">Who</h4>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="input-text full-width" placeholder="enter your full name" />
                            </div>
                        </div>
                        <div class="form-group col-md-2 fixheight">
                            <label class="hidden-xs">&nbsp;</label>
                            <button class="icon-check full-width">SEARCH NOW</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end search box -->
