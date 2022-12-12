<div class="category-search-area">
    <form action="{{ route('blog.posts.search') }}" method="GET" id="search_post_form">
        <input type="text" placeholder="Поиск......" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Поиск......'" name="q">
        <a class="srch-btn" href="#" onclick="document.getElementById('search_post_form').submit()"><i class="zmdi zmdi-search"></i></a>   
    </form>
</div>
<br>
{{ Widget::run(\App\Widget\Blog\CategoriesWidget::class) }}