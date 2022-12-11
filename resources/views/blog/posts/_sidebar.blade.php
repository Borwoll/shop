<div class="col-lg-4">
    <div class="blog_right_sidebar">
        <aside class="single_sidebar_widget search_widget">
            <div class="input-group">
                <form action="{{ route('blog.posts.search') }}" method="GET">
                    <input type="text" class="form-control" placeholder="Search Posts" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'" name="q">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                </span>
                </form>
            </div><!-- /input-group -->
            <div class="br"></div>
        </aside>

        <aside class="single_sidebar_widget ads_widget">
            <a href="#"><img class="img-fluid" src="/img/blog/add.jpg" alt=""></a>
            <div class="br"></div>
        </aside>

        {{ Widget::run(\App\Widget\Blog\CategoriesWidget::class) }}
    </div>
</div>