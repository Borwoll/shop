@extends('layouts.app')
@section('content')
<div class="wrapper fixed__footer">
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Сравнение товаров</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wishlist-area bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wishlist-content">
                        <form action="#">
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Характеристика</th>
                                            @foreach ($user->comparisonItems as $item)
                                                <th>
                                                    <p>
                                                        {{ $item->product->title }} {{ $item->product->category()->exists() ? "(" . $item->product->category->name . ")" : '' }}
                                                    </p>
                                                    <img src="{{ $item->product->photos()->exists() ? $item->product->photos()->first()->getUrl() : '' }}" alt="" width="100px">
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($characteristics as $characteristicId => $characteristic)
                                            <tr>
                                                <td>{{ $characteristic->name }}</td>
                                                @foreach ($user->comparisonItems as $item)
                                                    @foreach ($item->product->characteristics->where('characteristic_id', $characteristicId) as $characteristicItem)
                                                        <td class="green">
                                                            {{ $characteristicItem->variant ? $characteristicItem->variant->name : $characteristicItem->characteristic->default }}
                                                        </td>
                                                    @endforeach

                                                    @if (!$item->product->characteristics()->where('characteristic_id', $characteristicId)->exists())
                                                        <td class="red">Empty</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection