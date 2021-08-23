@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title font-weight-normal">@lang('Referrer Link')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <labelclass="card-title font-weight-normal" >Select User:</label>
                        <select onchange="myFunction()" style="width:100%;" class="align-items-center" id="user" value="Mickey">
                            @foreach($bvs as $bv)
                                <option value="{{$bv->id}}">{{$bv->username}}</option>
                            @endforeach
                    </select>                        
                    </div>
                    </div><br>
                    <h4 class="card-title font-weight-normal">@lang('Join left')</h4>
                    <form id="copyBoard" >
                        <div class="form-row align-items-center">
                            <div class="col-md-10 my-1">
                                <input value="{{route('user.register')}}/?ref={{auth()->user()->username}}&position=left" id="ref_pre" type="hidden">
                                <input value="" type="url" id="ref" class="form-control from-control-lg" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button   type="button" @click="copyBtnClick" data-copytarget="#ref" id="copybtn" class="btn btn--primary btn-block"> <i class="fa fa-copy"></i> @lang('Copy')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <h4 class="card-title font-weight-normal">@lang('Join right')</h4>
                    <form id="copyBoard2" >
                        <div class="form-row align-items-center">
                            <div class="col-md-10 my-1">
                                <input type="hidden" value="{{route('user.register')}}?ref={{auth()->user()->username}}&position=right" id="ref2_pre">
                                <input value="" type="url" id="ref2" class="form-control from-control-lg" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button   type="button" @click="copyBtnClick" data-copytarget="#ref2" id="copybtn2" class="btn btn--primary btn-block"> <i class="fa fa-copy"></i> @lang('Copy')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 ">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">

                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Sl')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Join Date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $key=>$data)
                                <tr>
                                    <td data-label="@lang('Sl')" >{{$logs->firstItem()+$key}}</td>
                                    <td data-label="@lang('Username')">{{$data->username}}</td>
                                    <td data-label="@lang('Name')">{{$data->fullname}}</td>
                                    <td data-label="@lang('Email')">{{printEmail($data->email)}}</td>
                                    <td data-label="@lang('Join Date')">
                                        @if($data->created_at != '')
                                        {{ showDateTime($data->created_at) }}
                                        @else
                                        @lang('Not Assign')
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $logs->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

        <script>
            function myFunction() {
              var user = document.getElementById("user").value;
              var ref = document.getElementById("ref_pre").value;
              var ref2 = document.getElementById("ref2_pre").value;
              document.getElementById("ref").value = ref+"&bv="+user;
              document.getElementById("ref2").value = ref2+"&bv="+user;
              
              return false;
            }
        </script>

@endsection

@push('script')

    <script>
        'use strict';
        (function($) {
            document.body.addEventListener('click', copy, true);
            function copy(e) {
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);
                if (inp && inp.select) {
                    inp.select();
                    try {
                        document.execCommand('copy');
                        inp.blur();
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }catch (err) {
                        alert(`@lang('Please press Ctrl/Cmd+C to copy')`);
                    }
                }
            }
        })(jQuery);
    </script>

@endpush
