@extends('theme::layouts.app')

@section('content')
<div class="confirm-area mt-150 mb-150">
	<div class="container">
		<div class="row mt-50">
			<div class="col-lg-6 offset-lg-3">
				<div class="confirmation-page text-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414 1.414L11.003 16z"/></svg>
					<div class="order-confirm">
						<h4>{{ __('Your Order is Confirmed') }}</h4>
						<a href="{{ route('author.dashboard') }}">{{ __('View Order') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection