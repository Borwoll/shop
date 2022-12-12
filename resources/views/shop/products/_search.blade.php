<div class="product-sidebar">
    <div class="sidebar-filter mt-50">
        <h4 class="section-title-4">Фильтры</h4>
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
                        <option value="out-of-stock">Нет в наличии</option>
                        <option value="in-stock" selected>В наличии</option>
                    </select>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
        </form>
    </div>
</div>

<br>
