@extends('layouts.app')
@section('content')
<div class="wrapper fixed__footer">
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Список желаний</h2>
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
                                            <th class="product-thumbnail">Фотография</th>
                                            <th class="product-name"><span class="nobr">Название</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ $item->product->photos()->exists() ? $item->product->photos()->first()->getUrl() : '' }}" alt="" width="100px">
                                                </td>
                                                <td>
                                                    <h6>
                                                        <a href="{{ $item->product ? route('shop.products.single', ['id' => $item->product->id, 'slug' => $item->product->slug]) : '' }}">
                                                            {{ $item->product ? $item->product->title : 'Deleted' }}
                                                        </a>
                                                    </h6>
                                                </td>
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