@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "orders";
        $subActive = 'orders_all';
        $title = 'All Orders';
        $bread = ['Orders' ,'active' => 'All Orders'];
    @endphp
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#printer').click(function (){
                console.log('clicked')
                printDiv('printableArea');
                location.reload();
            });
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        })
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h2>Invoice</h2>
                </div>
                <div class="col">
                    <button type="button" id="printer" class="btn btn-primary shadow-md-primary">Print</button>
                </div>
                <div class="col-md-4">
                    <h5 class="">Order Status</h5>
                    @php
                        if($order->status == 'pending'){
                            $status = 'warning';
                        } elseif ($order->status == 'approved') {
                            $status = 'primary';
                        } elseif ($order->status == 'shipped') {
                            $status = 'info';
                        } elseif ($order->status == 'completed') {
                            $status = 'success';
                        }
                    @endphp
                    <div class="col-5">
                        <p class="alert text-center alert-{{ $status }} p-1 m-0">{{ $order->status }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="">Mark This Order As</h5>
                    <form class="mb-1 d-flex flex-row justify-content-center"
                          action="/order/{{$order->id}}" method="post">
                        @csrf @method('PUT')

                        <input type="hidden" value="{{auth()->user()->id}}" name="updated_by">

                        <select name="status" class="form-control d-block mr-2 shadow-sm">
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                        </select>
                        <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                            <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="printableArea" class="container bg-white rounded-lg shadow-md p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-title">
                        <h3 class="pull-right">Order # 12345</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>Order By:</strong><br>
                                {{ $order->createdBy->profile->user_name }}<br>
                                Vat No: {{ $order->createdBy->profile->vat_no }}<br>
                                Company No: {{ $order->createdBy->profile->company_number }}<br>
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>Shipped To:</strong><br>
                                {{ $order->shipping_address }}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>Fulfilment Method:</strong><br>
                                Manual
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ $order->created_at->format('F j, Y') }}<br>
                                {{ $order->created_at->toTimeString() }}
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td class="text-center">${{$product->perUnit()}}</td>
                                            <td class="text-center">{{$order->orderQtty($product->id)}}</td>
                                            <td class="text-right">
                                                ${{$order->perTotal( $product->perUnit(), $order->orderQtty($product->id) )}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Others</strong></td>
                                        <td class="no-line text-right">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">${{$order->orderTotal()}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
