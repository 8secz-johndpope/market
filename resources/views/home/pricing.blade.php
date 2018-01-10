<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="cd-pricing-container">
    <div style="width: 100%">
        <h1 style="text-align: center">Minimum Single Contract Value For Business Accounts</h1>
        <h4 style="text-align: center">Spread over 12 payments </h4>

    </div> <!-- .cd-pricing-switcher -->

    <ul class="cd-pricing-list cd-bounce-invert">
        <li>
            <ul class="cd-pricing-wrapper">
                <li data-type="monthly" class="is-ended is-visible">
                    <header class="cd-pricing-header">
                        <h4>Small Businesses</h4>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">5000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>20%</em> Discount on Enhancements</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>90</em> days credit</li>
                            <li><em>Online</em> Management</li>
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
                            <li><em>90</em> days credit</li>
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
                        <h4>Medium Sized Businesses</h4>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">25000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>30%</em> Discount on Enhancements</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>90</em> days credit</li>
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
                            <li><em>90</em> days credit</li>
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
                        <h4>Large Sized Businesses</h4>

                        <div class="cd-price">
                            <span class="cd-currency">£</span>
                            <span class="cd-value">100000</span>
                            <span class="cd-duration">minimum</span>
                        </div>
                    </header> <!-- .cd-pricing-header -->

                    <div class="cd-pricing-body">
                        <ul class="cd-pricing-features">
                            <li><em>40%</em> Discount on Enhancements</li>
                            <li><em>Unlimited</em> free ads</li>
                            <li><em>90</em> days credit</li>
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
                            <li><em>90</em> days credit</li>
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