@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.cart') }}
@endsection

@section("content")
    <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>{{ __('words.Yourcart') }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
            @if($errors->any('quantity') && $errors->first('quantity'))
                <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
            @endif
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
                                    <th class="product-imagee">{{ __('words.proImage') }}</th>
									<th class="product-name">{{ __('words.proName') }}</th>
									<th class="product-price">{{ __('words.proPrice') }}</th>
									<th class="product-quantity">{{ __('words.proQuantity') }}</th>
									<th class="product-total">{{ __('words.total') }}</th>
								</tr>
							</thead>
							<tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach (session()->get('cart') as $cart)
                                    <tr class="table-body-row">
                                        <td class="product-remove"><a href="{{route('cart.reomve',$cart['id'])}}"><i class="far fa-window-close"></i></a></td>
                                        <td class="product-imagee"><img src="{{ $cart['image'] }}" alt=""></td>
                                        @if (Session::get('lang') == 'ar')
                                            <td class="product-name">{{ $cart['nameAr'] }}</td>
                                        @else
                                            <td class="product-name">{{ $cart['nameEn'] }}</td>
                                        @endif
                                        <td class="product-price">{{ $cart['price'] }}</td>
                                        <td class="product-quantity"><input type="number" data-rowid="{{ $cart['id'] }}" name="quantity" value="{{ $cart['quantity'] }}" onchange="updateCartQuantity(this)" min="0"></td>
                                        <td class="product-total">{{  $cart['quantity'] * $cart['price'] }}</td>
                                        </tr>
                                        @php
                                            $total += $cart['quantity'] * $cart['price']
                                        @endphp
                                @endforeach
                                <tr>
                                    <td colspan="5">{{ __('words.totalPrice') }}</td>
                                    <td colspan="1">{{ number_format($total, 3, '.', ',')  }} {{ __('words.currency')}}</td>
                                </tr>
							</tbody>
						</table>
                        <div class="cart-buttons text-center">
							<a href="{{ route('cart.checkout') }}" class="boxed-btn black">{{ __('words.checkOut') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->
    <form id="updateCart" action="{{ route('cart.update') }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="rowid" id="rowid">
        <input type="hidden" name="quantity" id="quantity">
    </form>
    {{ session()->forget('errors') }}
@endsection
<script>
    function updateCartQuantity(qty) {
        // Access the row ID and quantity using data attributes
        const rowId = qty.dataset.rowid;
        const quantity = qty.value;

        // Set values for the corresponding form fields
        document.getElementById('rowid').value = rowId;
        document.getElementById('quantity').value = quantity;

        // Submit the form with ID "updateCart"
        document.getElementById('updateCart').submit();
    }
</script>




