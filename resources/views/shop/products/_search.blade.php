<div class="product-sidebar">
    <div class="sidebar-filter mt-50">
        <div class="top-filter-head">Фильтры для товаров</div>
        <form action="{{ route('shop.products.search') }}" method="GET">
            <div class="product-search">
                <div class="common-filter">
                    <div>Название</div>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="common-filter">
                    <div>Вес</div>
                    <input type="text" name="weight" class="form-control">
                </div>

                <div class="common-filter">
                    <div>Доступность</div>
                    <select name="availability" class="form-control">
                        <option value="0">Нет в наличии</option>
                        <option value="1">В наличии</option>
                    </select>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
        </form>
    </div>
</div>

<br>
