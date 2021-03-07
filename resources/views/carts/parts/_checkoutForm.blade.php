<form action="{{ route('cart.checkoutSubmit', ) }}" method="post">
    @csrf
    <div class="card mb-3">
        <h5 class="card-header">Payment</h5>

        <div class="card-body">
            {{--            <h5 class="card-title">Payment method</h5>--}}

            <div class="form-group">
                <label for="methodPayment">Method Payment</label>
                <select name="method_payment" id="methodPayment" class="form-control">
                    @foreach($dataCart['select_method_payment']['options'] as $value => $option)
                        <option value="{{ $value }}"{{ isset($option['selected']) ? ' selected="selected' : '' }}>
                            {{ $option['title_ru'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <h5 class="card-header">Delivery to address</h5>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="methodDelivery">Method Delivery</label>
                        <select name="method_delivery" id="methodDelivery" class="form-control">
                            @foreach($dataCart['select_method_delivery']['options'] as $value => $option)
                                <option value="{{ $value }}"{{ isset($option['selected']) ? ' selected="selected' : '' }}>
                                    {{ $option['title_ru'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="addressCity">City</label>
                        <input type="text" class="form-control" id="addressCity" name="address_city"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['city']) ? $dataFrom['address']['city'] : '' }}"
                               aria-describedby="" placeholder="City">
                        {{--                    <small id="firstNameHelp" class="form-text text-muted">text</small>--}}
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="addressZip">Zip</label>
                        <input type="number" class="form-control" id="addressZip" name="address_zip"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['zip']) ? $dataFrom['address']['zip'] : '' }}"
                               aria-describedby="" placeholder="Zip">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="addressStreet">Street</label>
                        <input type="text" class="form-control" id="addressStreet" name="address_street"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['street']) ? $dataFrom['address']['street'] : '' }}"
                               aria-describedby="" placeholder="Street">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="addressHouse">House</label>
                        <input type="text" class="form-control" id="addressHouse" name="address_house"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['house']) ? $dataFrom['address']['house'] : '' }}"
                               aria-describedby="" placeholder="House">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="addressEntrance">Entrance</label>
                        <input type="text" class="form-control" id="addressEntrance" name="address_entrance"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['entrance']) ? $dataFrom['address']['entrance'] : '' }}"
                               aria-describedby="" placeholder="Entrance">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="addressFloor">Floor</label>
                        <input type="number" class="form-control" id="addressFloor" name="address_floor"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['floor']) ? $dataFrom['address']['floor'] : '' }}"
                               aria-describedby="" placeholder="Floor">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="addressApartment">Apartment</label>
                        <input type="text" class="form-control" id="addressApartment" name="address_apartment"
                               value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['apartment']) ? $dataFrom['address']['apartment'] : '' }}"
                               aria-describedby="" placeholder="Apartment">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Number NP</label>
                <input type="text" class="form-control" id="" name="address_np_number"
                       value="{{ isset($dataFrom['address']) && isset($dataFrom['address']['np_number']) ? $dataFrom['address']['np_number'] : '' }}"
                       aria-describedby="" placeholder="Number NP">
            </div>

        </div>
    </div>

    <div class="card mb-3">
        <h5 class="card-header">Receiver full name</h5>

        <div class="card-body">
            {{--           <h5 class="card-title">Full name</h5>--}}

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="name_last"
                               value="{{ isset($dataFrom['name']) && isset($dataFrom['name']['last']) ? $dataFrom['name']['last'] : '' }}"
                               aria-describedby="lastNameHelp" placeholder="Last name">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="name_first"
                               value="{{ isset($dataFrom['name']) && isset($dataFrom['name']['first']) ? $dataFrom['name']['first'] : '' }}"
                               aria-describedby="firstNameHelp" placeholder="First name">
                        {{--                    <small id="firstNameHelp" class="form-text text-muted">text</small>--}}
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="patronymicName">Patronymic name</label>
                        <input type="text" class="form-control" id="patronymicName" name="name_patronymic"
                               value="{{ isset($dataFrom['name']) && isset($dataFrom['name']['patronymic']) ? $dataFrom['name']['patronymic'] : '' }}"
                               aria-describedby="patronymicNameHelp" placeholder="Patronymic name">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card mb-3">
        <h5 class="card-header">Contacts</h5>

        <div class="card-body">
            {{--      <h5 class="card-title">Phone</h5>--}}

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="contactPhone">Phone</label>
                        <input type="text" class="form-control" id="contactPhone" name="contact_phone"
                               value="{{ isset($dataFrom['contact']) && isset($dataFrom['contact']['phone']) ? $dataFrom['contact']['phone'] : '' }}"
                               aria-describedby="phoneHelp" placeholder="Phone">
                        {{--                        <small id="phoneHelp" class="form-text text-muted">text</small>--}}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="contactEmail">Email</label>
                        <input type="text" class="form-control" id="contactEmail" name="contact_email"
                               value="{{ isset($dataFrom['contact']) && isset($dataFrom['contact']['email']) ? $dataFrom['contact']['email'] : '' }}"
                               aria-describedby="emailHelp" placeholder="Email">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="orderComment">Comment</label>
                <textarea class="form-control" id="orderComment" name="order_comment" rows="3"
                          style="min-height: calc(15vh);"
                          placeholder="Clarifications to the order">
                    {{ isset($dataFrom['order']) && isset($dataFrom['order']['comment']) ? $dataFrom['order']['comment'] : '' }}
                </textarea>
            </div>

        </div>
    </div>


    <div class="card mb-3">
        {{--     <h5 class="card-header">Contacts</h5>--}}

        <div class="card-body">

            <div style="display: table; width: 100%;">
                <div style="display: table-cell; vertical-align: middle; white-space: nowrap; padding-right: 20px; font-size: 18px;">
                    Total price
                </div>
                <div style="display: table-cell; vertical-align: middle; text-align: right; white-space: nowrap; font-size: 36px; font-weight: 700;">
                    <b><span class="content">{{ $cart['dataCart']['total_price_float'] }}</span> ₴</b>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="buttons">
                        {{--            <a href="#" data-submit="checkout"--}}
                        {{--               class="btn btn-primary btn-lg btn-block">Checkout</a>--}}
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
