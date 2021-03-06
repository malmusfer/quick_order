@section('style')
@if (Amcoders\Plugin\Plugin::is_active('WebNotification')) 
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  "use strict";
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: '{{ env('ONESIGNAL_APP_ID') }}',
      notifyButton: {
        enable: true,
      },
      subdomainName: "{{ env('ONESIGNAL_SUB_DOMAIN') }}",
    });
    OneSignal.on('subscriptionChange', function (isSubscribed) {
      OneSignal.getUserId(function(userId) {
       $('#signal_user_id').val(userId);
       $('#hiddenbtn').click();   
     });
    });
  });
</script>
@endif
@endsection
@extends('layouts.backend.app')

@section('content')
<form method="post" id="basicform" action="{{ route('store.subscribe') }}">
  @csrf
  <input type="hidden" name="player_id"  id="signal_user_id" >
  <button type="hidden" class="none" id="hiddenbtn"></button>
</form>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon">
        @if(Auth::user()->status=='approved')
        <img src="{{ asset('uploads/open.png') }}" height="60">
        @else
        <img src="{{ asset('uploads/close.png') }}" height="60">
        @endif
      </div>
      <div class="card-wrap">
        <div class="card-header">
         @if(Auth::user()->status=='approved')
         <h4>{{ __('Resturant Open') }}</h4>
         @else
         <h4>{{ __('Resturant Close') }}</h4>
         @endif
       </div>
       <div class="card-body">
        @if(Auth::user()->status=='approved' || Auth::user()->status=='offline')
        <form action="{{ route('store.status') }}" method="post">
          @csrf

          @if(Auth::user()->status=='approved')
          <input type="hidden" name="status" value="offline">
          <button class="btn btn-danger btn-sm text-white mt-2">{{ __('Turn Off') }}</button>
          @else
          <input type="hidden" name="status" value="approved">
          <button class="btn btn-success btn-sm text-white mt-2">{{ __('Turn On') }}</button>
          @endif
        </form>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon">
      <img src="{{ asset('uploads/money.png') }}" height="60">
    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Total Earnings') }}</h4>
      </div>
      <div class="card-body">
        {{ number_format($totals,2) }}
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon">
      <img src="{{ asset('uploads/salary.png') }}" height="60">

    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Earnings In this Month') }}</h4>
      </div>
      <div class="card-body">
        {{ number_format($earningMonth,2) }}
      </div>
    </div>
  </div>
</div>
@if(Auth::user()->badge)
<div class="col-lg-3 col-md-6 col-sm-6 col-12">
  <div class="card card-statistic-1">
    <div class="card-icon">
      <img height="80" class="rounded pb-1 mb-1" src="{{ asset(Auth::user()->badge->preview->content ?? null) }}">
    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>{{ __('Your Badge') }}</h4>
      </div>
      <div class="card-body">
        {{ Auth::user()->badge->title ?? '' }}
      </div>
    </div>
  </div>
</div>
@endif

@if(!empty($notice))
<div class="col-lg-6 col-md-6 col-12 col-sm-12">
  @else
  <div class="col-lg-12 col-md-12 col-12 col-sm-12"> 
    @endif  

    <div class="card card-primary">
      <div class="card-header">
        <h4>{{ __('Latest Order') }}</h4>
        <div class="card-header-action">
          <a href="{{ route('store.order.index') }}" class="btn btn-primary">View All</a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>{{ __('Order') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Payment Status') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $row)
              <tr>
                <td>
                  {{ __('Order No') }} #{{ $row->id }}
                  <div class="table-links">
                    @if($row->order_type==1)
                    <a href="{{ route('store.order.show',$row->id) }}">{{ __('Home Delivery') }}</a>
                    @else
                    <a href="{{ route('store.order.show',$row->id) }}">{{ __('Pickup') }}</a>
                    @endif
                    <div class="bullet"></div>
                    <a href="{{ route('store.order.show',$row->id) }}">{{ __('View Order') }}</a>
                    <div class="bullet"></div>
                    <a href="{{ route('store.invoice',$row->id) }}">{{ __('Download Invoice') }}</a>
                  </div>
                </td>
                <td>
                  {{ number_format($row->total,2) }}
                </td>
                <td>@if($row->status == 1) 
                  <span class="badge badge-success">{{ __('Completed') }}</span> 
                  @elseif($row->status == 2) 
                  <span class="badge badge-primary"> {{ __('Pending') }} </span>
                   @elseif($row->status == 3) <span class="badge badge-warning"> {{ __('Accepted') }} </span> 
                   @elseif($row->status == 0)  <span class="badge badge-danger"> {{ __('Cancelled') }} </span>
                    @endif</td>


                <td>@if($row->payment_status == 1) 
                  <span class="badge badge-success">{{ __('Completed') }}</span> 
                  @elseif($row->payment_status == 0)  <span class="badge badge-danger"> {{ __('Pending') }} </span> 
                @endif</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $orders->links() }}
        </div>
      </div>
    </div>
  </div>


  @if(!empty($notice))
  @php
  $json=json_decode($notice->value);
  @endphp
  <div class="col-lg-6 col-md-6 col-12 col-sm-12">
    <div class="card card-danger">
      <div class="card-header">
        <h4>{{ __('Announcement') }}</h4>
      </div>
      <div class="card-body">
        <h5>{{ $json->title }}</h5>
        <p>{{ $json->message }}</p>
      </div>
    </div>
  </div>
  @endif

</div>
@endsection

@section('script')

<script src="{{ asset('admin/js/form.js') }}"></script>
<script type="text/javascript">
  "use strict";
  function success(arg) {
    //window.location.reload();
  }
</script>
@endsection