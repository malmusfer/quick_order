@extends('theme::layouts.app')

@section('content')
@php
$currency=\App\Options::where('key','currency_name')->select('value')->first();
@endphp
<!-- success-alert start -->
<div class="alert-message-area">
	<div class="alert-content">
		<h4 class="ale"></h4>
	</div>
</div>
<!-- success-alert end -->

<!-- error-alert start -->
<div class="error-message-area">
	<div class="error-content">
		<h4 class="error-msg"></h4>
	</div>
</div>
<!-- error-alert end -->

<!-- main area start -->
<section>
	<div class="main-area mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="settings-sidebar-card">
						<div class="profile-show-area text-center">
							<div class="profile-img">
								<img src="{{ asset(Auth::User()->avatar) }}" alt="">
							</div>
							<div class="profile-content">
								<h5>{{ Auth::User()->name }}</h5>
								<span>{{ Auth::User()->email }}</span>
							</div>
						</div>
						<div class="settings-main-menu">
							<nav>
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item" role="presentation">
										<a href="javascript:void(0)" class="active" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
											<i class="fas fa-tachometer-alt"></i> {{ __('Dashboard') }}
										</a>
									</li>
									<li class="nav-item" role="presentation"> 
										<a href="javascript:void(0)" data-bs-toggle="tab" data-bs-target="#orders" role="tab" aria-controls="orders" aria-selected="true">
											<i class="fas fa-clone"></i> {{ __('Orders') }}
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a href="javascript:void(0)" data-bs-toggle="tab" data-bs-target="#settings" role="tab" aria-controls="settings" aria-selected="true">
											<i class="fas fa-cog"></i> {{ __('Settings') }}
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a href="javascript:void(0)" data-bs-toggle="tab" data-bs-target="#rattings" role="tab" aria-controls="rattings" aria-selected="true">
											<i class="fas fa-star"></i> {{ __('Rattings & Reviews') }}
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-toggle="tab">
											<i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								        @csrf
								      </form>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="tab-content">
						<div class="setting-main-area tab-pane fade in active show" id="home">
							<div class="settings-content-area">
								<div class="row">
									@if (\Session::has('error'))
									<div class="col-lg-12">
										<div class="alert alert-danger">
											<ul>
												<li>{!! \Session::get('error') !!}</li>
											</ul>
										</div>
									</div> 
									@endif
									<div class="col-lg-6">
										<div class="single-dashboard-widget d-flex">
											<div class="left-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M20 22H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zM8 7v2h8V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z"/></svg>
											</div>
											<div class="right-area f-right">
												<h5>{{ __('Total Orders') }}</h5>
												<span>{{ App\Order::where('user_id',Auth::User()->id)->count() }}</span>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="single-dashboard-widget d-flex">
											<div class="left-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M11 4h10v2H11V4zm0 4h6v2h-6V8zm0 6h10v2H11v-2zm0 4h6v2h-6v-2zM3 4h6v6H3V4zm2 2v2h2V6H5zm-2 8h6v6H3v-6zm2 2v2h2v-2H5z"/></svg>
											</div>
											<div class="right-area f-right">
												<h5>{{ __('Pending Orders') }}</h5>
												<span>{{ App\Order::where([
													['user_id',Auth::User()->id],
													['status',2]
													])->count() }}</span>
												</div>
											</div>
										</div>
									</div>
									@php
									$orders=\App\Order::where('user_id',Auth::User()->id)->orderBy('id','DESC')->paginate(20)
									@endphp
									<div class="row mt-30">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">{{ __('Order Id') }}</th>
															<th scope="col">{{ __('Payment Method') }}</th>
															<th scope="col">{{ __('Status') }}</th>
															<th scope="col">{{ __('Amount') }}</th>
															<th scope="col">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody>
														@foreach($orders as $order)
														<tr>
															<th>{{ $order->id }}</th>
															<td>{{ $order->payment_method }}</td>
															<td>
																@if($order->status == 2)
																<div class="badge badge-primary">{{ __('pending') }}</div>
																@elseif($order->status == 3)
																<div class="badge badge-info">{{ __('pickup') }}</div>
																@elseif($order->status == 1)
																<div class="badge badge-info">{{ __('complete') }}</div>
																@elseif($order->status == 0)
																<div class="badge badge-danger">{{ __('cancel') }}</div>
																@endif
															</td>
															<td>{{ strtoupper($currency->value) }} {{ $order->total + $order->shipping }}</td>
															<td>
																<div class="order-btn d-flex">
																	@if($order->status == 1)
																	@if(!$order->review()->count() > 0)
																	<a class="view_btn mr-2 btn-send" href="#" data-toggle="modal" data-target="#send_review_{{ $order->id }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"/></svg></a>
																	@endif
																	@endif
																	<a class="view_btn" href="{{ route('author.order.details',encrypt($order->id)) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M1.181 12C2.121 6.88 6.608 3 12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9zM12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg></a>
																</div>
															</td>
														</tr>
														@if($order->status == 1)
														@if(!$order->review()->count() > 0)
														<div class="modal fade" id="send_review_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">{{ __('Send Review') }}</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<form action="{{ route('author.review') }}" method="POST">
																		@csrf
																		<div class="modal-body">
																			<div class="form-group">
																				<label for="ratting" class="col-form-label">{{ __('Select Ratting') }}:</label>
																				<select id="ratting" class="form-control" name="ratting">
																					<option value="5">{{ __('5 Star') }}</option>
																					<option value="4">{{ __('4 Star') }}</option>
																					<option value="3">{{ __('3 Star') }}</option>
																					<option value="2">{{ __('2 Star') }}</option>
																					<option value="1">{{ __('1 Star') }}</option>
																				</select>
																			</div>
																			<input type="hidden" name="vendor_id" value="{{ $order->vendor_id }}">
																			<input type="hidden" name="order_id" value="{{ $order->id }}">
																			<div class="form-group">
																				<label for="review" class="col-form-label">{{ __('Write Review') }}:</label>
																				<textarea class="form-control" id="review" name="review"></textarea>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
																			<button type="submit" class="btn btn-primary">{{ __('Send Review') }}</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
														@endif
														@endif
														@endforeach
													</tbody>
												</table>
											</div>

											{{ $orders->links() }}
										</div>
									</div>
								</div>
							</div>
							<div class="setting-main-area verification_area tab-pane fade" id="orders">
								<div class="settings-content-area">
									<h4>{{ __('Orders') }}</h4>
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">{{ __('Order Id') }}</th>
															<th scope="col">{{ __('Payment Method') }}</th>
															<th scope="col">{{ __('Status') }}</th>
															<th scope="col">{{ __('Amount') }}</th>
															<th scope="col">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody>
														@foreach($orders as $order)
														<tr>
															<th>{{ $order->id }}</th>
															<td>{{ $order->payment_method }}</td>
															<td>
																@if($order->status == 2)
																<div class="badge badge-primary">{{ __('pending') }}</div>
																@elseif($order->status == 3)
																<div class="badge badge-info">{{ __(
																'pickup') }}</div>
																@elseif($order->status == 1)
																<div class="badge badge-info">{{ __('complete') }}</div>
																@elseif($order->status == 0)
																<div class="badge badge-danger">{{ 
																__('cancel') }}</div>
																@endif
															</td>
															<td>{{ strtoupper($currency->value) }}{{ $order->total + $order->shipping }}</td>
															<td>
																<div class="order-btn d-flex">
																	@if($order->status == 1)
																	@if(!$order->review()->count() > 0)
																	<a class="view_btn mr-2 btn-send" href="#" data-toggle="modal" data-target="#send_review{{ $order->id }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"/></svg></a>
																	@endif
																	@endif
																	<a class="view_btn" href="{{ route('author.order.details',encrypt($order->id)) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M1.181 12C2.121 6.88 6.608 3 12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9zM12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg></a>
																</div>
															</td>
														</tr>
														@if($order->status == 1)
														@if(!$order->review()->count() > 0)
														<div class="modal fade" id="send_review{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">{{ __('Send Review') }}</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<form action="{{ route('author.review') }}" method="POST">
																		@csrf
																		<div class="modal-body">
																			<div class="form-group">
																				<label for="ratting" class="col-form-label">{{ __('Select Ratting') }}:</label>
																				<select id="ratting" class="form-control" name="ratting">
																					<option value="5">{{ __('5 Star') }}</option>
																					<option value="4">{{ __('4 Star') }}</option>
																					<option value="3">{{ __('3 Star') }}</option>
																					<option value="2">{{ __('2 Star') }}</option>
																					<option value="1">{{ __('1 Star') }}</option>
																				</select>
																			</div>
																			<input type="hidden" name="vendor_id" value="{{ $order->vendor_id }}">
																			<input type="hidden" name="order_id" value="{{ $order->id }}">
																			<div class="form-group">
																				<label for="review" class="col-form-label">{{ __('Write Review') }}:</label>
																				<textarea class="form-control" id="review" name="review"></textarea>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
																			<button type="submit" class="btn btn-primary">{{ __('Send Review') }}</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
														@endif
														@endif
														@endforeach
													</tbody>
												</table>
											</div>
											{{ $orders->links() }}
										</div>
									</div>
								</div>
							</div>
							<div class="setting-main-area verification_area tab-pane fade" id="settings">
								<div class="settings-content-area">
									<h4>{{ __('Settings') }}</h4>
									<form action="{{ route('author.settings.update') }}" method="POST" id="user_settings_form">
										@csrf
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="name">{{ __('Name') }}</label>
													<input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" id="name" value="{{ Auth::User()->name }}">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="email">{{ __('Email') }}</label>
													<input type="text" class="form-control" name="email" placeholder="{{ __('Email') }}" id="email" value="{{ Auth::User()->email }}">
												</div>
											</div>
											<div class="col-lg-12">
												<h5>{{ __('Password Change') }}</h5>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label for="current_password">{{ __('Current Password') }}</label>
													<input type="password" class="form-control" placeholder="{{ __('Current Password') }}" name="current_password" id="current_password">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="new_password">{{ __('New Password') }}</label>
													<input type="password" class="form-control" placeholder="{{ __('New Password') }}" name="password" id="new_password">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="confirm_password">{{ __('Confirm Password') }}</label>
													<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="confirm_password">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="btn-submit f-right">
													<button type="submit">{{ __('Update') }}</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="setting-main-area verification_area tab-pane fade" id="rattings">
								<div class="settings-content-area">
									<h4>{{ __('Rattings & Reviews') }}</h4>
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">#</th>
															<th scope="col">{{ __('Resturant Name') }}</th>
															<th scope="col">{{ __('Ratting') }}</th>
															<th scope="col">{{ __('Review') }}</th>
															<th scope="col">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody>
														@foreach(Auth::User()->user_reviews as $key=>$review)
														<tr>
															<th>{{ $key + 1 }}</th>
															<td><a target="__blank" href="{{ url('store',App\User::find($review->vendor_id)->slug) }}">{{ App\User::find($review->vendor_id)->name }}</a></td>
															<td>{{ $review->comment_meta->star_rate }} {{ __('Star') }}</td>
															<td>{{ Str::limit($review->comment_meta->comment,20) }}</td>
															<td><a class="view_btn" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M1.181 12C2.121 6.88 6.608 3 12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9zM12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg></a></td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- main area end -->
	@endsection