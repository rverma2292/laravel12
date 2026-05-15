<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Query\Builder;

class QueryController extends Controller
{
    public function index(Request $request) {
        echo "===============================<br>";
        echo "Eloquent Queries<br>";
        echo "===============================<br>";

        $post = Post::find(502);
        echo "Post comment count: {$post->loadCount('comments')}<br>";
        echo "===============================<br>";
        echo "Post::all()<br>";
        $blog = Post::where('id', 502)->get();
        print_r($blog);
        echo "===============================<br>";
        $user = User::where('name', 'like', '%test%')->first();
        echo '<pre>'; print_r($user->toArray()); echo '</pre>';
        echo "===============================<br>";
        echo "WhereNull + get() example<br>";
        $collection = User::whereNull('remember_token')
            ->orderBy('name', 'asc')
            ->limit(5)
            ->get()->toArray();
        echo '<pre>'; print_r($collection); echo '</pre>';
        echo "===============================<br>";
        echo "whereIn() example<br>";
        $post = Post::whereIn('id', [2,5,6,1])->get(['title', 'slug']);
        echo '<pre>'; print_r($post->toArray()); echo '</pre>';
        echo "===============================<br>";
        echo "with() example<br>";
        $post = Post::with('category', 'comments', 'likes')->whereIn('id', [2,5,6,1])->get();
        echo '<pre>'; print_r($post->toArray()); echo '</pre>';
        echo "===============================<br>";
        echo "has() example<br>";
        echo $post = Post::has('category')->get()->count()."<br>";
        echo "===============================<br>";
        echo "scope example<br>";
        $post = Post::Published()->limit(10)->get();
        echo '<pre>'; print_r($post->toArray()); echo '</pre>';
        User::where('email', 'test@example.com')->firstOrFail();
        Post::whereDate(date('Y-m-d'))->get();
    }
}
