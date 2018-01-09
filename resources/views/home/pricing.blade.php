<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="cd-pricing-container">
    <div class="cd-pricing-switcher" style="display: none">
        <p class="fieldset">
            <input type="radio" name="duration-1" value="monthly" id="monthly-1" checked="">
            <label for="monthly-1">Monthly</label>
            <input type="radio" name="duration-1" value="yearly" id="yearly-1">
            <label for="yearly-1">Yearly</label>
            <span class="cd-switch"></span>
        </p>
    </div> <!-- .cd-pricing-switcher -->

    <ul class="cd-pricing-list cd-bounce-invert">
        <li>
            <ul class="cd-pricing-wrapper">
                <li data-type="monthly" class="is-ended is-visible">
                    <header class="cd-pricing-header">
                        <h2>SBA</h2>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">5000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>20%</em> Discount</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>1</em> Website</li>
                            <li><em>Online</em></li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="/user/contract/business/1">Select</a>
                    </footer> <!-- .cd-pricing-footer -->
                </li>

                <li data-type="yearly" class="is-ended is-hidden">
                    <header class="cd-pricing-header">
                        <h2>Basic</h2>
                        <div class="cd-price">
                            <span class="cd-currency">$</span>
                            <span class="cd-value">320</span>
                            <span class="cd-duration">yr</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>256MB</em> Memory</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>1</em> Website</li>
                            <li><em>1</em> Domain</li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                    </footer> <!-- .cd-pricing-footer -->
                </li>
            </ul> <!-- .cd-pricing-wrapper -->
        </li>

        <li class="cd-popular">
            <ul class="cd-pricing-wrapper">
                <li data-type="monthly" class="is-ended is-visible">
                    <header class="cd-pricing-header">
                        <h2>MBA</h2>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">25000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>30%</em> Discount</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>5</em> Websites</li>
                            <li><em>Dedicated</em> Account Manager</li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="/user/contract/business/2">Select</a>
                    </footer> <!-- .cd-pricing-footer -->
                </li>

                <li data-type="yearly" class="is-ended is-hidden">
                    <header class="cd-pricing-header">
                        <h2>Popular</h2>

                        <div class="cd-price">
                            <span class="cd-currency">$</span>
                            <span class="cd-value">630</span>
                            <span class="cd-duration">yr</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>512MB</em> Memory</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>5</em> Websites</li>
                            <li><em>Dedicated</em> Account Manager</li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                    </footer> <!-- .cd-pricing-footer -->
                </li>
            </ul> <!-- .cd-pricing-wrapper -->
        </li>

        <li>
            <ul class="cd-pricing-wrapper">
                <li data-type="monthly" class="is-ended is-visible">
                    <header class="cd-pricing-header">
                        <h2>BBA</h2>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">100000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>40%</em> Discount</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>10</em> Websites</li>
                            <li><em>Dedicated</em> Account Manager</li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="/user/contract/business/3">Select</a>
                    </footer>  <!-- .cd-pricing-footer -->
                </li>

                <li data-type="yearly" class="is-ended is-hidden">
                    <header class="cd-pricing-header">
                        <h2>Premier</h2>
                        <div class="cd-price">
                            <span class="cd-currency">$</span>
                            <span class="cd-value">950</span>
                            <span class="cd-duration">yr</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>1024MB</em> Memory</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>10</em> Websites</li>
                            <li><em>Dedicated</em> Account Manager</li>
                            <li><em>Access to </em> Company Showcase Board</li>
                            <li><em>24/7</em> Support</li>
                        </ul>
                    </div> <!-- .cd-pricing-body -->

                    <footer class="cd-pricing-footer">
                        <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                    </footer>  <!-- .cd-pricing-footer -->
                </li>
            </ul> <!-- .cd-pricing-wrapper -->
        </li>
    </ul> <!-- .cd-pricing-list -->
</div>

    @endsection