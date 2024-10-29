<section id="calculators">
    <!-- <div class="ror-calculator-section" id="calculators">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>RETURN ON RETURN COMPOUND CALCULATOR</h2>
                </div>
                <div class="heading-divider"></div>
            </div>
            <div class="compoundWrapper">
                <div class="container">
                    <div class="row calculate">
                        <div class=" col-xl-5 col-lg-5 col-md-5 offset-lg-1 text-center text-lg-right">
                            <div class="form-group mr-0 ml-auto mb-3 ror-calc-aligner">
                                <label class="d-block d-lg-inline-block" for="initialInvestment" style="font-size: 16px; vertical-align: middle;">INITIAL PARTICIPATION</label>
                                <span class="form-control info mr">€</span>
                                <input type="text" name="initial_investment" class="form-control" id="initialInvestment">
                                <label id="initialInvestment-error" class="error-calculate" for="initialInvestment" style="display: none"></label>
                            </div>
                            <div class="form-group mr-0 ml-auto mb-3 ror-calc-aligner">
                                <label class="d-block d-lg-inline-block" for="regularInvestment" style="font-size: 16px; vertical-align: middle;"></label>
                                <span class="form-control info mr">€</span>
                                <input type="text" name="regular_investment" class="form-control mr-2" id="regularInvestment" style="width: 104px;">
                                <select name="regular_investment_select" class="form-control custom-select roi-calc-custom-select" id="regularInvestmentSelect" style="-webkit-appearance:none; width: 120px; background-position: 94%">
                                    <option value="12">Monthly</option>
                                    <option value="1">Yearly</option>
                                </select>
                                <label id="regularInvestment-error" class="error-calculate" for="regularInvestment" style="display: none"></label>
                            </div>
                            <div class="form-group mr-0 ml-auto mb-3 ror-calc-aligner">
                                <label class="d-block d-lg-inline-block" for="compounded" style="font-size: 16px; vertical-align: middle;">Compounded</label>
                                <select name="compounded" class="form-control custom-select roi-calc-custom-select" id="compounded" style="width: 270px;-webkit-appearance:none; background-position: 98%;">
                                    <option value="1">Annually</option>
                                    <option value="12">Monthly</option>
                                </select>
                                <label id="compounded-error" class="error-calculate" for="compounded" style="display: none"></label>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 text-center text-lg-right ror-calc-aligner">
                            <div class="form-group mr-0 ml-auto mb-3">
                                <label class="d-block d-lg-inline-block" for="rorRate" style="font-size: 16px; vertical-align: middle;">Ror rate</label>
                                <input type="text" name="ror_rate" class="form-control" id="rorRate">
                                <span class="form-control info ml">%</span>
                                <label id="rorRate-error" class="error-calculate" for="rorRate" style="display: none"></label>
                            </div>
                            <div class="form-group mr-0 ml-auto mb-3 ror-calc-aligner">
                                <label class="d-block d-lg-inline-block" for="term" style="font-size: 16px; vertical-align: middle;">Term</label>
                                <input type="text" name="term" class="form-control" id="term">
                                <span class="form-control info ml">Yr</span>
                                <label id="term-error" class="error-calculate" for="term" style="display: none"></label>
                            </div>
                            <button type="submit" class="btn btn-green mr-0 ml-auto" data-button="calculate" style="width: 270px; background-color: #00afaa; border-radius: 0;border-color: #00afaa; font-family: 'Oswald', Open Sans, Helvetica, sans-serif; outline: none; text-transform: uppercase; color: #fff;">Calculate</button>
                        </div>
                    </div>
                    <div class="row calculate mt-5" data-content="result" style="display: none">
                        <div class="col-xl-10 offset-lg-1">
                            <p style="font-family: 'Raleway', sans-serif; font-weight: 400;">After <span data-content="years"></span> years your participation will be worth € <span data-content="investment-worth"></span></p>
                            <p style="font-family: 'Raleway', sans-serif; font-weight: 400;">This is made up of</p>
                            <div class="row">
                                <div class="col-lg-3 d-inline-block w-auto"><p style="font-family: 'Raleway', sans-serif; font-weight: 400;">Initial participation</p></div>
                                <div class="col-lg-4 d-inline-block w-auto"><p style="font-family: 'Raleway', sans-serif; font-weight: 400;">€ <span data-content="initial-worth" style="font-family: 'Raleway', sans-serif; font-weight: 400;"></span></p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 d-inline-block w-auto" style="font-family: 'Raleway', sans-serif; font-weight: 400;"><p style="font-family: 'Raleway', sans-serif; font-weight: 400;">Additional participation</p></div>
                                <div class="col-lg-9 d-inline-block w-auto"><p style="font-family: 'Raleway', sans-serif; font-weight: 400;">€ <span data-content="regular-worth" style="font-family: 'Raleway', sans-serif; font-weight: 400;"></span></p></div>
                            </div>
                            <div class="row" style="align-items: center;">
                                <div class="col-lg-3 d-inline-block w-auto" style="font-family: 'Raleway', sans-serif; font-weight: 400;"><span style="font-family: 'Raleway', sans-serif; font-weight: 400;">Return On Return</span></div>
                                <div class="col-lg-5 d-inline-block w-auto"><span style="font-family: 'Raleway', sans-serif; font-weight: 400;">€ <span data-content="return-on-return" style="font-family: 'Raleway', sans-serif; font-weight: 400;"></span></span></div>
                                <div class="col-lg-4" style="padding-left: 0px;">
                                    <a href="{{ route('auth::register') }}" class="btn btn-green mr-0 ml-auto" data-button="calculate" style="width: 270px; background-color: #00afaa; border-radius: 0;border-color: #00afaa; font-family: 'Oswald', Open Sans, Helvetica, sans-serif; outline: none; padding-left: 0px; text-decoration: none; text-transform: uppercase; color: #fff; float: right">Participate Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="einstein-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                                    <h3 style="font-size: 36px;">The Power of Compounding</h3>
                                </div>
                                <div class="col-lg-12">
                                    <p style="font-size: 16px;">“Compound interest is the eight wonder of the world.<br>He who understands it, earns it. He who doesn’t, pays it.”</p>
                                </div>
                                <div class="col-lg-12">
                                    <p style="font-size: 16px;">– Albert Einstein</p>
                                </div>
            </div>
        </div>
    </div> -->
</section>