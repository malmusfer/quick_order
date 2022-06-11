@extends('theme::layouts.app')

@section('content')
 
<!-- list area start -->
<section>
    <div class="list-area">
        <div class="container-fluid">
            <div class="map-embed-area">
                <div id="contact-map"></div>
            </div>
        </div>
        <div class="container">
            <div class="row pt-100 pb-100">
                <div class="col-lg-3">
                     <div class="filter-area">
                         <div class="single-filter-area">
                             <div class="search-filter">
                                 <div class="filter-search-title">
                                     <h5>{{ __('Filter By') }}</h5>
                                 </div>
                                 <div class="filter-search-content">
                                     <input type="text" placeholder="Search" id="restaurants_search" class="form-control">
                                 </div>
                             </div>
                             <div class="filter-header">
                                 <h5>{{ __('Select Location') }}</h5>
                             </div>
                             @php
                                $locations=\App\Terms::where('type',2)->where('status',1)->get();
                                $crntid=$info->id ?? 0;
                            @endphp
                             <div class="filter-content">
                                @foreach($locations as $key=> $row)
                                 <div class="form-check">
                                     <input @if($crntid ==$row->id) checked @endif class="form-check-input area" type="checkbox" id="customCheck{{ $key }}" value="{{ $row->id }}" name="area">
                                     <label class="form-check-label" for="customCheck{{ $key }}">
                                       {{ $row->title }} <span class="right"></span>
                                     </label>
                                 </div>
                                 @endforeach
                             </div>
                         </div>
                         <div class="single-filter-area">
                             <div class="filter-header">
                                 <h5>{{ __('Category Lists') }}</h5>
                             </div>
                            @php
                            $categories=\App\Category::where('type',2)->select('id','name')->latest()->get();
                            if (isset($category)) {
                                $cat_row=$category->id;
                            }
                            else{
                            $cat_row='';
                            }
                            @endphp
                             <div class="filter-content">
                                @foreach($categories as $key => $row)
                                 <div class="form-check">
                                     <input class="form-check-input cat" type="checkbox" id="customCheckaa{{ $row->id }}" value="{{ $row->id }}" @if($cat_row == $row->id) checked @endif name="gfg">
                                     <label class="form-check-label" for="customCheckaa{{ $row->id }}">
                                       {{ $row->name }} <span class="right"></span>
                                     </label>
                                 </div>
                                 @endforeach
                             </div>
                         </div>
                     </div>
                </div>
                <div class="col-lg-6">
                     <div class="row" id="resturent_area">
                         
                         
                     </div>
                </div>
                <div class="col-lg-3">
                     <div class="single-find-area text-center rider-area">
                         <div class="find-restaurant-content">
                             <h4>{{ __('I‘ m not Listed!') }}</h4>
                             <p>{{ __('is your restaurant or business not listed on over site') }}
                             </p>
                             <a href="{{ url('rider/register') }}">{{ __('Request For Delivery') }}</a>
                         </div>
                     </div>
                     <div class="single-find-area text-center">
                         <div class="find-restaurant-content">
                             <h4>{{ __('Can’t find a Restaurant?') }}</h4>
                             <p>{{ __("If you can't find the Restaurant that you want to Order, request to add in our list") }}</p>
                             <a href="{{ url('restaurant/register') }}">{{ __('Restaurant Request') }}</a>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- list area end -->
    
<input type="hidden" id="location_slug" value="{{ $slug ?? '' }}">
<input type="hidden" id="baseurl" value="{{ url('/') }}">
<input type="hidden" id="location_id" value="{{ $info->id ?? 00 }}">
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('PLACE_KEY') }}"></script> 
<script type="text/javascript">
    "use strict";
    var current_lat= {{ $lat }};
    var current_long= {{ $long }};
    var current_zoom= {{ $zoom }};
    var default_image= '{{ asset('uploads/store.jpg') }}';
    var resturent_icon= '{{ asset('uploads/location.png') }}';
</script>
<script src="{{ theme_asset('food/public/js/area.js') }}"></script>

@endpush