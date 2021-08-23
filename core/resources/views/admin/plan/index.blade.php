@extends('admin.layouts.app')

@section('panel')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Sl')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Business Volume (BV)')</th>
                                <th scope="col">@lang('Referral Commission')</th>
                                <th scope="col">@lang('Tree Commission')</th>
                                <th scope="col">@lang('Daily Commission')</th>
                                <th scope="col">@lang('Weekly Commission')</th>
                                <th scope="col">@lang('Monthly Commission')</th>
                                <th scope="col">@lang('Max Deposit')</th>
                                <th scope="col">@lang('Min Deposit')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($plans as $key => $plan)
                                <tr>
                                    <td data-label="@lang('Sl')">{{$key+1}}</td>
                                    <td data-label="@lang('Name')">{{ __($plan->name) }}</td>
                                    <td data-label="@lang('Bv')">{{ $plan->bv }}</td>
                                    <td data-label="@lang('Referral Commission')"> {{ getAmount($plan->ref_com) }} {{$general->cur_text}}</td>

                                    <td data-label="@lang('Tree Commission')">
                                       {{ getAmount($plan->tree_com) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Daily Commission')">
                                       {{ getAmount($plan->daily_com) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Weekly Commission')">
                                       {{ getAmount($plan->weekly_com) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Monthly Commission')">
                                       {{ getAmount($plan->monthly_com) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Min Amount')">
                                       {{ getAmount($plan->min_amount) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Max Amount')">
                                       {{ getAmount($plan->max_amount) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($plan->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                            <span class="text--small badge font-weight-normal badge--danger">@lang('Inactive')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                                data-id="{{ $plan->id }}"
                                                data-name="{{ $plan->name }}"
                                                data-status="{{ $plan->status }}"
                                                data-bv="{{ $plan->bv }}"
                                                data-ref_com="{{ getAmount($plan->ref_com) }}"
                                                data-tree_com="{{ getAmount($plan->tree_com) }}"
                                                data-daily_com="{{ getAmount($plan->daily_com) }}"
                                                data-weekly_com="{{ getAmount($plan->weekly_com) }}"
                                                data-monthly_com="{{ getAmount($plan->monthly_com) }}"
                                                data-min_amount="{{ getAmount($plan->min_amount) }}"
                                                data-max_amount="{{ getAmount($plan->max_amount) }}"
                                                data-original-title="Edit">
                                            <i class="la la-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $plans->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>


{{--    edit modal--}}
    <div id="edit-plan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Plan')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form method="post" action="{{route('admin.plan.update')}}">
                    @csrf
                    <div class="modal-body">

                        <input class="form-control plan_id" type="hidden" name="id">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Name') :</label>
                                <input class="form-control name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Business Volume (BV)')</label>
                            <input class="form-control bv" name="bv" required>
                            <small class="text--red">@lang('When someone buys this plan, all of his ancestors will get this value which will be used for a matching bonus.')</small>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Referral Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                    class="input-group-text">{{$general->cur_sym}} </span></div>
                                    <input type="text" class="form-control  ref_com" name="ref_com"
                                    required>
                                    <small class="text--red">@lang('If a user who subscribed to this plan, refers someone and if the referred user buys a plan, then he will get this amount.')</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Tree Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  tree_com" name="tree_com"
                                    required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, all of his ancestors will get this amount.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Daily Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  daily_com" name="daily_com"
                                    required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet daily.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Weekly Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  weekly_com" name="weekly_com"
                                    required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet weekly.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Monthly Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  monthly_com" name="monthly_com"
                                    required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet monthly.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Min Amount')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  min_amount" name="min_amount"
                                    required>
                            </div>
                            <small class="small text--red">@lang('Set The Minimum Deposit Amount to Purchase This Plan')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Max Amount')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  max_amount" name="max_amount"
                                    required>
                            </div>
                            <small class="small text--red">@lang('Set The Maximum Deposit Amount to Purchase This Plan')</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Status')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Inactive')" name="status" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn--primary">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="add-plan" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New plan')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.plan.store')}}">
                    @csrf
                    <div class="modal-body">

                        <input class="form-control plan_id" type="hidden" name="id">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Name') :</label>
                                <input type="text" class="form-control " name="name"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Business Volume (BV)')</label>
                            <input class="form-control " type="number" min="0" name="bv" required>

                            <small class="text--red">@lang('If a user who subscribed to this plan, refers someone and if the referred user buys a plan, then he will get this amount.')</small>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Referral Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="ref_com" required>
                                <small class="small text--red">@lang('If a user who subscribed to this plan, refers someone and if the referred user buys a plan, then he will get this amount.')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Tree Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="tree_com" required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, all of his ancestors will get this amount.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Daily Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="daily_com" required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet daily.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Weekly Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="weekly_com" required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet weekly.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Monthly Commission')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="monthly_com" required>
                            </div>
                            <small class="small text--red">@lang('When someone buys this plan, He will get this amount comission added to his wallet monthly.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Min Amount')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="min_amount" required>
                            </div>
                            <small class="small text--red">@lang('Set The Minimum Deposit Amount to Purchase This Plan.')</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Max Amount')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="max_amount" required>
                            </div>
                            <small class="small text--red">@lang('Set The Maximum Deposit Amount to Purchase This Plan.')</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Status')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Inactive')" name="status" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-block btn btn--primary">@lang('Submit')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection



@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--success add-plan"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>

@endpush

@push('script')
    <script>
        "use strict";
        (function ($) {
            $('.edit').on('click', function () {
                var modal = $('#edit-plan');
                modal.find('.name').val($(this).data('name'));
                modal.find('.bv').val($(this).data('bv'));
                modal.find('.ref_com').val($(this).data('ref_com'));
                modal.find('.tree_com').val($(this).data('tree_com'));
                modal.find('.daily_com').val($(this).data('daily_com'));
                modal.find('.weekly_com').val($(this).data('weekly_com'));
                modal.find('.monthly_com').val($(this).data('monthly_com'));
                modal.find('.min_amount').val($(this).data('min_amount'));
                modal.find('.max_amount').val($(this).data('max_amount'));
                modal.find('input[name=daily_ad_limit]').val($(this).data('daily_ad_limit'));

                if($(this).data('status')){
                    modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
                    modal.find('input[name="status"]').prop('checked',true);

                }else{
                    modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
                    modal.find('input[name="status"]').prop('checked',false);
                }

                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.add-plan').on('click', function () {
                var modal = $('#add-plan');
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

