<!-- breadcumb -->
<section class="page_title corner-title overflow-visible">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{__('msg.checkout_summary')}}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{__('msg.home')}}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{__('msg.checkout_summary')}}
                    </li>
                </ol>
                <div class="divider-15 d-none d-xl-block"></div>
            </div>
        </div>
    </div>
</section>
<!-- eof breadcumb -->
<div class="main-content">
    <section class="checkout-section ptb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12 mb-4">
                    <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded account-sidebar account-tab mb-sm-30">
                        <div class="dark-bg tab-title-bg">
                            <div class="heading-part">
                                <div class="sub-title text-center"><span></span><em class="far fa-user"></em> {{__('msg.my_account')}}</div>
                            </div>
                        </div>
                        <div class="account-tab-inner">
                            <ul class="account-tab-stap">
                                <li class="active">
                                    <a href="#"><em class="fas fa-wallet"></em>{{__('msg.cart')}}<em class="fa fa-angle-right"></em></a>
                                </li>
                                <li>
                                    <a><em class="fas fa-wallet"></em>{{__('msg.Address')}}<em class="fa fa-angle-right"></em></a>
                                </li>
                                <li>
                                    <a><em class="far fa-heart"></em>{{__('msg.checkout_summary')}}<em class="fa fa-angle-right"></em></a>
                                </li>
                                <li>
                                    <a><em class="fas fa-digital-tachograph"></em>{{__('msg.payment')}}<em class="fa fa-angle-right"></em></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div id="data-step1" class="account-content" data-temp="tabdata">

                            <div class=" cart-main-content pb-2 pb-lg-5">
                                <div class="outer_box px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded mb-3">
                                    <div class="section_title d-flex mb-3 align-items-baseline border-bottom">
                                        <h2>
                                           <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{__('msg.Order Summary')}}</span>
                                        </h2>
                                     </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="table_description">
                                                <div class="cart_page-content">
                                                    <table aria-describedby="cart-table">
                                                        <thead>
                                                            <tr class="cart-header">
                                                                <th scope="col" class="header_product_thumb">{{__('msg.Image')}}</th>
                                                                <th scope="col" class="header_product_name">{{__('msg.product')}}</th>
                                                                <th scope="col" class="header_product-price">{{__('msg.price')}}</th>
                                                                <th scope="col" class="header_product_quantity">{{__('msg.qty')}}</th>
                                                                <th scope="col" class="header_product_total">{{__('msg.subtotal')}}</th>
                                                                <th scope="col" class="header_product_total">{{__('msg.action')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @php $ready_to_checkout = '1'; @endphp
                                                            @if(isset($data['cart']['cart']['data']) && is_array($data['cart']['cart']['data']) && count($data['cart']['cart']['data']))

                                                            @foreach($data['cart']['cart']['data'] as $p)
                                                            @if(isset($p->item[0]))
                                                            @php
                                                            if(isset($p->qty) &&  ($p->qty) > 0){
                                                            $qty = $p->qty;
                                                            }else{
                                                            $qty = $data['cart']['cart_session'][$p->product_variant_id]['quantity'];
                                                            }
                                                            @endphp

                                                            <tr>
                                                                <td class="header_product_thumb">
                                                                    <span class="cart__page">{{__('msg.Image')}}</span>
                                                                    <a href="#"><img class="lazy" data-original="{{ $p->item[0]->image }}" alt=""></a>
                                                                </td>
                                                                <td class="header_product_name">
                                                                    <span class="cart__page pt-3">{{__('msg.product')}}</span>
                                                                    @if(($p->item[0]->is_item_deliverable == false) && (Cache::get('pincode_no') == true))
                                                                    <p class="deliver_notice">{{__('msg.Not Deliverable for')}} {{ Cache::get('pincode_no') }}</p>
                                                                    @php $ready_to_checkout = '0'; @endphp
                                                                    @endif
                                                                    <a href="#">{{ strtoupper($p->item[0]->name) ?? '-' }}</a>
                                                                    <p class="small text-muted text-center">{{ get_varient_name($p->item[0]) }}
                                                                        @if(intval($p->item[0]->discounted_price))
                                                                        ({{intval($p->item[0]->discounted_price)}} X {{($qty ?? 1)}})
                                                                        @else
                                                                        ({{intval($p->item[0]->price)}} X {{($qty ?? 1)}})
                                                                        @endif
                                                                        <br>{{ __('msg.tax')." (".$p->item[0]->tax_percentage  }}% {{ $p->item[0]->tax_title  }})
                                                                    </p>
                                                                </td>
                                                                <td class="header_product-price">
                                                                    <span class="cart__page">{{__('msg.price')}}</span>
                                                                    @if(intval($p->item[0]->discounted_price))
                                                                    @if (isset($p->item[0]->tax_percentage) && $p->item[0]->tax_percentage > 0)
                                                                    {{ $p->item[0]->discounted_price+($p->item[0]->discounted_price*$p->item[0]->tax_percentage/100) ?? '' }}
                                                                    @else
                                                                    {{ $p->item[0]->discounted_price ?? '' }}
                                                                    @endif
                                                                    @else
                                                                    @if (isset($p->item[0]->tax_percentage) && $p->item[0]->tax_percentage > 0)
                                                                    {{ $p->item[0]->price+($p->item[0]->price*$p->item[0]->tax_percentage/100) ?? '' }}
                                                                    @else
                                                                    {{ $p->item[0]->price ?? '' }}
                                                                    @endif
                                                                    @endif
                                                                </td>
                                                                <td class="cart sep_cart">
                                                                    <span class="cart__page">{{__('msg.qty')}}</span>
                                                                    <div class="price-wrap cartShow">{{ $qty??1 }}</div>
                                                                    <form action="{{ route('cart-update-cartpage', $p->product_id) }}" method="POST" class="cartEdit">
                                                                        @csrf
                                                                        <input type="hidden" name="child_id" value="{{ $p->product_variant_id }}">
                                                                        <input type="hidden" name="product_id" value="{{ $p->product_id }}">
                                                                        <div class="button-container col pr-0 my-1">
                                                                            <button class="cart-qty-minus button-minus" type="button" id="button-minus{{$p->product_id}}" value="-">-</button>
                                                                            <input class="form-control qtyPicker" type="number" name="qty" data-min="1" min="1" max="{{ intval(getMaxQty($p->item[0])) }}" data-max="{{ intval(getMaxQty($p->item[0])) }}" data-max-allowed="{{ Cache::get('max_cart_items_count') }}" value="{{ $qty??1 }}" readonly>
                                                                            <button class="cart-qty-plus button-plus" type="button" id="button-plus{{$p->product_id}}" value="+">+</button>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td class="header_product_total">
                                                                    <span class="cart__page">{{__('msg.subtotal')}}</span>
                                                                    @if(intval($p->item[0]->discounted_price))
                                                                    @if (isset($p->item[0]->tax_percentage) && $p->item[0]->tax_percentage > 0)
                                                                    {{ ($p->item[0]->discounted_price+($p->item[0]->discounted_price*$p->item[0]->tax_percentage/100)) * ($qty ?? 1) }}
                                                                    @else
                                                                    {{ $p->item[0]->discounted_price * ($qty ?? 1) }}
                                                                    @endif
                                                                    @else
                                                                    @if (isset($p->item[0]->tax_percentage) && $p->item[0]->tax_percentage > 0)
                                                                    {{ ($p->item[0]->price+($p->item[0]->price*$p->item[0]->tax_percentage/100)) * ($qty ?? 1) }}
                                                                    @else
                                                                    {{ $p->item[0]->price * ($qty ?? 1) }}
                                                                    @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span class="cart__page">{{__('msg.action')}}</span>
                                                                    <button class="btn btn-light btn-round btnEdit cartShow">
                                                                        <em class="fa fa-pencil-alt"></em>
                                                                    </button>
                                                                    <button class="btn btn-light btn-round cartSave cartEdit cartEditmini">
                                                                        <em class="fas fa-check"></em>
                                                                    </button>
                                                                    <button class="btn btn-light btn-round btnEdit cartEdit cartEditmini">
                                                                        <em class="fa fa-times"></em>
                                                                    </button>
                                                                    <a href="{{ route('cart-remove-cartpage', $p->product_variant_id ) }}" class="btn btn-light btn-round"> <em class="fas fa-trash-alt"></em></a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    <img class="lazy" data-original="{{ asset('images/empty-cart.png') }}" alt="No Items In Cart">
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="cart_submit">
                                                    <a href="{{ route('shop') }}" class="btn cart_shopping"><em class="fas fa-angle-double-left"></em>&nbsp;&nbsp;{{__('msg.Continue Shopping')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if(isset($data['cart']['cart']['data']) && is_array($data['cart']['cart']['data']) && count($data['cart']['cart']['data']))
                                    <div class="col-12 float-right">
                                        <div class="outer_box px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded">
                                            <div class="grand-total-content">
                                                <div class="title-wrap">
                                                    <h4 class="cart-bottom-title section-bg-gary-cart">{{__('msg.Cart Total')}}</h4>
                                                </div>
                                                <h5>{{__('msg.subtotal')}} : <span>{{ get_price(sprintf("%0.2f",$data['cart']['subtotal'] ?? '-')) }}</span></h5>
                                                @if(isset($data['cart']['cart']) && is_array($data['cart']['cart']) && count($data['cart']['cart']))
                                                <td colspan="" class="text-end checkoutbtn">
                                                    @if(Cache::has('min_order_amount') && intval($data['cart']['subtotal']) >= intval(Cache::get('min_order_amount')))
                                                    @if(Cache::has('pincode'))
                                                    @if($ready_to_checkout == '1')
                                                    @if(isLoggedIn())
                                                    <a href="{{ route('checkout-address') }}" class="btn btn-primary">{{__('msg.checkout')}}
                                                        <em class="fa fa-arrow-right"></em>
                                                    </a>
                                                    @else
                                                    <a class="btn btn-primary login-popup">{{__('msg.checkout')}}
                                                        <em class="fa fa-arrow-right"></em>
                                                    </a>
                                                    @endif
                                                    @else
                                                    <a class="btn btn-primary checkout-dbutton">{{__('msg.checkout')}}
                                                        <em class="fa fa-arrow-right"></em>
                                                    </a>
                                                    @endif
                                                    @else
                                                    <a class="btn btn-primary checkout-spincode-button">{{__('msg.checkout')}}
                                                        <em class="fa fa-arrow-right"></em></a>
                                                    @endif
                                                    @else
                                                    <a href="" class="btn btn-primary" disabled>{{__('msg.checkout')}}
                                                        <em class="fa fa-arrow-right"></em>
                                                    </a>
                                                    @endif
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>