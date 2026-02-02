@extends('frontend.layouts.master')

@section('title', 'Checkout page')

@section('main-content')
    <main class="main">

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('cart.order') }}">
            @csrf
            <section class="mt-50 mb-50">
                <div class="container">
                    {{-- <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span>
                                <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click
                                    here to login</a></span>
                        </div>
                        <div class="panel-collapse collapse login_form" id="loginform">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details
                                    below. If you are a new customer, please proceed to the Billing &amp; Shipping section.
                                </p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Username Or Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" name="login">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a
                                    href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click
                                    here to enter your code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Coupon Code...">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn  btn-md" name="login">Apply Coupon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    {{-- <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-25">
                                <h4>Billing Details</h4>
                            </div>

                            <div class="form-group">
                                <input type="text" required="" name="first_name" value="{{ old('first_name') }}"
                                    placeholder="First name *">
                                @error('first_name')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text"  name="last_name" value="{{ old('lat_name') }}"
                                    placeholder="Last name *">
                                @error('last_name')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" value="{{ old('phone') }}" name="phone"
                                    placeholder="Phone *">
                                @error('phone')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="email" value="{{ old('email') }}"
                                    placeholder="Email address *">
                                @error('email')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom_select">
                                    <select name="country" class="form-select">
                                        <option selected value="India">India</option>
                                        {{-- <option value="AX">Aland Islands</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="ZW">Zimbabwe</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="address1" value="{{ old('address1') }}" required=""
                                    placeholder="Address *">
                                @error('address1')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ old('address2') }}" name="address2" required=""
                                    placeholder="Address line2">
                                @error('address2')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="post_code" value="{{ old('post_code') }}"
                                    placeholder="Postcode / ZIP *">
                                @error('post_code')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <input required="" type="text" name="city" placeholder="City / Town *">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="state" placeholder="State / County *">
                            </div> --}}


                            {{-- <div class="form-group">
                                <div class="checkbox">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="createaccount">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse"
                                            href="#collapsePassword" data-target="#collapsePassword"
                                            aria-controls="collapsePassword" for="createaccount"><span>Create an
                                                account?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div id="collapsePassword" class="form-group create-account collapse in">
                                <input required="" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="ship_detail">
                                <div class="form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="differentaddress">
                                            <label class="form-check-label label_info" data-bs-toggle="collapse"
                                                data-target="#collapseAddress" href="#collapseAddress"
                                                aria-controls="collapseAddress" for="differentaddress"><span>Ship to a
                                                    different address?</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseAddress" class="different_address collapse in">
                                    <div class="form-group">
                                        <input type="text" required="" name="fname" placeholder="First name *">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required="" name="lname" placeholder="Last name *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="cname" placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom_select">
                                            <select class="form-control select-active select2-hidden-accessible"
                                                data-select2-id="7" tabindex="-1" aria-hidden="true">
                                                <option value="" data-select2-id="9">Select an option...</option>
                                                <option value="AX">Aland Islands</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="PW">Belau</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo (Brazzaville)</option>
                                                <option value="CD">Congo (Kinshasa)</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">CuraÇao</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="CI">Ivory Coast</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao S.A.R., China</option>
                                                <option value="MK">Macedonia</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="KP">North Korea</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PS">Palestinian Territory</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="QA">Qatar</option>
                                                <option value="IE">Republic of Ireland</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="ST">São Tomé and Príncipe</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="SX">Saint Martin (Dutch part)</option>
                                                <option value="MF">Saint Martin (French part)</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="SM">San Marino</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia/Sandwich Islands</option>
                                                <option value="KR">South Korea</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom (UK)</option>
                                                <option value="US">USA (US)</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="WS">Western Samoa</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select><span class="select2 select2-container select2-container--default"
                                                dir="ltr" data-select2-id="8" style="width: auto;"><span
                                                    class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-labelledby="select2-8raz-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-8raz-container" role="textbox"
                                                            aria-readonly="true" title="Select an option...">Select an
                                                            option...</span><span class="select2-selection__arrow"
                                                            role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="billing_address" required=""
                                            placeholder="Address *">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="billing_address2" required=""
                                            placeholder="Address line2">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="city" placeholder="City / Town *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="state"
                                            placeholder="State / County *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode"
                                            placeholder="Postcode / ZIP *">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-20">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes"></textarea>
                            </div> --}}

                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Your Orders</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (App\Helpers\Helper::getAllProductFromCart())
                                                @foreach (App\Helpers\Helper::getAllProductFromCart() as $key => $cart)
                                                    <tr>
                                                        @php
                                                            $photo = explode(',', $cart->product['photo']);
                                                        @endphp
                                                        <td class="image product-thumbnail">
                                                            <img src="{{ Storage::url($photo[0]) }}"
                                                                alt="{{ $photo[0] }}">
                                                        </td>
                                                        <td>
                                                            <h5>
                                                                <a
                                                                    href="{{ route('product-detail', $cart->product['slug']) }}">
                                                                    {{ $cart->product['title'] }}
                                                                </a>
                                                            </h5>
                                                            <span class="product-qty">x {{ $cart['quantity'] }}</span>
                                                        </td>
                                                        {{-- @php
                                                            $after_discount =
                                                                $cart->product['price'] -
                                                                ($cart->product['price'] * $cart->product['discount']) /
                                                                    100;
                                                        @endphp
                                                        <td>&#8377;{{ number_format($after_discount, 2) }}</td> --}}
                                                        <td>&#8377;{{ number_format($cart['amount'], 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <th>SubTotal</th>
                                                <td class="product-subtotal" colspan="2">
                                                    &#8377;{{ number_format(App\Helpers\Helper::totalCartPrice(), 2) }}
                                                </td>
                                            </tr>
                                            {{-- <li class="shipping">
                                                Shipping Cost
                                                @if (count(App\Helpers\Helper::shipping()) > 0 && App\Helpers\Helper::cartCount() > 0)
                                                    <select name="shipping" class="nice-select" required>
                                                        <option value="">Select your address</option>
                                                        @foreach (App\Helpers\Helper::shipping() as $shipping)
                                                            <option value="{{ $shipping->id }}" class="shippingOption"
                                                                data-price="{{ $shipping->price }}">{{ $shipping->type }}:
                                                                ${{ $shipping->price }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <span>Free</span>
                                                @endif
                                            </li> --}}
                                            <tr>
                                                <th>Shipping</th>
                                                <td colspan="2"><em>Free Shipping</em></td>
                                            </tr>
                                            @if (session('coupon'))
                                                <tr>
                                                    <th>You Save</th>
                                                    <td colspan="2" class="coupon_price"
                                                        data-price="{{ session('coupon')['value'] }}">
                                                        &#8377;{{ number_format(session('coupon')['value'], 2) }}</td>
                                                </tr>
                                                {{-- <li class="coupon_price" data-price="{{ session('coupon')['value'] }}">You
                                                Save<span>${{ number_format(session('coupon')['value'], 2) }}</span></li> --}}
                                            @endif
                                            @php
                                                $total_amount = App\Helpers\Helper::totalCartPrice();
                                                if (session('coupon')) {
                                                    $total_amount = $total_amount - session('coupon')['value'];
                                                }
                                            @endphp
                                            @if (session('coupon'))
                                                <tr>
                                                    <th>Total</th>
                                                    <td colspan="2" class="product-subtotal" id="order_total_price">
                                                        <span
                                                            class="font-xl text-brand fw-900">&#8377;{{ number_format($total_amount, 2) }}</span>
                                                    </td>
                                                </tr>
                                                {{-- <li class="last" id="order_total_price">
                                                    Total<span>${{ number_format($total_amount, 2) }}</span></li> --}}
                                            @else
                                                <tr>
                                                    <th>Total</th>
                                                    <td colspan="2" class="product-subtotal" id="order_total_price">
                                                        <span
                                                            class="font-xl text-brand fw-900">&#8377;{{ number_format($total_amount, 2) }}</span>
                                                    </td>
                                                </tr>
                                                {{-- <li class="last" id="order_total_price">
                                                    Total<span>${{ number_format($total_amount, 2) }}</span></li> --}}
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="payment_method">
                                    <div class="mb-25">
                                        <h5>Payment</h5>
                                    </div>
                                    <div class="payment_option">
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="payment_method" id="exampleRadios4" checked="">

                                            <label class="form-check-label" for="exampleRadios4"
                                                data-bs-toggle="collapse" data-target="#checkPayment"
                                                aria-controls="checkPayment">Cash On Delivery</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" disabled required="" type="radio"
                                                name="payment_method" id="exampleRadios5">
                                            <label class="form-check-label" for="exampleRadios5"
                                                data-bs-toggle="collapse" data-target="#paypal"
                                                aria-controls="paypal">Card Payment</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>
@endsection

@push('scripts')
    <script>
        function showMe(box) {
            var checkbox = document.getElementById('shipping').style.display;
            // alert(checkbox);
            var vis = 'none';
            if (checkbox == "none") {
                vis = 'block';
            }
            if (checkbox == "block") {
                vis = "none";
            }
            document.getElementById(box).style.display = vis;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('input[name="payment_method"]').change(function() {
                if ($(this).val() === 'cardpay') {
                    $('#creditCardDetails').show();
                } else {
                    $('#creditCardDetails').hide();
                }
            });

            $(".select2.select2-container.select2-container--default").click(function() {
                $(".select2-selection__arrow").click()
            })
        });
    </script>
@endpush
