@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Checkout - Order Information</h1>

            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="col">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                @endif
            </div>


            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3">
                <div class="col">

                    <form action="{{ route('cart.checkoutSubmit', ) }}" method="post">
                        <div class="card mb-3">
                            <h5 class="card-header">Payment method</h5>

                            <div class="card-body">
    {{--                            <h5 class="card-title">Payment method</h5>--}}

                                <div class="form-group">
                                    <label for="methodPayment">Method</label>
                                    <input type="text" class="form-control" id="methodPayment" name="method_payment"
                                           value="" aria-describedby="" placeholder="Method">
                                    {{--                    <small id="firstNameHelp" class="form-text text-muted">text</small>--}}
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Address</h5>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="addressCity">City</label>
                                            <input type="text" class="form-control" id="addressCity" name="address_city"
                                                   value="" aria-describedby="" placeholder="City">
                                            {{--                    <small id="firstNameHelp" class="form-text text-muted">text</small>--}}
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="addressZip">Zip</label>
                                            <input type="text" class="form-control" id="addressZip" name="address_zip"
                                                   value="" aria-describedby="" placeholder="Zip">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="addressStreet">Street</label>
                                            <input type="text" class="form-control" id="addressStreet" name="address_street"
                                                   value="" aria-describedby="" placeholder="Street">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="addressHouse">House</label>
                                            <input type="text" class="form-control" id="addressHouse" name="address_house"
                                                   value="" aria-describedby="" placeholder="House">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="addressFloor">Floor</label>
                                            <input type="text" class="form-control" id="addressFloor" name="address_floor"
                                                   value="" aria-describedby="" placeholder="Floor">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="addressApartment">Apartment</label>
                                            <input type="text" class="form-control" id="addressApartment" name="address_apartment"
                                                   value="" aria-describedby="" placeholder="Apartment">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Number NP</label>
                                    <input type="text" class="form-control" id="" name="address_np_number"
                                           value="" aria-describedby="" placeholder="Number NP">
                                </div>

                            </div>
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Recipient Information</h5>

                            <div class="card-body">
    {{--                            <h5 class="card-title">Full name</h5>--}}

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" id="firstName" name="name_first"
                                                   value="" aria-describedby="firstNameHelp" placeholder="First name">
                                            {{--                    <small id="firstNameHelp" class="form-text text-muted">text</small>--}}
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="lastName">Last name</label>
                                            <input type="text" class="form-control" id="lastName" name="name_last"
                                                   value="" aria-describedby="lastNameHelp" placeholder="Last name">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="patronymicName">Patronymic name</label>
                                            <input type="text" class="form-control" id="patronymicName" name="name_patronymic"
                                                   value="" aria-describedby="patronymicNameHelp" placeholder="Patronymic name">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Contacts</h5>

                            <div class="card-body">
                {{--                    <h5 class="card-title">Phone</h5>--}}

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contactPhone">Phone</label>
                                            <input type="text" class="form-control" id="contactPhone" name="contact_phone"
                                                value="" aria-describedby="phoneHelp" placeholder="Phone">
                                            {{--                        <small id="phoneHelp" class="form-text text-muted">text</small>--}}
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contactEmail">Email</label>
                                            <input type="text" class="form-control" id="contactEmail" name="contact_email"
                                                   value="" aria-describedby="emailHelp" placeholder="Email">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="orderComment">Comment</label>
                                    <textarea class="form-control" id="orderComment" name="order_comment" rows="3"
                                              style="min-height: calc(15vh);"
                                              placeholder="Clarifications to the order"></textarea>
                                </div>

                            </div>
                        </div>


                        <div class="card mb-3">
    {{--                        <h5 class="card-header">Contacts</h5>--}}

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
                                            <a href="{{ route('cart.checkout', []) }}" data-submit="checkout"
                                               class="btn btn-primary btn-lg btn-block">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>


                <div class="col">
                    <div class="card mb-3" style="position: sticky; top: 80px; ">
{{--                        padding: 6px; background: linear-gradient(127deg, #6875e5, #003c94);--}}
                        <div style="background: #ffffff;">
                            <h5 class="card-header">In your order <span>{{ count($cart['products']) }} products</span></h5>

                            <div class="card-body">

                                <div class="form-group">
    {{--                                <label for="orderComment">Comment</label>--}}
                                    <div style="overflow-y: auto; max-height: calc(60vh); ">

                                        <table class="table table-striped">
                                        @if( !empty($cart) )
                                            @foreach($cart['products'] as $product_id => $dataOfProduct)
                                            <tr>

                                                <td>
                                                    <a href="{{ $dataOfProduct['photo_main']['link'] }}" target="_blank">
                                                        <img src="{{ $dataOfProduct['photo_main']['link'] }}"
                                                             title="{{ $dataOfProduct['photo_main']['description_ru'] }}"
                                                             style="width: 50px; height: auto; max-height: 100px;" />
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="{{ route('product.show', [ $dataOfProduct['uuid'] ]) }}" target="_blank">
                                                        {{ mb_substr($dataOfProduct['title_ru'], 0, 60) }}
                                                        {{ mb_strlen($dataOfProduct['title_ru']) > 60 ? "..." : "" }}
                                                    </a>
                                                </td>

                                                <td class="text-right" style="white-space: nowrap;">
                                                    <span>{{ $dataOfProduct['quantity'] }}</span><span> x</span>
                                                    <b><span>{{ $dataOfProduct['price_float'] }}</span><span> ₴</span></b>
                                                    <br>
                                                    <b><span>{{ $dataOfProduct['multi_price_float'] }}</span><span> ₴</span></b>
                                                </td>

                                            @endforeach

                                        @endif
                                        </table>
                                    </div>
                                </div>

                                <div style="display: table; width: 100%;">
                                    <div style="display: table-cell; vertical-align: middle; white-space: nowrap; padding-right: 20px; font-size: 18px;">
                                        Total price
                                    </div>
                                    <div style="display: table-cell; vertical-align: middle; text-align: right; white-space: nowrap; font-size: 36px; font-weight: 700;">
                                        <b><span class="content">{{ $cart['dataCart']['total_price_float'] }}</span> ₴</b>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <br>



        </div>
    </div>

@endsection
