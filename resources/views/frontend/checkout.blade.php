@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.checkOut') }}
@endsection

@section("content")
   <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>{{__('words.checkOut')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          {{ __('words.orderReceiptAddress') }}
						        </button>
						      </h5>
						    </div>
						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        	<form id="plaseOrder" method="post" action="{{ route('createOrder') }}">
                                        @csrf
						        		<p>
                                            <input id="ordername" type="text" placeholder="{{ __('words.name') }}" value="{{ Auth::user('web')->name }}" name="name">
                                            @if($errors->any('name') && $errors->first('name'))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                                            @endif
                                        </p>
										<p>
                                            <select class="form-control" id="shippingValue" name="shippingValue">
                                                <option value="" selected disabled>{{ __('words.selectOne') }}</option>
                                                @foreach (DB::table('shippings')->get() as $area)
                                                    @if (Session::get('lang') == 'ar')
                                                        <option value="{{ $area->value }}">{{ $area->areaAr }}</option>
                                                    @else
                                                        <option value="{{ $area->value }}">{{ $area->areaEn }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->any('shippingValue') && $errors->first('shippingValue'))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('shippingValue') }}</div>
                                            @endif
                                        </p>
						        		<p>
                                            <input type="text" placeholder="{{ __('words.address') }}" name="address">
                                            @if($errors->any('address') && $errors->first('address'))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('address') }}</div>
                                            @endif
                                        </p>
						        		<p>
                                            <input type="tel" placeholder="{{ __('words.phone') }}" name="phone">
                                            @if($errors->any('phone') && $errors->first('phone'))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</div>
                                            @endif
                                        </p>
                                        <p><input type="hidden" id="totalshippingValue" name="shippingValue"></p>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach (session()->get('cart') as $cart)
                                            @php
                                                $total += $cart['quantity'] * $cart['price']
                                            @endphp
                                        @endforeach
                                        <p><input type="hidden" id="totalWithoutSgipping" name="totalWithoutSgipping" value="{{ $total }}"></p>
						        		<p>
                                            <textarea name="note" cols="30" rows="10" placeholder="{{ __('words.saySomthing') }}"></textarea>
                                            @if($errors->any('note') && $errors->first('note'))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('note') }}</div>
                                            @endif
                                        </p>
						        	</form>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
                        @php
                            $total = 0;
                        @endphp
						<table class="order-details">
							<thead>
								<tr>
									<th>{{ __('words.yourOrderDetails') }}</th>
									<th>{{ __('words.proPrice') }}</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>{{ __('words.prodecut') }}</td>
									<td>{{ __('words.total') }}</td>
								</tr>
                                @foreach (session()->get('cart') as $cart)
                                <tr>
                                    @if (Session::get('lang') == 'ar')
                                    <td >{{ $cart['nameAr'] }}</td>
                                    @else
                                    <td>{{ $cart['nameEn'] }}</td>
                                    @endif
                                    <td>{{ $cart['price'] }}</td>
                                </tr>
                                @php
                                    $total += $cart['quantity'] * $cart['price']
                                @endphp
                                @endforeach
                                <tr>
									<td>{{ __('words.shippingValue') }}</td>
									<td><span id="selected-content">0</span> {{ __('words.currency') }}</td>
								</tr>
                                <tr>
									<td>{{ __('words.totalPrice') }}</td>
									<td><span id="total">{{ number_format($total, 2, ',')  }} </span></td>
								</tr>
							</tbody>
						</table>
						<button type="submit" form="plaseOrder" class="boxed-btn">{{ __('words.confirmOrder') }}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->
    <script>
            document.getElementById('shippingValue').addEventListener('change', function() {
            const selectedOption = this.value;
            document.getElementById('selected-content').textContent = selectedOption;
            document.getElementById('totalshippingValue').value = selectedOption;
            const totalProdect = parseInt(document.getElementById('totalWithoutSgipping').value);
            const totalshippingValue = parseInt(document.getElementById('totalshippingValue').value) ;
            document.getElementById('total').textContent  = (totalProdect + totalshippingValue).toFixed(2);

        });
    </script>
@endsection





