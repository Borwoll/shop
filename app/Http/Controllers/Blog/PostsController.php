<?php

namespace App\Http\Controllers\Blog;

use App\Entity\Blog\Category;
use App\Entity\Blog\Post\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Comment\CreateRequest;
use App\UseCases\Blog\CategoryService;
use App\UseCases\Blog\CommentService;
use App\UseCases\Blog\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostsController extends Controller
{
    private $postService;
    private $categoryService;
    private $commentService;

    public function __construct(
        PostService $postService,
        CommentService $commentService,
        CategoryService $categoryService,
    )
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
        $this->categoryService = $categoryService;
    }

    public function all()
    {
        $query = $this->postService->getAllPosts();
        $posts = $query->paginate(6);

        return view('blog.posts.all', compact('posts'));
    }

    public function category($slug)
    {
        $category = $this->categoryService->findCategoryBySlug($slug);
        return view('blog.posts.category', compact('category'));
    }

    public function single($id, $slug)
    {
        if (!$post = $this->postService->findPostById($id)) {
            throw new NotFoundHttpException('Post is not found');
        }
        if (!$this->postService->findPostBySlug($id, $slug)) {
            return redirect()->route('blog.posts.single', compact('id', 'slug'));
        }

        $this->postService->view($post);
        return view('blog.posts.single', compact('post'));
    }

    public function search()
    {
        $q = request()->get('q');
        $posts = $this->postService->search(Str::limit($q, 10));

        return view('blog.posts.search', compact('posts'));
    }

    public function like(Request $request)
    {
        $this->middleware('auth');

        if ($request->ajax()) {
            $postId = $request->post('id');
            $post = $this->postService->findPostById($postId);

            $likes = $this->postService->like($post->id, Auth::guard()->id());

            return $likes;
        }
    }

    public function comment(CreateRequest $request, Post $post)
    {
        $this->middleware('auth');

        $this->commentService->create($request, $post, Auth::guard()->id());

        return redirect()->route('blog.posts.single', [
            'id' => $post->id,
            'slug' => $post->slug,
            '#comments'
        ]);
    }
}
